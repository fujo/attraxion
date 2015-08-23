<?php

add_action('init','create_post_type_at_slide');

function create_post_type_at_slide() {

  $labels = array(
    'name'               => 'Slides',
    'singular_name'      => 'Slide',
    'menu_name'          => 'Slides',
    'name_admin_bar'     => 'Slide',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Slide',
    'new_item'           => 'New Slide',
    'edit_item'          => 'Edit Slide',
    'view_item'          => 'View Slide',
    'all_items'          => 'All Slides',
    'search_items'       => 'Search Slides',
    'parent_item_colon'  => 'Parent Slide',
    'not_found'          => 'No Slides Found',
    'not_found_in_trash' => 'No Slides Found in Trash'
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 100,
    'menu_icon'           => 'dashicons-images-alt2',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
    'has_archive'         => false,
    'rewrite'             => array( 'slug' => 'slides' ),
    'query_var'           => true
  );

  register_post_type( 'at_slide', $args );

}
