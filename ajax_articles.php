<?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
<div class="row">
	<div class="large-6 columns">
		<a href="<?php the_permalink(); ?>" data-postid="<?php the_ID(); ?>"><?php the_title(); ?></a>
		<?php the_date();?> - <?php the_title(); ?>
	</div>
</div>
<?php endforeach; wp_reset_postdata(); ?>
