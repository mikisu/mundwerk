<?php

class pt_custom_menu {

	function __construct() {

		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'pt_scm_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'pt_scm_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'pt_scm_edit_walker'), 10, 2 );
	} 
	

	function pt_scm_add_custom_nav_fields( $menu_item ) {

		$menu_item->external_link = get_post_meta( $menu_item->ID, '_menu_item_external_link', true );

		return $menu_item;
	}
	
	function pt_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		// actualiza a checkbox do external_link
		$external_link_value =  isset($_REQUEST['menu-item-external_link'][$menu_item_db_id])  ? "1" : "0";
		update_post_meta( $menu_item_db_id, '_menu_item_external_link', $external_link_value );
	}
	
	function pt_scm_edit_walker($walker,$menu_id) {

		return 'Walker_Nav_Menu_Edit_Custom';

	}
}

include_once( 'edit_custom_walker.php' );
