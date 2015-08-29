<?php

error_reporting(E_ALL); ini_set('display_errors', 0);

function relativePathForUploads($fileInfos)
{
	global $blog_id;
	$path = get_blog_option($blog_id,'siteurl');

	$fileInfos['url'] = str_replace($path,'',$fileInfos['url']);

	return $fileInfos;
}
add_filter('wp_handle_upload', 'relativePathForUploads');

// disallow edition of theme files in wp-admin
define( 'DISALLOW_FILE_EDIT', true );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 */
add_action( 'after_setup_theme', 'attraxion15_setup' );
function attraxion15_setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'aquatheme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'attraxion15', get_template_directory() . '/languages' );
	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable navigations menu
	 *
	 */
	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
			'main' 		=> __( 'Main Menu' ),
			'meta' 		=> __( 'Meta Menu' ),
			'footer' 	=> __( 'Footer Menu' )
	));
	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true ); // default Post Thumbnail dimensions (cropped)
	
	// additional image sizes
	// add_image_size ( string $name, int $width, int $height, bool|array $crop = false )
	// delete the next line if you do not need additional image sizes
	// add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	// add_image_size( 'large_thumb', 600, 600, true );
	// add_image_size( 'blog_thumb', 600, 600, true );
	// add_image_size( 'wider_image', 200, 150 );
	// use it: 
	// - wp_get_attachment_image_src( 325, 'wider_image'); 
	// - the_post_thumbnail();

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
/**
* Register style sheets
* @link https://codex.wordpress.org/Function_Reference/wp_register_style
*/
add_action( 'wp_enqueue_scripts', 'attraxion15_enqueue_custom_stylesheets', 11 );
function attraxion15_enqueue_custom_stylesheets() {

  wp_enqueue_style( 'attraxion15', get_template_directory_uri() . '/css/style.css' );

}
/**
 * Register stylesheets + js scripts
 * Proper way to enqueue scripts and styles
 * @link https://codex.wordpress.org/Function_Reference/wp_enqueue_script
 */
add_action( 'wp_enqueue_scripts', 'attraxion15_js_scripts', 10 );
function attraxion15_js_scripts() {
	//wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	wp_enqueue_script( 'app2', get_template_directory_uri() . '/js/plugins.js', array('jquery' ), '1.0', true );
	wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array('jquery' ), '1.0', true );
	// pass var "ajaxurl" to app.js
	wp_localize_script('app', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
add_action( 'widgets_init', 'attraxion15_widgets_init' );
function attraxion15_widgets_init() {

	register_sidebar(array(
		'name' => 'Footer Left',
		'id'   => 'footer_left',
		'description'   => 'This is the widgetized footer.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

}
/*
*
*	Tiny MCE setup
*
*	https://codex.wordpress.org/TinyMCE_Custom_Styles
*	http://www.tinymce.com/wiki.php/TinyMCE3x:Buttons/controls
*
*/
// add_filter('tiny_mce_before_init', 'attraxion15_make_mce_awesome');
function attraxion15_make_mce_awesome($in) {
    $in['block_formats'] = 'h2=h2';
    $in['theme_advanced_styles'] = '.lead=lead';
    $in['toolbar1']='formatselect,|,bold,italic,|,bullist,numlist,blockquote,|,link,unlink,|,pastetext,undo,redo,|,cleanup';
    //$in['toolbar1']='bold,italic,|,bullist,numlist,blockquote,|,link,unlink,|,pastetext,undo,redo';
    $in['toolbar2']='';
    $in['toolbar3']='';
    $in['toolbar4']='';
    return $in;
}
/*

Add class to edit button

*/
function custom_edit_post_link($output) {
 $output = str_replace('class="post-edit-link"', 'class="post-edit-link btn icn edit"', $output);
 return $output;
}
add_filter('edit_post_link', 'custom_edit_post_link');
/*

Add Excerpts to Your Pages in WordPress

*/
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
/*

Add Excerpts to Your Pages in WordPress

*/
add_filter( "the_excerpt", "add_class_to_excerpt" );
function add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="excerpt"', $excerpt);
}
/*

Excerpts length

*/
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length ) {
	return 20;
}
/*

Get the perfect title provides the perfect title for your page
Source : https://digwp.com/demo/Digging-Into-WordPress_DEMO.pdf

*/
function get_perfect_title() {
	if (function_exists('is_tag') && is_tag()) {
		single_tag_title('Tag Archive for &quot;'); echo '&quot; - ';
	} elseif (is_archive()) {
		wp_title(''); echo ' Archive - ';
	} elseif (is_search()) {
		echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
	} elseif (!(is_404()) && (is_single()) || (is_page())) {
		wp_title(''); echo ' - ';
	} elseif (is_404()) {
		echo 'Not Found - ';
	}
	if (is_home()) {
		bloginfo('name'); echo ' - '; bloginfo('description');
	} else {
		bloginfo('name');
	}
	if ($paged > 1) {
		echo ' - page '. $paged;
	} 
}
/**
 * Global Custom Fields
 * A value that you can access from anywhere that returns a value you can use. 
 * Posts and Pages can have custom fields as well.
 * get the value: <?php echo get_option('myname'); ?>
 * @link https://digwp.com/demo/Digging-Into-WordPress_DEMO.pdf
*/
add_action('admin_menu', 'add_gcf_interface');
function add_gcf_interface() {
	add_options_page(
		'Global Custom Fields', 	// page title
		'Global Custom Fields', 	// menu title
		'8', 						// capability ??
		'functions',				// menu slug ??
		'editglobalcustomfields'	// function callback
	);
}
function editglobalcustomfields() { ?>
<!-- functions.php -->
<div class='wrap'>
	<h1>Global Custom Fields</h1>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table">
		<tbody>
			<!--- e.g.
			<tr>
				<th scope="row">
					<label for="myname">My Name</label>
				</th>
				<td>
					<input type="text" name="myname" size="45" value="<?php echo get_option('myname'); ?>" />
					<textarea name="aqua_longitude"  cols="80%" rows="7"><?php echo get_option('aqua_longitude'); ?></textarea>
					<p class="description">Your name...</p>
				</td>
			</tr>
			-->
			<tr>
				<th scope="row">
					<label for="aqua_gatrackid">Google Analytics Tracking ID</label>
				</th>
				<td>
					<input type="text" name="aqua_gatrackid" size="45" value="<?php echo get_option('aqua_gatrackid'); ?>" />
					<p class="description">UA-XXXXXXXX-X</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="aqua_latitude">Latitude</label>
				</th>
				<td>
					<input type="text" name="aqua_latitude" size="45" value="<?php echo get_option('aqua_latitude'); ?>" />
					<p class="description">eg: 38.792763</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="aqua_longitude">Longitude</label>
				</th>
				<td>
					<input type="text" name="aqua_longitude" size="45" value="<?php echo get_option('aqua_longitude'); ?>" />
					<p class="description">eg: 15.218296</p>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit"><input class="button button-primary" type="submit" name="Submit" value="Update Options" /></p>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="aqua_gatrackid,aqua_welcometext,aqua_latitude,aqua_longitude" />
	</form>
</div>

<?php } 

/**
 * Inc files
*
*require get_template_directory() . '/inc/CPT_location.php';
*require get_template_directory() . '/inc/CPT_people.php';
*/
require get_template_directory() . '/inc/ajax_functions.php';
require get_template_directory() . '/inc/cpt_slide.php';
require get_template_directory() . '/inc/cpt_event.php';

/**
 * Display the classes for the post div and automatically mark the first and last posts
 * 
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post $post_id Optional. Post ID or post object.
 */
function attraxion_post_class( $class = '', $post_id = null ) {
	global $wp_query;
	$class = ! empty( $class ) ? sprintf( '%s ', trim( $class ) ) : '';
	if ( 0 === $wp_query->current_post ) {
		$class .= 'first';
	} elseif ( ( $wp_query->current_post + 1 ) === $wp_query->post_count ) {
		$class .= 'last';
	}
	echo get_post_class( $class, $post_id );
}
/*

Tinymce

*/
function make_mce_awesome($in) {
    //$in['block_formats'] = 'h2=h2';
    //$in['toolbar1']='formatselect,|,bold,italic,|,bullist,numlist,blockquote,|,link,unlink,|,pastetext,undo,redo';
    $in['toolbar1']='bold,italic,|,bullist,numlist,blockquote,|,link,unlink,|,pastetext,undo,redo';
    $in['toolbar2']='';
    $in['toolbar3']='';
    $in['toolbar4']='';
    return $in;
}
add_filter('tiny_mce_before_init', 'make_mce_awesome');
/*

No shortcode

*/
//remove_shortcode('gallery', 'gallery_shortcode');