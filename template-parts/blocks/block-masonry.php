<?php

/**
 * Block Name: Masonry
 *
 * //dependencies
 * 
 * masonry.js
 * initmasonry() - main.js
 * 
 * This is the template that displays a masonry gallery.
 */

// content
$gallery_images = get_field('galerij_afbeeldingen');
$gallery_cols = get_field('galerij_kolommen');


//var
$delay = 0;


//globals 
$spacing_group = get_field('globals_spacing_instellingen');
$color_group = get_field('globals_kleuren_instellingen');
$image_group = get_field('globals_afbeelding_instellingen');
$container_class = !$spacing_group['content_breedte'] ? '' : 'container';
$padding_top_style = !$spacing_group['padding_top'] ? '' : 'padding-top:' . $spacing_group['padding_top'] . 'px;';
$padding_bottom_style = !$spacing_group['padding_bottom'] ? '' : 'padding-bottom:' . $spacing_group['padding_bottom'] . 'px;';
$background_color_style = !$color_group['achtergrond_kleur'] ? '' : 'background-color:' . $color_group['achtergrond_kleur'];
$lazy_load_attr = $image_group['lazy_loading'] ? 'loading="lazy"' : '';
$image_fit_class = $image_group['afbeelding_fit'];
$max_image_height = $image_group['maximale_afbeelding_hoogte'] ?: '';
?>

<section class="block-masonry relative" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <div class="row">
            <div class="col-12">
                <?php if ($gallery_images) : ?>
                    <div class="masonry-grid ">
                        <?php foreach ($gallery_images as $image) : ?>
                            <div class="masonry-item masonry-cols-<?= $gallery_cols ?>" data-animate="zoom-in" data-animate-delay="<?= $delay ?>">
                                <a href="<?= esc_url($image['url']) ?>" data-fancybox="gallery">
                                    <img src="<?= esc_url($image['url']) ?>"
                                        alt="<?= esc_attr($image['alt']) ?>"
                                        style="border-radius:8px; max-height:<?= $max_image_height ?>px;"
                                        class="<?= $image_fit_class ?>"
                                        <?= $lazy_load_attr ?>>
                                </a>
                            </div>
                            <?php $delay += 50 ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>