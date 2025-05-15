<?php

/**
 * Block Name: Post Archive
 */

$post_settings = get_sub_field('post_settings');
$posts_per_page = $post_settings['posts_per_page'] ?: 12;
$columns = $post_settings['columns'] ?: '3';

//globals 
$spacing_settings = get_sub_field('spacing_settings');
$colors_settings = get_sub_field('colors_settings');
$image_settings = get_sub_field('image_settings');

// Build styles and classes
$container_class = !$spacing_settings['content_width'] ? '' : 'container';
$padding_top_style = !$spacing_settings['padding_top'] ? '' : 'padding-top:' . $spacing_settings['padding_top'] . 'px;';
$padding_bottom_style = !$spacing_settings['padding_bottom'] ? '' : 'padding-bottom:' . $spacing_settings['padding_bottom'] . 'px;';
$background_color_style = !$colors_settings['background_color'] ? '' : 'background-color:' . $colors_settings['background_color'];

// Query posts
$args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
);
$query = new WP_Query($args);

// Set grid columns class
$grid_class = 'md:grid-cols-2 lg:grid-cols-3'; // Default 3 columns
if ($columns === '2') {
    $grid_class = 'md:grid-cols-2';
} elseif ($columns === '4') {
    $grid_class = 'md:grid-cols-2 lg:grid-cols-4';
}
?>

<section class="block-post-archive" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <?php if ($query->have_posts()) : ?>
            <div class="post-grid grid grid-cols-1 <?= $grid_class ?> gap-6">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    $post_args = array(
                        'title' => get_the_title(),
                        'description' => get_the_excerpt(),
                        'image' => array(
                            'url' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                            'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)
                        ),
                        'link' => array(
                            'url' => get_permalink(),
                            'title' => 'Read More'
                        ),
                        'button' => true,
                        'image_fit' => $image_settings['image_fit'],
                        'image_height' => $image_settings['max_image_height'],
                    );
                    get_template_part('template-parts/card', null, $post_args);
                endwhile;
                ?>
            </div>

            <?php if ($query->max_num_pages > 1) : ?>
                <div class="pagination mt-8">
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
            <p>No posts found.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>