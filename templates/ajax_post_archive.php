<?php $i=0; $tot = count($posts); ?>
<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
 <li class="small-12 medium-6 large-6 columns <?php echo ($i == $tot ? 'end' : false); ?>">
    <article>
      <div class="date"><strong><?php the_date() ?></strong></div>
      <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
      <figure style="background-image:url(<?php echo $url; ?>);"></figure>
      <h3><?php the_title(); ?></h3>
      <?php the_excerpt(); ?>
      <a href="#blog/<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" class="ajax" rel="nofollow">more</a>
    </article>
  </li>
<?php endforeach; wp_reset_postdata();?>