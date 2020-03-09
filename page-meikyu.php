<?php 
/*
 * Template Name: Meikyu（Slug:page-meikyu）
 */
get_header();?>

<?php
function getQuestion($name){
	$ret = [
		'first' => 'よくきたな。<br/>働き方に迷うものよ。<br/>お主にこの迷宮を脱出できるかな。<br/>試してみよ。',
		'challenge' => 'すこし、興味があることを、始めてみてはどうじゃ？なーに、違ったら戻れば良い。そうしてお主の道が育っていくのじゃ' 
	];
	return $ret[$name];
}

function getAnswerList($name){
	$ret = [
		'first' => [
			'cant' => '働けなくて困ってる',
			'mayoi' => '働き方に迷っている',
			'fukugyo' => '時短・家で働きたい副業したい',
			'tenshoku' => '転職したい',
			'challenge' => '新しいことにチャレンジしたい'
		],
		'challenge' => [
			'programming' => 'プログラミングに興味がある',
			'design' => 'デザインに興味がある',
			'communication' => '人との会話がすき',
			'handmade' => 'ハンドメイドが好き',
			'kabu' => '株・投資に興味がある',
			'kaji' => '家事が好き',
		],
		'programming' => [
			'geekjob' => '未経験からプログラマーへの転職率95.1%！20代第二新卒/フリーター向け【GEEK JOB】',
			'pro' => '最高の6ヶ月！超実践型プログラミングスクール【.pro】',
			'itce' => '1ヶ月でITエンジニアになれる！【ITCE Academy】',
		]		
	];

	return $ret[$name];
}

function setAnswer(){
	if( ($_POST["question"] !== null) && ($_POST["answer"] !== null) ){
		setcookie('answer[]', $_POST["answer"], time()+3600);
	}else{
		echo 'no post'
	}
}

function getQuestionKey(){
	return 'first';
}

?>

<?php
setAnswer();
$question = getQuestionKey();
echo 'cookie= ' . $_COOKIE["answer"] . '<br/>';
echo 'question=' . $_POST["question"] . '<br/>';
echo 'answer=' . $_POST["answer"] . '<br/>';
?>

<main>
	<section id="meikyu" class="meikyu">
		<h2 class="meikyu__title-sub">働き方の迷宮</h2>

		<div class="meikyu__answer" style="border: black 1px solid; margin: 30px auto;">
			<form action="" method="POST">
				<input name="question" type="hidden" value="<?= $question ?>">
				<?php if($answers = getAnswerList($question)): foreach($answers as $key => $value):?>
					<p><input type="radio" name="answer" value="<?= $key ?>" style="-webkit-appearance: radio"><?= $value ?></p>
				<?php endforeach; endif; ?>
				<input type="submit" value="回答" style="-webkit-appearance: button;border: black 1px solid;">
			</form>
		</div>

	</section>
</main>

<?php get_footer();
