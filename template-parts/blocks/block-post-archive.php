<?php

/**
 * Block Name: Post Archive
 */
$posts_per_page = get_sub_field('maximum_aantal_posts') ?: 12;
$productgroep = get_sub_field('productgroep');
$animation_counter = 0; // Single counter for smooth waterfall effect
$eol_intro = get_sub_field('end_of_line_printers_intro');
$uitgelichte_producten = get_sub_field('uitgelichte_producten'); // Get featured products
$uitgelichte_eol_producten = get_sub_field('uitgelichte_eol_producten'); // Get featured end-of-line products

// Get ordering options
$orderby = get_sub_field('post_orderby') ?: 'date';
$order = get_sub_field('post_order') ?: 'DESC';
$meta_key = get_sub_field('post_meta_key') ?: '';

// Get current page for bestelbare products
$bestelbare_paged = isset($_GET['bestelbare_page']) ? intval($_GET['bestelbare_page']) : 1;
// Get current page for end-of-life products  
$eol_paged = isset($_GET['eol_page']) ? intval($_GET['eol_page']) : 1;

// Base query args for product queries
$base_args = array(
    'post_type'      => 'product',
    'posts_per_page' => $posts_per_page,
    'orderby'        => $orderby,
    'order'          => $order,
);

// Add meta_key if using meta_value or meta_value_num ordering
if (in_array($orderby, ['meta_value', 'meta_value_num']) && !empty($meta_key)) {
    $base_args['meta_key'] = $meta_key;
}

// Apply product group filter if selected
if ($productgroep) {
    $base_args['tax_query'] = array(
        array(
            'taxonomy' => $productgroep[0]->taxonomy,
            'field'    => 'term_id',
            'terms'    => $productgroep[0]->term_id,
        ),
    );
}

// Exclude featured products from regular queries
$featured_product_ids = array();
if ($uitgelichte_producten) {
    foreach ($uitgelichte_producten as $featured_product) {
        $featured_product_ids[] = $featured_product->ID;
    }
}
if ($uitgelichte_eol_producten) {
    foreach ($uitgelichte_eol_producten as $featured_eol_product) {
        $featured_product_ids[] = $featured_eol_product->ID;
    }
}
if (!empty($featured_product_ids)) {
    $base_args['post__not_in'] = $featured_product_ids;
}

// Query for bestelbare products
$bestelbare_args = array_merge($base_args, array(
    'paged' => $bestelbare_paged,
    'meta_query' => array(
        array(
            'key' => 'bestelbaar',
            'value' => '1',
            'compare' => '='
        )
    )
));

$bestelbare_query = new WP_Query($bestelbare_args);

// Query for end-of-life products
$eol_args = array_merge($base_args, array(
    'paged' => $eol_paged,
    'meta_query' => array(
        array(
            'key' => 'bestelbaar',
            'value' => '0',
            'compare' => '='
        )
    )
));

$eol_query = new WP_Query($eol_args);

// Build final product arrays
$bestelbare_products = [];
$end_of_life_products = [];

// Add featured products first (check if they are bestelbaar or end-of-life)
if ($uitgelichte_producten && !empty($uitgelichte_producten)) {
    foreach ($uitgelichte_producten as $featured_product) {
        $is_bestelbaar = get_field('bestelbaar', $featured_product->ID) ?? true;
        if ($is_bestelbaar) {
            $bestelbare_products[] = $featured_product;
        } else {
            $end_of_life_products[] = $featured_product;
        }
    }
}

// Add featured end-of-line products first to end-of-life products
if ($uitgelichte_eol_producten && !empty($uitgelichte_eol_producten)) {
    foreach ($uitgelichte_eol_producten as $featured_eol_product) {
        $end_of_life_products[] = $featured_eol_product;
    }
}

// Add bestelbare products from query
if ($bestelbare_query->have_posts()) {
    while ($bestelbare_query->have_posts()) {
        $bestelbare_query->the_post();
        $bestelbare_products[] = get_post();
    }
}



// Add end-of-life products from query
if ($eol_query->have_posts()) {
    while ($eol_query->have_posts()) {
        $eol_query->the_post();
        $end_of_life_products[] = get_post();
    }
}



// Products are displayed directly from query results

wp_reset_postdata();
?>

<section class="block-post-archive test">
    <div class="container">
        <!-- Bestelbare printers section -->
        <?php if (!empty($bestelbare_products)) : ?>
            <div class="row row-gap-2">
                <?php foreach ($bestelbare_products as $product) : ?>
                    <?php
                    $is_orderable = get_field('bestelbaar', $product->ID) ?? true;
                    // Check if custom thumbnail text is available, otherwise use excerpt
                    $custom_thumbnail_text = get_field('korte_thumbnail_text', $product->ID);
                    $description = $custom_thumbnail_text ? $custom_thumbnail_text : get_the_excerpt($product->ID);
                    
                    $post_args = array(
                        'title' => get_the_title($product->ID),
                        'description' => $description,
                        'image' => array(
                            'url' => get_the_post_thumbnail_url($product->ID, 'medium'),
                            'alt' => get_post_meta(get_post_thumbnail_id($product->ID), '_wp_attachment_image_alt', true)
                        ),
                        'link' => array(
                            'url' => get_permalink($product->ID),
                            'title' => 'Bekijken'
                        ),
                        'button' => true,
                        'is_orderable' => $is_orderable,
                    ); ?>
                    <div class="col-12 col-lg-4 col-xl-3" data-animate="fade-up" data-animate-delay="<?= $animation_counter * 150 ?>">
                        <?php get_template_part('template-parts/card', null, $post_args); ?>
                    </div>
                    <?php $animation_counter++; ?>
                <?php endforeach; ?>
            </div>

            <!-- Bestelbare pagination -->
            <?php if ($bestelbare_query->max_num_pages > 1) : ?>
                <div class="pagination mt-4">
                    <?php
                    $current_url = remove_query_arg(['bestelbare_page', 'eol_page']);
                    echo paginate_links(array(
                        'base' => add_query_arg('bestelbare_page', '%#%', $current_url),
                        'format' => '',
                        'current' => max(1, $bestelbare_paged),
                        'total' => $bestelbare_query->max_num_pages,
                        'prev_text' => '&laquo; Previous',
                        'next_text' => 'Next &raquo;',
                    ));
                    ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- End of life printers section -->
        <?php if (!empty($end_of_life_products)) : ?>
            <div class="mt-5">
                <?php if ($eol_intro) : ?>
                    <div class="row">
                        <div class="col-12">
                            <?php echo $eol_intro; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="row row-gap-2">
                    <?php 
                    // Reset animation counter for end-of-life products to start animations earlier
                    $eol_animation_counter = 0; 
                    ?>
                    <?php foreach ($end_of_life_products as $product) : ?>
                        <?php
                        $is_orderable = get_field('bestelbaar', $product->ID) ?? false;
                        // Check if custom thumbnail text is available, otherwise use excerpt
                        $custom_thumbnail_text = get_field('korte_thumbnail_text', $product->ID);
                        $description = $custom_thumbnail_text ? $custom_thumbnail_text : get_the_excerpt($product->ID);
                        
                        $post_args = array(
                            'title' => get_the_title($product->ID),
                            'description' => $description,
                            'image' => array(
                                'url' => get_the_post_thumbnail_url($product->ID, 'medium'),
                                'alt' => get_post_meta(get_post_thumbnail_id($product->ID), '_wp_attachment_image_alt', true)
                            ),
                            'link' => array(
                                'url' => get_permalink($product->ID),
                                'title' => 'Bekijken'
                            ),
                            'button' => true,
                            'is_orderable' => $is_orderable,
                        ); ?>
                        <div class="col-12 col-lg-4 col-xl-3" data-animate="fade-up" data-animate-delay="<?= $eol_animation_counter * 150 ?>">
                            <?php get_template_part('template-parts/card', null, $post_args); ?>
                        </div>
                        <?php $eol_animation_counter++; ?>
                    <?php endforeach; ?>
                </div>

                <!-- End-of-life pagination -->
                <?php if ($eol_query->max_num_pages > 1) : ?>
                    <div class="pagination mt-4">
                        <?php
                        $current_url = remove_query_arg(['bestelbare_page', 'eol_page']);
                        echo paginate_links(array(
                            'base' => add_query_arg('eol_page', '%#%', $current_url),
                            'format' => '',
                            'current' => max(1, $eol_paged),
                            'total' => $eol_query->max_num_pages,
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;',
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- No products found message -->
        <?php if (empty($bestelbare_products) && empty($end_of_life_products)) : ?>
            <div class="row">
                <div class="col-12">
                    <p>Geen producten gevonden.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>