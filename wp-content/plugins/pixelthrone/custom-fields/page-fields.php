<?php
/* 
Template One Page
*/


/* get revolution slider sliders*/
// $rev_sliders = array( );

// if ( class_exists('RevSlider') ) {

// 	$rev = new RevSlider();

// 	$arrSliders = $rev->getArrSliders();
// 	foreach ( (array) $arrSliders as $revSlider ) { 
// 		$rev_sliders[ $revSlider->getAlias() ] = $revSlider->getTitle();
// 	}
// }

/* Page */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_page-options',
		'title' => 'Page Options',
		'fields' => array (
			array (
				'key' => 'field_527298e5619d6',
				'label' => 'Show page on site',
				'name' => 'show_page',
				'type' => 'true_false',
				'message' => 'Show page',
				'default_value' => 1,
				),
			array (
				'key' => 'field_52f4bb126d4c3',
				'label' => 'Page Title',
				'name' => 'page_title',
				'type' => 'radio',
				'instructions' => '',
				'choices' => array (
					'style_1' => 'Show',
					'hide' => 'Hide',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5272984e619d5',
				'label' => 'Page with full height',
				'name' => 'full_height',
				'type' => 'true_false',
				'message' => 'Set full height',
				'default_value' => 0,
				),
			array (
				'key' => 'field_5272984f357d5',
				'label' => 'Page with shadow on top',
				'name' => 'has_shadow',
				'type' => 'true_false',
				'message' => 'Set page shadow',
				'default_value' => 0,
				),
			array (
				'key' => 'field_52729496619d1',
				'label' => 'Padding Top',
				'name' => 'margin_top',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 'Only Numbers',
				'prepend' => '',
				'append' => 'px',
				'min' => '',
				'max' => '',
				'step' => 1,
				),
			array (
				'key' => 'field_527295b0619d2',
				'label' => 'Padding Bottom',
				'name' => 'margin_bottom',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => 'Only Numbers',
				'prepend' => '',
				'append' => 'px',
				'min' => '',
				'max' => '',
				'step' => 1,
				),
			array (
				'key' => 'field_5272928f9d599',
				'label' => 'Text Color',
				'name' => 'text_color',
				'type' => 'color_picker',
				'default_value' => '',
				),
			array (
				'key' => 'field_527291f49d598',
				'label' => 'Background Color',
				'name' => 'bg_color',
				'type' => 'color_picker',
				'default_value' => '',
				),
			array (
				'key' => 'field_527293489d59b',
				'label' => 'Background Opacity',
				'name' => 'bg_opacity',
				'type' => 'number',
				'instructions' => 'Opacity level (0-100)',
				'default_value' => '100',
				'placeholder' => 'Only Numbers',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				),
			array (
				'key' => 'field_5272984e618a5',
				'label' => 'Background lines overlay',
				'name' => 'bg_overlay',
				'type' => 'true_false',
				'message' => 'Set Background overlay',
				'default_value' => 0,
				),
			array (
				'key' => 'field_528e173a8a7c0',
				'label' => __('Select Background Type'),
				'name' => 'bg_type',
				'type' => 'radio',
				'instructions' => __('Use video or images as background'),
				'choices' => array (
					'image' => 'Image',
					'video' => 'Video',
					),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
				),
			array (
				'key' => 'field_528b99c72a3f0',
				'label' => 'Background Gallery <i class="fa fa-question-circle" data-toggle="tooltip" title="Parallax Effect and Background Cover/Repeat options only apply when gallery has one image (no slideshow)"></i>',
				'name' => 'bg_images',
				'type' => 'gallery',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_528e173a8a7c0',
							'operator' => '==',
							'value' => 'image',
							),
						),
					'allorany' => 'all',
					),
				'instructions' => '',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				),
			array (
				'key' => 'field_527295d0619d3',
				'label' => 'Parallax Effect',
				'name' => 'parallax',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_528e173a8a7c0',
							'operator' => '==',
							'value' => 'image',
							),
						),
					'allorany' => 'all',
					),
				'message' => 'Enable Parallax Effect',
				'default_value' => 0,
				),
			array (
				'key' => 'field_52729766619d4',
				'label' => 'Background Cover <i class="fa fa-question-circle" data-toggle="tooltip" title="Scale the background image to be as large as possible so that the background area is completely covered by the background image."></i>',
				'name' => 'bg_cover',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_528e173a8a7c0',
							'operator' => '==',
							'value' => 'image',
							),
						),
					'allorany' => 'all',
					),
				'instructions' => '',
				'message' => 'Disable Background Cover',
				'default_value' => 0,
				),
			array (
				'key' => 'field_5307738e72504',
				'label' => 'Background Repeat <i class="fa fa-question-circle" data-toggle="tooltip" title="The background-repeat property sets if a background image will be repeated. Enabling this disables background-cover property!"></i>',
				'name' => 'bg_repeat',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_528e173a8a7c0',
							'operator' => '==',
							'value' => 'image',
							),
						),
					'allorany' => 'all',
					),
				'instructions' => '',
				'message' => 'Enable Background Repeat',
				'default_value' => 0,
				),

			// array (
			// 	'key' => 'field_527a6b7f50056',
			// 	'label' => __('revolution_slider'),
			// 	'name' => 'revolution_slider',
			// 	'type' => 'select',
			// 	'instructions' => __('Select the slide to show'),
			// 	'choices' => $rev_sliders,
			// 	'default_value' => '',
			// 	'allow_null' => 1,
			// 	'multiple' => 0,
			// 	),			
			// array (
			// 	'key' => 'field_528e16ff8a7bf',
			// 	'label' => __('Video'),
			// 	'name' => 'video_online',
			// 	'type' => 'text',
			// 	'conditional_logic' => array (
			// 		'status' => 1,
			// 		'rules' => array (
			// 			array (
			// 				'field' => 'field_528e173a8a7c0',
			// 				'operator' => '==',
			// 				'value' => 'video',
			// 				),
			// 			),
			// 		'allorany' => 'all',
			// 		),
			// 	'default_value' => '',
			// 	'placeholder' => 'Youtube or Vimeo link',
			// 	'prepend' => '',
			// 	'append' => '',
			// 	'formatting' => 'none',
			// 	'maxlength' => '',
			// 	),

			array (
				'key' => 'field_5272955d0619d3',
				'label' => 'Video image fallback',
				'name' => 'video_img_fallback',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_528e173a8a7c0',
							'operator' => '==',
							'value' => 'video',
							),
						),
					'allorany' => 'all',
					),
				'message' => 'In case the browser does not support HTML5 video, it will display this image.',
				'default_value' => 0,
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				),
			array (
				'key' => 'field_528e161758a7be',
				'label' => __('Video File .mp4'),
				'name' => 'video_file_mp4',
				'type' => 'file',
				'instructions' => __('Upload your video '),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_528e173a8a7c0',
							'operator' => '==',
							'value' => 'video',
							),
						),
					'allorany' => 'all',
					),
				'save_format' => 'object',
				'library' => 'all',
				),
			array (
				'key' => 'field_5258e16178a7be',
				'label' => __('Video File .webm'),
				'name' => 'video_file_webm',
				'type' => 'file',
				'instructions' => __('Upload your video '),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_528e173a8a7c0',
							'operator' => '==',
							'value' => 'video',
							),
						),
					'allorany' => 'all',
					),
				'save_format' => 'object',
				'library' => 'all',
				),
			array (
				'key' => 'field_58526496619d1',
				'label' => 'Video Volume',
				'name' => 'video_volume',
				'type' => 'number',
				'instructions' => __('Volume Level (0-10)'),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_528e173a8a7c0',
							'operator' => '==',
							'value' => 'video',
							),
						),
					'allorany' => 'all',
					),
				'default_value' => '0',
				'placeholder' => 'Only Numbers',
				'prepend' => '',
				'append' => '',
				'min' => '0',
				'max' => '10',
				'step' => 1,
				),
			),
'location' => array (
	array (
		array (
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'page',
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


/* 
Footer Template
*/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_footer-options',
		'title' => 'Footer Options',
		'fields' => array (
			array (
				'key' => 'field_52729e0c3c838',
				'label' => 'Set Footer fixed',
				'name' => 'footer_fixed',
				'type' => 'true_false',
				'message' => 'Set footer fixed',
				'default_value' => 0,
				),
			),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-footer.php',
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


/* 
Blog Template
*/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_blog-options',
		'title' => 'Blog Options',
		'fields' => array (
			array (
				'key' => 'field_528b80737b5e5',
				'label' => __('Sidebar'),
				'name' => 'show_sidebar',
				'type' => 'true_false',
				'message' => 'Show Sidebar',
				'default_value' => 0,
				),
			array (
				'key' => 'field_52aae052caeca',
				'label' => 'Blog Categories',
				'name' => 'blog_categories',
				'type' => 'taxonomy',
				'instructions' => 'Leave empty to show all categories',
				'taxonomy' => 'category',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
				),
			),
'location' => array (
	array (
		array (
			'param' => 'page_template',
			'operator' => '==',
			'value' => 'template-blog.php',
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



/* 
Portfolio Template
*/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_portfolio-options',
		'title' => 'Portfolio Options',
		'fields' => array (
			array (
				'key' => 'field_52972f7c1e7dd',
				'label' => 'Number of Columns',
				'name' => 'portfolio_columns',
				'type' => 'number',
				'instructions' => 'From 1 to 6',
				'default_value' => 4,
				'placeholder' => 'only numbers',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 6,
				'step' => 1,
				),
			array (
				'key' => 'field_52972f7c1e7ff',
				//'label' => 'Number of rows',
				'label' => 'Number os rows <i class="fa fa-question-circle" data-toggle="tooltip" title="Number of visible rows, after this shows a load more button."></i>',
				'name' => 'portfolio_rows',
				'type' => 'number',
				'instructions' => 'Leave empty to show all.',
				'default_value' => '',
				'placeholder' => 'only numbers',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => '',
				'step' => 1,
				),
			array (
				'key' => 'field_52e8f48c6f86d',
				//'label' => 'Fit rows',
				'label' => 'Fit rows <i class="fa fa-question-circle" data-toggle="tooltip" title="Fit Rows layout for items have the same height."></i>',
				'name' => 'fit_rows',
				'type' => 'true_false',
				'instructions' => '',
				'message' => 'Fit rows',
				'default_value' => 0,
			),
			array (
				'key' => 'field_52e8f48c6h58d',
				'label' => 'Show categories filter',
				'name' => 'show_folio_categories',
				'type' => 'true_false',
				'instructions' => '',
				'message' => 'Show categories filter',
				'default_value' => 1,
				),
			array (
				'key' => 'field_52fb9fe76f123',
				'label' => 'Layout',
				'name' => 'portfolio_layout',
				'type' => 'radio',
				'instructions' => '',
				'choices' => array (
					'full' => 'Full width',
					'contained' => 'Contained',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_52fb9fe76f231',
				'label' => 'Information',
				'name' => 'info_style',
				'type' => 'radio',
				'instructions' => '',
				'choices' => array (
					'style_1' => 'Show full info',
					'style_2' => 'Show just title',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_52fb9fe76j528',
				'label' => 'Information Options',
				'name' => 'show_type',
				'type' => 'radio',
				'instructions' => '',
				'choices' => array (
					'show_hover' => 'Show on hover',
					'hide_hover' => 'Hide on hover',
				),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_52fb9fe76f231',
							'operator' => '==',
							'value' => 'style_2',
							),
						),
					'allorany' => 'all',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_52cbe56374ef2',
				'label' => 'Text Color',
				'name' => 'portfolio_text_color',
				'type' => 'color_picker',
				'instructions' => 'Set portfolio hover Text color',
				'default_value' => '',
				),
			array (
				'key' => 'field_52cbe76f74ef3',
				'label' => 'Background Color',
				'name' => 'portfolio_bg_color',
				'type' => 'color_picker',
				'instructions' => 'Set portfolio hover background color',
				'default_value' => '',
				),
			array (
				'key' => 'field_534d54568da90',
				'label' => 'Portfolio Categories',
				'name' => 'portfolio_categories',
				'type' => 'taxonomy',
				'instructions' => 'Leave empty to show all categories',
				'taxonomy' => 'portfolio_category',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
				),
			),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-portfolio.php',
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
		)
	);
}

