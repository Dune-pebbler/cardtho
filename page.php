<?php get_header();

if (have_rows('content_blocks')):
    while (have_rows('content_blocks')) : the_row();
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

                
        }
    endwhile;
endif;

get_footer();
