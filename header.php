<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-159211204-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-159211204-1');
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>

	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,500,700,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lexend+Deca&display=swap" rel="stylesheet">
</head>

<body <?php body_class(); ?>>
	<header class="header">
		<div class="header-nav">
			<div class="header-inner">
				<a class="header-nav-logo-area" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if ( is_home() || is_front_page() ) : ?>
					<h1 class="header-nav-title"><?php bloginfo( 'name' ); ?></h1>
				<?php else : ?>
					<p class="header-nav-title"><?php bloginfo( 'name' ); ?></p>
				<?php endif; ?>
					<p class="header-nav-description"><?php bloginfo( 'description' ); ?></p>
				</a>
				<div class="header-nav-menu">
					<input type="checkbox" id="tab">
					<label for="tab"></label>
					<div class="header-nav-menu-list">
						<?php wp_nav_menu( array( 'theme_location' => 'g-nav' ) ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php if ( is_home() || is_front_page() ) : ?>
			<div class="header-mv">
				<img src="<?php header_image(); ?>" alt="">
			</div>
		<?php endif; ?>
	</header>