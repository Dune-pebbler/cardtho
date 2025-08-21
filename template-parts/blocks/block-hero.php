
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
    <div class="container arrow-bg">
        <div class="arrow-1">
        </div>
        <div class="arrow-2" data-animate="slide-in" data-animate-delay="300">
        </div>
        <div class="arrow-3" data-animate="slide-in" data-animate-delay="300">
        </div>
        <div class="row flex-between">
            <div class="col-12 col-md-6">
                <?php if ($content): ?>
                    <div class="" data-animate="fade-up" data-animate-delay="50"><?= $content ?></div>
                <?php endif; ?>
                <?php if ($button): ?>
                    <div data-animate="fade-up" data-animate-delay="200" class="btn-container flex-start">
                        <div class="btn">
                            <a href="<?= esc_url($button['url']) ?>" class="button" target="<?= $button['target'] ?>"><?= $button['title'] ?></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($image) : ?>
                <div class="col-12 col-md-6 relative">
                    <img class="stamp" src="<?= get_template_directory_uri() ?>/images/stamp.png" alt="evolis stamp">
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