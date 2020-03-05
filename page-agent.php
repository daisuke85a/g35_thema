<?php 
/*
 * Template Name: Agent（Slug:page-agent）
 */
get_header();?>

<main>
	<section id="agent" class="agent">
		<h2 class="agent__title">
			<img src="<?php echo get_template_directory_uri(); ?>/images/pick-up-title.png" srcset="<?php echo get_template_directory_uri(); ?>/images/pick-up-title.png 1x, <?php echo get_template_directory_uri(); ?>/images/pick-up-title@2x.png 2x" alt="PICK UP">
		</h2>
		<p class="agent__title-sub">エージェント比較ページ</p>
		<ul class="agent-list wrap">
			<?php
				$posts = get_posts(array(
					'posts_per_page' => 4,
					'post_type' => 'agent'    //投稿タイプの指定
				));
			?>
			<?php if($posts): foreach($posts as $post): setup_postdata($post); ?>
			<li>
				<a href="<?php the_permalink() ?>">
					<?php if(has_post_thumbnail()): ?>
						<?php the_post_thumbnail('index_thumbnail'); ?>
					<?php else: ?> 
						<img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="<?php the_title(); ?>">
					<?php endif; ?>
					<div class="agent-list-inner">
						<?php if(get_post_meta($post->ID, 'agent',true)): ?>
							<p class="agent-list__agent">エージェント名：<?php echo get_post_meta($post->ID , 'agent' ,true); ?></p>
						<?php endif; ?>
						<?php if(get_post_meta($post->ID, 'rating',true)): ?>
                            <p class="agent-list__rating">評価：<?php echo get_post_meta($post->ID , 'rating' ,true); ?></p>
                            <p><?php for($i=0;$i<get_post_meta($post->ID , 'rating' ,true);$i++) echo '★'; ?></p>
						<?php endif; ?>
					</div>
				</a>
			</li>
			<?php endforeach; endif; ?>
		</ul>
		<button class="pick-up__button" onclick="location.href='<?php echo esc_url( home_url( 'category/interview' ) ); ?>'">一覧はこちら</button>
	</section>
</main>

<?php get_footer();
