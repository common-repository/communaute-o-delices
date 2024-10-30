<?php
/*
Plugin name: Communauté Ôdélices
Plugin URI: http://www.odelices.com
Author: Julia Briend
Author URI: http://juliabr.com
Version: 1.0
Description: Ajoute un bouton "J'aime cet article" par Ôdélices.
*/

if ( !defined( 'ODE_URL' ) )
	define( 'ODE_URL', 'http://www.odelices.com' );

if ( !defined( 'ODE_PLUGIN_URL' ) )
	define( 'ODE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



add_filter('the_content', 'ode_content_hook', 5);
add_action('wp_enqueue_scripts', 'ode_enqueue_scripts');

function ode_content_hook($content) {

	$content .= ode_like_button_html();

	return $content;

}

function ode_like_button_html() {
	
	$permalink = urlencode(strip_tags(get_permalink()));
	
	$rand = rand(0,1000000);

	return '
<!-- Bouton Ô Délices DEBUT -->
<div id="ode_button_like'.$rand.'" class="ode_button_like" style="width:180px;height:30px;position:relative;padding:0;margin:10px 0;clear:both;" name="'.$permalink.'"><a href="http://www.odelices.com/communaute/" target="_blank" style="display:block;width:150px;height:30px;position:absolute;top:0;left:0;" title="J\'aime cet article sur Ô délices !"><img src="'.ODE_PLUGIN_URL.'/img/btn_jaime.png" border="0" style="background:transparent;padding:0;border:0;margin:0;float:none;" /></a><a href="http://www.odelices.com" target="_blank" style="display:block;width:30px;height:30px;position:absolute;top:0;left:150px;" title="Rendez-vous sur Ô délices !"><img src="'.ODE_PLUGIN_URL.'/img/btn_ode.png" border="0" alt="Rendez-vous sur Ô délices !" style="background:transparent;padding:0;border:0;margin:0;float:none;" /></a>
</div>
<!-- Bouton Ô Délices FIN -->';

}

function ode_enqueue_scripts() {
	wp_register_script('ode_button_widget', 'http://www.odelices.com/button_widget.js', false, null, 1);
	wp_enqueue_script('ode_button_widget');
}

?>