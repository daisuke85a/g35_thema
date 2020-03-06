<?php 
/*
 * Template Name: Agent（Slug:page-agent）
 */
get_header();?>

<?php
function getMetaQuery(){
	$meta_query = [];

	// 年収の絞り込み
	switch($_GET['income']){
		case 'none':
			break;
		case 'under':
			$meta_query[] = [
				'key'=> 'yearly_income_upper',
				'value'=> '600',
				'compare' => '<'
			];
			break;
		case 'over':
			$meta_query[] = [
				'key'=> 'yearly_income_upper',
				'value'=> '600',
				'compare' => '>='
			];
			break;
		default:
			break;
	}


	// 年齢の絞り込み
	switch($_GET['age']){	
		case 'none':
			break;
		case '20':
			$meta_query[] = [
				'key'=> 'age',
				'value'=> '20',
				'compare' => '>='
			];
			break;
		case '30':
			$meta_query[] = [
				'key'=> 'age',
				'value'=> '30',
				'compare' => '>='
			];
			break;
		case '40':
			$meta_query[] = [
				'key'=> 'age',
				'value'=> '40',
				'compare' => '>='
			];
			break;
		case '50':
			$meta_query[] = [
				'key'=> 'age',
				'value'=> '50',
				'compare' => '>='
			];
			break;
		default:
			break;
	}
	// こだわり条件での絞り込み
	foreach($_GET['kodawari'] as $kodawari){
		$meta_query[] = [
			'key'=> 'kodawari',
			'value'=> '"' . $kodawari . '"',	//Advanced Custom Fields対策。LIKEのあいまい検索で余計なものを見つけないよう""で囲む。
			'compare' => 'LIKE'
		];
	}

	return $meta_query;
}
?>

<main>
	<section id="agent" class="agent">
		<h2 class="agent__title-sub">エージェント比較ページ</h2>
		<?php
			$meta_query = [];
			$meta_query = getMetaQuery();

			// URLで絞り込み条件を複数指定できる
			// 全ての条件を満たすエージェントを抽出する（AND条件）
			// key[]：カスタムフィールド名(age,ratingなど)
			// value[]：カスタムフィールド名(20,3など)
			// compare[]：比較演算子。(=,<,<=など。省略化。省略すると=になる)
			// 例 (20代) : http://localhost:8800/wordpress/agent-hikaku/?key[]=age&value[]=20
			// 例 (20代以上) : 20代以上　かつ　レートが2以上http://localhost:8800/wordpress/agent-hikaku/?key[]=age&value[]=20&compare[]=%3E=&key[]=rating&value[]=2&compare[]=%3E=
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

		<div class="agent-search-cconditions-view" style="border: black 1px solid; margin: 30px auto;">
			<h3>現在の絞り込み条件</h3>
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
			<h3>絞り込み条件の入力</h3>
			<form action="" method="GET">
				<p>現在の年収を教えてください</p>
				<p>
					<input type="radio" name="income" value="none" checked="checked" style="-webkit-appearance: radio">指定なし
					<input type="radio" name="income" value="under" style="-webkit-appearance: radio">600万円未満
					<input type="radio" name="income" value="over" style="-webkit-appearance: radio">600万円以上
				</p>
				<p>年齢を教えて下さい</p>
				<p>
					<input type="radio" name="age" value="none" checked="checked" style="-webkit-appearance: radio">指定なし
					<input type="radio" name="age" value="20" style="-webkit-appearance: radio">20代
					<input type="radio" name="age" value="30" style="-webkit-appearance: radio">30代
					<input type="radio" name="age" value="40" style="-webkit-appearance: radio">40代
					<input type="radio" name="age" value="50" style="-webkit-appearance: radio">50代以上
				</p>
				<p>こだわり条件を教えて下さい</p>
				<p>
					<input type="checkbox" name="kodawari[]" id="support" value="support" checked="checked" style="-webkit-appearance: radio">
					<label for="support">転職サポートが充実</label>
					<input type="checkbox" name="kodawari[]" value="woman" style="-webkit-appearance: radio">
					<label for="woman">女性の転職に強い</label>
					<input type="checkbox" name="kodawari[]" value="freeter" style="-webkit-appearance: radio">
					<label for="freeter">フリーターの転職実績◎</label>
					<input type="checkbox" name="kodawari[]" value="career_up" style="-webkit-appearance: radio">
					<label for="career_up">キャリアアップに強い</label>
					<input type="checkbox" name="kodawari[]" value="second_graduates" style="-webkit-appearance: radio">
					<label for="second_graduates">第二新卒向け</label>
					<input type="checkbox" name="kodawari[]" value="it_web" style="-webkit-appearance: radio">
					<label for="it_web">IT/WEB業界に強い</label>
					<input type="checkbox" name="kodawari[]" value="foreign_capital" style="-webkit-appearance: radio">
					<label for="foreign_capital">外資企業への転職実績◎</label>
				</p>

				<input type="submit" value="絞り込み" style="-webkit-appearance: button;border: black 1px solid;">
			</form>
		</div>

		<div class="agent-list" style="border: black 1px solid; margin: 30px auto;">
			<h2>エージェント一覧</h2>
			<ul class="agent-list">
				<?php if($posts): foreach($posts as $post): setup_postdata($post); ?>
				<li style="margin: 10px auto;">
					<?php if(get_post_meta($post->ID, 'agent',true)): ?>
						<p class="agent-list__agent">エージェント名：<?php echo get_post_meta($post->ID , 'agent' ,true); ?></p>
					<?php endif; ?>
					<?php if(get_post_meta($post->ID, 'rating',true)): ?>
						<p class="agent-list__rating">評価：<?php echo get_post_meta($post->ID , 'rating' ,true); ?></p>
						<p><?php for($i=0;$i<get_post_meta($post->ID , 'rating' ,true);$i++) echo '★'; ?></p>
					<?php endif; ?>
					<?php if(get_post_meta($post->ID, 'yearly_income_upper',true)): ?>
						<p class="agent-list__yearly_income_upper">年収：<?php echo get_post_meta($post->ID , 'yearly_income_upper' ,true); ?></p>
					<?php endif; ?>
					<?php if(get_post_meta($post->ID, 'age',true)): ?>
						<p class="agent-list__age">年齢：<?php echo get_post_meta($post->ID , 'age' ,true); ?></p>
					<?php endif; ?>
					<?php if(get_post_meta($post->ID, 'kodawari',true)): ?>
						<p class="agent-list__kodawari">こだわり条件：<?php foreach(get_post_meta($post->ID , 'kodawari' ,true) as $kodawari) echo $kodawari . '/'; ?></p>
					<?php endif; ?>
				</li>
				<?php endforeach; endif; ?>
			</ul>
		</div>
	</section>
</main>

<?php get_footer();
