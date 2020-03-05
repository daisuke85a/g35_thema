<?php

// WordPress標準機能
function gokigen_setup() {
	add_theme_support( 'custom-logo' ); /* カスタムロゴ */
	add_theme_support( 'custom-header' ); /* カスタムヘッダー */
	add_theme_support( 'post-thumbnails' ); /* アイキャッチ */
	add_theme_support( 'automatic-feed-links' ); /* RSSフィード */
	add_theme_support( 'title-tag' ); /* タイトルタグ自動生成 */
	add_theme_support( 'html5', array( /* HTML5のタグで出力 */
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
add_action( 'after_setup_theme', 'gokigen_setup' );


// CSS/JavaScript
function gokigen_script_init() {
	wp_enqueue_style( 'style-name', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'gokigen_script_init' );


// menu
function gokigen_menu_init() {
	register_nav_menus( array(
		'g-nav'  => 'グローバルナビ',
		'footer-nav'  => 'フッターナビ',
	) );
}
add_action( 'init', 'gokigen_menu_init' );