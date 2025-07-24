<?php

/**
 * Block Name: Image with Text
 */

//content fields
$title = get_sub_field('afb_tekst_titel');
$content = get_sub_field('afb_tekst_content');
$image = get_sub_field('afb_tekst_afbeelding');
$button = get_sub_field('afb_tekst_button');
//true = tekst links
$layout = get_sub_field('afb_layout');
$deco = get_sub_field('afb_deco');

?>

<section class="block-image-text has-padding">
    <div class="container">
        <div class="row flex-center <?= !$layout ? 'reverse' : '' ?>">
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
                    <?php if ($deco): ?>
                        <div class="img-container deco-img">
                    <?php else: ?>
                        <div data-animate="zoom-in" data-animate-delay="100" class="img-container">
                    <?php endif; ?>

                            <img
                                loading="lazy"
                                class="contain"
                                src="<?= esc_url($image['url']) ?>"
                                alt="<?= esc_attr($image['alt']) ?>" />
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
        </div>
</section>