<?php
/**
 * Template part for displaying a Google Map
 *
 * @param array $args {
 *     @type array $location Location data with lat, lng, zoom, address
 *     @type bool  $marker_bool Whether to show marker
 *     @type array $marker Marker image data
 * }
 */

if (empty($args) || empty($args['location'])) {
    return;
}

$location = $args['location'];
$marker_bool = $args['marker_bool'] ?? false;
$marker = $args['marker'] ?? [];

// Generate unique map ID
$map_id = 'map-' . uniqid();
?>

<div class="map-container">
    <div class="map-parent">
        <div id="<?= $map_id ?>" 
             class="google-map" 
             data-zoom="<?= esc_attr($location['zoom']) ?>" 
             data-lat="<?= esc_attr($location['lat']) ?>" 
             data-lng="<?= esc_attr($location['lng']) ?>"></div>
        <?php if ($marker_bool && $marker && !empty($marker['url'])) : ?>
            <img class="hide map-marker" 
                 loading="lazy" 
                 src="<?= esc_url($marker['url']) ?>" 
                 alt="<?= esc_attr($marker['alt'] ?? 'Map marker') ?>"
                 data-map-id="<?= $map_id ?>">
        <?php endif; ?>
    </div>
</div>
