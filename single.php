<?php get_header(); ?>

<article class="single-post">
    <div class="container mx-auto px-4">
        <?php while (have_posts()) : the_post(); ?>
            
            <!-- Post Header -->
            <header class="single-post__header">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-post__featured-image">
                        <?php the_post_thumbnail('large', ['class' => 'single-post__img']); ?>
                    </div>
                <?php endif; ?>
                
                <div class="single-post__meta">
                    <div class="single-post__breadcrumb">
                        <a href="<?php echo get_post_type_archive_link('post'); ?>">Nieuws</a>
                        <span class="separator">/</span>
                        <span class="current"><?php the_title(); ?></span>
                    </div>
                    
                    <h1 class="single-post__title"><?php the_title(); ?></h1>
                    
                    <div class="single-post__info">
                        <time class="single-post__date" datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date('d F Y'); ?>
                        </time>
                        
                        <?php 
                        $categories = get_the_category();
                        if (!empty($categories) && $categories[0]->name !== 'Geen categorie') : ?>
                            <span class="single-post__category">
                                <?php echo esc_html($categories[0]->name); ?>
                            </span>
                        <?php endif; ?>
                        
                    
                    </div>
                </div>
            </header>

            <!-- Post Content -->
            <div class="single-post__content">
                <div class="single-post__body">
                    <?php the_content(); ?>
                </div>
                
                <!-- Post Tags -->
                <?php if (has_tag()) : ?>
                    <div class="single-post__tags">
                        <h4>Tags:</h4>
                        <div class="tags-list">
                            <?php the_tags('', '', ''); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Post Navigation -->
            <nav class="single-post__navigation">
                <div class="post-nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                        <div class="post-nav-link post-nav-link--prev">
                            <a href="<?php echo get_permalink($prev_post); ?>">
                                <span class="nav-direction">
                                    <i class="fas fa-chevron-left"></i> Vorig artikel
                                </span>
                                <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <div class="post-nav-link post-nav-link--next">
                            <a href="<?php echo get_permalink($next_post); ?>">
                                <span class="nav-direction">
                                    Volgend artikel <i class="fas fa-chevron-right"></i>
                                </span>
                                <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

        <?php endwhile; ?>
    </div>
</article>

<!-- Related Posts -->
<?php 
// Create a modified version of related posts for regular posts
$current_post_id = get_the_ID();
$current_categories = wp_get_post_terms($current_post_id, 'category', array('fields' => 'ids'));

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post__not_in'   => array($current_post_id),
    'orderby'        => 'rand',
);

if (!empty($current_categories)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $current_categories,
            'operator' => 'IN',
        ),
    );
}

$related_query = new WP_Query($args);

if ($related_query->have_posts()) : ?>
    <section class="related-posts">
        <div class="container mx-auto px-4">
            <div class="related-posts__header">
                <h2 class="related-posts__title">Gerelateerde artikelen</h2>
            </div>
            
            <div class="related-posts__grid">
                <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                    <article class="related-post-card">
                        <a href="<?php the_permalink(); ?>" class="related-post-card__link">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="related-post-card__image">
                                    <?php the_post_thumbnail('medium', ['class' => 'related-post-card__img']); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="related-post-card__content">
                                <time class="related-post-card__date" datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date('d F Y'); ?>
                                </time>
                                
                                <h3 class="related-post-card__title"><?php the_title(); ?></h3>
                                
                                <div class="related-post-card__excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer(); ?>
