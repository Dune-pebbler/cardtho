<?php

/**
 * Custom Shop Query Template with AJAX Category Filter
 */


// Get the current filter option
$current_filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'default';
$i = 3;
?>

<section class="custom-shop">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <?php
                $terms = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                ));
                if ($terms && !is_wp_error($terms)) :
                ?>
                    <h3>Categories</h3>
                    <ul class="list-unstyled category-filter">
                        <li><a href="#" data-category="all" class="active">All Categories</a></li>
                        <?php foreach ($terms as $term) : ?>
                            <li><a href="#" data-category="<?= $term->slug ?>"><?= $term->name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="col-12 col-lg-9">

                <div class="mb-4">
                    <select name="filter" id="product-filter" class="form-control">
                        <option value="default" <?php selected($current_filter, 'default'); ?>>Default sorting</option>
                        <option value="price_low_high" <?php selected($current_filter, 'price_low_high'); ?>>Price: Low to High</option>
                        <option value="price_high_low" <?php selected($current_filter, 'price_high_low'); ?>>Price: High to Low</option>
                        <option value="date" <?php selected($current_filter, 'date'); ?>>Newest first</option>
                        <option value="popularity" <?php selected($current_filter, 'popularity'); ?>>Popularity</option>
                    </select>
                </div>

                <div id="product-container">

                </div>
            </div>
        </div>
    </div>

</section>