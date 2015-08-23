<?php

add_action('init','create_post_type_at_event');

function create_post_type_at_event() {

  $labels = array(
    'name'               => 'Events',
    'singular_name'      => 'Event',
    'menu_name'          => 'Events',
    'name_admin_bar'     => 'Event',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Event',
    'new_item'           => 'New Event',
    'edit_item'          => 'Edit Event',
    'view_item'          => 'View Event',
    'all_items'          => 'All Events',
    'search_items'       => 'Search Events',
    'parent_item_colon'  => 'Parent Event',
    'not_found'          => 'No Events Found',
    'not_found_in_trash' => 'No Events Found in Trash'
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
    'menu_position'       => 110,
    'menu_icon'           => 'dashicons-megaphone',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'thumbnail', 'excerpt' ),
    'has_archive'         => false,
    'rewrite'             => array( 'slug' => 'events' ),
    'query_var'           => true
  );

  register_post_type( 'at_event', $args );

}
