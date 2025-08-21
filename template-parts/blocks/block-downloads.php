<?php
$title = get_sub_field('downloads_titel');
$content = get_sub_field('downloads_content');
$button_1 = get_sub_field('downloads_button_1');
$button_2 = get_sub_field('downloads_button_2');
?>

<section class="block-downloads">
    <div class="container">
        <div class="row justify-center">
            <div class="col-8">
                <?php if ($title): ?>
                    <h2 class="block-downloads__title"><?= esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($content): ?>
                    <div class="block-downloads__content">
                        <?= $content; ?>
                    </div>
                <?php endif; ?>
                
                <div class="block-downloads__buttons">
                    <?php if ($button_1): ?>
                        <a href="<?= esc_url($button_1['url']); ?>" class="btn" target="<?= $button_1['target'] ? esc_attr($button_1['target']) : '_self'; ?>">
                            <?= esc_html($button_1['title']); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($button_2): ?>
                        <a href="<?= esc_url($button_2['url']); ?>" class="btn btn-secondary" target="<?= $button_2['target'] ? esc_attr($button_2['target']) : '_self'; ?>">
                            <?= esc_html($button_2['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
