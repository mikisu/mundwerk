<?php
/**
 * PixelThrone — Alma — Main Functions
 */

if (!defined('ABSPATH')) die('-1');
if (!class_exists('throne_building')) {

	class throne_building{
		public static $lib_dir;
		public static $plugin_dir;
		public static $plugin_info;

	    public function __construct() {
	    	// Define variaveis chave
	    	self::$lib_dir 		= dirname( __FILE__ );
	    	self::$plugin_dir 	= PLUGIN_PATH;

	    	// Carrega classes
	    	require_once self::$lib_dir.'/notices.php';

	    	// Chama funções
	    	self::loads_if_not_exists();
	    	self::composer_run();

	    	// Carrega Variaveis que precisam das funções em cima.
	    	self::$plugin_info 	= get_plugin_data( PLUGIN_PATH.'index.php', $markup = true, $translate = true );
	    }

	    public function composer_run() {
			/* Page Builder */
			if ( !class_exists('WPBakeryVisualComposer') ) {
				 global $composer_settings;
		         $composer_settings = array(
		             'APP_ROOT'       => PLUGIN_PATH . '/js_composer/',
		             'WP_ROOT'        => ABSPATH,
		             'APP_DIR'        => basename( PLUGIN_PATH ) . '/',
		             'CONFIG'         => PLUGIN_PATH . '/js_composer/config/',
		             'ASSETS_DIR'     => '/js_composer/assets/',
		             'COMPOSER'       => PLUGIN_PATH . '/js_composer/composer/',
		             'COMPOSER_LIB'   => PLUGIN_PATH . '/js_composer/composer/lib/',
		             'SHORTCODES_LIB' => PLUGIN_PATH . '/js_composer/composer/lib/shortcodes/',

		             'USER_DIR_NAME'      => 'vc_templates',
		             'default_post_types' => array('page', 'portfolio', 'post') 
		         );

				require_once self::$plugin_dir.'js_composer/js_composer.php';
				$wpVC_setup->init($composer_settings);

				vc_set_as_theme(true);
			} else {
				add_action( 'admin_notices', 'pt_notices::custom_error_notice_vcomposer_already_instaled' );
			}

			/* Shortcodes */
			require_once self::$plugin_dir.'shortcodes/shortcodes.php';

			/* Remove Shortcodes */
			require_once self::$plugin_dir.'shortcodes/shortcodes-remove.php';

			/* VComposer Templates */
			require_once self::$plugin_dir.'shortcodes/vc_templates.php';
	    }

	    public function loads_if_not_exists() {
	    	if(!function_exists('get_plugin_data')) {
	    		include(ABSPATH . "wp-admin/includes/plugin.php");
			}
	    }
	}

}