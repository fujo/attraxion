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

//
//
//
add_action( 'wp_ajax_get_all_posts', 'get_all_posts' );
add_action( 'wp_ajax_nopriv_get_all_posts', 'get_all_posts' );
function get_all_posts() {
	global $post;
	$query = new WP_Query(array('post_type' => 'post', 'orderby' => 'date', 'posts_per_page' => 2 ));
	$posts = $query->get_posts();
	include(locate_template( 'test.php' )); 
	die();
}
//
//
//
add_action( 'wp_ajax_get_posts_by_offset', 'get_posts_by_offset' );
add_action( 'wp_ajax_nopriv_get_posts_by_offset', 'get_posts_by_offset' );
function get_posts_by_offset() {
	global $post;
	$offset = $_POST['offset'];
	$query = new WP_Query(array('post_type' => 'post', 'orderby' => 'date', 'offset' => $offset, 'posts_per_page' => 2 ));
	$posts = $query->get_posts();
	include(locate_template( 'test.php' )); 
	die();
}
//
//
//
add_action( 'wp_ajax_get_post_by_id', 'get_post_by_id' );
add_action( 'wp_ajax_nopriv_get_post_by_id', 'get_post_by_id' );
function get_post_by_id() {
	global $post;
	$id = $_POST['post_id'];
	$query = new WP_Query(array('post_type' => 'post', 'orderby' => 'date', 'offset' => $offset, 'posts_per_page' => 2 ));
	$posts = $query->get_posts();
	include(locate_template( 'test.php' )); 
	die();
}
