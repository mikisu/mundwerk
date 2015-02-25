<?php

class WPBakeryShortCode_pt_gallery extends WPBakeryShortCode {

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

		$output = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'mode' => 'horizontal',
			'auto' => 'true',
			'pause' => '4000',
			'speed' => '500',
			'easing' => 'linear',
			'adaptiveheight' => 'true',
			'images' => '',
			'img_size' => 'large',
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

		if ($onclick == 'swipebox')
		{
			wp_enqueue_script( 'swipebox' );
			wp_enqueue_style( 'swipebox' );
		}

		if ($onclick == 'magnificPopup')
		{
			wp_enqueue_script( 'magnificPopup' );
			wp_enqueue_style( 'magnificPopup' );
		}

		$output .= '<div class="pt_gallery_wrapper'. $el_class .'" ' . $animation_attr . '>';
		$output .= '<ul class="pt_gallery" data-mode="' . $mode . '" data-auto="' . $auto . '"  data-pause="' . $pause . '"  data-speed="' . $speed . '"  data-easing="' . $easing . '" data-adaptiveheight="' . $adaptiveheight . '">';

		foreach ( $images as $attach_id ) 
		{
			$post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
			$thumbnail = $post_thumbnail['thumbnail'];
			$p_img_large = $post_thumbnail['p_img_large'];

			$output .= '<li>';

			if ($onclick != '')
			{
				$output .= '<a class="' . ($onclick == 'magnificPopup' ? '' : $onclick) . '" href="' . $p_img_large[0] . '">';
			}

			$output .= $thumbnail;

			if ($onclick != '')
			{
				$output .= '</a>';
			}

			$output .= '</li>';
		}

		$output .= '</ul>';
		$output .= '</div>';

		return $output;

	}
}


vc_map( array(
	"name" => __("Image Gallery", "js_composer"),
	"base" => "pt_gallery",
	"icon" => "fa fa-picture-o",
	"category" => __('Content', 'js_composer'),
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => __("Mode", "js_composer"),
			"param_name" => "mode",
			"value" => array(
				__("Horizontal", "js_composer") => 'horizontal',
				__("Vertical", "js_composer") => 'vertical',
				__("Fade", "js_composer") => 'fade'
				),
			"description" => __("Type of transition between slides", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Auto", "js_composer"),
			"param_name" => "auto",
			"value" => array(
				__("Yes", "js_composer") => 'true',
				__("No", "js_composer") => 'false',
				),
			"description" => __("Slides will automatically transition", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Pause", "js_composer"),
			"param_name" => "pause",
			"description" => __("The amount of time (in ms) between each auto transition", "js_composer"),
			"value" => "4000",
			),
		array(
			"type" => "textfield",
			"heading" => __("Speed", "js_composer"),
			"param_name" => "speed",
			"description" => __("Slide transition duration (in ms)", "js_composer"),
			"value" => "500",
			),
		array(
			"type" => "dropdown",
			"heading" => __("Easing", "js_composer"),
			"param_name" => "easing",
			"value" => array('linear', 'ease', 'ease-in', 'ease-out', 'ease-in-out'),
			"description" => __("The type of \"easing\" to use during transitions.", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Adaptive Height", "js_composer"),
			"param_name" => "adaptiveheight",
			"value" => array(
				__("No", "js_composer") => 'false',
				__("Yes", "js_composer") => 'true',
				),
			"description" => __("Dynamically adjust slider height based on each slide's height", "js_composer")
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
			"heading" => __("Image size", "js_composer"),
			"param_name" => "img_size",
			"value" => "full",
			"description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'large' size.", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("On click", "js_composer"),
			"param_name" => "onclick",
			"value" => array(__("Do nothing", "js_composer") => "", __("Open with Swipebox", "js_composer") => "swipebox", __("Open with Magnific Popup", "js_composer") => "magnificPopup"),
			"description" => __("What to do when slide is clicked?", "js_composer")
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
) );