<?php
$title = get_sub_field('infoslid_titel');
$content = get_sub_field('infoslid_content');
$image = get_sub_field('infoslid_afbeelding');
$button = get_sub_field('infoslid_button');
?>

<section class="block-info-slider">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
                <?php if ($title): ?>
                    <h2 class="block-info-slider__title"><?= esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($content): ?>
                    <div class="block-info-slider__content">
                        <?= $content; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($button): ?>
                    <div class="block-info-slider__button">
                        <a href="<?= esc_url($button['url']); ?>" class="btn" target="<?= $button['target'] ? esc_attr($button['target']) : '_self'; ?>">
                            <?= esc_html($button['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ($image): ?>
                <div class="col-12 col-lg-6">
                    <div class="block-info-slider__image">
                        <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" />
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
