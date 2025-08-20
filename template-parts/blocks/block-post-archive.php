<?php
/**
 * Block Name: Post Archive
 */
$posts_per_page = get_sub_field('maximum_aantal_posts') ?: 12;
$productgroep = get_sub_field('productgroep');
$featured_products = get_sub_field('featured_products') ?: [];
$i = 3;

// Get featured product IDs
$featured_product_ids = [];
if ($featured_products) {
    foreach ($featured_products as $featured_product) {
        $featured_product_ids[] = $featured_product->ID;
    }
}

// Build query args for regular products (excluding featured ones)
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => $posts_per_page - count($featured_product_ids), // Subtract featured products from total
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
);

// Exclude featured products from regular query
if (!empty($featured_product_ids)) {
    $args['post__not_in'] = $featured_product_ids;
}

// Apply product group filter if selected
if ($productgroep) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => $productgroep[0]->taxonomy,
            'field'    => 'term_id',
            'terms'    => $productgroep[0]->term_id,
        ),
    );
}

$query = new WP_Query($args);

// Merge featured products with regular products
$all_products = [];

// Add featured products first (only on first page)
if (get_query_var('paged') <= 1) {
    foreach ($featured_products as $featured_product) {
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
            $all_products[] = $featured_product;
        }
    }
}

// Add regular products
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $all_products[] = get_post();
    }
}

wp_reset_postdata();
?>

<section class="block-post-archive">
    <div class="container">
        <div class="row row-gap-2">
            <?php if (!empty($all_products)) : ?>
                <?php foreach ($all_products as $product) : ?>
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
                    <div class="col-12 col-lg-4 col-xl-3" data-animate="fade-up" data-animate-delay="<?= $i * 100 ?>">
                        <?php get_template_part('template-parts/card', null, $post_args); ?>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>

                <?php if ($query->max_num_pages > 1) : ?>
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $query->max_num_pages,
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;',
                        ));
                        ?>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <p>Geen producten gevonden.</p>
            <?php endif; ?>
        </div>
    </div>
</section>