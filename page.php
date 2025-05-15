<?php get_header();?>

<?php the_content(); ?>


<?php get_footer();?>

<!-- // if (have_rows('content_blocks')):
//     while (have_rows('content_blocks')) : the_row();
//         $layout = get_row_layout();

//         switch ($layout) {
//             case 'hero':
//                 get_template_part('template-parts/blocks/block', 'hero');
//                 break;

//             case 'text':
//                 get_template_part('template-parts/blocks/block', 'single-text');
//                 break;

//             case 'post_archive':
//                 get_template_part('template-parts/blocks/block', 'post-archive');
//                 break;
//         }
//     endwhile;
// endif; -->
