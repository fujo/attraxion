<!doctype html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
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
  <nav class="mobile">
    <?php
      $menuParameters = array(
        'container'       => false,
        'echo'            => false,
        'items_wrap'      => '%3$s',
        'depth'           => 0,
      );
      echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
    ?>   
  </nav>
  <header>
    <a href="<?php echo site_url();?>" title="Retour à la page d'accueil" id="logo">
      <img src="<?php echo get_bloginfo('template_directory'); ?>/img/logo_svg_goutte.svg">
    </a>
    <nav class="main">
    <?php
      $menuParameters = array(
        'container'       => false,
        'echo'            => false,
        'items_wrap'      => '%3$s',
        'depth'           => 0,
      );
      echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
    ?>
    </nav>
    <a href="#" class="hamburger" rel="nofollow"><span></span></a>
  </header>
  <div id="content">