<?php
/**
 * Download post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */
$client_name = get_the_title();
$client_id = get_the_ID();
$client_logo = get_field('clientLogo', $post -> ID);
$industry_vertical = get_field('industry_vertical', $post -> ID);
$case_study = get_field('case_study', $post -> ID);
$case_study_url = get_field('case_study_url', $post -> ID);

$clientsHTML = '';
?>

<article <?php post_class();?> id="post-<?php the_ID();?>">

	<header class="entry-header">

	<?php if ('client' == get_post_type()): ?>

		<div class="entry-meta">
			<?php understrap_posted_on();?>
		</div><!-- .entry-meta -->

	<?php endif;?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>

	<div class="entry-content">

		<?php
// the_excerpt();
// if($client_name != 'Renegade'):

	
	if($case_study == 'Yes'):
		$clientsHTML .= '<a href="' . $case_study_url . '">';
	endif;
	
	// $clientsHTML .= '<div>CLIENT ID: ' . $client_id . '</div>';
	$clientsHTML .= '<div class="client-logo"><img src="' . $client_logo . '" alt=""></div>';
	
	if($case_study == 'Yes'):
		$clientsHTML .= '</a>';
	endif;
// endif;
?>

		<?php
		echo $clientsHTML;
// wp_link_pages(array(
//     'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
//     'after' => '</div>',
// ));
?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php 
			// understrap_entry_footer();
		?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
