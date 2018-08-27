<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

				<!-- HEADER -->
				<div class="content-section" id="search_header" style="background:#f2f2f2">
				<?php if ( have_posts() ) : ?>

					<header class="page-header">
							<?php get_search_form(); ?>
							<h1 class="page-title"><?php printf(
							/* translators:*/
							 esc_html__( 'Search Results for: %s', 'understrap' ),
								'<span style="color:#007bff">' . get_search_query() . '</span>' ); ?></h1>

					</header><!-- .page-header -->
				</div><!-- #search_header -->

				<div class="content-section" id="search_content">
					<?php /* Start the Loop */ ?>
					<div class="post-feed dynamic grid row">
					<?php while ( have_posts() ) : the_post(); 
						$post_type = get_post_type();
					?>
						<div class="col-lg-4 col-md-6 grid__item">
						<?php
						// use post types loop template, content-search is default
                        if($post_type == 'podcasts'):   
                            get_template_part( '/loop-templates/content', 'podcast' );
                        elseif($post_type == 'newsletters'):
                            get_template_part( '/loop-templates/content', 'newsletter' );
                        elseif($post_type == 'post'):
                            get_template_part( '/loop-templates/content', 'post' );
                        elseif($post_type == 'videos'):
							get_template_part( '/loop-templates/content', 'video' );
						else:
							get_template_part( 'loop-templates/content', 'search' );
                        endif;
						?>
						</div>
					<?php endwhile; ?>
					</div>
					
					<div class="row">
                    	<div class="col-md-4"></div>
                    	<div class="col-md-4">
                    		<!-- view more button -->
                    		<div class="view-more-button-container"><button type="button" class="btn btn-dark btn-block view-more-button">View More</button></div>
                    		<!-- // loader wheel -->
                    		<div class="loader-wheel">
								<div class="infinite-scroll-request">
									<i><i><i><i><i><i><i><i><i><i><i><i>
									</i></i></i></i></i></i></i></i></i></i></i></i>
								</div>
                    		</div>
						</div>
						<div class="col-md-4"></div>
					</div>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

				<!-- The pagination component -->
				<?php understrap_pagination(); ?>

				</div><!-- #search_content -->

	</div> <!--.row-->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
