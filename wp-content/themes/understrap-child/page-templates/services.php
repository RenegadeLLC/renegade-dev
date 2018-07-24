<?php
/**
 * Template Name: Services Page
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row jumbotron jumbotron-fluid">
			<!-- Placehoder -->
			<div class="col-md-8">
				<h2>Renegade Services</h2>
				<h4>In theory, content is king. In practice, it is more like an ungainly prince, teasing you with his promise but ultimately failing to live up to his potential. We solve for that and let your content reign supreme.</h4>
			</div>
			<div class="col-md-4">
			</div>
		</div>

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'loop-templates/content', 'services' ); ?>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :

                        comments_template();

                    endif;
                    ?>

                <?php endwhile; // end of the loop. ?>

                </main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>