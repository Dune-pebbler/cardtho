<?php
$anchor_link = get_field('anchor_link');
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
                <div class="col-lg-1"></div>
                <div class="col-12 col-lg-5">
                    <?= the_content(); ?>
                    <div class="product-buttons">
                        <a href="https://cardthostore.nl/product/<?= get_post_field('post_name') ?>" target="_blank" class="btn">Koop in shop</a>
                        <?php if ($anchor_link): ?>
                            <a href="#anchor" class="btn btn-secondary"><?= esc_html($anchor_link); ?></a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <?php if (have_rows('content_blocks')): ?>
        <div class="info-container">
            <div class="container">
                <?php while (have_rows('content_blocks')) : the_row();
                    $layout = get_row_layout();

                    switch ($layout) {
                        case 'hero':
                            get_template_part('template-parts/blocks/block', 'hero');
                            break;

                        case 'tekst':
                            get_template_part('template-parts/blocks/block', 'single-text');
                            break;

                        case 'post_archive':
                            get_template_part('template-parts/blocks/block', 'post-archive');
                            break;

                        case 'tiles':
                            get_template_part('template-parts/blocks/block', 'tiles');
                            break;

                        case 'kaart':
                            get_template_part('template-parts/blocks/block', 'map');
                            break;

                        case 'tekst_met_afbeelding':
                            get_template_part('template-parts/blocks/block', 'image-text');
                            break;

                        case 'form':
                            get_template_part('template-parts/blocks/block', 'form');
                            break;

                        case 'latest_news':
                            get_template_part('template-parts/blocks/block', 'latest-news');
                            break;

                        case 'afbeelding':
                            get_template_part('template-parts/blocks/block', 'image');
                            break;

                        case 'breadcrumbs':
                            get_template_part('template-parts/blocks/block', 'breadcrumbs');
                            break;

                        case 'decoratie':
                            get_template_part('template-parts/blocks/block', 'decoration');
                            break;

                        case 'downloads':
                            get_template_part('template-parts/blocks/block', 'downloads');
                            break;

                        case 'faq':
                            get_template_part('template-parts/blocks/block', 'faq');
                            break;

                        case 'info_slider':
                            get_template_part('template-parts/blocks/block', 'info-slider');
                            break;

                        case 'logo_slider':
                            get_template_part('template-parts/blocks/block', 'logo-slider');
                            break;

                        case 'masonry':
                            get_template_part('template-parts/blocks/block', 'masonry');
                            break;
                    }
                endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php
// Load related posts
get_template_part('template-parts/related-posts');
?>

<?php get_footer(); ?>