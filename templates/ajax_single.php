<?php $post =  $posts[0] ; ?>
<article>
	<div class="row">	
		<h1><?php echo $post->post_title; ?></h1>

	</div>
	<div class="row">
		<div class="small-12 medium-6 medium-centered columns">
		<span><?php echo $post->post_date; ?></span>	<?php echo $post->post_author; ?><br>
			<?php echo $post->post_content; ?>


		</div>
	</div>
</article>
<!-- fuck up the img links -->
<script type="text/javascript">
$( document ).ready(function() {
  	//$('#ajax-overlay').find('.content img')
});
</script>