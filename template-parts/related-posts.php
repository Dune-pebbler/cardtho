<?php

/**
 * Template part for displaying related posts
 * 
 * Displays related products based on shared product categories
 */

// Get current post ID
$current_post_id = get_the_ID();

// Get the product categories of the current post
$current_categories = wp_get_post_terms($current_post_id, 'product-groep', array('fields' => 'ids'));

// Default args for related posts query
$posts_per_page = 4; // Show 4 related posts by default
$i = 3; // Animation delay counter

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

// Only display section if we have related posts
if ($related_query->have_posts()) : ?>

<section class="related-posts">
    <div class="container">
        <div class="row row-gap-2">
            <div class="col-12">
                <h2 class="text-center" data-animate="fade-up" data-animate-delay="100">
                    Gerelateerde producten
                </h2>
            </div>
            
            <?php while ($related_query->have_posts()) : 
                $related_query->the_post();
                
                $is_orderable = get_field('bestelbaar') ?? true;
                
                $post_args = array(
                    'title' => get_the_title(),
                    'description' => get_the_excerpt(),
                    'image' => array(
                        'url' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                        'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)
                    ),
                    'link' => array(
                        'url' => get_permalink(),
                        'title' => 'Bekijken'
                    ),
                    'button' => true,
                    'is_orderable' => $is_orderable,
                ); ?>
                
                <div class="col-12 col-lg-6 col-xl-3" data-animate="fade-up" data-animate-delay="<?= $i * 100 ?>">
                    <?php get_template_part('template-parts/card', null, $post_args); ?>
                </div>
                
                <?php $i++; ?>
            <?php endwhile; ?>
            
        </div>
    </div>
</section>

<?php 
endif;

// Reset post data
wp_reset_postdata();
?>