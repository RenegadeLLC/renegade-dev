<?php
/**
 * Single post partial template for blog posts.
 *
 * @package understrap
 */

?>


<article <?php post_class();?> id="post-<?php the_ID();?>">

		<!-- row header -->
		<header class="entry-header">
			<div class="row">
				<div class="content-section">
					<div class="col-md-8">
						<?php the_title('<h1 class="entry-title">', '</h1>');?>
					</div>
					<div class="col-md-4">
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
					</div><!-- .entry-meta -->
					<div class="entry-content">
							<?php 
								// echo get_the_post_thumbnail($post->ID, 'large'); 
							?>
							<?php the_content();?>
					</div>
				</div>

				<!-- right sidebar -->
				<div class="col-md-2">
				</div>
			</div>
		</main><!-- main -->

		<!-- row pagination -->
		<div class="row entry-pagination">
			<div class="col-md-12">
				<?php understrap_post_nav();?>

				<?php
				wp_link_pages(array(
					'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
					'after' => '</div>',
				));
				?>
			</div>
		</div><!-- .row pagination-->

</article><!-- article -->

<footer class="entry-footer">

	<?php understrap_entry_footer(); ?>

</footer><!-- .entry-footer -->
