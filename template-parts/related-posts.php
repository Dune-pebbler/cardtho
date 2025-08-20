<?php

/**
 * Template part for displaying related posts
 * 
 * Displays related products based on shared product categories
 */

// Get current post ID
$current_post_id = get_the_ID();

// Check for manually selected related products
$manual_related_products = get_field('manual_related_products', $current_post_id);

// Default settings
$posts_per_page = 4; // Show 4 related posts by default
$i = 3; // Animation delay counter
$related_products = [];

if (!empty($manual_related_products)) {
    // Use manually selected products
    $related_products = $manual_related_products;
    
    // If manual selection has fewer than 4 products, fill remaining spots with automatic selection
    if (count($related_products) < $posts_per_page) {
        $remaining_spots = $posts_per_page - count($related_products);
        
        // Get IDs of manually selected products to exclude them from automatic selection
        $manual_product_ids = array_map(function($product) {
            return $product->ID;
        }, $manual_related_products);
        
        // Add current post ID to exclusion list
        $exclude_ids = array_merge($manual_product_ids, array($current_post_id));
        
        // Get automatic products to fill remaining spots
        $current_categories = wp_get_post_terms($current_post_id, 'product-groep', array('fields' => 'ids'));
        
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => $remaining_spots,
            'post__not_in'   => $exclude_ids,
            'orderby'        => 'rand',
        );

        if (!empty($current_categories)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product-groep',
                    'field'    => 'term_id',
                    'terms'    => $current_categories,
                    'operator' => 'IN',
                ),
            );
        }

        $auto_query = new WP_Query($args);
        
        if ($auto_query->have_posts()) {
            while ($auto_query->have_posts()) {
                $auto_query->the_post();
                $related_products[] = get_post();
            }
            wp_reset_postdata();
        }
    }
} else {
    // Use automatic selection based on product categories
    $current_categories = wp_get_post_terms($current_post_id, 'product-groep', array('fields' => 'ids'));
    
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $posts_per_page,
        'post__not_in'   => array($current_post_id), 
        'orderby'        => 'rand', 
    );

    if (!empty($current_categories)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product-groep',
                'field'    => 'term_id',
                'terms'    => $current_categories,
                'operator' => 'IN',
            ),
        );
    }

    $related_query = new WP_Query($args);
    
    if ($related_query->have_posts()) {
        while ($related_query->have_posts()) {
            $related_query->the_post();
            $related_products[] = get_post();
        }
        wp_reset_postdata();
    }
}

// Only display section if we have related products
if (!empty($related_products)) : ?>

<section class="related-posts">
    <div class="container">
        <div class="row row-gap-2">
            <div class="col-12">
                <h2 class="text-center" data-animate="fade-up" data-animate-delay="100">
                    Gerelateerde producten
                </h2>
            </div>
            
            <?php foreach ($related_products as $related_product) : 
                $is_orderable = get_field('bestelbaar', $related_product->ID) ?? true;
                
                $post_args = array(
                    'title' => get_the_title($related_product->ID),
                    'description' => get_the_excerpt($related_product->ID),
                    'image' => array(
                        'url' => get_the_post_thumbnail_url($related_product->ID, 'medium'),
                        'alt' => get_post_meta(get_post_thumbnail_id($related_product->ID), '_wp_attachment_image_alt', true)
                    ),
                    'link' => array(
                        'url' => get_permalink($related_product->ID),
                        'title' => 'Bekijken'
                    ),
                    'button' => true,
                    'is_orderable' => $is_orderable,
                ); ?>
                
                <div class="col-12 col-lg-6 col-xl-3" data-animate="fade-up" data-animate-delay="<?= $i * 100 ?>">
                    <?php get_template_part('template-parts/card', null, $post_args); ?>
                </div>
                
                <?php $i++; ?>
            <?php endforeach; ?>
            
        </div>
    </div>
</section>

<?php endif; ?>