<?php 
/*
 * Template Name: Agent（Slug:page-agent）
 */
get_header();?>

<main>
	<section id="agent" class="agent">
		<h2 class="agent__title-sub">エージェント比較ページ</h2>
		<?php
			// URLで絞り込み条件を複数指定できる
			// 全ての条件を満たすエージェントを抽出する（AND条件）
			// key[]：カスタムフィールド名(age,ratingなど)
			// value[]：カスタムフィールド名(20,3など)
			// compare[]：比較演算子。(=,<,<=など。省略化。省略すると=になる)
			// 例 (20代) : http://localhost:8800/wordpress/agent-hikaku/?key[]=age&value[]=20
			// 例 (20代以上) : 20代以上　かつ　レートが2以上http://localhost:8800/wordpress/agent-hikaku/?key[]=age&value[]=20&compare[]=%3E=&key[]=rating&value[]=2&compare[]=%3E=
			$meta_query = [];
			for($i=0;$i<count($_GET['key']);$i++){
				$meta_query[] = [
					'key'=> $_GET['key'][$i],
					'value'=> $_GET['value'][$i],
					'compare' => $_GET['compare'][$i] === null ? '=' : $_GET['compare'][$i]
				];
			}
			$posts = get_posts(array(
				'posts_per_page' => 4,
				'post_type' => 'agent',
				'orderby' => $_GET['orderby'],
				'order'   => $_GET['order'],
				'meta_query' => $meta_query
			));
		?>

		<h3>絞り込み条件</h3>
		<?php if($meta_query != []) :?>
			<p>次の条件をすべて満たすエージェントを表示</p>
			<ul class="agent-list">
				<li>
				<?php foreach($meta_query as $item): ?>
					<p>絞り込みキー: <?php echo($item['key']); ?></p>
					<p>絞り込みの値: <?php echo($item['value']); ?> </p>
					<p>絞り込みの比較: <?php echo($item['compare']); ?> </p>
				<?php endforeach; ?>
				</li>
			</ul>
		<?php else: ?>
			<p>絞り込みなし</p>
		<?php endif; ?>
	
		<h2>エージェント一覧</h2>
		<ul class="agent-list">
			<?php if($posts): foreach($posts as $post): setup_postdata($post); ?>
			<li>
				<?php if(get_post_meta($post->ID, 'agent',true)): ?>
					<p class="agent-list__agent">エージェント名：<?php echo get_post_meta($post->ID , 'agent' ,true); ?></p>
				<?php endif; ?>
				<?php if(get_post_meta($post->ID, 'rating',true)): ?>
					<p class="agent-list__rating">評価：<?php echo get_post_meta($post->ID , 'rating' ,true); ?></p>
					<p><?php for($i=0;$i<get_post_meta($post->ID , 'rating' ,true);$i++) echo '★'; ?></p>
				<?php endif; ?>
			</li>
			<?php endforeach; endif; ?>
		</ul>
	</section>
</main>

<?php get_footer();
