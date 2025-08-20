<?php

/**
 * Block Name: Post Archive
 */
$posts_per_page = get_sub_field('maximum_aantal_posts') ?: 12;
$productgroep = get_sub_field('productgroep');
$featured_products = get_sub_field('featured_products') ?: [];
$bestelbare_counter = 3;
$eol_counter = 3;
$eol_intro = get_sub_field('end_of_line_printers_intro');

// Get current page for bestelbare products
$bestelbare_paged = isset($_GET['bestelbare_page']) ? intval($_GET['bestelbare_page']) : 1;
// Get current page for end-of-life products  
$eol_paged = isset($_GET['eol_page']) ? intval($_GET['eol_page']) : 1;

// Get featured product IDs
$featured_product_ids = [];
$featured_bestelbare = [];
$featured_eol = [];

if ($featured_products) {
    foreach ($featured_products as $featured_product) {
        $featured_product_ids[] = $featured_product->ID;

        // Check if featured product matches the selected product group (if any)
        $include_featured = true;
        if ($productgroep) {
            $product_terms = wp_get_post_terms($featured_product->ID, $productgroep[0]->taxonomy);
            $include_featured = false;
            foreach ($product_terms as $term) {
                if ($term->term_id == $productgroep[0]->term_id) {
                    $include_featured = true;
                    break;
                }
            }
        }

        if ($include_featured) {
            $is_bestelbaar = get_field('bestelbaar', $featured_product->ID);
            if ($is_bestelbaar) {
                $featured_bestelbare[] = $featured_product;
            } else {
                $featured_eol[] = $featured_product;
            }
        }
    }
}

// Base query args - don't exclude featured products, let them be part of normal pagination
$base_args = array(
    'post_type'      => 'product',
    'posts_per_page' => $posts_per_page,
);

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

// Move featured products to the front on first page only
if ($bestelbare_paged <= 1 && !empty($featured_bestelbare)) {
    // Remove featured products from regular array if they exist
    $bestelbare_products = array_filter($bestelbare_products, function($product) use ($featured_product_ids) {
        return !in_array($product->ID, $featured_product_ids);
    });
    // Add featured products to the beginning
    $bestelbare_products = array_merge($featured_bestelbare, $bestelbare_products);
    // Trim to posts_per_page limit
    $bestelbare_products = array_slice($bestelbare_products, 0, $posts_per_page);
}

if ($eol_paged <= 1 && !empty($featured_eol)) {
    // Remove featured products from regular array if they exist
    $end_of_life_products = array_filter($end_of_life_products, function($product) use ($featured_product_ids) {
        return !in_array($product->ID, $featured_product_ids);
    });
    // Add featured products to the beginning
    $end_of_life_products = array_merge($featured_eol, $end_of_life_products);
    // Trim to posts_per_page limit
    $end_of_life_products = array_slice($end_of_life_products, 0, $posts_per_page);
}

wp_reset_postdata();
?>

<section class="block-post-archive">
    <div class="container">
        <!-- Bestelbare printers section -->
        <?php if (!empty($bestelbare_products)) : ?>
            <div class="row row-gap-2">
                <?php foreach ($bestelbare_products as $product) : ?>
                    <?php
                    $is_orderable = get_field('bestelbaar', $product->ID) ?? true;
                    $post_args = array(
                        'title' => get_the_title($product->ID),
                        'description' => get_the_excerpt($product->ID),
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
                    <div class="col-12 col-lg-4 col-xl-3" data-animate="fade-up" data-animate-delay="<?= $bestelbare_counter * 100 ?>">
                        <?php get_template_part('template-parts/card', null, $post_args); ?>
                    </div>
                    <?php $bestelbare_counter++; ?>
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
                    <?php foreach ($end_of_life_products as $product) : ?>
                        <?php
                        $is_orderable = get_field('bestelbaar', $product->ID) ?? false;
                        $post_args = array(
                            'title' => get_the_title($product->ID),
                            'description' => get_the_excerpt($product->ID),
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
                        <div class="col-12 col-lg-4 col-xl-3" data-animate="fade-up" data-animate-delay="<?= $eol_counter * 100 ?>">
                            <?php get_template_part('template-parts/card', null, $post_args); ?>
                        </div>
                        <?php $eol_counter++; ?>
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