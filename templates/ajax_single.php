<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
<?php $thumb_url =  wp_get_attachment_image_src(get_post_thumbnail_id(),'blog_thumb', true); ?>
 <div class="row">
	<div class="small-12 medium-7 medium-centered columns">
<!--
	style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center center scroll;"
-->
		<?php the_date();?>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
</div>
<?php endforeach; wp_reset_postdata(); ?>
