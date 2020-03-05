<?php get_header();?>
<div class="container wrap">
	<main class="entry-content">
		<?php if(have_posts()): while(have_posts()):the_post(); ?>
		<h1 class="entry-content"><?php the_title(); ?></h1>
		<p><?php the_time('Y.m.d'); ?></p>
		<?php if (has_post_thumbnail()) : ?>
			<?php the_post_thumbnail(); ?>
		<?php endif ; ?>
		<p>SNSボタン入れたい</p>
		<p>目次入れたい</p>
		<p><?php the_content(); ?></p>
		<p>SNSボタン入れたい</p>
		<p>関連しそうな取材記事</p>
		<p>人気の記事</p>

		<?php endwhile; endif; ?>

	</main>

	<aside class="sidebar">
		<?php get_sidebar();?>
	</aside>
</div>

<?php get_footer();
