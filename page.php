<?php get_header();?>

	<main>
		<?php if(have_posts()): while(have_posts()):the_post(); ?>
		<h1><?php the_title(); ?></h1>

		<p><?php the_time('Y.m.d'); ?></p>
		<p><?php the_content(); ?></p>

		<?php endwhile; endif; ?>

	</main>

	<aside class="sidebar">
		<?php get_sidebar();?>
	</aside>

<?php get_footer();
