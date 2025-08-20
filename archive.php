<?php get_header(); ?>

<section class="news-archive">
    <div class="container mx-auto px-4">
        <div class="news-archive__header">
            <h1 class="news-archive__title">Nieuws</h1>
            <p class="news-archive__subtitle">Blijf op de hoogte van het laatste nieuws</p>
            
            <!-- Search Form -->
            <div class="news-archive__search">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="search-input-group">
                        <input type="search" 
                               class="search-field" 
                               placeholder="Zoek in nieuws..." 
                               value="<?php echo get_search_query(); ?>" 
                               name="s" />
                        <button type="submit" class="search-submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="news-archive__content">
            <?php if (have_posts()) : ?>
                <div class="news-grid">
                    <?php while (have_posts()) : the_post(); ?>
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
                                    
                                    <h2 class="news-card__title"><?php the_title(); ?></h2>
                                    
                                    <div class="news-card__excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </div>
                                    
                                    <span class="news-card__read-more">Lees meer</span>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="news-archive__pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i> Vorige',
                        'next_text' => 'Volgende <i class="fas fa-chevron-right"></i>',
                        'screen_reader_text' => 'Paginatie',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="news-archive__no-posts">
                    <h2>Geen berichten gevonden</h2>
                    <p>Er zijn momenteel geen nieuwsberichten beschikbaar.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
