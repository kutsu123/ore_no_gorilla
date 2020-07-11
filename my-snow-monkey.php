<?php
/**
 * Plugin name: おれのゴリラ
 * Description: このプラグインに、Snow Monkey 用カスタマイズコードが入っています
 * Version: 0.1.0
 *
 * @package my-snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
$theme = wp_get_theme( get_template() );
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	return;
}

/**
 * 定数を宣言
 */
define( 'MSM_PLUGIN_URL', plugins_url( '', __FILE__ ) ); // このプラグインのURL
define( 'MSM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); // このプラグインのパス


/**
 * 外部JS・CSSの読み込み
 */
add_action( 'wp_enqueue_scripts', 'msm_enqueue_style_script' );
function msm_enqueue_style_script() {
	wp_enqueue_style( 'msm_style', MSM_PLUGIN_URL . '/src/css/msm_style.css' );
}


/**
 * 外部ファイルの読み込み
 */
// require_once MSM_PLUGIN_PATH . 'inc/class-Utility.php';


/**
 * テーマファイルの読み込み先の変更
 * https://github.com/inc2734/snow-monkey/wiki/Filter-hooks#snow_monkey_template_part_root_hierarchy
 *
 * @param array $hierarchy ルートディレクトリ配列
 * @param array $slug 対象のtemplateのslug
 * @param array $name 対象のtemplateの名前
 * @param array $vars パラメータ
 * @return $root ルート先とするディレクトリ配列
 */
add_filter(
	'snow_monkey_template_part_root_hierarchy',
	function( $hierarchy, $slug, $name, $vars ) {
		$hierarchy[] = MSM_PLUGIN_PATH . '/template_root';
		return $hierarchy;
	},
	10,
	4
);


/**
 * 固定ページのslugで識別できるbody_classを追加
 *
 * @param array $classes 出力予定のbody class
 * @return $classes 変更したboxy class
 */
add_filter( 'body_class', 'msm_is_page_add_bodyclass' );
function msm_is_page_add_bodyclass( $classes ) {
	global $post;
	if ( is_page() ) {
		$classes[] = 'page-'.$post->post_name;
	}
	return $classes;
}