<?php
function filter_products_by_category()
{
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    $current_filter = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'default';
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 2,
        'paged' => $paged
    );

    // category filter
    if ($category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category
            )
        );
    }

    // sorting filter
    switch ($current_filter) {
        case 'price_low_high':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'price_high_low':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'date':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'popularity':
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        default:
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
    }

    $shop_query = new WP_Query($args);
    ob_start();

    if ($shop_query->have_posts()) :
        echo '<div class="row">';
        while ($shop_query->have_posts()) : $shop_query->the_post();
            global $product;
            if (!$product || !$product->is_visible()) {
                continue;
            }
?>


            <div class="col-12 col-md-6 col-lg-4 mb-4 product-item">
                <div class="card h-100">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo woocommerce_get_product_thumbnail('woocommerce_thumbnail', ['class' => 'card-img-top']); ?>
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p class="card-text"><?= wp_trim_words(get_the_excerpt(), 20) ?></p>
                        <div class="mt-auto">
                            <p class="card-text"><?php echo $product->get_price_html(); ?></p>
                            <?php
                            echo apply_filters(
                                'woocommerce_loop_add_to_cart_link',
                                sprintf(
                                    '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button btn btn-primary %s product_type_%s">%s</a>',
                                    esc_url($product->add_to_cart_url()),
                                    esc_attr($product->get_id()),
                                    esc_attr($product->get_sku()),
                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                    esc_attr($product->get_type()),
                                    esc_html($product->add_to_cart_text())
                                ),
                                $product
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>


<?php
        endwhile;
        echo '</div>';

        // Pagination
        $total_pages = $shop_query->max_num_pages;
        if ($total_pages > 1) {
            echo '<div class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<a href="#" class="page-numbers' . ($i == $paged ? ' current' : '') . '" data-page="' . $i . '">' . $i . '</a>';
            }
            echo '</div>';
        } else {
            echo '<p>No products found.</p>';
        }
    endif;

    wp_reset_postdata();

    $output = ob_get_clean();
    wp_send_json_success($output);
    wp_die();
}
add_action('wp_ajax_filter_products', 'filter_products_by_category');
add_action('wp_ajax_nopriv_filter_products', 'filter_products_by_category');
