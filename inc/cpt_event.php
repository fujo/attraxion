<?php

include_once('Class/CPT.php');

// options

$options = array(
    'public'              => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => false,
    'show_ui'             => true,
    'show_in_nav_menus'   => false,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 110,
    'menu_icon'           => 'dashicons-megaphone',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'editor', 'thumbnail' ),
    'has_archive'         => false,
    'query_var'           => true
);

// instance

$event = new CPT(array(
    'post_type_name' => 'event',
    'singular' => 'Event',
    'plural' => 'Events',
    'slug' => 'events'
), $options );

// define an icon shown in menu bar

$event->menu_icon("dashicons-megaphone");

// add columns to admin list pages
/*
$event->columns(array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Title'),
    'start_date' => __('Start Date'),
    'place' => __('Place'),
    'date' => __('Date')
));

$event->populate_column('start_date', function($column, $post) {
    $date = DateTime::createFromFormat('Ymd', get_field('start_date'));
    echo $date->format('F j, Y');
    //echo get_field('start_date'); // ACF get_field() function
});

$event->populate_column('place', function($column, $post) {
    echo get_field('place');
});

$event->populate_column('date', function($column, $post) {
    echo $date;
});

$event->sortable(array(
    'start_date' => array('start_date', true)
));
*/