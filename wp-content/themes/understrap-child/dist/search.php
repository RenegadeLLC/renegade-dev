<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

get_header();

// $container   = get_theme_mod( 'understrap_container_type' );
$container = get_field('container_width', 'option');

?>

<div class="wrapper" id="full-width-page-wrapper">
<?php
// echo esc_attr($container);
if ($container == 'Fixed Width Container'):
    echo '<div class="container" id="content" tabindex="-1">';
elseif ($container == 'Full Width Container'):
    echo '<div id="content" tabindex="-1">';
endif; //END CONTAINER WIDTH IF
?>


		<div class="row">

				<!-- HEADER -->
				<div class="content-section" id="search_header">
				<?php if ( have_posts() ) : ?>

					<header class="page-header">
							<?php get_search_form(); ?>
							<h1 class="page-title"><?php printf(
							/* translators:*/
							 esc_html__( 'Search Results for: %s', 'understrap' ),
								'<span class="page-query">' . get_search_query() . '</span>' ); ?></h1>

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
