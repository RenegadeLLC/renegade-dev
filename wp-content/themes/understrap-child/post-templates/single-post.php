<?php
/**
 * Single post partial template for blog posts.
 *
 * @package understrap
 */

?>


	<!-- content header -->
	<div class="row">
		<div class="content-section" style="background-color:#f2f2f2">
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="row">
	<!-- left sdebar -->
	<div class="col-md-2">
	</div>
	<div class="col-md-8">
	<main class="site-main" id="main">
<article <?php post_class();?> id="post-<?php the_ID();?>">

	<header class="entry-header">

		<?php the_title('<h1 class="entry-title">', '</h1>');?>

		<div class="entry-meta">

			<?php understrap_posted_on();?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>

	<div class="entry-content">
		<?php the_content();?>

</article><!-- #post-## -->
			</main><!-- #main -->

		</div>

		<!-- right sidebar -->
		<div class="col-md-2">
		</div>

</div><!-- .row -->

<div class="row">
	<div class="col-md-12">
		<div class="content-section">

		<?php understrap_post_nav();?>

		<?php
wp_link_pages(array(
    'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
    'after' => '</div>',
));
?>
		</div>
	</div>
</div>
