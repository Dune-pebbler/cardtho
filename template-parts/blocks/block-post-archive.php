<?php

/**
 * Block Name: Post Archive
 */
$posts_per_page =  get_sub_field('maximum_aantal_posts') ?: 12;
$productgroep = get_sub_field('productgroep');
$i = 3;

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => $posts_per_page,
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
);

if ($productgroep) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => $productgroep[0]->taxonomy,
            'field'    => 'term_id',
            'terms'    => $productgroep[0]->term_id,
        ),
    );
}
$query = new WP_Query($args);
?>

<section class="block-post-archive">
    <div class="container">
        <div class="row row-gap-2">
            <?php if ($query->have_posts()) : ?>
                <?php
                while ($query->have_posts()) :
                    $query->the_post();

                    $is_orderable = get_field('bestelbaar') ?? true;

                    $post_args = array(
                        'title' => get_the_title(),
                        'description' => get_the_excerpt(),
                        'image' => array(
                            'url' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                            'alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)
                        ),
                        'link' => array(
                            'url' => get_permalink(),
                            'title' => 'Bekijken'
                        ),
                        'button' => true,
                        'is_orderable' => $is_orderable,
                    ); ?>
                    <div class="col-12 col-lg-4 col-xl-3" data-animate="fade-up" data-animate-delay="<?= $i * 100 ?>">

                        <?php
                        get_template_part('template-parts/card', null, $post_args);
                        ?>

                    </div>
                    <?php if ($i >= 7) {
                        return;
                    } else {
                        $i++;
                    } ?>
                <?php
                endwhile;
                ?>

                <?php if ($query->max_num_pages > 1) : ?>
                    <div class=" pagination mt-8">
                        <?php
                        echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $query->max_num_pages,
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;',
                        ));
                        ?>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <p>Geen producten gevonden.</p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </div>

</section>