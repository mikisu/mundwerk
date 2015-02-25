<?php

class WPBakeryShortCode_pt_thumbnails_gallery extends WPBakeryShortCode {

	public function singleParamHtmlHolder($param, $value) {
		$output = '';
		
	// Compatibility fixes
		$old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
		$new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
		$value = str_ireplace($old_names, $new_names, $value);
	//$value = __($value, "js_composer");
	//
		$param_name = isset($param['param_name']) ? $param['param_name'] : '';
		$type = isset($param['type']) ? $param['type'] : '';
		$class = isset($param['class']) ? $param['class'] : '';

		if ( isset($param['holder']) == true && $param['holder'] !== 'hidden' ) {
			$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
		}
		if($param_name == 'images') {
			$images_ids = empty($value) ? array() : explode(',', trim($value));
			$output .= '<ul class="attachment-thumbnails'.( empty($images_ids) ? ' image-exists' : '' ).'" data-name="' . $param_name . '">';
			foreach($images_ids as $image) {
				$img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ));
				$output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.$image.'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
			}
			$output .= '</ul>';
			$output .= '<a href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '">' . __( 'Add images', 'js_composer' ) . '</a>';

		}
		return $output;
	}


	protected function content($atts, $content = null) {

		$css_animation = $animation_attr = $output = '';

		extract(shortcode_atts(array(
			'images' => '',
			'rows' => '',
			'onclick' => '',
			'el_class' => '',
			'css_animation' => '',
			'css_delay' => '',
			'pt_hidden_viewport' => ''
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$images = explode( ',', $images);
		$data = array();
		$photo_default_size = 150;

		foreach ( $images as $attach_id ) {
			$thumb = wp_get_attachment_image_src( $attach_id, 'thumbnail' );
			$large = wp_get_attachment_image_src( $attach_id, 'full' );

			if ($thumb && $large) {
				$data[] = array(
					'thumb' => $thumb[0],
					'large' => $large[0]
					);
			}
		}

		if ( $data ) {

			$json_data = json_encode(array('data' => $data));

			$uniqid = uniqid('gallery_images_');

			wp_localize_script( 'plugins', $uniqid, $json_data );

			if ($onclick == 'magnificPopup'){
				wp_enqueue_script( 'magnificPopup' );
				wp_enqueue_style( 'magnificPopup' );
			}

			if ($onclick == 'swipebox'){
				wp_enqueue_script( 'swipebox' );
				wp_enqueue_style( 'swipebox' );
			}

			wp_register_style('template-gallery', get_template_directory_uri() . '/framework/lib/gallery/gallery.css', NULL);
			wp_enqueue_style('template-gallery');

			wp_register_script('template-gallery', get_template_directory_uri() . '/framework/lib/gallery/gallery.min.js', NULL, WP_THEME_VERSION, TRUE);
			wp_enqueue_script('template-gallery');
		

			$style = 'style="height: '. $photo_default_size * (int)$rows .'px;"';

			$output = '
			<div class="template-gallery-loading"></div>
			<div class="template-gallery-wrapper'. $el_class .'" '. $style .'>
				<div class="template-gallery '. ($onclick=="magnificPopup" ? $onclick : '') .'" '. $style .' data-window="'. $onclick .'" data-images="'. $uniqid .'" ' . $animation_attr . '></div>
			</div>
			';
		}

		return $output;
	}
}


vc_map( array(
	"name" => __("Thumbnails Gallery", "js_composer"),
	"base" => "pt_thumbnails_gallery",
	"icon" => "icon-wpb-images-stack",
	"category" => __('Content', 'js_composer'),
	"params" => array(
		array(
			"type" => "textfield", //Dummy textfield Pixelthrone. Just change the value to the desired class
			"param_name" => "pt_vc_dummy_textfield", // don't touch
			"value"=> "pt_thumbs_gallery_dummy" // class name
			),
		array(
			"type" => "attach_images",
			"heading" => __("Images", "js_composer"),
			"param_name" => "images",
			"value" => "",
			"description" => __("Select images from media library.", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Number of rows", "js_composer"),
			"param_name" => "rows",
			"value" => "2",
			"description" => __("Enter the Number of rows for gallery", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("On click", "js_composer"),
			"param_name" => "onclick",
			"value" => array(__("Do nothing", "js_composer") => "", __("Open with Swipebox", "js_composer") => "swipebox", __("Open with Magnific Popup", "js_composer") => "magnificPopup"),
			),
		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		)
));