<?php get_header();?>

<h2 class="category__title"><?php wp_title(''); ?></h2>
<div class="container wrap">
    <main>
        <section class="category-inner wrap">
            <ul class="category-list">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
                <li>
                    <a href="<?php the_permalink() ?>">
                        <?php if(has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('index_thumbnail'); ?>
                        <?php else: ?> 
                            <img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="category-list-inner">
                            <?php if(get_post_meta($post->ID, 'interviewee-title',true)): ?>
                                <p class="pick-up-list__interviewee-title"><?php echo get_post_meta($post->ID , 'interviewee-title' ,true); ?></p>
                            <?php endif; ?>
                            <?php if(get_post_meta($post->ID, 'interviewee-name',true)): ?>
                                <p class="pick-up-list__interviewee-name"><?php echo get_post_meta($post->ID , 'interviewee-name' ,true); ?></p>
                            <?php endif; ?>
                            <h3 class="category-list__title">
                                <?php echo wp_trim_words( get_the_title(), 40, '...' );?>
                            </h3>
                        </div>
                    </a>
                </li>
                <?php endwhile;?>
            </ul>
            <?php
                $big = 9999999999;
                $arg = array(
                'base' => str_replace( $big, '  ', esc_url( get_pagenum_link( $big ) ) ),
                'current' => max( 1, get_query_var('paged') ),
                'total'   => $wp_query->max_num_pages,
                'type'    => 'list',
                'prev_text'          => __('<前へ'),
                'next_text'          => __('次へ>')
                );

                echo paginate_links($arg);
            ?>
            <?php else : ?>
                お探しの記事はありません
            <?php endif ; ?>
        </section>
    </main>

    <aside class="sidebar">
        <?php get_sidebar();?>
    </aside>
</div>

<?php get_footer();