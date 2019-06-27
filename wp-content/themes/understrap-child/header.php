<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

//$container = get_theme_mod( 'understrap_container_type' );
$container = get_field('container_width', 'option');
$header_logo = get_field('header_logo', 'option');
$header_title = get_field('header_title', 'option');
$include_utility_header = get_field('include_utility_header', 'option');
$phone_number = get_field('phone_number', 'option');
$email_address = get_field('email_address', 'option');
$include_search =  get_field('include_search', 'option');

if($include_search == 'Yes'):
    $search_shortcode = get_field('search_form_short_code', 'option');
endif;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="referrer" content="unsafe-url">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php 
	$google_header_code = get_field('google_header_code', 'option');
	if($google_header_code):
		echo($google_header_code);
	endif;
	?>

	<?php wp_head(); ?>

	

<!-- Hotjar Tracking Code for www.renegade.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:633381,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


</head>

<body <?php body_class(); ?>>

<div class="hfeed site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
		<!-- <div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite"> -->
		<?php if ($container == 'Fixed Width Container'):?>
		<div class="container" >
		<?php elseif ($container == 'Full Width Container'):?>
		<div class="container-fluid" >
		<?php endif;?>

			<!-- skip link -->
			<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>
			
			<!-- utility bar -->
			<?php if($include_utility_header == 'Yes'):?>
			<div class="row">
				<!-- <div class="utility-bar"> -->
				<?php 
					// echo '<div class="header-phone-ct"><a href="tel:' .  preg_replace('/\D/', '', $phone_number) . '">' .  $phone_number . '</a></div><!-- .header-phone-ct -->';
					// echo '<div class="header-email-ct"><a href="mailto:' .  $email_address . '"><i class="fas fa-envelope"></i></a></div><!-- .header-email-ct -->';
					// if($include_search == 'Yes'):
					// echo  '<div class="header-search-ct">' . do_shortcode($search_shortcode) . '</div><!-- .header-search-ct -->';
					// endif;
				?>
				<!-- </div> -->
				<div class="utility-bar">
				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'utility',
						'menu_id'         => 'utiliy-menu',
						'depth'           => 1
					)
				); ?>
				</div>
			</div>
			<?php endif;//END INCLUDE UTILITY HEADER CONDITIONAL?>
			
			<!-- navbar -->
			<nav class="navbar navbar-expand-md">
				<!-- Your site title as branding in the menu -->
				<?php if ( ! $header_logo ) { ?>

					<?php if ( is_front_page() && is_home() ) : ?>

						<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php echo $header_title; ?></a></h1>
						
					<?php else : ?>

						<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php echo $header_title; ?></a>
					
					<?php endif; ?>
					
				
				<?php } else {?>
					
					<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo $header_title;?>" itemprop="url"><img src="<?php echo $header_logo ?>" alt="<?php echo $header_title;?>"></a>
						<?php //the_custom_logo();
				} ?><!-- end custom logo -->

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Renegade_WP_Bootstrap_Navwalker(),
					)
				); ?>

			</nav><!-- .site-navigation -->
		</div><!-- .container end -->
	</div><!-- .wrapper-navbar end -->
