<?php get_header(); ?>

<section class="product-archive">
    <div class="container mx-auto px-4">
        <div class="product-archive__header">
            <h1 class="product-archive__title">Producten</h1>
            <p class="product-archive__subtitle">Bekijk al onze beschikbare producten</p>
            
            <!-- Search Form -->
            <div class="product-archive__search">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="search-input-group">
                        <input type="search" 
                               class="search-field" 
                               placeholder="Zoek in producten..." 
                               value="<?php echo get_search_query(); ?>" 
                               name="s" />
                        <input type="hidden" name="post_type" value="product" />
                        <button type="submit" class="search-submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="product-archive__content">
            <?php 
            // Query for products
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $products_query = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => 12,
                'paged' => $paged,
                'post_status' => 'publish'
            ));
            
            if ($products_query->have_posts()) : ?>
                <div class="product-grid">
                    <?php while ($products_query->have_posts()) : $products_query->the_post(); ?>
                        <article class="product-card" data-animate="fade-up">
                            <a href="<?php the_permalink(); ?>" class="product-card__link">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="product-card__image">
                                        <?php the_post_thumbnail('medium', ['class' => 'product-card__img', 'loading' => 'lazy']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="product-card__content">
                                    <h2 class="product-card__title"><?php the_title(); ?></h2>
                                    
                                    <div class="product-card__excerpt">
                                        <?php 
                                        // Check if custom thumbnail text is available, otherwise use excerpt
                                        $custom_thumbnail_text = get_field('korte_thumbnail_text');
                                        if ($custom_thumbnail_text) {
                                            echo wp_kses_post($custom_thumbnail_text);
                                        } else {
                                            echo wp_trim_words(get_the_excerpt(), 20, '...');
                                        }
                                        ?>
                                    </div>
                                    
                                    <span class="product-card__read-more">Bekijk product</span>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="product-archive__pagination">
                    <?php
                    $big = 999999999;
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $products_query->max_num_pages,
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i> Vorige',
                        'next_text' => 'Volgende <i class="fas fa-chevron-right"></i>',
                        'screen_reader_text' => 'Paginatie',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="product-archive__no-posts">
                    <h2>Geen producten gevonden</h2>
                    <p>Er zijn momenteel geen producten beschikbaar.</p>
                </div>
            <?php endif; 
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
