<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<link rel="stylesheet" media="all and (max-width: 1025px) and (min-width: 0px)" href="/wp-content/themes/alma/css/style-ipad.css">
	<!--<link rel="stylesheet" media="all and (max-width: 768px) and (min-width: 0px)" href="/wp-content/themes/tracks/style-ipad-port.css">
	<link rel="stylesheet" media="all and (max-width: 680px) and (min-width: 0px)" href="/wp-content/themes/tracks/style-mobile-land.css">
	<link rel="stylesheet" media="all and (max-width: 400px) and (min-width: 0px)" href="/wp-content/themes/tracks/style-mobile.css">!-->
	<script type="text/javascript" src="/wp-content/themes/alma/js/script.js"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php bloginfo('name'); wp_title('|'); ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php if ( pt_get_theme_option('favicon', 'url') ) { echo '<link rel="shortcut icon" href="' . pt_get_theme_option('favicon', 'url') . '">'; } ?>

	<?php if (pt_get_theme_option('custom-css')) {	echo '<style type="text/css">'. pt_get_theme_option('custom-css') .'</style>';	}?>
	
	<?php 

	wp_head(); 

	$extra_body_class = pt_get_theme_option('show_menu_position') == 1 ? 'navbar-on-top ' : 'navbar-on-bottom ';

	?>
</head>

<body <?php body_class($extra_body_class);?>>

	<?php if ( pt_get_theme_option('show_preloader') ) { ?>
		<div id="preloader">
			<div class="spinner"></div>
		</div>
	<?php } ?>

	<?php if ( !defined('TEMPLATE_BLANK') ) { ?>

		<?php if ( pt_get_theme_option('show_menu') ) { ?>

			<header class="navbar menu <?php echo (pt_get_theme_option('show_menu_position') == 1 ? 'navbar-fixed-top ' : 'navbar-fixed-bottom '); echo (pt_get_theme_option('show_menu_delayed') || !is_front_page() ? ' ' : 'delayed '); echo (pt_get_theme_option('show_menu_bg_first_page') || !is_front_page() ? '' : 'hide_menu_bg_first_page ');?>">
				
				<div class="container">

					<div class="searchBox">
						<button class="search_close"><i class="ion-close-round"></i></button>
						<span></span>
						<form method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
							<input type="text" name="s" id="s" placeholder="<?php echo __('type to search...', 'pt_framework'); ?>" value="<?php the_search_query(); ?>" />
						</form>
					</div>

					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">  <!-- visible-phone -->
							<span class="sr-only">Toggle navigation</span>
							<span class="ionicons ion-android-sort"></span>
						</button>

						<a class="navbar-brand" href="<?php echo home_url('/') ?>"><?php echo pt_get_logo(); ?></a>
					</div>

					<?php
					if (function_exists('icl_get_languages'))
					{ 
						echo '<ul class="languages navbar-left hidden-xs hidden-sm">';
						pt_language_flags();
						echo '</ul>';
					}
					?>

					<nav class="menu-desktop hidden-xs hidden-sm" role="navigation">
						<?php 
						if (pt_get_theme_option('show_menu_search') == 1) {
							echo '<button class="navbar-search navbar-right col-sm-1"><i class="ion-search"></i></button>';
						}

						if ( has_nav_menu( 'primary-nav' ) )
						{
							wp_nav_menu( array(
								'menu'       => 'primary-nav',
								'theme_location' => 'primary-nav',
								'depth'      => 3,
								'container'  => false,
								'menu_class' => 'nav navbar-nav navbar-right',
								'fallback_cb' => 'wp_page_menu',
								'walker' => new wp_bootstrap_navwalker( is_front_page() ? 'local-menu' : '' ))
							);
						}
						?>
					</nav>

					<nav id="menu-mobile" class="panel hidden-md hidden-lg" role="navigation">
						<?php
						if (function_exists('icl_get_languages'))
						{ 
							echo '<ul class="languages navbar-left">';
							pt_language_flags();
							echo '</ul>';
						}
						?>
					</nav>

				</div>

			</header>

		<?php } ?>

	<?php } ?>