<?php
/**
 * Template Name: Articles
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$paged = get_query_var('paged');

$rn_args = array( 'post_type' => 'articles', 'posts_per_page' => 8, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged  );

$wp_query = new WP_Query( $rn_args );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
				<div class=" post-listing">
<div class="grid row"  id="post-grid"><div class="grid-gutter"></div>
					<?php while ($wp_query->have_posts() ) : $wp_query->the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'article' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :

							//comments_template();

						endif;
						?>

					<?php endwhile; // end of the loop. ?>
</div><!-- .grid -->
<div class="pagination">
        <?php //understrap_pagination(); ?>
        
             <?php previous_posts_link( '« Newer posts' ); ?>
        <?php next_posts_link( 'Older posts »', $wp_query->max_num_pages ); ?>
        
    </div>
</div><!-- .post-listing -->
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
