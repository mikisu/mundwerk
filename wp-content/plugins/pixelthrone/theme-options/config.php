<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('pt_alma_theme_options')) {

    class pt_alma_theme_options {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
           // $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
            
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field   set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            global $wp_filesystem;

            $content = "/********* Do not edit this file *********/\n\n";

            $content .= "// Styling Options\n";
            $content .= "@primaryColor: ". ($options['primary-color'] ? $options['primary-color'] : '#c1e23b') .";\n";
            $content .= "@secondaryColor: ". ($options['secondary-color'] ? $options['secondary-color'] : '#000000') .";\n";
            $content .= "@headerBackgroundColor: ". ($options['header-bg-color'] ? $options['header-bg-color'] : '#ffffff') .";\n";
            $content .= "@BodyBackgroundColor: ". ($options['body-bg-color'] ? $options['body-bg-color'] : '#ffffff') .";\n";
            $content .= "@music_bar_color: ". ($options['music_bar_color'] ? $options['music_bar_color'] : '#ffffff') .";\n";

            $content .= "// Mobile Menu\n";
            $content .= "@navMobileBackground: ". ($options['navMobileBackground'] ? $options['navMobileBackground'] : '#0099cc') .";\n";
            $content .= "@navMobileText: ". ($options['navMobileText'] ? $options['navMobileText'] : '#ffffff') .";\n";
            $content .= "@navMobileHeading: ". ($options['navMobileHeading'] ? $options['navMobileHeading'] : '#000000') .";\n";

            $content .= "// Body\n";
            $content .= "@bodyFontFamily: \"". $options['body_font']['font-family'] ."\";\n";
            $content .= "@bodyFontWeight: ". ($options['body_font']['font-size'] ? (int) $options['body_font']['font-weight'] : '400') .";\n";
            $content .= "@bodyFontStyle: ". ($options['body_font']['font-style'] ? $options['body_font']['font-style'] : 'normal') .";\n";
            $content .= "@bodyFontSize: ". (int) $options['body_font']['font-size'] .";\n";
            $content .= "@bodyLineHeight: ". (int) $options['body_font']['line-height'] .";\n";
            $content .= "@bodyColor: ". ($options['body_font']['color'] ? $options['body_font']['color'] : 'inherit') .";\n";

            $content .= "// Header\n";
            $content .= "@headerFontFamily: \"". $options['header_font']['font-family'] ."\";\n";
            $content .= "@headerFontWeight: ". ($options['header_font']['font-size'] ? (int) $options['header_font']['font-weight'] : '400') .";\n";
            $content .= "@headerFontStyle: ". ($options['header_font']['font-style'] ? $options['header_font']['font-style'] : 'normal') .";\n";
            $content .= "@headerFontSize: ". (int) $options['header_font']['font-size'] .";\n";
            $content .= "@headerLineHeight: ". (int) $options['header_font']['line-height'] .";\n";
            $content .= "@headerColor: ". ($options['header_font']['color'] ? $options['header_font']['color'] : '#ffffff') .";\n";

            $content .= "// Page Title\n";
            $content .= "@pageTitleFontFamily: \"". $options['page_title']['font-family'] ."\";\n";
            $content .= "@pageTitleFontWeight: ". ($options['page_title']['font-size'] ? (int) $options['page_title']['font-weight'] : '400') .";\n";
            $content .= "@pageTitleFontStyle: ". ($options['page_title']['font-style'] ? $options['page_title']['font-style'] : 'normal') .";\n";
            $content .= "@pageTitleFontSize: ". (int) $options['page_title']['font-size'] .";\n";
            $content .= "@pageTitleLineHeight: ". (int) $options['page_title']['line-height'] .";\n";
            $content .= "@pageTitleColor: ". ($options['page_title']['color'] ? $options['page_title']['color'] : 'inherit') .";\n";

            $content .= "// Heading 1\n";
            $content .= "@h1FontFamily: \"". $options['h1_font']['font-family'] ."\";\n";
            $content .= "@h1FontWeight: ". ($options['h1_font']['font-size'] ? (int) $options['h1_font']['font-weight'] : '400') .";\n";
            $content .= "@h1FontStyle: ". ($options['h1_font']['font-style'] ? $options['h1_font']['font-style'] : 'normal') .";\n";
            $content .= "@h1FontSize: ". (int) $options['h1_font']['font-size'] .";\n";
            $content .= "@h1LineHeight: ". (int) $options['h1_font']['line-height'] .";\n";
            $content .= "@h1Color: ". ($options['h1_font']['color'] ? $options['h1_font']['color'] : 'inherit') .";\n";

            $content .= "// Heading 2\n";
            $content .= "@h2FontFamily: \"". $options['h2_font']['font-family'] ."\";\n";
            $content .= "@h2FontWeight: ". ($options['h2_font']['font-size'] ? (int) $options['h2_font']['font-weight'] : '400') .";\n";
            $content .= "@h2FontStyle: ". ($options['h2_font']['font-style'] ? $options['h2_font']['font-style'] : 'normal') .";\n";
            $content .= "@h2FontSize: ". (int) $options['h2_font']['font-size'] .";\n";
            $content .= "@h2LineHeight: ". (int) $options['h2_font']['line-height'] .";\n";
            $content .= "@h2Color: ". ($options['h2_font']['color'] ? $options['h2_font']['color'] : 'inherit') .";\n";

            $content .= "// Heading 3\n";
            $content .= "@h3FontFamily: \"". $options['h3_font']['font-family'] ."\";\n";
            $content .= "@h3FontWeight: ". ($options['h3_font']['font-size'] ? (int) $options['h3_font']['font-weight'] : '400') .";\n";
            $content .= "@h3FontStyle: ". ($options['h3_font']['font-style'] ? $options['h3_font']['font-style'] : 'normal') .";\n";
            $content .= "@h3FontSize: ". (int) $options['h3_font']['font-size'] .";\n";
            $content .= "@h3LineHeight: ". (int) $options['h3_font']['line-height'] .";\n";
            $content .= "@h3Color: ". ($options['h3_font']['color'] ? $options['h3_font']['color'] : 'inherit') .";\n";

            $content .= "// Heading 4\n";
            $content .= "@h4FontFamily: \"". $options['h4_font']['font-family'] ."\";\n";
            $content .= "@h4FontWeight: ". ($options['h4_font']['font-size'] ? (int) $options['h4_font']['font-weight'] : '400') .";\n";
            $content .= "@h4FontStyle: ". ($options['h4_font']['font-style'] ? $options['h4_font']['font-style'] : 'normal') .";\n";
            $content .= "@h4FontSize: ". (int) $options['h4_font']['font-size'] .";\n";
            $content .= "@h4LineHeight: ". (int) $options['h4_font']['line-height'] .";\n";
            $content .= "@h4Color: ". ($options['h4_font']['color'] ? $options['h4_font']['color'] : 'inherit') .";\n";

            $content .= "// Heading 5\n";
            $content .= "@h5FontFamily: \"". $options['h5_font']['font-family'] ."\";\n";
            $content .= "@h5FontWeight: ". ($options['h5_font']['font-size'] ? (int) $options['h5_font']['font-weight'] : '400') .";\n";
            $content .= "@h5FontStyle: ". ($options['h5_font']['font-style'] ? $options['h5_font']['font-style'] : 'normal') .";\n";
            $content .= "@h5FontSize: ". (int) $options['h5_font']['font-size'] .";\n";
            $content .= "@h5LineHeight: ". (int) $options['h5_font']['line-height'] .";\n";
            $content .= "@h5Color: ". ($options['h5_font']['color'] ? $options['h5_font']['color'] : 'inherit') .";\n";

            $content .= "// Heading 6\n";
            $content .= "@h6FontFamily: \"". $options['h6_font']['font-family'] ."\";\n";
            $content .= "@h6FontWeight: ". ($options['h6_font']['font-size'] ? (int) $options['h6_font']['font-weight'] : '400') .";\n";
            $content .= "@h6FontStyle: ". ($options['h6_font']['font-style'] ? $options['h6_font']['font-style'] : 'normal') .";\n";
            $content .= "@h6FontSize: ". (int) $options['h6_font']['font-size'] .";\n";
            $content .= "@h6LineHeight: ". (int) $options['h6_font']['line-height'] .";\n";
            $content .= "@h6Color: ". ($options['h6_font']['color'] ? $options['h6_font']['color'] : 'inherit') .";\n";

           if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
                WP_Filesystem();
            }
            
            if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                  get_template_directory().'/less/site-options.less',
                  $content,
                  FS_CHMOD_FILE 
                );
            }
            /* Compile less .less */
            require_once(PLUGIN_PATH .'lib/lessphp/lessc.inc.php');

            $less = new lessc;
            $less->setPreserveComments(true);

            $compile = $less->compileFile(get_template_directory()."/less/style.less", get_template_directory()."/style.css");

        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            /**

            PixelThrone Theme Options

            */
            require_once(dirname(__FILE__) . '/theme-options.php');

            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework-demo'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'redux-framework-demo'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'redux-framework-demo'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme();


            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'pt_theme_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name') . " — Theme Options",     // Name that appears at the top of your panel
                'display_version'   => throne_building::$plugin_info['Version'],  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'redux-framework-demo'),
                'page_title'        => __('Theme Options', 'redux-framework-demo'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyCMx4DTFWl48n9QRtrN4IExwBZnZN5i', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => 'pt_theme_options',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => PLUGIN_URL . 'assets/img/pt_menu_icon.png',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => 'pt_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => true, // REMOVE
                'page_position' => '99.1',

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url' => 'http://www.facebook.com/pixelthrone',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/pixelthrone',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://themeforest.net/user/pixelthrone?ref=pixelthrone',
                'title' => 'ThemeForest Portfolio',
                'icon' => 'el-icon-leaf'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
            } else {
                //$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>Please always do a <b>Save Changes</b> after a <b>Reset to Defaults</b>.</p>', 'redux-framework');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new pt_alma_theme_options();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
