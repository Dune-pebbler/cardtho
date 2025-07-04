<?php

/**
 * Template part for displaying a card
 *
 * @param array $args {
 *     @type string $title       The card title
 *     @type string $description The card description
 *     @type array  $image       The image array with 'url' and 'alt'
 *     @type array  $link        The link array with 'url' and 'title'
 *     @type bool   $button      Whether to show a button
 *     @type string $image_fit   The image fit class
 *     @type int    $image_height The max image height
 * }
 */

if (empty($args)) {
    return;
}

$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
$image = $args['image'] ?? [];
$link = $args['link'] ?? [];
$button = $args['button'] ?? false;
?>

<a href="<?= esc_url($link['url']) ?>" class="card">
    <?php if ($image && $image['url']) : ?>
        <img
            src="<?= esc_url($image['url']) ?>"
            alt="<?= esc_attr($image['alt']) ?>"
            class="card__image contain"
            loading="lazy" />
    <?php endif; ?>

    <?php if ($title) : ?>
        <h3 class="card__title"><?= esc_html($title) ?></h3>
    <?php endif; ?>

    <?php if ($description) : ?>
        <div class="card__description">
            <?= wp_kses_post($description) ?>
        </div>
    <?php endif; ?>

    <?php if ($button) : ?>
        <div class="card__button">
            <span class="btn"><?= esc_html($link['title']) ?></span>
        </div>
    <?php endif; ?>
</a>