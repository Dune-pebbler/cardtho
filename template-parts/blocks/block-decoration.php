<?php

/**
 * Block Name: Decoration
 *
 * This is the template that displays a decorative line.
 */

$height = get_field('decoration_hoogte');

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

<section class="block-decoration" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> ">
    <div class="<?= $container_class ?>">
        <div class="row">
            <div class="bar"  class="w-full" style="height:<?=$height?>px; <?= $background_color_style ?>"></div>
        </div>
    </div>
</section>