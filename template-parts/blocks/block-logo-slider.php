<?php

/**
 * Block Name: Logo slider
 *
 * This is the template that display a logo slider
 */
$logo_herhaler = 'logo_slider_repeater';

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
<section class="block-logo-slider relative" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <div class="row">
            <div class="owl-carousel owl-3 logo-slider">
                <?php $delay = 100; ?>
                <?php while (have_rows($logo_herhaler)) : the_row(); ?>
                    <?php
                    $logo_image_sub = get_sub_field('logo');
                    $logo_link_sub = get_sub_field('link');
                    ?>
                    <a href="<?php echo esc_url($logo_link_sub['url']); ?>" class="item logo-slider__link" data-animate="zoom-in" data-animate-delay="<?= $delay ?>">
                        <img style="max-height:<?= $max_image_height ?>px" <?= $lazy_load_attr ?> class="<?= $image_fit_class ?> logo-slider__image" src="<?= esc_url($logo_image_sub['url']); ?>" alt="<?= esc_attr($logo_image_sub['alt']); ?>" />
                    </a>
                    <?php $delay += 50; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>