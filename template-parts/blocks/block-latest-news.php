<?php

/**
 * Block Name: Latest News
 * Description: Displays the 3 most recent news items in the style of the news posts on the archive page
 */

// Get the latest 3 news posts
$latest_news_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
);

$latest_news_query = new WP_Query($latest_news_args);

// Block settings
$block_title = get_sub_field('block_title') ?: 'Laatste nieuws';
$show_view_all = get_sub_field('show_view_all_link') ?: true;
$view_all_text = get_sub_field('view_all_text') ?: 'Bekijk alle nieuws';
$view_all_url = get_sub_field('view_all_url') ?: get_permalink(get_option('page_for_posts'));

?>

<section class="latest-news-block">
    <div class="container mx-auto px-4">
        <div class="latest-news-block__header">
            <h2 class="latest-news-block__title"><?php echo esc_html($block_title); ?></h2>
            <?php if ($show_view_all) : ?>
                <a href="<?php echo esc_url($view_all_url); ?>" class="latest-news-block__view-all">
                    <?php echo esc_html($view_all_text); ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
            <?php endif; ?>
        </div>

        <?php if ($latest_news_query->have_posts()) : ?>
            <div class="latest-news-block__grid">
                <?php while ($latest_news_query->have_posts()) : $latest_news_query->the_post(); ?>
                    <article class="news-card" data-animate="fade-up">
                        <a href="<?php the_permalink(); ?>" class="news-card__link">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-card__image">
                                    <?php the_post_thumbnail('medium', ['class' => 'news-card__img', 'loading' => 'lazy']); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="news-card__content">
                                <div class="news-card__meta">
                                    <time class="news-card__date" datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date('d F Y'); ?>
                                    </time>
                                    <?php 
                                    $categories = get_the_category();
                                    if (!empty($categories) && $categories[0]->name !== 'Geen categorie') : ?>
                                        <span class="news-card__category">
                                            <?php echo esc_html($categories[0]->name); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <h3 class="news-card__title"><?php the_title(); ?></h3>
                                
                                <div class="news-card__excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </div>
                                
                                <span class="news-card__read-more">Lees meer</span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="latest-news-block__no-posts">
                <p>Er zijn momenteel geen nieuwsberichten beschikbaar.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php wp_reset_postdata(); ?>
