<?php

/**
 * Block Name: Afbeelding
 *
 * This is the template that displays the Hero banner block.
 */

//content fields
$title = get_field('afbeelding_titel');
$image = get_field('afbeelding_afbeelding');
$image1 = get_field('afbeelding_afbeelding1');
$image2 = get_field('afbeelding_afbeelding2');
$button = get_field('afbeelding_button');
$slider_images_ar = get_field('afbeelding_slider_afbeeldingen');
$slider_aside_text = get_field('afbeelding_aside_tekst');
//settings
$layout = get_field('afbeelding_layout');
$slider_bool = get_field('afbeelding_afbeelding_slider_bool');

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
<section class="block-image" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <div class="row">

            <?php if ($title) : ?>
                <div class="col-12">
                    <h2 style="<?= $title_color_style ?>" class="text-center title animate-text-fade"><?= $title ?></h2>
                </div>
            <?php endif; ?>

            <?php if ($layout == '1col') : ?>
                <?php if ($image) : ?>
                    <div class="col-12 relative">
                        <div data-animate="zoom-in" data-animate-delay="100" class="img-container"  >
                            <img style="max-height:<?= $max_image_height ?>px" <?= $lazy_load_attr ?> class="<?= $image_fit_class ?>" src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" />
                        </div>
                    </div>
                <?php elseif ($slider_images_ar) : ?>
                    <div class="col-12 relative">
                    <div data-animate="zoom-in" data-animate-delay="100" class="img-container owl-carousel owl-1" >
                            <?php foreach ($slider_images_ar as $slider_image) : ?>
                                <img style="max-height:<?= $max_image_height ?>px"  class="<?= $image_fit_class ?>" src="<?= esc_url( $slider_image['url']); ?>" alt="<?= esc_attr( $slider_image['alt']); ?>" />
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php elseif ($layout == '2col') : ?>
                <?php if (!$slider_bool) : ?>
                    <?php if ($image1) : ?>
                        <div class="col-12 col-lg-6  relative">
                            <div class="img-container">
                                <img style="max-height:<?= $max_image_height ?>px" <?= $lazy_load_attr ?> class="<?= $image_fit_class ?>" src="<?= esc_url($image1['url']); ?>" alt="<?= esc_attr($image1['alt']); ?>" />
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($image2) : ?>
                        <div class="col-12 col-lg-6 relative">
                            <div class="img-container">
                                <img style="max-height:<?= $max_image_height ?>px" <?= $lazy_load_attr ?> class="<?= $image_fit_class ?>" src="<?= esc_url($image2['url']); ?>" alt="<?= esc_attr($image2['alt']); ?>" />
                            </div>
                        </div>
                    <?php endif; ?>
                    
                <?php elseif ($slider_images_ar && $slider_bool) : ?>
                    <div class="col-12 relative">
                        <div class="img-container owl-carousel owl-2" style="padding:0;">
                            <?php foreach ($slider_images_ar as $slider_image) : ?>
                                <img style="max-height:<?= $max_image_height ?>px" <?= $lazy_load_attr ?> class="<?= $image_fit_class ?> item" src="<?= esc_url($slider_image['url']); ?>" alt="<?= esc_attr($slider_image['alt']); ?>" />
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($button) : ?>
                <div class="btn-container flex-center">
                    <a href="<?php echo esc_url($button['url']); ?>" class="btn"><?php echo esc_html($button['title']); ?></a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>