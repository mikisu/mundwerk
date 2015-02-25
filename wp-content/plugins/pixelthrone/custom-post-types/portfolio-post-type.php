<?php
add_action('init', 'pt_post_type_portfolio');

function pt_post_type_portfolio()
{

	$labels = array(
		'name'					=> __('Portfolio', 'pt_admin_framework'),
		'singular_name'			=> __('Portfolio' , 'pt_admin_framework'),
		'add_new'				=> __('Add New', 'pt_admin_framework'),
		'add_new_item'			=> __('Add New Portfolio', 'pt_admin_framework'),
		'edit_item'				=> __('Edit Portfolio', 'pt_admin_framework'),
		'new_item'				=> __('New Portfolio', 'pt_admin_framework'),
		'view_item'				=> __('View Portfolio', 'pt_admin_framework'),
		'search_items'			=> __('Search Portfolio', 'pt_admin_framework'),
		'not_found'				=> __('No portfolio found', 'pt_admin_framework'),
		'not_found_in_trash'	=> __('No portfolio found in Trash', 'pt_admin_framework'), 
		'parent_item_colon'		=> ''
		);

	$args = array(
		'labels'				=> $labels,
		'public'				=> TRUE,
		'exclude_from_search'	=> TRUE,
		'publicly_queryable'	=> TRUE,
		'rewrite'				=> array('slug' => get_option('pt_portfolio_slug', 'portfolio-item')),
		'show_ui'				=> TRUE, 
		'query_var'				=> TRUE,
		'capability_type'		=> 'post',
		'hierarchical'			=> FALSE,
		'menu_position'			=> NULL,
		'supports'				=> array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt')
		); 

	register_post_type( 'portfolio', $args );


	$args = array(
		'hierarchical'			=> TRUE, 
		'label'					=> __( 'Portfolio Categories' , 'pt_admin_framework'), 
		'singular_label'		=> __( 'Portfolio Category' , 'pt_admin_framework'), 
		'rewrite'				=> array('slug' => 'portfolio-category', 'hierarchical' => TRUE)
		);

	register_taxonomy( 'portfolio_category', 'portfolio', $args ); 
}
