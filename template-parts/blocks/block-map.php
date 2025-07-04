<?php

/**
 * Block Name: Map
 *
 * This is the template that displays a google map
 */
$title = get_field('kaart_titel');
$content = get_field('kaart_content');
$button = get_field('kaart_button');
$marker = get_field('kaart_marker');
$location = get_field('kaart_instellingen');
//groups
$image_group = get_field('kaart_afbeelding_instellingen');
$color_group = get_field('kaart_kleur_instellingen');
//settings 
$layout = get_field('kaart_layout');
$gespiegeld = get_field('kaart_gespiegeld');
$button_bool = get_field('kaart_button_bool');
$marker_bool = get_field('kaart_marker_bool');
$max_height = get_field('kaart_max_height');
?>

<?php if ($layout == '1') : ?>
    <section class="map" >
        <div class="container">
            <?php if ($location) : ?>
                <div class="">
                    <div class="map-parent">
                        <div id="map" data-zoom="<?php echo esc_attr($location['zoom']); ?>" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
                        <?php if ($marker_bool && $marker) : ?>
                            <img  class="hide" id="logo-marker" loading="lazy" src="<?= esc_url($marker['url']); ?>" alt="<?= esc_attr($marker['alt']); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
    </section>
<?php elseif ($layout == '2') : ?>
    <?php if ($location) : ?>
        <section class="map">
            <div class="container">
                <div class="row flex-center">
                    <div class="col-12 col-md-5">
                        <?php if ($title) : ?>
                            <h2><?= $title ?></h2>
                        <?php endif; ?>
                        <?php if ($content) : ?>
                            <div class="content-group">
                                <?= $content ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($button_bool && $button) : ?>
                            <div class="btn-container flex-start">
                                <a href="<?php echo esc_url($button['url']); ?>" class="btn"><?php echo esc_html($button['title']); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-12 col-md-6">
                        <?php
                        $map_args = [
                            'location' => $location,
                            'marker_bool' => $marker_bool,
                            'marker' => $marker,
                            // 'api_key' => $api_key,
                        ];
                        get_template_part('template-parts/google-map', null, $map_args);
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>