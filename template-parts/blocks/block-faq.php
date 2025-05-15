<?php

/**
 * Block Name: Faq
 *
 * This is the template that display faq quesitons
 */
$faq_herhaler = get_field('faq_va_repeater');

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
<section class="block-faq relative" style="<?= $padding_top_style ?> <?= $padding_bottom_style ?> <?= $background_color_style ?>">
    <div class="<?= $container_class ?>">
        <div class="row">
            <div class="socials">

                <?php if ($faq_herhaler): ?>
                    <?php while (have_rows('faq_va_repeater')) : the_row(); ?>
                        <?php
                        $faq_vraag_sub = get_sub_field('faq_vraag');
                        $faq_antwoord_sub = get_sub_field('faq_antwoord');
                        ?>
                        <div class="faq-item">
                            <div class="faq-question">
                                <?= $faq_vraag_sub ?>
                                <svg class="icon icon-plus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                </svg>
                                <svg class="icon icon-minus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                                </svg>
                            </div>
                            <div class="faq-answer"><?= $faq_antwoord_sub ?></div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>