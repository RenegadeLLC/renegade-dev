<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

get_header();

// $container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
$container = get_field('container_width', 'option');

?>

<div class="wrapper" id="error-404-wrapper">

    <?php
    // echo esc_attr($container);
    if ($container == 'Fixed Width Container'):
        echo '<div class="container" id="content" tabindex="-1">';
    elseif ($container == 'Full Width Container'):
        echo '<div id="content" tabindex="-1">';
    endif; //END CONTAINER WIDTH IF
    ?>

		<div class="row">

            <div class="content-section" style="background-color:#c4bd06; " id="hero">
                <div class="row">
                    <div class="column col-md-12">
                        <div class="text-ct">
                            <p>
                            <img src="/wp-content/uploads/404_img.png" alt="" width="1600" height="483" 
                            class="alignnone size-full wp-image-15288" 
                            srcset="/wp-content/uploads/404_img.png 1600w, 
                            /wp-content/uploads/404_img-900x272.png 900w, 
                            /wp-content/uploads/404_img-768x232.png 768w, 
                            /wp-content/uploads/404_img-1200x362.png 1200w" 
                            sizes="(max-width: 1600px) 100vw, 1600px">
                            </p>
                        </div><!-- .text-ct -->
                    </div><!-- .column-->
                </div>
            </div>

            <div class="content-section" style="background-color:#f2f2f2; " id="search">
                <div class="row">
                    <div class="column col-md-12">
                        <div class="text-ct">
                            <h2>Can we help you find what your looking for?</h2>
                            <p><?php echo do_shortcode('[wpbsearch]') ?></p>
                        </div><!-- .text-ct -->
                    </div><!-- .column-->
                </div>
            </div>

			<div class="content-section content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<div class="page-content">

                        <div class="post-feed non-dynamic grid row">

                            <?php 

                            // recent post
                            $post_query = new WP_Query( array(
                                'posts_per_page' => 1,
                                'post_type' => 'post',
                                'post_status' => 'publish'
                            )); 
                            if ( $post_query->have_posts() ) : 
                                echo '';
                                while ( $post_query->have_posts() ) : $post_query->the_post();
                                    echo '<div class="col-lg-4 col-md-6 grid__item">'; 
                                        get_template_part( '/loop-templates/content', 'post' );
                                    echo '</div>';
                                endwhile; 
                                wp_reset_postdata();
                            endif;

                            // recent newsletter
                            $newsletter_query = new WP_Query( array(
                                'posts_per_page' => 1,
                                'post_type' => 'newsletters',
                                'post_status' => 'publish'
                            )); 
                            if ( $newsletter_query->have_posts() ) : 
                                echo '';
                                while ( $newsletter_query->have_posts() ) : $newsletter_query->the_post();
                                    echo '<div class="col-lg-4 col-md-6 grid__item">'; 
                                        get_template_part( '/loop-templates/content', 'newsletter' );
                                    echo '</div>';
                                endwhile; 
                                wp_reset_postdata();
                            endif;

                            // recent podcast
                            $podcast_query = new WP_Query( array(
                                'posts_per_page' => 1,
                                'post_type' => 'podcasts',
                                'post_status' => 'publish'
                            )); 
                            if ( $podcast_query->have_posts() ) : 
                                echo '';
                                while ( $podcast_query->have_posts() ) : $podcast_query->the_post();
                                    echo '<div class="col-lg-4 col-md-6 grid__item">'; 
                                        get_template_part( '/loop-templates/content', 'podcast' );
                                    echo '</div>';
                                endwhile; 
                                wp_reset_postdata();
                            endif;


                            ?>

                            </div>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
