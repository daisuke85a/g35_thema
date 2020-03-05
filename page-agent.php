<?php 
/*
 * Template Name: Agent（Slug:page-agent）
 */
get_header();?>

<main>
	<section id="agent" class="agent">
		<p class="agent__title-sub">エージェント比較ページ</p>
		<ul class="agent-list wrap">
			<?php
				$posts = get_posts(array(
					'posts_per_page' => 4,
					'post_type' => 'agent',    //投稿タイプの指定
					'orderby' => $_GET['orderby'],
					'order'   => $_GET['order'],
				));
			?>
			<p>------------------------------------------------------------------------------</p>
			<?php if($posts): foreach($posts as $post): setup_postdata($post); ?>
			<li>
				<?php if(get_post_meta($post->ID, 'agent',true)): ?>
					<p class="agent-list__agent">エージェント名：<?php echo get_post_meta($post->ID , 'agent' ,true); ?></p>
				<?php endif; ?>
				<?php if(get_post_meta($post->ID, 'rating',true)): ?>
					<p class="agent-list__rating">評価：<?php echo get_post_meta($post->ID , 'rating' ,true); ?></p>
					<p><?php for($i=0;$i<get_post_meta($post->ID , 'rating' ,true);$i++) echo '★'; ?></p>
				<?php endif; ?>
				<p>------------------------------------------------------------------------------</p>
			</li>
			<?php endforeach; endif; ?>
		</ul>
	</section>
</main>

<?php get_footer();
