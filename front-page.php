<?php get_header();?>

<main>
	<section id="pickUp" class="pick-up">
		<h2 class="pick-up__title">
			<img src="<?php echo get_template_directory_uri(); ?>/images/pick-up-title.png" srcset="<?php echo get_template_directory_uri(); ?>/images/pick-up-title.png 1x, <?php echo get_template_directory_uri(); ?>/images/pick-up-title@2x.png 2x" alt="PICK UP">
		</h2>
		<p class="pick-up__title-sub">いろんな働き方が見つかる!<br>ごきげんなインタビュー<br>（具体的に何がわかるのかかいてあげたい）</p>
		<ul class="pick-up-list wrap">
			<?php
				$posts = get_posts(array(
					'posts_per_page' => 4,
					'category' => 2 //interview
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
					<div class="pick-up-list-inner">
						<?php if(get_post_meta($post->ID, 'interviewee-title',true)): ?>
							<p class="pick-up-list__interviewee-title"><?php echo get_post_meta($post->ID , 'interviewee-title' ,true); ?></p>
						<?php endif; ?>
						<?php if(get_post_meta($post->ID, 'interviewee-name',true)): ?>
							<p class="pick-up-list__interviewee-name"><?php echo get_post_meta($post->ID , 'interviewee-name' ,true); ?></p>
						<?php endif; ?>
						<h3 class="pick-up-list__title">
						<?php echo wp_trim_words( get_the_title(), 30, '...' );?>
						</h3>
					</div>
				</a>
			</li>
			<?php endforeach; endif; ?>
		</ul>
		<button class="pick-up__button" onclick="location.href='<?php echo esc_url( home_url( 'category/interview' ) ); ?>'">一覧はこちら</button>
	</section>
	<section id="movie" class="movie">
		<div class="movie-inner">
		<h2 class="movie__title">
			<img src="<?php echo get_template_directory_uri(); ?>/images/movie-title.png" srcset="<?php echo get_template_directory_uri(); ?>/images/movie-title.png 1x, <?php echo get_template_directory_uri(); ?>/images/movie-title@2x.png 2x" alt="MOVIE">
		</h2>
		<p class="movie__title-sub">ここにも何かコメント書いた方がいいのかな</p>
		<div class="movie-area wrap">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/rPTKNk1vU5w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
		<p>この辺に見出しとその場面に飛べるリンクを貼ってあげたいかも</p>
		<p>
			例<br>
			１．「アプリケーション開発」ってどんな仕事？1:00<br>
			２．今の働き方の魅力 2:00<br>
			３．今の働き方を選んだ理由 3:00<br>
			４．どうやって今の働き方が実現したか 4:00<br>
			５．今の働き方の苦労 5:00<br>
			６．きゅ〜ぶ君にとっての「成長」とは 6:00<br>
		</p>
		<button class="movie__button" onclick="location.href='<?php echo esc_url( home_url( 'category/interview' ) ); ?>'">一覧はこちら</button>
		</div>
	</section>

	<section id="column" class="column">
		<h2 class="column__title">
			<img src="<?php echo get_template_directory_uri(); ?>/images/pick-up-title.png" srcset="<?php echo get_template_directory_uri(); ?>/images/pick-up-title.png 1x, <?php echo get_template_directory_uri(); ?>/images/pick-up-title@2x.png 2x" alt="PICK UP">
		</h2>
		<p class="column__title-sub">働き方の事例もいっぱい<br>ごきげんなコラム</p>
		<ul class="column-list wrap">
			<?php
				$posts = get_posts(array(
					'posts_per_page' => 4,
					'category' => 1 //column
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
					<div class="column-list-inner">
						<p class="column-list__time"><?php the_time('Y-m-d'); ?></p>
						<h3 class="column-list__title">

						<?php echo wp_trim_words( get_the_title(), 50, '...' );?>
						</h3>
					</div>
				</a>
				<?php the_tags('<ul class="column-list__tag"><li>','</li><li>','</li></ul>'); ?>
				<?php the_category(); ?>
			</li>
			<?php endforeach; endif; ?>
		</ul>
		<button class="column__button" onclick="location.href='<?php echo esc_url( home_url( 'category/column' ) ); ?>'">一覧はこちら</button>
	</section>

	<section class="questionnaire">
		<h2 class="questionnaire-title">
			働き方アンケート的なやつ
		</h2>
		<div class="questionnaire-form wrap">
			<?php echo do_shortcode('[mwform_formkey key="55"]'); ?>
		</div>
	</section>

	<section class="recommended">
		<h2 class="recommended-title">
			おすすめ記事
		</h2>
		<div class="recommended wrap">
			<p>おすすめ記事一覧</p>
		</div>
	</section>

	<section class="recommended">
		<h2 class="recommended-title">
			ここにコンバージョンをおきたい
		</h2>
		<div class="recommended wrap">
			<p>転職サイトの絞り込みフォームがあるといいのかも</p>
		</div>
	</section>

</main>

<?php get_footer();
