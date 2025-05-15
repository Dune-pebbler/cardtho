<?php

/**
 * Block Name: Hero
 *
 * This is the template that displays the Hero banner block.
 */

$column_left = get_sub_field('column_left');
$image = $column_left['image'];

$column_right = get_sub_field('column_right');
$title = $column_right['title'];  
$content = $column_right['text'];  
$button = $column_right['button'];

//globals 
$spacing_settings = get_sub_field('spacing_settings');
$colors_settings = get_sub_field('colors_settings');
$image_settings = get_sub_field('image_settings');

// Build styles and classes
$container_class = !$spacing_settings['content_width'] ? '' : 'container';
$padding_top_style = !$spacing_settings['padding_top'] ? '' : 'padding-top:' . $spacing_settings['padding_top'] . 'px;';
$padding_bottom_style = !$spacing_settings['padding_bottom'] ? '' : 'padding-bottom:' . $spacing_settings['padding_bottom'] . 'px;';
$background_color_style = !$colors_settings['background_color'] ? '' : 'background-color:' . $colors_settings['background_color'];
$lazy_load_attr = $image_settings['lazy_loading'] ? 'loading="lazy"' : '';
$image_fit_class = $image_settings['image_fit'];
$max_image_height = $image_settings['max_image_height'] ?: '';
?>

<section class="block-hero relative" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <div class="row">
            <div class="col-12">
                <?php if ($title): ?>
                    <h2 class="text-center text-overlay" data-animate="fade-up" data-animate-delay="50"><?= $title ?></h2>
                <?php endif; ?>
                <?php if ($content): ?>
                    <div class="text-center text-overlay" data-animate="fade-up" data-animate-delay="50"><?= $content ?></div>
                <?php endif; ?>
                <?php if ($button): ?>
                    <div class="text-center">
                        <a href="<?= esc_url($button['url']) ?>" class="button" target="<?= $button['target'] ?>"><?= $button['title'] ?></a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($image) : ?>
                <div class="col-12 relative">
                    <div class="img-container">
                        <img style="max-height:<?= $max_image_height ?>px"
                            <?= $lazy_load_attr ?>
                            class="<?= $image_fit_class ?>"
                            src="<?= esc_url($image['url']); ?>"
                            alt="<?= esc_attr($image['alt']); ?>" />
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>