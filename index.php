<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage 
 * @since 
 */

get_header(); ?>

  <section id="hero" class="flexslider winHeight">
    <ul class="slides">
      <?php $loop = new WP_Query( array( 'post_type' => 'at_slide', 'posts_per_page' => 10 ) );
      while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <?php $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'hero', true); ?>
        <li class="winHeight" style="background-image:url(<?php echo $thumb_url[0] ?>);">
          <div class="hero-jumbotron animation" data-animation="slideUp">
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
            <?php //if( isset( the_field('external_link_url') ) ) : ?>
            <a href="/t-shirt-attraxion/" class="ajax btn icn more" data-ajax-action="mon_action" data-ajax-param="salut les terriers">More<?php //the_field('external_link_text'); ?></a>
            <?php // endif; ?>
          </div>
          <div class="hero-overlay"></div>
        </li>
      <?php endwhile; ?>
    </ul>
<!--
    <div class="wrap-center">
      <div class="custom-navigation flex-pagger">
        <div class="custom-controls-container"></div>
      </div>
    </div>

    <div class="wrap-center">
      <a id="scrollTo" href="#club">scroll down</a>
    </div>
-->

<!--
    <div id="appHouse">
      <span class="icon-home"></span>
      <span class="icon-user"></span>
    </div>

    <div id="tabs">
      <div class="tabs-titel">
        <a href="">windguru</a>
        <a href="">clubhouse</a>
      </div>
      <div class="tabs-content">
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis aliquid ex doloremque mollitia incidunt distinctio doloribus cum cupiditate inventore amet iste esse, eius dolor, est explicabo eligendi, at quis eveniet?</div>    
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis aliquid ex doloremque mollitia incidunt distinctio doloribus cum cupiditate inventore amet iste esse, eius dolor, est explicabo eligendi, at quis eveniet?</div>
      </div>
    </div>
-->

  </section>


<?php 

// CLUB ++++++++++++++++++++++++++++++++++++++++++++++++++

$page = get_posts(array('name' => 'club', 'post_type' => 'page') ); ?>
<?php if(isset($page)) : ?>
<section id="club" class="section">
  <article class="row">
    <div class="small-12 medium-7 medium-centered columns">
      <h2 class=""><?php echo $page[0]->post_title; ?></h2>
      <?php $content = apply_filters('the_content', $page[0]->post_content);
      echo $content; ?>
      <!--<a href="#contact" class="btn icn more scrollTo">Contact-nous!</a>-->
  </article>
</section>

<section id="factsheet" class="parallax">

  <ul class="row">
    <li class="small-6 medium-3 columns">
      <article class="animation" data-animation="slideUp" >
        <div class="count">2</div>
        bateaux de wake
      </article>
    </li>
    <li class="small-6 medium-3 columns">
      <article class="animation" data-animation="slideUp">
        <div class="count">6</div>
        canoës
      </article>
    </li>
    <li class="small-6 medium-3 columns">
      <article class="animation" data-animation="slideUp" >
        <div class="count">2</div>
        stand up paddle
      </article>
    </li>
    <li class="small-6 medium-3 columns">
      <article class="animation" data-animation="slideUp" >
        <div class="count">1</div>
        trampoline
      </article>
    </li>
  </ul>

</section>
<?php endif; wp_reset_postdata(); ?>


<?php 

// PROGRAMME ++++++++++++++++++++++++++++++++++++++++++++++++++

$page = get_posts(array('name' => 'programme', 'post_type' => 'page') ); ?>
<?php if(isset($page)) : ?>
<section id="programme" class="section">

    <div class="row">
      <div class="small-12 medium-7 medium-centered columns">
      <h2><?php echo $page[0]->post_title; ?></h2>
      <?php $content = apply_filters('the_content', $page[0]->post_content);
      echo $content; ?>
      </div>
    </div>
 
</section>
<?php endif; wp_reset_postdata();?>






<section id="tshirts" class="">


</section>



<?php 

// BLOG ++++++++++++++++++++++++++++++++++++++++++++++++++

$flagLastClass = 0;

$args = array(
  'posts_per_page'   => 7,
  'offset'           => 0,
  'category'         => '',
  'category_name'    => '',
  'orderby'          => 'date',
  'order'            => 'DESC',
  'include'          => '',
  'exclude'          => '',
  'meta_key'         => '',
  'meta_value'       => '',
  'post_type'        => 'post',
  'post_mime_type'   => '',
  'post_parent'      => '',
  'author'     => '',
  'post_status'      => 'publish',
  'suppress_filters' => true 
);
$posts_array = get_posts( $args ); ?>

<?php if(isset($posts_array)) : ?>

<section id="blog" class="section isotope" data-route="blog">

  <div class="row">
    <div class="small-12 medium-7 medium-centered columns">
      <h2>blog</h2>
    </div>
    <div class="isotope small-12 columns">
      <article class="grid-sizer"></article>
      <!--<article class="gutter-sizer"></article>-->
      <?php foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
      <?php $thumb_url =  wp_get_attachment_image_src(get_post_thumbnail_id(),'blog_thumb', true); ?>
      <a href="<?php the_permalink(); ?>" class="ajax-popup-link" rel="nofollow">
        <article id="<?php echo 'post-'.$id ?>" class="item <?php if($flagLastClass === 0) { 
            echo "last"; 
            $flagLastClass = 1;
          };
          ?>" style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center center scroll;">
          <div class="row">
            <div class="large-12 columns">
              <span class="date"><?php the_time('d') ?><br><?php the_time('M') ?></span>
              <h3 class=""><?php the_title(); ?></h3>
              <?php the_excerpt(); ?>
              <!--<a href="<?php the_permalink(); ?>" class="btn icn more">more</a>-->
            </div>
          </div>
        </article>
      </a>
      <?php endforeach; wp_reset_postdata();?>
      <!--<article class="item">voir tous les articles</article>-->
    </div>
  </div>
 
</section>
<?php endif; ?>





<?php 

// GRAVIERE ++++++++++++++++++++++++++++++++++++++++++++++++++

$page = get_posts(array('name' => 'graviere', 'post_type' => 'page') ); ?>
<?php if(isset($page)) : ?>
<section id="graviere" data-route="graviere">

    <div class="row">
      <div class="small-12 small-centered large-6 large-centered columns">
      <h2 class="shadow"><?php echo $page[0]->post_title; ?></h2>
      </div>
    </div>

    <div class="row">
      <div class="small-12 small-centered large-6 large-centered columns">
      <?php $content = apply_filters('the_content', $page[0]->post_content);
      echo $content; ?>
      <!--<a href="#contact" class="btn icn more scrollTo">Contact-nous!</a>-->
      </div>
    </div>
 
</section>
<?php endif; ?>


<?php 

// PROGRAMME ++++++++++++++++++++++++++++++++++++++++++++++++++

$page = get_posts(array('name' => 'contact', 'post_type' => 'page') ); ?>
<?php if(isset($page)) : ?>
<section id="contact" class="section">

    <div class="row">
      <div class="small-12 medium-7 medium-centered columns">
      <h2><?php echo $page[0]->post_title; ?></h2>
      <?php $content = apply_filters('the_content', $page[0]->post_content);
      echo $content; ?>
      </div>
    </div>
 
</section>
<?php endif; wp_reset_postdata();?>



<section id="map" class="winHeight">
  <div id="map-canvas" style="width: 100%; height: 100%"></div>
</section>



<?php get_footer(); ?>