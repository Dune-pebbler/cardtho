<?php

/**
 * Template part for displaying a card
 *
 * @param array $args {
 * @type string $title       The card title
 * @type string $description The card description
 * @type array  $image       The image array with 'url' and 'alt'
 * @type array  $link        The link array with 'url' and 'title'
 * @type bool   $button      Whether to show a button
 * @type string $image_fit   The image fit class (e.g., 'cover' or 'contain')
 * @type string $image_height The max image height (e.g., '200px')
 * @type array  $location    The location array with 'lat', 'lng', 'zoom', 'address'
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
$location = $args['location'] ?? [];

$image_fit = $args['image_fit'] ?? 'contain';
$image_height = $args['image_height'] ?? '';

$is_orderable = $args['is_orderable'] ?? true;
$is_orderable_class = !$is_orderable ? 'not-orderable' : '';

// Check if we should show a map instead of an image
$show_map = !empty($location) && !empty($location['lat']) && !empty($location['lng']);

// turn desc into an excerpt
$description = wp_trim_words($description, 10, '...');
?>

<a href="<?= esc_url($link['url']) ?>" class="card <?= $is_orderable_class ?>">
    <?php if ($title) : ?>
        <h3 class="card__title"><?= esc_html($title) ?></h3>
    <?php endif; ?>
    
    <?php if ($show_map) : ?>
        <div class="card__map">
            <?php
            $map_args = [
                'location' => $location,
                'marker_bool' => false, // For cards, we'll use a simple marker
                'marker' => []
            ];
            get_template_part('template-parts/google-map', null, $map_args);
            ?>
        </div>
    <?php elseif ($image && $image['url']) : ?>
        <img
            src="<?= esc_url($image['url']) ?>"
            alt="<?= esc_attr($image['alt']) ?>"
            class="card__image <?= esc_attr($image_fit) ?>"
            loading="lazy"
            style="<?= $image_height ? 'max-height:' . esc_attr($image_height) . ';' : '' ?>" />
    <?php endif; ?>

    <?php if ($description) : ?>
        <div class="card__description">
            <?= wp_kses_post($description) ?>
        </div>
    <?php endif; ?>

    <?php if ($is_orderable): ?>
        <?php if ($button) : ?>
            <div class="card__button">
                <span class="btn"><?= esc_html($link['title']) ?></span>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="card__button">
            <span class="btn">Meer informatie</span>
        </div>
    <?php endif; ?>

</a>