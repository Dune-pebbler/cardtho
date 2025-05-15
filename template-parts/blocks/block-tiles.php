<?php

/**
 * Block Name: Tiles
 *
 * This is the template that display tiles
 */


$columns_amount = 12 / get_field('columns_aantal_kolommen') ;
$card_repeater = 'columns_kaarten';

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
?>
<section class="block-tiles relative" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <div class="row row-gap-1">
            <?php while (have_rows($card_repeater)) : the_row(); ?>
                <div class="col-12 col-lg-<?=$columns_amount?>">
                    <?php
                    $card_args = [
                        'title' => get_sub_field('kaart_titel'),
                        'description' => get_sub_field('kaart_beschrijving'),
                        'image' => get_sub_field('kaart_afbeelding'),
                        'image_fit' => $image_group['afbeelding_fit'],
                        'link' => get_sub_field('kaart_link'),
                        'button' => get_sub_field('kaart_button'),
                    ];
                    get_template_part('template-parts/card', null, $card_args);
                    ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>