<?php
$title = get_field('title');
$paragraph = get_field('paragraph');

$title_2 = get_field('title_2');
$paragraph_2 = get_field('paragraph_2');

$gallery_images = get_field('product_afbeeldingen');

?>

<?php get_header(); ?>

<section class="single-product">
    <div class="product-container">
        <div class="container arrow-bg ">
            <div class="row">
                <div class="arrow-1">
                </div>
                <div class="arrow-2" data-animate="slide-in-right" data-animate-delay="300">
                </div>
                <div class="arrow-3" data-animate="slide-in-right" data-animate-delay="300">
                </div>
                <?php if ($gallery_images): ?>
                    <div class="col-12 col-lg-6">
                        <div class="main-image">
                            <!-- Main Product Image Slider -->
                            <div class="owl-carousel owl-1 product-image-slider">
                                <?php foreach ($gallery_images as $image): ?>
                                    <div class="item">
                                        <a href="<?= esc_url($image['url']); ?>" data-fancybox="product-gallery">
                                            <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" />
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="product-thumbnail-slider owl-carousel owl-theme mt-3">
                            <?php foreach ($gallery_images as $image): ?>
                                <div class="item">
                                    <img src="<?= esc_url($image['sizes']['thumbnail']); ?>" alt="<?= esc_attr($image['alt']); ?>" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-12 col-lg-6">
                    <?php
                    if (has_post_thumbnail() && empty($gallery_images)) {
                        the_post_thumbnail('large');
                    }
                    ?>
                    <?= the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="info-container">
        <div class="container">
            <div class="row justify-center">
                <div class="col-8">
                    <div class="content">
                        <?php if ($title): ?>
                            <h2 class="content__title"><?= $title ?></h2>
                        <?php endif; ?>
                        <?php if ($paragraph): ?>
                            <div class="content__paragraph"><?= $paragraph ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-8">
                    <div class="content">
                        <?php if ($title_2): ?>
                            <h2 class="content__title"><?= $title_2 ?></h2>
                        <?php endif; ?>
                        <?php if ($paragraph_2): ?>
                            <div class="content__paragraph"><?= $paragraph_2 ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</section>
<?php get_footer(); ?>