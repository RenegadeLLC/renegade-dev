<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper main-content" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

                    <?php 
                    $single_type = get_post_type( get_the_ID() );
                    // printf( __( 'The post type is: %s', 'textdomain' ), get_post_type( get_the_ID() ) );
                    
                    if( $single_type == 'people' ) {
						get_template_part( 'post-templates/single', 'people' );
					} elseif( $single_type == 'newsletters' ) {
						get_template_part( 'post-templates/single', 'newsletters' );
					} elseif( $single_type == 'podcasts' ) {
						get_template_part( 'post-templates/single', 'podcasts' );
                    } else {
                        get_template_part( 'loop-templates/content', 'default' ); 
                    };
                    ?>

						<?php understrap_post_nav(); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>