<?php
$my_theme = wp_get_theme();

/* CONSTANTS */
define('WP_THEME_VERSION', $my_theme->get('Version'));

// acf lite mode
if( !defined('ACF_LITE') ) {
	define( 'ACF_LITE', TRUE );
}

/* Load resources */
require_once(get_template_directory() . '/framework/helpers.php');
require_once(get_template_directory() . '/framework/wp_bootstrap_navwalker.php');
require_once(get_template_directory() . '/framework/lib/custom-menu/custom-menu.php');

/* Language */
load_theme_textdomain('pt_framework', get_template_directory().'/language');
$locale = get_locale();
$locale_file = get_template_directory()."/language/$locale.php";

if ( is_readable($locale_file) ) {
	require_once($locale_file);
}


/* Framework Setup */
add_action('after_setup_theme', 'pt_framework_setup');
if (!function_exists('pt_framework_setup'))
{
	function pt_framework_setup()
	{
		if (!isset($content_width)) $content_width = 940;

		if (function_exists('add_theme_support'))
		{
			add_theme_support('post-thumbnails');
			add_theme_support('automatic-feed-links');
		}

		// Cria opções extra no menu em WP-admin
		$GLOBALS['pt_custom_menu'] = new pt_custom_menu();

		//Thumbnails
		add_image_size('portfolio-thumb', 600, 9999);
		add_image_size('portfolio-thumb-fit', 600, 400, TRUE);
		add_image_size('portfolio-thumb-large', 960, 9999);
		add_image_size('portfolio-thumb-large-fit', 960, 640, TRUE);
		add_image_size('post-thumb-1', 735, 9999);
		add_image_size('post-thumb-1-full', 1170, 9999);
		add_image_size('post-thumb-2', 770, 9999);
		add_image_size('team', 360, 260, TRUE);
		
		//Register Menu
		add_action('init', 'pt_framework_menus');
		function pt_framework_menus()
		{
			register_nav_menus(array(
				'primary-nav' => __('Header Navigation', 'pt_admin_framework')
			));
		}

		/* Sidebars */

		if (function_exists('register_sidebar'))
		{
			register_sidebar(array(
				'name' => 'Blog Sidebar',
				'id' => 'blog-sidebar',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
			));
		}

		// add placeholder for vc templates
		if ( get_option( 'pt_placeholder_id' ) === false || !wp_get_attachment_url( get_option( 'pt_placeholder_id' ) ) ) {

			$file = get_stylesheet_directory() . '/framework/assets/placeholder.png';
			$filename = basename($file);

			$upload_file = wp_upload_bits($filename, null, file_get_contents($file));
			if (!$upload_file['error']) {
				$wp_filetype = wp_check_filetype($filename, null );
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
					'post_content' => '',
					'post_status' => 'inherit'
					);
				$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );
				if (!is_wp_error($attachment_id)) {
					require_once(ABSPATH . "wp-admin" . '/includes/image.php');
					$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
					wp_update_attachment_metadata( $attachment_id,  $attachment_data );
				}
			}

			update_option('pt_placeholder_id', $attachment_id);
			delete_option('pt_vc_templates');
		}

	}
}


/* Front End enqueuing */
add_action('wp_enqueue_scripts', 'load_wp_enqueue_scripts');
function load_wp_enqueue_scripts()
{
	// If acf not instaled
	if ( !function_exists( 'get_fields' ) ) {
		function get_field( $key, $id=false ) {
			return false;
		}
	}

	// Styles
	wp_enqueue_style( 'js_composer_front' );

	wp_register_style('bootstrap', get_template_directory_uri() . '/framework/lib/bootstrap/css/bootstrap.min.css', NULL, '3.1.1');
	wp_enqueue_style('bootstrap');

	wp_register_style('bootstrap-theme', get_template_directory_uri() . '/framework/lib/bootstrap/css/bootstrap-theme.min.css', NULL, '3.1.1');
	wp_enqueue_style('bootstrap-theme');

	wp_register_style('font-awesome', get_template_directory_uri() . '/framework/lib/fonts/font-awesome/css/font-awesome.min.css', NULL, '4.1.0');
	wp_enqueue_style('font-awesome');

	wp_register_style('ionicons', get_template_directory_uri() . '/framework/lib/fonts/ionicons/css/ionicons.min.css', NULL, '1.4.1');
	wp_enqueue_style('ionicons');

	wp_register_style('elusive-iconfont', get_template_directory_uri() . '/framework/lib/fonts/elusive-iconfont/css/elusive-webfont.css', NULL, NULL);
	wp_enqueue_style('elusive-iconfont');

	wp_register_style('mfglabs-iconset', get_template_directory_uri() . '/framework/lib/fonts/mfglabs-iconset/css/mfglabs_iconset.css', NULL, NULL);
	wp_enqueue_style('mfglabs-iconset');

	wp_register_style('monosocialiconsfont', get_template_directory_uri() . '/framework/lib/fonts/monosocialiconsfont/css/monosocialiconsfont.css', NULL, '1.10');
	wp_enqueue_style('monosocialiconsfont');

	wp_register_style('swipebox', get_template_directory_uri() . '/framework/lib/gallery/swipebox/swipebox.css', NULL);
	wp_enqueue_style('swipebox');

	wp_register_style('magnificPopup', get_template_directory_uri() . '/framework/lib/magnific-popup/magnific-popup.css', NULL);
	wp_enqueue_style('magnificPopup');

	wp_register_style('owl-carousel', get_template_directory_uri() . '/framework/lib/owl-carousel/owl.carousel.css', NULL);
	wp_enqueue_style('owl-carousel');

	wp_register_style('revslider', get_template_directory_uri() . '/less/static-captions.css', NULL);
	wp_enqueue_style('revslider');

	wp_register_style('google-font-open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
    wp_enqueue_style('google-font-open-sans');

	wp_register_style('style', get_stylesheet_uri() . '?last_saved=' . pt_get_theme_option('REDUX_last_saved'), 'bootstrap', WP_THEME_VERSION);
	wp_enqueue_style('style');

	//Scripts
	wp_register_script('gmaps', '//maps.googleapis.com/maps/api/js?sensor=false', NULL, NULL, TRUE);
	
	wp_register_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.7.1.min.js', NULL, '2.7.1', FALSE);
	wp_enqueue_script('modernizr');

	wp_register_script('bootstrap', get_template_directory_uri() . '/framework/lib/bootstrap/js/bootstrap.min.js', array('jquery'), '3.1.1', TRUE);
	wp_enqueue_script('bootstrap');

	wp_register_script('plugins', get_template_directory_uri() . '/js/plugins.min.js', array('jquery'), WP_THEME_VERSION, TRUE);
	wp_enqueue_script('plugins');

	wp_register_script('history', get_template_directory_uri() . '/js/vendor/jquery.history.min.js', array('jquery'), WP_THEME_VERSION, TRUE);

	wp_register_script('swipebox', get_template_directory_uri() . '/framework/lib/gallery/swipebox/jquery.swipebox.min.js', array('plugins'), WP_THEME_VERSION, TRUE);
	wp_enqueue_script('swipebox');

	wp_register_script('magnificPopup', get_template_directory_uri() . '/framework/lib/magnific-popup/jquery.magnific-popup.min.js', array('plugins'), WP_THEME_VERSION, TRUE);
	wp_enqueue_script('magnificPopup');

	if (!pt_is_ajax_request())
	{
		wp_enqueue_script('history');
	}

	// VComposer
	if ( defined('WPB_VC_VERSION') ) {
		wp_enqueue_script('wpb_composer_front_js');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery_ui_tabs_rotate');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-autocomplete');
		wp_enqueue_script('farbtastic');
		wp_enqueue_script('progressCircle');
		wp_enqueue_script('vc_pie');
		wp_enqueue_script('waypoints');
		wp_enqueue_script('jcarousellite');
		wp_enqueue_script('nivo-slider');
		wp_enqueue_script('flexslider');
		wp_enqueue_script('prettyphoto');

		$js_composer = true;
	}
	else {
		$js_composer = false;
	}


	wp_register_script('main', get_template_directory_uri() . '/js/main.min.js', array('plugins'), WP_THEME_VERSION, TRUE);
	wp_enqueue_script('main');
	

	if ( pt_get_theme_option('google_maps_marker', 'url') )
	{
		$google_maps_marker = pt_get_theme_option('google_maps_marker', 'url');
	}
	else {
		$google_maps_marker = get_template_directory_uri() . "/img/marker.png";
	}

	$theme_options_js_settings = array(
		'ajaxurl'						=> admin_url( 'admin-ajax.php' ),
		'js_composer'					=> $js_composer,
		'pt_twitter_username'			=> pt_get_theme_option('twitter_username'),
		'pt_twitter_count'				=> pt_get_theme_option('twitter_count'),
		'pt_twitter_path'				=> get_template_directory_uri() . '/framework/lib/twitter/',

		'google_maps_marker'			=> $google_maps_marker,
		'google_maps_landscape_color'	=> pt_get_theme_option('google_maps_landscape_color'),
		'google_maps_water_color'		=> pt_get_theme_option('google_maps_water_color'),
		'google_maps_roads_color'		=> pt_get_theme_option('google_maps_roads_color'),
		'google_maps_zoom'				=> pt_get_theme_option('google_maps_zoom'),

		'text_back'						=> __('Back', 'pt_framework'),
		'text_weeks'					=> __('Weeks', 'pt_framework'),
		'text_days'						=> __('Days', 'pt_framework'),
		'text_hours'					=> __('Hours', 'pt_framework'),
		'text_minutes'					=> __('Minutes', 'pt_framework'),
		'text_seconds'					=> __('Seconds', 'pt_framework'),

		'template_url'					=> get_template_directory_uri(),
		
		'playSounds'					=> pt_get_theme_option('playSounds'),
		'musicPlayer'					=> pt_get_theme_option('musicPlayer', 'url'),
		

		'musicON_msg'					=> __('ON', 'pt_framework'),
		'musicOFF_msg'					=> __('OFF', 'pt_framework'),
		'musicSound_msg'				=> __('SOUND', 'pt_framework'),
	);


	if ( is_front_page() ) {
		$theme_options_js_settings['show_musicPlayer'] = pt_get_theme_option('show_musicPlayer');
	}
	else {
		$theme_options_js_settings['show_musicPlayer'] = false;
	}


	// $portfolio_page = pt_get_page_by_template('template-portfolio.php');

	// if ($portfolio_page)
	// {
	// 	$theme_options_js_settings['portfolio_total_items'] = (int) (get_field('portfolio_total_rows', $portfolio_page[0]->ID) ? get_field('portfolio_total_rows', $portfolio_page[0]->ID) : 2);
	// }

	for($i=1; $i<5; $i++)
	{
		$google_maps_point = pt_get_theme_option('google_maps_point_' . $i);

		if (!$google_maps_point) {
			$google_maps_point['latitude'] = 0;
			$google_maps_point['longitude'] = 0;
		}

		$theme_options_js_settings['google_maps_point_' . $i] = array(
			'latitude' => $google_maps_point['latitude'],
			'longitude' => $google_maps_point['longitude'],
		);
	}

	wp_localize_script( 'main', 'pt_settings', $theme_options_js_settings );
}


/* Newsletter Form */
add_action( 'wp_ajax_nopriv_pt-ajax-newsletter-form', 'pt_ajax_newsletter_form' );
add_action( 'wp_ajax_pt-ajax-newsletter-form', 'pt_ajax_newsletter_form' );
function pt_ajax_newsletter_form()
{
	if ( isset($_POST['newsletter_name']) )  {
		$newsletter_name = sanitize_text_field($_POST['newsletter_name']);
	}
	$newsletter_email = sanitize_email($_POST['newsletter_email']);
	$exist_email = true;
	$i = 0;

	if(filter_var($newsletter_email, FILTER_VALIDATE_EMAIL))
	{
		//delete_option( 'pt_email_newsletter' );
		$pt_email_newsletter = get_option('pt_email_newsletter');

		if ( $pt_email_newsletter ) {
			foreach($pt_email_newsletter as $key => $value) {
				if ( in_array($newsletter_email, $value) ) {
					$exist_email = false;
				}
				$i = $key;
			}
			$i++;
		}

		if ( $exist_email )
		{
			if ( isset($newsletter_name) ) {
				$pt_email_newsletter[$i]['name'] = $newsletter_name;
			}
			$pt_email_newsletter[$i]['email'] = $newsletter_email;
			update_option( 'pt_email_newsletter', $pt_email_newsletter);
		}

		if ( pt_get_theme_option('mailchimp_enable'))
		{
			require_once get_template_directory() . '/framework/lib/mailchimp/MCAPI.class.php';
			$api = new MCAPI(pt_get_theme_option('mailchimp_api_key'));
			if ( isset($newsletter_name) ) {
				$merge_vars = array( 'FNAME' => $newsletter_name );
			}else{
				$merge_vars = array();
			}
			$api->listSubscribe( pt_get_theme_option('mailchimp_list_id'), $newsletter_email, $merge_vars );
		}
	}

	exit;
}


/* Contact Form */
add_action( 'wp_ajax_nopriv_pt-ajax-contact-form', 'pt_ajax_contact_form' );
add_action( 'wp_ajax_pt-ajax-contact-form', 'pt_ajax_contact_form' );
function pt_ajax_contact_form()
{
	$to =  sanitize_email($_POST['pt_mail_to']);
	$from = sanitize_email($_POST['pt_contact_email']);

	$headers = 'From: "'. sanitize_text_field($_POST['pt_contact_name']) .'" <'. $from .'>';

	$subject = sanitize_text_field($_POST['pt_contact_subject']);

	$body = "Name: " . sanitize_text_field($_POST['pt_contact_name']) ."\n";
	$body .= "E-mail: " . sanitize_text_field($_POST['pt_contact_email']) ."\n";
	$body .= "Subject: " . sanitize_text_field($_POST['pt_contact_subject']) ."\n";
	$body .= "Message: " . esc_textarea($_POST['pt_contact_message']) ."\n";

	if( is_email($from) )
	{
		if ( wp_mail($to, $subject, $body, $headers) ) 
		{
			echo "true";
		}
	}
	exit;
}


/* Portfolio Gallery */
add_action( 'wp_ajax_nopriv_pt_portfolio_ajax_gallery_function', 'pt_portfolio_ajax_gallery_function' );
add_action( 'wp_ajax_pt_portfolio_ajax_gallery_function', 'pt_portfolio_ajax_gallery_function' );
function pt_portfolio_ajax_gallery_function() {

	$page = pt_get_page_options( $_REQUEST['portfolio_id'] );

	if ( isset($page['raw']['folio_portfolio_type']) && $page['raw']['folio_portfolio_type'] == "pt_portfolio_3" && isset($page['raw']['folio_portfolio_gallery']) && !empty($page['raw']['folio_portfolio_gallery']) ) {

		$items = array();

		foreach ( $page['raw']['folio_portfolio_gallery'] as $key => $value ) {
			$items[$key]['src'] = $value['url'];
			$items[$key]['title'] = $value['caption'];
		}

		$output = json_encode($items);

		if( is_array($output) ) {
			print_r($output);  
		}
		else {
			echo $output;
		}
	}

	exit;
}


/* Include the TGM_Plugin_Activation class */
require_once dirname( __FILE__ ) . '/framework/lib/class-tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pt_framework_register_required_plugins' );
function pt_framework_register_required_plugins() {

	$plugins = array(

		// // This is an example of how to include a plugin pre-packaged with a theme
		// array(
		// 	'name'     				=> 'TGM Example Plugin', // The plugin name
		// 	'slug'     				=> 'tgm-example-plugin', // The plugin slug (typically the folder name)
		// 	'source'   				=> get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source
		// 	'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		// 	'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		// 	'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		// 	'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		// 	'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		// ),

		// Within the theme
		array(
			'name'					=> 'PixelThrone',
			'slug'					=> 'pixelthrone',
			'source'				=> get_stylesheet_directory() . '/plugins/pixelthrone.zip',
			'force_activation'		=> false,
			'force_deactivation'	=> true,
			'required'				=> true,
			'version'				=> '1.1.15',
			),
		array(
			'name'					=> 'Advanced Custom Fields: Gallery Field',
			'slug'					=> 'acf-gallery',
			'source'				=> get_stylesheet_directory() . '/plugins/acf-gallery.zip',
			'force_activation'		=> true,
			'required'				=> true,
			'version'				=> '1.1.0',
			),
		array(
			'name'					=> 'Revolution Slider',
			'slug'					=> 'revslider',
			'source'				=> get_stylesheet_directory() . '/plugins/revslider.zip',
			'required'				=> false,
			'version'				=> '4.6',
			),
		array(
			'name'					=> 'Envato WordPress Toolkit',
			'slug'					=> 'envato-wordpress-toolkit',
			'source'				=> get_stylesheet_directory() . '/plugins/envato-wordpress-toolkit.zip',
			'required'				=> false,
			'version'				=> '1.5',
			),

		// WordPress Repository
		array(
			'name'					=> 'Advanced Custom Fields',
			'slug'					=> 'advanced-custom-fields',
			'force_activation'		=> true,
			'required'				=> true,
			),
		array(
			'name'					=> 'WordPress Importer',
			'slug'					=> 'wordpress-importer',
			'required'				=> false,
			),
		array(
			'name'					=> 'Intuitive Custom Post Order',
			'slug'					=> 'intuitive-custom-post-order',
			'required'				=> false,
			),
		array(
			'name'					=> 'WP Retina 2x',
			'slug'					=> 'wp-retina-2x',
			'required'				=> false,
			),
	);

	/**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );


	/* Check PixelThrone plugin for updates */
	pt_pixelthrone_plugin_check( $plugins[0]['version'] );
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'. __('Read More', 'pt_framework') .'</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
