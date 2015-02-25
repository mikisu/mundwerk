<?php

/* 
	DISPARA ERRO AO DETECTAR QUE O THEME N TEM 
	PERMIÇÕES DE ESCRITA NO FICHEIROS NECESSARIOS.
*/
	function custom_error_notice_file_not_writable(){
		global $current_screen;

		if ( is_child_theme() ) {
			$my_file = get_template_directory().'/less/site-options.less';
			$my_style = get_template_directory().'/style.css';
		} else {
			$my_file = get_stylesheet_directory().'/less/site-options.less';
			$my_style = get_stylesheet_directory().'/style.css';
		}

		if( !is_writable($my_file) || !is_writable($my_style) ){
			echo '<div class="error custom_error_notice_file_not_writable">
					<h1>Warning (Theme Options)</h1>

					<span class="block1">
						<p>We detected that you need to give some files written permission so that "<a href="/wp-admin/admin.php?page=_options&tab=0" >Theme Options</a>" page can save the new changes.
						<br>To learn how to do it check out this video.</p>
					</span>

					<span class="block2">
						<a href="https://www.youtube.com/watch?v=LX-37zRTJaQ" target="_blank"><i class="ion-social-youtube"></i><p>View on <br>YouTube<p></a>
					</span>
				</div>';
		}

		// if( !ini_get('allow_url_fopen') ) {
		// 	echo '<div class="error custom_error_allow_url_fopen">
		// 				<h1>Warning (Allow Url fopen) is OFF</h1>

		// 				<p>We detected that your server have the "<strong><u>allow_url_fopen</u></strong>" php  function <strong><i>OFF</i> </strong>.
		// 				<br>For the theme works you need to turn it <strong><i>ON</i> </strong>.
		// 				<br>If you do not know how to do it, please contact your server support.</p>
		// 				<h4>While you are see this error the "theme options" will not work. </h4>
		// 		</div>';
		// } 

		//print_r($current_screen->parent_base);
		//if ( $current_screen->parent_base == 'edit' )
	}


/* 
Redux Tracking
*/
	function pt_redux_tracking() {

		$redux_tracking = get_option('redux-framework-tracking');

		if ( isset($redux_tracking) && $redux_tracking ) {
			$redux_tracking = array(
				"dev_mode" => true,
				"hash" => md5(site_url() . '-' . $_SERVER['REMOTE_ADDR']),
				"allow_tracking" => "no",
				"tour" => 1,
				);

			update_option('redux-framework-tracking', $redux_tracking);
		}

	}


/* 
	AUMENTA O NUMERO DE POSTS NA LISTA
*/
	function customize_admin(){
		global $per_page;
		$per_page = 500;
	}


/* 
	ADICIONA PORTFOLIO NOVA COLUNA
*/
	function dt_add_post_columns($columns){

		$announcement_columns = array(
			"cb" 			=> "<input type=\"checkbox\" />",
			"thumbnail" 	=> "Thumb",
			"title" 		=> "Title",
			//"topics" 		=> "Topics",
			//"author" 		=> "Author",
			//"categories" 	=> "Category",
			//"tags"		=> "Tags",
			//"comments"	=> "Comments",
			"date" 			=> "Date",
			);

		return $announcement_columns;			
	}

	// get post featured image
	function pt_get_featured_image($post_ID) {  
		$post_thumbnail_id = get_post_thumbnail_id($post_ID);  
		if ($post_thumbnail_id) {  
			$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
			return $post_thumbnail_img[0];  
		}  
	}

	// Show featured image
	function pt_columns_content($column_name, $post_ID) {  
		if ($column_name == 'thumbnail') {  
			$post_featured_image = pt_get_featured_image($post_ID);  
			if ($post_featured_image) {  
				echo '<img src="' . $post_featured_image . '" />';  
			}  
		}  
	}

/* 
	FUNÇÃO PARA VEREFICAR SE PLUGIN EXISTE
*/
	// echo get_option('active_plugins');

	function plugin_is_active( $plugin ) {
	    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
	}



/* Documentation menu */
function plugin_load_plugins_loaded()
{
	global $pt_theme_options;

	if ( isset($pt_theme_options['show_menu_docs']) && $pt_theme_options['show_menu_docs'] == 1) {
		// Hook for adding admin menus
		add_action('admin_menu', 'pt_add_documentation_pages');
	}
}

// action function for above hook
function pt_add_documentation_pages() {
	add_menu_page(__('Documentation', 'pt_admin_framework'), 'Documentation', 'manage_options', 'pixelthrone_documentation', 'pt_page_documentation', PLUGIN_URL . 'assets/img/pt_menu_icon.png', '99.2' );
}

function pt_page_documentation() {
	include(PLUGIN_PATH.'documentation/index.php');
}
