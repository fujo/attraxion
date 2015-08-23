<?php
/*****************************************

AJAX 

*****************************************/
add_action( 'wp_ajax_mon_action', 'mon_action' );
add_action( 'wp_ajax_nopriv_mon_action', 'mon_action' );

function mon_action() {

	$param = $_POST['param'];

	echo $param;

	die();
}

add_action( 'wp_ajax_get_post_content', 'get_post_content' );
add_action( 'wp_ajax_nopriv_get_post_content', 'get_post_content' );
function get_post_content() {

	$url = $_POST['url'];

	$postid = url_to_postid( get_site_url().$url ); 

	echo $postid;

	die();




}