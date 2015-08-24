<!doctype html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo get_bloginfo(); ?> - <?php echo get_the_title( $ID ); ?> </title>
  <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
  <meta name="author" content="Jonathan Fuchs">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <?php wp_head(); ?> 
  <script src="<?php echo get_bloginfo('template_directory'); ?>/js/vendor/modernizr.js"></script>
  <!-- JS Globals -->
  <script type="text/javascript">
  var app_globals = {
    url_base:   '<?php echo get_bloginfo('url'); ?>', 
    url_path:   window.location.pathname, 
    url_hash:   window.location.hash,
    lang:       '<?php get_locale(); ?>',  
    lat:        47.1167,
    lng:        7.1167 
  }
  </script>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body class="loaded">

  <?php show_admin_bar( true ); ?>

  <div id="loader-wrapper">
    <div id="loader"></div>
  </div>

  <header>
    <a href="<?php echo site_url();?>" title="Return to the homepage" id="logo">
      <img width="145" height="25" src="<?php echo get_bloginfo('template_directory'); ?>/img/logo_svg.svg">
    </a>
    <a href="#" class="hamburger" rel="nofollow"><span></span></a>
    <nav id="mainNavWrapper">
    <?php
    /*
      $defaults = array(
        'theme_location'  => '',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => 'mainNav',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
      );
      //wp_nav_menu( $defaults ); // printed with ul+li
      */
      $menuParameters = array(
        'container'       => false,
        'echo'            => false,
        'items_wrap'      => '%3$s',
        'depth'           => 0,
      );
      echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
    ?>   
    </nav> 
  </header>
  <div id="content">