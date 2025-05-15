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

//globals 
$spacing_group = get_field('globals_spacing_instellingen');
$color_group = get_field('globals_kleuren_instellingen');
$image_group = get_field('globals_afbeelding_instellingen');
$container_class = !$spacing_group['content_breedte'] ? '' : 'container';
$padding_top_style = !$spacing_group['padding_top'] ? '' : 'padding-top:' . $spacing_group['padding_top'] . 'px;';
$padding_bottom_style = !$spacing_group['padding_bottom'] ? '' : 'padding-bottom:' . $spacing_group['padding_bottom'] . 'px;';
$background_color_style = !$color_group['achtergrond_kleur'] ? '' : 'background-color:' . $color_group['achtergrond_kleur'];
$lazy_load_attr = $image_group['lazy_loading'] ? 'loading="lazy"' : '';
$image_fit_class = $image_group['afbeelding_fit'];
$max_image_height = $image_group['maximale_afbeelding_hoogte'] ?: '';
?>

<?php if ($layout == '1') : ?>
    <section class="map" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
        <div class="<?= $container_class ?>">
            <?php if ($location) : ?>
                <div class="<?= $image_width ?>">
                    <div class="map-parent">
                        <div style="max-height:<?= $max_image_height ?>px" id="map" data-zoom="<?php echo esc_attr($location['zoom']); ?>" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
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
                <div class="row <?= $gespiegeld ? 'flex-reverse' : '' ?> flex-center">
                    <div class="col-12 col-md-5">
                        <?php if ($title) : ?>
                            <h2 style="<?= $title_color_style ?>"><?= $title ?></h2>
                        <?php endif; ?>
                        <?php if ($content) : ?>
                            <div style="<?= $paragraph_color_style ?>" class="content-group">
                                <?= $content ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($button_bool && $button) : ?>
                            <div class="btn-container flex-start">
                                <a style="<?= $button_color_style ?>" href="<?php echo esc_url($button['url']); ?>" class="btn"><?php echo esc_html($button['title']); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-12 col-md-6">
                        <?php
                        $map_args = [
                            'max_height' => $max_image_height,
                            'location' => $location,
                            'marker_bool' => $marker_bool,
                            'marker' => $marker,
                            // 'api_key' => $api_key,
                            'class' => $image_width ?? '',
                        ];
                        get_template_part('template-parts/google-map', null, $map_args);
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>