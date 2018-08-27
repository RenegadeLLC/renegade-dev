<?php
/**
 * Single post partial template for blog posts.
 *
 * @package understrap
 */

?>
<?php $post_thumb = get_the_post_thumbnail_url(); ?>

<article <?php post_class();?> id="post-<?php the_ID();?>">

	<!-- row header -->
	<header class="entry-header">
		<div class="row">
			<div class="content-section">
				<div class="col-md-8 blog-headline">
					<?php the_title('<h1 class="entry-title">', '</h1>');?>
				</div>
				<div class="col-md-4 blog-header-img">
				</div>
			</div>
			
		</div><!-- .row header -->
		</header><!-- .entry-header -->

	<!-- main content -->
	<main class="site-main" id="main">
		<div class="row">

			<!-- left sdebar -->
			<div class="col-md-2">
			</div>

			<!-- entry content -->
			<div class="col-md-8">
				<div class="entry-meta">
					<?php understrap_posted_on();?>
					<?php if($post_thumb):
					echo'<div class="row"><div class="post-feature-img"><img src="' . $post_thumb. '"></div></div>';
					endif;
					?>
					<?php echo do_shortcode("[TheChamp-Sharing]"); ?>
				</div><!-- .entry-meta -->
				<div class="entry-content">
					<?php 
						// echo get_the_post_thumbnail($post->ID, 'large'); 
					?>
					<?php the_content();?>

					<div id="respond">
						<!-- social commenting inserted here by socializer plugin -->
					</div>
				
				</div>
			</div>

			<!-- right sidebar -->
			<div class="col-md-2">
			</div>
		</div>
	</main><!-- main -->

	<!-- footer .row pagination -->
	<footer class="entry-footer">
			<?php understrap_post_nav();?>

			<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
				'after' => '</div>',
			));
			?>	
	</footer><!-- footer .row pagination-->

</article><!-- article -->

<script>
$(document).ready(function(){
	if ($post_thumb) {
      $(".post-feature-img").appendTo(".entry-content p:first-of-type").first();
	}
  
});
</script>