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
    <div class="small-12 medium-6 medium-centered columns">
      <h2 class="animation" data-animation="slideUp"><?php echo $page[0]->post_title; ?></h2>
    </div>
    <ul>
      <li></li>
      <li></li>
      <li></li>
    </ul>
    <div class="small-12 medium-6 medium-centered columns">
      <?php $content = apply_filters('the_content', $page[0]->post_content);
      echo $content; ?>
      <!--<a href="#contact" class="btn icn more scrollTo">Contact-nous!</a>-->
    </div>
  </article>
</section>



<section id="factsheet" class="parallax">
  <ul class="row animation" data-animation="slideUp" >
    <li class="small-6 medium-3 columns">
      <article>
        <div class="count">45</div>
        membres
      </article>
    </li>
    <li class="small-6 medium-3 columns">
      <article>
        <div class="count">6</div>
        canoës
      </article>
    </li>
    <li class="small-6 medium-3 columns">
      <article>
        <div class="count">2</div>
        stand up paddle
      </article>
    </li>
    <li class="small-6 medium-3 columns">
      <article>
        <div class="count">1</div>
        trampoline
      </article>
    </li>
  </ul>
</section>
<?php endif; wp_reset_postdata(); ?>


<?php 

// PROGRAMME ++++++++++++++++++++++++++++++++++++++++++++++++++

$posts = get_posts(array('post_type' => 'event', 'posts_per_page' => -1, 'meta_key' => 'start_date', 'orderby' => 'start_date', 'post_status' => 'publish', 'order' => 'ASC' ) ); 
$i=0; $tot = count($posts); 
if(isset($posts)) : ?>
<section id="programme" class="section" >
    <div class="row">
      <div class="small-12 medium-7 medium-centered columns">
        <h2 class="animation" data-animation="slideUp">programme</h2>
      </div>
    </div>
    <ul class="row overview equalHeights">
      <?php foreach ( $posts as $post ) : setup_postdata( $post ); $i++; ?>
      <li class="small-12 medium-6 large-3 columns <?php echo ($i == $tot ? 'end' : false); ?>">
        <article>
            <?php $date_s = new DateTime( get_field('start_date') ); ?>
            <div class="date"><strong><?php echo ( get_field('date_text') ? get_field('date_text') : $date_s->format('d.m') ) ; ?></strong></div>
            <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
            <figure style="background-image:url(<?php echo $url; ?>);"></figure>
            <h3><?php the_title(); ?></h3>
            <div class="meta">
            <?php if(  get_field('start_time') ) : ?>
            <span class="icon-access_alarms"></span> <?php echo get_field('start_time');?> <br>
            <?php endif; ?>
            <?php if(  get_field('place') ) : ?>
            <span class="icon-place"></span> <?php echo get_field('place'); ?>
            <?php endif; ?>
            </div>
            <?php the_content(); ?>
        </article>
      </li>
    <?php endforeach; wp_reset_postdata();?>
    </ul>
</section>
<?php endif; ?>




<section id="tshirts" class="">

    <div class="row">
      <div class="small-12 medium-7 medium-centered columns">
        <h2 class="animation" data-animation="slideUp">Tees!</h2>
      </div>
      <div class="small-12 medium-7 medium-centered columns">
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi voluptates amet blanditiis, quis asperiores voluptas fuga libero obcaecati nostrum odit labore commodi, delectus natus vel nam fugit repellat quae autem!
    </div>
  </div>


</section>



<?php 

// BLOG ++++++++++++++++++++++++++++++++++++++++++++++++++

?>
<section id="blog" class="section" data-route="blog">
  <div class="row">
    <div class="small-12 medium-7 medium-centered columns">
      <h2 class="animation" data-animation="slideUp" >blog</h2>
    </div>
  </div>
  <ul class="row overview equalHeights">
  <!-- blogs teaser container -->
  </ul>
  <div class="row">
    <div class="small-12 medium-7 medium-centered columns">
      <a href="#" class="loadmore btn more loading" >plus vieux</a>
    </div>
  </div>
</section>




<?php 

// CONTACT ++++++++++++++++++++++++++++++++++++++++++++++++++

$page = get_posts(array('name' => 'contact', 'post_type' => 'page') ); ?>
<?php if(isset($page)) : ?>

<section id="contact" class="section">
    <div class="row">
      <div class="small-12 medium-7 medium-centered columns">
        <h2 class="animation" data-animation="slideUp" ><?php echo $page[0]->post_title; ?></h2>
      </div>
    </div>
    <div class="row">
      <div class="small-12 medium-6 push-2 columns">
      <?php $content = apply_filters('the_content', $page[0]->post_content);
      echo $content; ?>
      </div>
      <div class="small-12 medium-6 columns">
      <?php echo do_shortcode("[si-contact-form form=1]"); ?>
      </div>
    </div>
</section>
<?php endif; wp_reset_postdata();?>



<section id="map" class="">
  <div id="map-canvas"></div>
</section>



<?php get_footer(); ?>