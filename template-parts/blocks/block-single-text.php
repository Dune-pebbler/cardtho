<?php

/**
 * Block Name: Text Block
 */

$content = get_sub_field('tekst_content');
$button = get_sub_field('tekst_button');
?>

<section class="block-single-text has-padding">
    <div class="container">
        <div class="row flex-center">
            <div class="col-12 col-lg-8">
                <div class="content-container">
                    <?php if ($content): ?>
                        <div class="wysiwyg-container" data-animate="fade-up" data-animate-delay="50"><?= $content ?></div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>