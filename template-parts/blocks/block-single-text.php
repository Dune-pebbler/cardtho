<?php

/**
 * Block Name: Text Block
 */

$column_layout = get_sub_field('column_layout');
$content_1 = get_sub_field('content_1');
$content_2 = get_sub_field('content_2');
$content_3 = get_sub_field('content_3');

//globals 
$spacing_settings = get_sub_field('spacing_settings');
$colors_settings = get_sub_field('colors_settings');

// Build styles and classes
$container_class = !$spacing_settings['content_width'] ? '' : 'container';
$padding_top_style = !$spacing_settings['padding_top'] ? '' : 'padding-top:' . $spacing_settings['padding_top'] . 'px;';
$padding_bottom_style = !$spacing_settings['padding_bottom'] ? '' : 'padding-bottom:' . $spacing_settings['padding_bottom'] . 'px;';
$background_color_style = !$colors_settings['background_color'] ? '' : 'background-color:' . $colors_settings['background_color'];

// Set column classes based on layout
switch ($column_layout) {
    case '2':
        $column_class = 'col-12 col-lg-6';
        break;
    case '3':
        $column_class = 'col-12 col-lg-4';
        break;
    default:
        $column_class = 'col-12';
}
?>

<section class="block-single-text" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <div class="row">
            <div class="<?= $column_class ?>">
                <div class="content-container">
                    <?php if ($content_1): ?>
                        <div class="wysiwyg-container" data-animate="fade-up" data-animate-delay="50"><?= $content_1 ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($column_layout >= 2 && $content_2): ?>
                <div class="<?= $column_class ?>">
                    <div class="content-container">
                        <div class="wysiwyg-container" data-animate="fade-up" data-animate-delay="100"><?= $content_2 ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($column_layout == 3 && $content_3): ?>
                <div class="<?= $column_class ?>">
                    <div class="content-container">
                        <div class="wysiwyg-container" data-animate="fade-up" data-animate-delay="150"><?= $content_3 ?></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>