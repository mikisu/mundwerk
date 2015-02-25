<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_portfolio-details-options',
		'title' => 'Portfolio Options',
		'fields' => array (
			array (
				'key' => 'field_530cd2612f12b',
				'label' => 'Background Color',
				'name' => 'folio_bg_color',
				'type' => 'color_picker',
				'default_value' => '#ffffff',
			),
			array (
				'key' => 'field_530cd2912f12c',
				'label' => 'Text Color',
				'name' => 'folio_text_color',
				'type' => 'color_picker',
				'default_value' => '#000000',
			),
			array (
				'key' => 'field_530cd2aa2f12d',
				'label' => 'Header Background Color',
				'name' => 'folio_header_bg_color',
				'type' => 'color_picker',
				'default_value' => '#000000',
			),
			array (
				'key' => 'field_530cd2da2f12e',
				'label' => 'Header Text Color',
				'name' => 'folio_header_text_color',
				'type' => 'color_picker',
				'default_value' => '#ffffff',
			),
			array (
				'key' => 'field_532732d7a0a6c',
				'label' => 'Background Repeat <i class="fa fa-question-circle" data-toggle="tooltip" title="Ajax - Opens portfolio content in a lightwindow (ajax)
				Refresh (no ajax) - Opens portfolio content in current window
				Gallery - Opens a lightwindow with Portfolio gallery"></i>',
				'name' => 'folio_portfolio_type',
				'type' => 'radio',
				'choices' => array (
					'pt_portfolio_1' => 'Ajax',
					'pt_portfolio_2' => 'Refresh (no ajax)',
					'pt_portfolio_3' => 'Gallery',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_532735dea0a6d',
				'label' => 'Portfolio Gallery',
				'name' => 'folio_portfolio_gallery',
				'type' => 'gallery',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_532732d7a0a6c',
							'operator' => '==',
							'value' => 'pt_portfolio_3',
						),
					),
					'allorany' => 'all',
				),
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'portfolio',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
