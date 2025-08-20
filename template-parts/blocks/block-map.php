<?php

/**
 * Block Name: Map
 *
 * This is the template that displays a google map
 */
$title = get_sub_field('kaart_titel');
$location = get_sub_field('kaart_instellingen');
?>

<section class="map">
    <div class="container">
        <?php if ($title) : ?>
            <h2 class="map-title"><?= esc_html($title) ?></h2>
        <?php endif; ?>
        
        <?php if ($location) : ?>
            <div class="map-parent">
                <div id="map" 
                     data-zoom="<?= esc_attr($location['zoom']) ?>" 
                     data-lat="<?= esc_attr($location['lat']) ?>" 
                     data-lng="<?= esc_attr($location['lng']) ?>"></div>
            </div>
        <?php endif; ?>
    </div>
</section>