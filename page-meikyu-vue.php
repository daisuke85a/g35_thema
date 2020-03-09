<?php 
/*
 * Template Name: Meikyu-vue（Slug:page-meikyu-vue）
 */
// この固定ページのときのみCDNでVueをロードしてる
get_header();?>

<!-- TODO:CDNから読み込みが遅いかも。暫定処置 -->
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- TODO:モダンブラウザならbody内でstyle書いても動くらしい。せめてheadからcssファイル読み出しにしたい。 -->
<style>
#meikyu { 
  background: linear-gradient(-135deg, #E4A972, #9941D8);
  white-space: pre-wrap;
  display: flex;
  justify-content: center;
}
#meikyu div{
 max-width: 600px;
}
#meikyu p { padding: 10px 0; }
#meikyu ul { padding: 10px 0; }

/* ここから下がボタンのCSS　*/
.btn-recommend{
  transition-duration: 0.4s;
  padding: 12px 24px;
  margin: 20px auto;
  border-radius: 4px;
  background-color: #fd9535; /* Orange */
  color: white;
}

.btn-recommend:hover {
  background-color: #4CAF50; /* Green */
  color: white;
}

.btn-answer {
  transition-duration: 0.4s;
  padding: 12px 24px;
  margin: 20px auto;
  border-radius: 4px;
  background-color: #4CAF50; /* Green */
  color: white;
}

.btn-answer:hover {
  background-color: #fd9535; /* Orange */
  color: white;
}

.btn-gradation {
  display: inline-block;
  /* width: 180px; */
  text-align: center;
  font-size: 16px;
  color: #FFF;
  text-decoration: none;
  font-weight: bold;
  padding: 12px 24px;
  border-radius: 4px;
  background-image: linear-gradient(-90deg, #FF006E, #FFD500);
  transition: .5s;
  background-size: 200%;
}

.btn-gradation:hover {
  background-position: right center;
}

.related-article{
  display: block;
  transition-duration: 0.4s;
  padding: 12px 24px;
  border-radius: 4px;
  background-color: gray; /* gray */
  color: white;
}


</style>

<div id="meikyu">
  <div>
    <p>{{questions[status]}}</p>

    <div v-if="recommend">
        <p>おすすめ！</p>
        <button class="btn-gradation" @click="selectRecommend(recommend.id)">{{recommend.name}}</button>
    </div>

    <div v-if="recommend">
        <p>その他</p>
    </div>

    <div v-for="(value, key) in answers[status]">
        <button class="btn-answer" @click="selectAnswer(key)">{{value}}</button>
    </div>

    <!-- 記事取得のテストコード -->
    <div v-if="posts.length != 0">
        <p>関連記事</p>
        <ul v-for="post in posts">
            <li>
            <a class="related-article" v-bind:href="post.link" target="_blank">
                {{post.title.rendered}}
            </a>
            </li>
        </ul>
    </div>
  </div>
</div>

<script>
new Vue( {
  el: '#meikyu',
  data: {
    posts: [],
    recommend: null,
    status: 'first',
    questions:
    {
        'first':'よくきたな。\n働き方に迷うものよ。\nお主にこの迷宮を脱出できるかな。\n試してみよ。',
        'challenge':'すこし、興味があることを、始めてみてはどうじゃ？\nなーに、違ったら戻れば良い。\nそうしてお主の道が育っていくのじゃ',
        'cant':'おやおや働けないとは、なかなか困った困ったじゃの\n今の正直な気持ちをもう一度聞かせてくれはしないか？', 
        'nochalleng':'お主に障害があると決めつけているわけではないぞよ。\nただ、こういう手段があることを知っておいてほしいのじゃ。\nお医者さんは、働き方を教えてくれるとは限らないからの。',
    },
    answers:
    {
        'first': {
			'cant': '働けなくて困ってる',
			'mayoi': '働き方に迷っている',
			'fukugyo': '時短・家で働きたい副業したい',
			'tenshoku': '転職したい',
			'challenge': '新しいことにチャレンジしたい'
		},
        'cant': {
            'nochalleng': 'チャレンジする気力がわかない',
            'tryotherjob': '他の仕事を試したい'
        },
		'challenge': {
			'programming': 'プログラミングに興味がある',
			'design': 'デザインに興味がある',
			'communication': '人との会話がすき',
			'handmade': 'ハンドメイドが好き',
			'kabu': '株・投資に興味がある',
			'kaji': '家事が好き',
		},
		'programming': {
			'geekjob': '未経験からプログラマーへの転職率95.1%！20代第二新卒/フリーター向け【GEEK JOB】',
			'pro': '最高の6ヶ月！超実践型プログラミングスクール【.pro】',
			'itce': '1ヶ月でITエンジニアになれる！【ITCE Academy】',
		},
        'design':{
            'dejihari': 'デジタルハリウッド STUDIO by LIG',
            'techcamp_design': 'テックキャンプ デザイナー転職（無料カウンセリング）'
        },
        'nochalleng': {
            'linkbe': '発達障害専門の就労移行支援【リンクビー】',
            'dodachallenge': 'dodaチャレンジ',
            'atGP':'Web制作と働き続けるスキルがバランス良く身につく就労移行支援【atGPジョブトレ IT・Web】',
            'shigotry':'うつ症状専門の就労移行支援【シゴトライ】',
            'redoors':'統合失調症専門の就労移行支援【リドアーズ】'
        }
    }
  },
  methods: {
    selectAnswer: function(key){
        this.status = key
        if(this.status === 'design'){
            this.recommend = {
                id:'dejihari',
                name:this.answers['design']['dejihari']
            };
            this.getPosts()
        }
        else{
            this.recommend = null
        }
    },
    getPosts: function(){
    // ローカルのMAMP環境からは404エラーで取得できなかった。残念。
    axios.get( 'https://g35.tokyo/wp-json/wp/v2/posts' )
      .then( response => {
        this.posts = response.data;
      } )
      .catch( error => {
        window.alert( error );
      } );
    }
  }
} )
</script>
<?php get_footer();

