<?php

/**
 * Block Name: Form Block
 */

$intro_text = get_sub_field('form_intro_text');
$form_number = get_sub_field('form_number');
?>

<section class="block-form has-padding">
    <div class="container">
        <div class="row">
            <?php if ($form_number): ?>
                <div class="col-12 col-lg-8">
                    <div class="form-container" data-animate="fade-up" data-animate-delay="50">
                        <?= do_shortcode('[gravityform id="' . $form_number . '" title="false" description="false"]'); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($intro_text): ?>
                <div class="col-12 col-lg-4">
                    <div class="intro-text" data-animate="fade-up" data-animate-delay="150">
                        <?= $intro_text ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
