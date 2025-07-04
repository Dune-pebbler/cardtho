<?php

/**
 * Block Name: Tiles
 *
 * This is the template that display tiles
 */


$card_repeater = 'columns_kaarten';
?>

<section class="block-tiles relative">
    <div class="container">
        <div class="row row-gap-1">
            <?php if (have_rows($card_repeater)): ?>
                <?php while (have_rows($card_repeater)) : the_row(); ?>
                    <div class="col-12 col-lg-3">
                        <?php
                        $card_args = [
                            'title' => get_sub_field('kaart_titel'),
                            'description' => get_sub_field('kaart_beschrijving'),
                            'image' => get_sub_field('kaart_afbeelding'),
                            'link' => get_sub_field('kaart_link'),
                            'button' => get_sub_field('kaart_button'),
                        ];
                        get_template_part('template-parts/card', null, $card_args);
                        ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>