<?php

/**
 * Template part for displaying a video
 *

 * 
 * @param array $args {
 *     Optional. An array of arguments.
 *
 *     @type string $title  
 *     @type string $description  
 *     @type array  $image  
 *     @type array  $link  
 * 
 * }
 */

$args = wp_parse_args($args);
$image = $args['image'];
$title = $args['title'];
$description = $args['description'];
$link = $args['link'];
$button = $args['button'];
?>

<a class="card" href="<?= $link['url'] ?>">
    <?php if ($image) : ?>
        <img class="card__image" loading="lazy" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
    <?php endif; ?>
    <?php if ($title): ?>
        <h3 class="card__title"><?= $title ?></h3>
    <?php endif; ?>
    <?php if ($description): ?>
        <p class="card__description"><?= $description ?></p>
    <?php endif; ?>
    <!-- fake button just for looks -->
    <?php if ($button): ?>
        <button class="card__button btn"><?= $link['title'] ?></button>
    <?php endif; ?>
</a>