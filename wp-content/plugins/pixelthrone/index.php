<?php
/**
 * Plugin Name: PixelThrone
 * Plugin URI: http://themeforest.net/user/pixelthrone
 * Description: PixelThrone Framework Plugin
 * Version: 1.1.15
 * Author: PixelThrone
 * Author URI: http://themeforest.net/user/pixelthrone
 * License: GPL2
 */

$my_theme = wp_get_theme();

if ( $my_theme->get('Author') == "PixelThrone") {

	// VARS de Sistema
	if( !defined('PLUGIN_PATH') ) {
		define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
	}
	if( !defined('PLUGIN_URL') ) {
		define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}
	// ACF lite mode
	if( !defined('ACF_LITE') ) {
		define( 'ACF_LITE', TRUE );
	}

	// Build Function
	require_once('lib/build.php');
	$start_building =  new throne_building;

	// Funções Antigas para organizar
	require_once('lib/functions.php');


	function pt_plugin_override() {


		/* Load Custom Post Types */
		require_once('custom-post-types/portfolio-post-type.php');

		/* Load Custom Fields */
		require_once('custom-fields/page-fields.php');
		require_once('custom-fields/blog-fields.php');
		require_once('custom-fields/portfolio-fields.php');

		/* Widgets */
		require_once('widgets/recent-posts.php');


		/* Theme Options */

		/* Redux Tracking */
		pt_redux_tracking();

		// Chama redux caso o plugin não exista.
		if(!class_exists('ReduxFramework') && !plugin_is_active('redux-framework/redux-framework.php')){
			require_once(dirname(__FILE__). '/theme-options/ReduxCore/framework.php');
		} 

		// Add Redux Custom Fields
		add_filter( "redux/pt_theme_options/field/class/google_maps_point", "overload_field_google_maps_point" );
		function overload_field_google_maps_point($field) {
			return dirname(__FILE__).'/theme-options/fields/google_maps_point/field_google_maps_point.php';
		}

		add_filter( "redux/pt_theme_options/field/class/sortable_label", "overload_field_sortable_label" );
		function overload_field_sortable_label($field) {
			return dirname(__FILE__).'/theme-options/fields/sortable_label/field_sortable_label.php';
		}

		// Pixelthrone Redux Options
		require_once(dirname(__FILE__). '/theme-options/config.php');
	

		add_action( 'admin_enqueue_scripts', 'plugin_load_admin_enqueue_scripts' );
		function plugin_load_admin_enqueue_scripts()
		{
			wp_register_style('font-awesome', PLUGIN_URL . 'lib/fonts/font-awesome/css/font-awesome.min.css', NULL, '4.1.0');
			wp_enqueue_style('font-awesome');

			wp_register_style('ionicons', PLUGIN_URL . 'lib/fonts/ionicons/css/ionicons.min.css', NULL, '1.4.1');
			wp_enqueue_style('ionicons');

			wp_register_style('elusive-iconfont', PLUGIN_URL . 'lib/fonts/elusive-iconfont/css/elusive-webfont.css', NULL, NULL);
			wp_enqueue_style('elusive-iconfont');

			wp_register_style('mfglabs-iconset', PLUGIN_URL . 'lib/fonts/mfglabs-iconset/css/mfglabs_iconset.css', NULL, NULL);
			wp_enqueue_style('mfglabs-iconset');

			wp_register_style('bootstrap-popovers', PLUGIN_URL . 'lib/bootstrap-iconpicker/bootstrap/css/bootstrap.min.css', NULL, '3.0.2');
			wp_enqueue_style('bootstrap-popovers');

			wp_register_script('bootstrap-popovers', PLUGIN_URL . 'lib/bootstrap-iconpicker/bootstrap/js/bootstrap.min.js', NULL, '3.0.2', TRUE);
			wp_enqueue_script('bootstrap-popovers');

			wp_register_style('bootstrap-iconpicker', PLUGIN_URL . 'lib/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css', NULL, '1.3.6');
			wp_enqueue_style('bootstrap-iconpicker');

			wp_register_script('bootstrap-iconpicker',  PLUGIN_URL . 'lib/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js', NULL, NULL, TRUE);
			wp_enqueue_script('bootstrap-iconpicker');

			wp_register_style( 'pt-framework', PLUGIN_URL . 'assets/css/framework.css', NULL, NULL );
			wp_enqueue_style( 'pt-framework' );

			wp_register_script('pt-framework',  PLUGIN_URL . 'assets/js/framework.min.js', array('jquery', 'jquery-ui-core'), NULL, TRUE);
			wp_enqueue_script('pt-framework');

			wp_localize_script( 'pt-framework', 'AjaxHelperAdmin', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' )
			));

			//revslider notive
			update_option('revslider-valid-notice', 'false');
		}


		// TinyMCE 4
		function mce_mod( $init ) {

			$style_formats = array(
				array(
					'title' => 'Headings',
					'items' => array(
						array('title' => 'Header 1', 'format' => 'h1'),
						array('title' => 'Header 2', 'format' => 'h2'),
						array('title' => 'Header 3', 'format' => 'h3'),
						array('title' => 'Header 4', 'format' => 'h4'),
						array('title' => 'Header 5', 'format' => 'h5'),
						array('title' => 'Header 6', 'format' => 'h6')
					)
				),

				array(
					'title' => 'Text Size',
					'items' => array(
						array('title' => '10px', 'inline' => 'span', 'classes' => 'textsize10'),
						array('title' => '11px', 'inline' => 'span', 'classes' => 'textsize11'),
						array('title' => '12px', 'inline' => 'span', 'classes' => 'textsize12'),
						array('title' => '13px', 'inline' => 'span', 'classes' => 'textsize13'),
						array('title' => '14px', 'inline' => 'span', 'classes' => 'textsize14'),
						array('title' => '16px', 'inline' => 'span', 'classes' => 'textsize16'),
						array('title' => '18px', 'inline' => 'span', 'classes' => 'textsize18'),
						array('title' => '20px', 'inline' => 'span', 'classes' => 'textsize20'),
						array('title' => '25px', 'inline' => 'span', 'classes' => 'textsize25'),
						array('title' => '30px', 'inline' => 'span', 'classes' => 'textsize30'),
						array('title' => '35px', 'inline' => 'span', 'classes' => 'textsize35'),
						array('title' => '40px', 'inline' => 'span', 'classes' => 'textsize40'),
						array('title' => '50px', 'inline' => 'span', 'classes' => 'textsize50'),
						array('title' => '60px', 'inline' => 'span', 'classes' => 'textsize60'),
						array('title' => '70px', 'inline' => 'span', 'classes' => 'textsize70'),
						array('title' => '80px', 'inline' => 'span', 'classes' => 'textsize80'),
						array('title' => '90px', 'inline' => 'span', 'classes' => 'textsize90'),
						array('title' => '100px', 'inline' => 'span', 'classes' => 'textsize100')
					)
				),

				array(
					'title' => 'Text Opacity',
					'items' => array(
						array('title' => 'Opacity 90%', 'inline' => 'span', 'classes' => 'op90'),
						array('title' => 'Opacity 80%', 'inline' => 'span', 'classes' => 'op80'),
						array('title' => 'Opacity 70%', 'inline' => 'span', 'classes' => 'op70'),
						array('title' => 'Opacity 60%', 'inline' => 'span', 'classes' => 'op60'),
						array('title' => 'Opacity 50%', 'inline' => 'span', 'classes' => 'op50'),
						array('title' => 'Opacity 40%', 'inline' => 'span', 'classes' => 'op40'),
						array('title' => 'Opacity 30%', 'inline' => 'span', 'classes' => 'op30'),
						array('title' => 'Opacity 20%', 'inline' => 'span', 'classes' => 'op20'),
						array('title' => 'Opacity 10%', 'inline' => 'span', 'classes' => 'op10'),
					)
				),

				array(
					'title' => 'Inline',
					'items' => array(
						array('title' => 'Strikethrough','format' => 'strikethrough','icon' => 'strikethrough'),
						array('title' => 'Superscript','format' => 'superscript','icon' => 'superscript'),
						array('title' => 'Subscript','format' => 'subscript', 'icon' => 'subscript'),
						array('title' => 'Code','format' => 'code', 'icon' => 'code'),
					)
				),

				array(
					'title' => 'Blocks',
					'items' => array(
						array('title' => 'Paragraph', 'format' => 'p'),
						array('title' => 'Blockquote', 'format' => 'blockquote'),
						array('title' => 'Address','format' => 'address'),
						array('title' => 'Div', 'format' => 'div'),
						array('title' => 'Pre','format' => 'pre'),
						)
					)
				);

			$init['style_formats'] = json_encode( $style_formats );
			$init['style_formats_merge'] = false;


			$default_colours = '000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,008000,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF';
			$custom_colours = 'e14d43,d83131,ed1c24,f99b1c,50b848,00a859,00aae7,282828';
			$init['theme_advanced_text_colors'] = $default_colours . ',' . $custom_colours;
			$init['theme_advanced_more_colors'] = true;

		    return $init;
		}
		add_filter('tiny_mce_before_init', 'mce_mod');

		function mce_add_buttons( $buttons ){
		    array_unshift( $buttons, 1, 0, 'styleselect' );
		    $remove = array('formatselect');
		    return array_diff($buttons,$remove);
		}
		add_filter( 'mce_buttons_2', 'mce_add_buttons' );



		// Importer
		add_action( 'wp_ajax_nopriv_pt-ajax-import', 'pt_ajax_import' );
		add_action( 'wp_ajax_pt-ajax-import', 'pt_ajax_import' );
		function pt_ajax_import()
		{
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

			// Load Importer API
			require_once ABSPATH . 'wp-admin/includes/import.php';

			if ( isset($_POST['dummy']) ) {
				$import_filename = $_POST['dummy'];
			}
			else {
				die();
			}

			$import_filepath = PLUGIN_PATH ."dummy_content/". $import_filename;

			if ( !class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				if ( file_exists( $class_wp_importer ) )
				{
					require_once($class_wp_importer);
				}
			}

			if ( !class_exists( 'WP_Import' ) ) {
				$class_wp_import = PLUGIN_PATH . 'lib/importer/wordpress-importer.php';
				if ( file_exists( $class_wp_import ) )
				{
					require_once($class_wp_import);
				}
			}

			if(!is_file($import_filepath))
			{
				echo "The XML file containing the dummy content is not available. Please use the wordpress importer to import the XML file (located in your dummy_content folder:". $import_filename .") <a href='/wp-admin/import.php'>here.</a>";
			}
			else
			{
				$GLOBALS['wp_import'] = new WP_Import();
				$GLOBALS['wp_import']->import($import_filepath);

				$page_on_front = 6;
				$page_for_posts = 1784;
				$option_pt_theme_options = 'a:85:{s:8:"last_tab";s:0:"";s:7:"favicon";a:5:{s:3:"url";s:0:"";s:2:"id";s:0:"";s:6:"height";s:0:"";s:5:"width";s:0:"";s:9:"thumbnail";s:0:"";}s:14:"show_preloader";s:1:"1";s:13:"tracking-code";s:0:"";s:10:"custom-css";s:28:"                            ";s:9:"custom-js";s:28:"                            ";s:14:"show_menu_docs";s:1:"1";s:13:"primary-color";s:7:"#ff6e00";s:15:"secondary-color";s:7:"#ffffff";s:13:"body-bg-color";s:7:"#ffffff";s:9:"show_menu";s:1:"1";s:18:"show_menu_position";s:1:"1";s:17:"show_menu_delayed";s:1:"0";s:15:"header-bg-color";s:7:"#ffffff";s:23:"show_menu_bg_first_page";s:1:"1";s:16:"show_menu_search";s:1:"1";s:11:"header_font";a:10:{s:11:"font-family";s:9:"Open Sans";s:12:"font-options";s:738:"{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"600","name":"Semi-Bold+600"},{"id":"700","name":"Bold+700"},{"id":"800","name":"Extra-Bold+800"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"600italic","name":"Semi-Bold+600+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"800italic","name":"Extra-Bold+800+Italic"}],"subsets":[{"id":"devanagari","name":"Devanagari"},{"id":"cyrillic","name":"Cyrillic"},{"id":"latin","name":"Latin"},{"id":"latin-ext","name":"Latin+Extended"},{"id":"cyrillic-ext","name":"Cyrillic+Extended"},{"id":"greek","name":"Greek"},{"id":"vietnamese","name":"Vietnamese"},{"id":"greek-ext","name":"Greek+Extended"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"600";s:10:"font-style";s:0:"";s:7:"subsets";s:0:"";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"13px";s:11:"line-height";s:4:"30px";s:5:"color";s:7:"#2d3032";}s:19:"navMobileBackground";s:7:"#20282d";s:13:"navMobileText";s:7:"#ffffff";s:16:"navMobileHeading";s:7:"#414f56";s:4:"logo";a:5:{s:3:"url";s:85:"http://alma.pixelthrone.it/v1-dummy/wp-content/uploads/sites/3/2014/04/logo_black.png";s:2:"id";s:4:"1931";s:6:"height";s:2:"30";s:5:"width";s:2:"77";s:9:"thumbnail";s:85:"http://alma.pixelthrone.it/v1-dummy/wp-content/uploads/sites/3/2014/04/logo_black.png";}s:11:"logo_retina";a:5:{s:3:"url";s:0:"";s:2:"id";s:0:"";s:6:"height";s:0:"";s:5:"width";s:0:"";s:9:"thumbnail";s:0:"";}s:10:"playSounds";s:1:"1";s:9:"body_font";a:10:{s:11:"font-family";s:9:"Open Sans";s:12:"font-options";s:738:"{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"600","name":"Semi-Bold+600"},{"id":"700","name":"Bold+700"},{"id":"800","name":"Extra-Bold+800"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"600italic","name":"Semi-Bold+600+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"800italic","name":"Extra-Bold+800+Italic"}],"subsets":[{"id":"devanagari","name":"Devanagari"},{"id":"cyrillic","name":"Cyrillic"},{"id":"latin","name":"Latin"},{"id":"latin-ext","name":"Latin+Extended"},{"id":"cyrillic-ext","name":"Cyrillic+Extended"},{"id":"greek","name":"Greek"},{"id":"vietnamese","name":"Vietnamese"},{"id":"greek-ext","name":"Greek+Extended"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"400";s:10:"font-style";s:0:"";s:7:"subsets";s:0:"";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"16px";s:11:"line-height";s:4:"25px";s:5:"color";s:7:"#000000";}s:10:"page_title";a:10:{s:11:"font-family";s:10:"Montserrat";s:12:"font-options";s:120:"{"variants":[{"id":"400","name":"Normal+400"},{"id":"700","name":"Bold+700"}],"subsets":[{"id":"latin","name":"Latin"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"400";s:10:"font-style";s:0:"";s:7:"subsets";s:5:"latin";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"25px";s:11:"line-height";s:4:"40px";s:5:"color";s:7:"#2d3032";}s:7:"h1_font";a:10:{s:11:"font-family";s:9:"Open Sans";s:12:"font-options";s:738:"{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"600","name":"Semi-Bold+600"},{"id":"700","name":"Bold+700"},{"id":"800","name":"Extra-Bold+800"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"600italic","name":"Semi-Bold+600+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"800italic","name":"Extra-Bold+800+Italic"}],"subsets":[{"id":"devanagari","name":"Devanagari"},{"id":"cyrillic","name":"Cyrillic"},{"id":"latin","name":"Latin"},{"id":"latin-ext","name":"Latin+Extended"},{"id":"cyrillic-ext","name":"Cyrillic+Extended"},{"id":"greek","name":"Greek"},{"id":"vietnamese","name":"Vietnamese"},{"id":"greek-ext","name":"Greek+Extended"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"300";s:10:"font-style";s:0:"";s:7:"subsets";s:0:"";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"25px";s:11:"line-height";s:4:"30px";s:5:"color";s:7:"#4a5157";}s:7:"h2_font";a:10:{s:11:"font-family";s:9:"Open Sans";s:12:"font-options";s:738:"{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"600","name":"Semi-Bold+600"},{"id":"700","name":"Bold+700"},{"id":"800","name":"Extra-Bold+800"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"600italic","name":"Semi-Bold+600+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"800italic","name":"Extra-Bold+800+Italic"}],"subsets":[{"id":"devanagari","name":"Devanagari"},{"id":"cyrillic","name":"Cyrillic"},{"id":"latin","name":"Latin"},{"id":"latin-ext","name":"Latin+Extended"},{"id":"cyrillic-ext","name":"Cyrillic+Extended"},{"id":"greek","name":"Greek"},{"id":"vietnamese","name":"Vietnamese"},{"id":"greek-ext","name":"Greek+Extended"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"400";s:10:"font-style";s:0:"";s:7:"subsets";s:0:"";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"25px";s:11:"line-height";s:4:"30px";s:5:"color";s:7:"#4a5157";}s:7:"h3_font";a:10:{s:11:"font-family";s:9:"Open Sans";s:12:"font-options";s:738:"{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"600","name":"Semi-Bold+600"},{"id":"700","name":"Bold+700"},{"id":"800","name":"Extra-Bold+800"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"600italic","name":"Semi-Bold+600+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"800italic","name":"Extra-Bold+800+Italic"}],"subsets":[{"id":"devanagari","name":"Devanagari"},{"id":"cyrillic","name":"Cyrillic"},{"id":"latin","name":"Latin"},{"id":"latin-ext","name":"Latin+Extended"},{"id":"cyrillic-ext","name":"Cyrillic+Extended"},{"id":"greek","name":"Greek"},{"id":"vietnamese","name":"Vietnamese"},{"id":"greek-ext","name":"Greek+Extended"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"600";s:10:"font-style";s:0:"";s:7:"subsets";s:0:"";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"25px";s:11:"line-height";s:4:"30px";s:5:"color";s:7:"#4a5157";}s:7:"h4_font";a:10:{s:11:"font-family";s:9:"Open Sans";s:12:"font-options";s:738:"{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"600","name":"Semi-Bold+600"},{"id":"700","name":"Bold+700"},{"id":"800","name":"Extra-Bold+800"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"600italic","name":"Semi-Bold+600+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"800italic","name":"Extra-Bold+800+Italic"}],"subsets":[{"id":"devanagari","name":"Devanagari"},{"id":"cyrillic","name":"Cyrillic"},{"id":"latin","name":"Latin"},{"id":"latin-ext","name":"Latin+Extended"},{"id":"cyrillic-ext","name":"Cyrillic+Extended"},{"id":"greek","name":"Greek"},{"id":"vietnamese","name":"Vietnamese"},{"id":"greek-ext","name":"Greek+Extended"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"600";s:10:"font-style";s:0:"";s:7:"subsets";s:0:"";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"20px";s:11:"line-height";s:4:"30px";s:5:"color";s:7:"#4a5157";}s:7:"h5_font";a:10:{s:11:"font-family";s:9:"Open Sans";s:12:"font-options";s:738:"{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"600","name":"Semi-Bold+600"},{"id":"700","name":"Bold+700"},{"id":"800","name":"Extra-Bold+800"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"600italic","name":"Semi-Bold+600+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"800italic","name":"Extra-Bold+800+Italic"}],"subsets":[{"id":"devanagari","name":"Devanagari"},{"id":"cyrillic","name":"Cyrillic"},{"id":"latin","name":"Latin"},{"id":"latin-ext","name":"Latin+Extended"},{"id":"cyrillic-ext","name":"Cyrillic+Extended"},{"id":"greek","name":"Greek"},{"id":"vietnamese","name":"Vietnamese"},{"id":"greek-ext","name":"Greek+Extended"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"600";s:10:"font-style";s:0:"";s:7:"subsets";s:0:"";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"60px";s:11:"line-height";s:4:"60px";s:5:"color";s:7:"#000000";}s:7:"h6_font";a:10:{s:11:"font-family";s:9:"Open Sans";s:12:"font-options";s:738:"{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"600","name":"Semi-Bold+600"},{"id":"700","name":"Bold+700"},{"id":"800","name":"Extra-Bold+800"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"600italic","name":"Semi-Bold+600+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"800italic","name":"Extra-Bold+800+Italic"}],"subsets":[{"id":"devanagari","name":"Devanagari"},{"id":"cyrillic","name":"Cyrillic"},{"id":"latin","name":"Latin"},{"id":"latin-ext","name":"Latin+Extended"},{"id":"cyrillic-ext","name":"Cyrillic+Extended"},{"id":"greek","name":"Greek"},{"id":"vietnamese","name":"Vietnamese"},{"id":"greek-ext","name":"Greek+Extended"}]}";s:6:"google";s:4:"true";s:11:"font-weight";s:3:"700";s:10:"font-style";s:0:"";s:7:"subsets";s:0:"";s:10:"text-align";s:0:"";s:9:"font-size";s:4:"70px";s:11:"line-height";s:4:"70px";s:5:"color";s:7:"#000000";}s:16:"twitter_username";s:11:"Pixelthrone";s:20:"twitter_consumer_key";s:19:"0VSSntqiTUbaY1uxz1g";s:23:"twitter_consumer_secret";s:40:"h5StyJlu5cEO0w6VsrgbiyYKFk4xyWIO6hgF2kSQ";s:18:"twitter_user_token";s:50:"17925886-iR2pgDVCDE4JBDwgIGDIGbh2CdKuMNRoN8WlCM2o0";s:19:"twitter_user_secret";s:43:"6U7uR4Wb3rfoX64WSq7u9Hsug6bpaE33CdZS2LFAbac";s:13:"twitter_count";s:1:"3";s:27:"google_maps_landscape_color";s:7:"#ffffff";s:23:"google_maps_water_color";s:7:"#eefdff";s:23:"google_maps_roads_color";s:7:"#00e5ff";s:16:"google_maps_zoom";s:2:"12";s:18:"google_maps_marker";a:5:{s:3:"url";s:0:"";s:2:"id";s:0:"";s:6:"height";s:0:"";s:5:"width";s:0:"";s:9:"thumbnail";s:0:"";}s:19:"google_maps_point_1";a:2:{s:8:"latitude";s:0:"";s:9:"longitude";s:0:"";}s:19:"google_maps_point_2";a:2:{s:8:"latitude";s:0:"";s:9:"longitude";s:0:"";}s:19:"google_maps_point_3";a:2:{s:8:"latitude";s:0:"";s:9:"longitude";s:0:"";}s:19:"google_maps_point_4";a:2:{s:8:"latitude";s:0:"";s:9:"longitude";s:0:"";}s:16:"mailchimp_enable";s:1:"0";s:17:"mailchimp_api_key";s:0:"";s:17:"mailchimp_list_id";s:0:"";s:10:"vc_gallery";s:1:"0";s:15:"vc_single_image";s:1:"0";s:9:"vc_button";s:1:"0";s:14:"vc_column_text";s:1:"0";s:8:"vc_gmaps";s:1:"0";s:15:"vc_progress_bar";s:1:"0";s:9:"vc_wp_rss";s:1:"0";s:14:"vc_wp_archives";s:1:"0";s:12:"vc_wp_search";s:1:"0";s:10:"vc_wp_meta";s:1:"0";s:20:"vc_wp_recentcomments";s:1:"0";s:14:"vc_wp_calendar";s:1:"0";s:11:"vc_wp_pages";s:1:"0";s:14:"vc_wp_tagcloud";s:1:"0";s:16:"vc_wp_custommenu";s:1:"0";s:10:"vc_wp_text";s:1:"0";s:11:"vc_wp_posts";s:1:"0";s:11:"vc_wp_links";s:1:"0";s:16:"vc_wp_categories";s:1:"0";s:6:"vc_pie";s:1:"0";s:9:"vc_flickr";s:1:"0";s:17:"vc_widget_sidebar";s:1:"0";s:15:"vc_posts_slider";s:1:"0";s:14:"vc_teaser_grid";s:1:"0";s:17:"vc_text_separator";s:1:"0";s:12:"vc_separator";s:1:"0";s:12:"vc_pinterest";s:1:"0";s:13:"vc_cta_button";s:1:"0";s:18:"vc_images_carousel";s:1:"0";s:11:"vc_carousel";s:1:"0";s:13:"vc_posts_grid";s:1:"0";s:10:"vc_message";s:1:"0";s:16:"REDUX_last_saved";i:1397489990;s:14:"REDUX_COMPILER";i:1397489989;s:15:"import_template";s:1:"0";s:16:"import_revslider";s:1:"0";}';

				// Theme Options
				$option_pt_theme_options = unserialize( $option_pt_theme_options );
				update_option( 'pt_theme_options', $option_pt_theme_options ); 

				update_option( 'show_on_front', 'page' ); //posts (default), page (page_on_front)
				update_option( 'page_on_front', $page_on_front ); // Front page
				update_option( 'page_for_posts', $page_for_posts ); // Posts page

				// get menu id
				if ( $menus =  get_terms( 'nav_menu', array( 'orderby' => 'id', 'order' => 'desc', 'number' => 1 ) ) ) {

					$menus_key = array_keys($menus);

					$menu_id = $menus[ $menus_key[0] ]->term_id;
					// set menu
					set_theme_mod( 'nav_menu_locations' , array( 'primary-nav' => $menu_id ) ); 
				}

				wp_delete_post( 1 ); //delete sample page
				wp_delete_post( 2 ); //delete sample post
			}

			exit;
		}
	}


	add_action('plugins_loaded', 'pt_plugin_override', 1 );

	// Adiciona Portfolio nova coluna
	add_filter('manage_portfolio_posts_columns', 'dt_add_post_columns');
	add_action('manage_portfolio_posts_custom_column', 'pt_columns_content', 10, 3);
	add_filter('manage_client_posts_columns', 'dt_add_post_columns');
	add_action('manage_client_posts_custom_column', 'pt_columns_content', 10, 3);
	add_image_size('featured_preview', 55, 55, true);

	// Adiciona Custom Msg
	add_action( 'admin_notices', 'custom_error_notice_file_not_writable' );

	// Aumentar o numero de post por pagina	
	add_action('admin_head', 'customize_admin');

	/* Documentation menu */
	//add_action( 'plugins_loaded', 'plugin_load_plugins_loaded' );

}