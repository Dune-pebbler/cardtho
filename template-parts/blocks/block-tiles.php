<?php

/**
 * Block Name: Tiles
 *
 * This is the template that display tiles
 */

$card_repeater = 'columns_kaarten';
$title = get_sub_field('tiles_title');
$i = 5;
?>

<section class="block-tiles relative">
    <div class="container">
        <div class="row row-gap-1">
            <?php if ($title): ?>
                <h2 data-animate="fade-up" data-animate-delay="300" class="tile-title"><?= $title ?></h2>
            <?php endif; ?>
            <?php if (have_rows($card_repeater)): ?>
                <?php while (have_rows($card_repeater)) : the_row(); ?>
                    <div class="col-12 col-lg-3" data-animate="fade-up" data-animate-delay="<?= $i * 100 ?>">
                        <?php
                        $card_args = [
                            'title' => get_sub_field('kaart_titel'),
                            'description' => get_sub_field('kaart_beschrijving'),
                            'image' => get_sub_field('kaart_afbeelding'),
                            'link' => get_sub_field('kaart_link'),
                            'button' => get_sub_field('kaart_button'),
                            'location' => get_sub_field('kaart_locatie'),
                        ];
                        get_template_part('template-parts/card', null, $card_args);
                        ?>
                    </div>
                    <?php $i++ ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>