<?php

/**
 * Block Name: Hero
 *
 * This is the template that displays the Hero banner block.
 */

$image = get_sub_field('hero_afbeelding');
$content = get_sub_field('hero_content');
$button = get_sub_field('hero_button');
?>

<section class="block-hero relative">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <?php if ($content): ?>
                    <div class="" ><?= $content ?></div>
                <?php endif; ?>
                <?php if ($button): ?>
                    <div class="btn" >
                        <a href="<?= esc_url($button['url']) ?>" class="button" target="<?= $button['target'] ?>"><?= $button['title'] ?></a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($image) : ?>
                <div class="col-12 col-md-6 relative">
                    <div class="img-container">
                        <img loading="lazy"
                            class="cover"
                            src="<?= esc_url($image['url']); ?>"
                            alt="<?= esc_attr($image['alt']); ?>" />
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>