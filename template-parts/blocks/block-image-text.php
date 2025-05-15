<?php

/**
 * Block Name: Image with Text
 */

//content fields
$title = get_sub_field('image_text_content')['title'] ?? '';
$content = get_sub_field('image_text_content')['content'] ?? '';
$image = get_sub_field('image_text_image');
$button = get_sub_field('image_text_button');
$layout = get_sub_field('image_text_layout');

//globals 
// Get settings from flexible content block
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

<section class="block-image-text" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <div class="row <?= $layout ?> flex-center">
            <div class="col-12 col-lg-5">
                <div class="content-container">
                    <?php if ($title): ?>
                        <h2 data-animate="fade-up" data-animate-delay="50" class="title"><?= $title ?></h2>
                    <?php endif; ?>
                    <?php if ($content): ?>
                        <div data-animate="fade-up" data-animate-delay="100" class="wysiwyg-container"><?= $content ?></div>
                    <?php endif; ?>
                    <?php if ($button): ?>
                        <div data-animate="fade-up" data-animate-delay="150" class="btn-container flex-start">
                            <a href="<?= esc_url($button['url']) ?>" class="btn"><?= esc_html($button['title']) ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <?php if ($image): ?>
                <div class="col-12 col-lg-6 relative">
                    <div data-animate="zoom-in" data-animate-delay="100" class="img-container">
                        <img style="max-height:<?= $max_image_height ?>px"
                            <?= $lazy_load_attr ?>
                            class="<?= $image_fit_class ?>"
                            src="<?= esc_url($image['url']) ?>"
                            alt="<?= esc_attr($image['alt']) ?>" />
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>