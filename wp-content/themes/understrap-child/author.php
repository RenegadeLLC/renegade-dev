<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
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
    echo '<div class="container" id="content">';
elseif ($container == 'Full Width Container'):
    echo '<div class="container" id="content">';
endif; //END CONTAINER WIDTH IF
?>


<article <?php post_class();?> id="post-<?php the_ID();?>">

<div class="entry-content">

		<div class="row">

			<!-- <main class="site-main" id="main"> -->
            <div class="content-section" id="author_header">

                <header class="page-header author-header">
                    <div class="col">
                        <!-- <h1>Drew Neisser<br><span class="job-title">Founder &amp; CEO</span>
                        </h1> -->
                        <?php
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug',
    $author_name) : get_userdata(intval($author));
?>

                        <h1><?php esc_html_e('Author: ', 'understrap');?><span><?php echo esc_html($curauth->nickname); ?></span></h1>
                    </div>
                </header><!-- .page-header -->
            </div>
            <div class="content-section" id="author_content">
					<!-- The Loop -->
					<?php if (have_posts()): ?>
                <div class="col">
                        <h2><?php esc_html_e('Posts by', 'understrap');?> <?php echo esc_html($curauth->nickname); ?></h2>

                </div>
                <div class="post-feed dynamic grid row">
						<?php while (have_posts()): the_post();?>
							    <div class="col-lg-4 col-md-6 grid__item">
	                                <?php
    // use post types loop template, content-search is default
    if ($post_type == 'podcasts'):
        get_template_part('/loop-templates/content', 'podcast');
    elseif ($post_type == 'newsletters'):
        get_template_part('/loop-templates/content', 'newsletter');
    elseif ($post_type == 'post'):
        get_template_part('/loop-templates/content', 'post');
    elseif ($post_type == 'videos'):
        get_template_part('/loop-templates/content', 'video');
    else:
        get_template_part('loop-templates/content', 'search');
    endif;
    ?>
								</div>
							<?php endwhile;?>
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

					<!-- End Loop -->
			<!--</main> #main -->

			<!-- The pagination component -->
				<?php understrap_pagination(); ?>

            </div>

<?php else: ?>

    <?php get_template_part('loop-templates/content', 'none');?>

<?php endif;?>

	    </div><!--.row -->

    </div><!-- .entry-content -->

</article><!-- #post-## -->

</div><!-- Wrapper end -->

<?php get_footer();?>
