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



?>

<section class="block-masonry relative">
    <div class="<?= $container_class ?>">
        <div class="row">
            <div class="col-12">
                <?php if ($gallery_images) : ?>
                    <div class="masonry-grid ">
                        <?php foreach ($gallery_images as $image) : ?>
                            <div class="masonry-item masonry-cols-3" data-animate="zoom-in" data-animate-delay="<?= $delay ?>">
                                <a href="<?= esc_url($image['url']) ?>" data-fancybox="gallery">
                                    <img src="<?= esc_url($image['url']) ?>"
                                        alt="<?= esc_attr($image['alt']) ?>"
                                        class="<?= $image_fit_class ?>"
                                        loading="lazy">
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