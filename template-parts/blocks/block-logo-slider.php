<?php

/**
 * Block Name: Logo slider
 *
 * This is the template that display a logo slider
 */
$logo_herhaler = get_sub_field('logo_slider_repeater');

?>
<section class="block-logo-slider relative">
    <div class="container">
        <div class="row">
            <div class="owl-carousel owl-3 logo-slider">
                <?php $delay = 100; ?>
                <?php while (have_rows($logo_herhaler)) : the_row(); ?>
                    <?php
                    $logo_image_sub = get_sub_field('logo');
                    $logo_link_sub = get_sub_field('link');
                    ?>
                    <a href="<?php echo esc_url($logo_link_sub['url']); ?>" class="item logo-slider__link" data-animate="zoom-in" data-animate-delay="<?= $delay ?>">
                        <img loading="lazy" class="cover logo-slider__image" src="<?= esc_url($logo_image_sub['url']); ?>" alt="<?= esc_attr($logo_image_sub['alt']); ?>" />
                    </a>
                    <?php $delay += 50; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>