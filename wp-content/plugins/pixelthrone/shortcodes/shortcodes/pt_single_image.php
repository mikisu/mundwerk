<?php

class WPBakeryShortCode_pt_single_image extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$output = $el_class = $image = $img_size = $img_link = $img_link_target = $img_link_large = $title = $css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'caption' => '',
			'image' => $image,
			'img_size'  => 'thumbnail',
			'onclick' => '',
			'image_align' => '',
			'img_link_large' => false,
			'img_link' => '',
			'onclick' => '',
			'el_class' => '',
			'css_animation' => '',
			'css_delay' => '',
			'pt_hidden_viewport' => '',
			'links_target' => '',
			'img_link_href' => '',
			), $atts));

		$img_id = preg_replace('/[^\d]/', '', $image);
		$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
		if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" /> <small>'.__('This is image placeholder, edit your page to replace it.', 'js_composer').'</small>';

		$link_img = wp_get_attachment_image_src( $img_id, 'large');

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($onclick == 'prettyphoto')
		{
			wp_enqueue_script( 'prettyphoto' );
			wp_enqueue_style( 'prettyphoto' );
		}

		if ($onclick == 'open_link')
		{
			wp_enqueue_script( 'prettyphoto' );
			wp_enqueue_style( 'prettyphoto' );
		}

		$caption = !empty($caption) ?  'title="'.$caption.'"' : $caption = "";

		$image_string = $img['thumbnail'];

		if (!empty($onclick) and $onclick != "open_link") {
			$image_string = '<a class="' . $onclick . ' mfp-image" href="' . $link_img[0] . '"' . $caption .' ><i class="zoon_icon fa fa-search"></i>' . $img['thumbnail'] .'</a>';
		
		} 

		if (!empty($onclick) and $onclick == "open_link") {
			$image_string = '<a  href="'.$img_link_href.'" target="'.$links_target.'"  >' . $img['thumbnail'] . '</a>';
		}

		$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_single_image wpb_content_element '.$image_align.' '.$el_class, $this->settings['base']);
		//$css_class .= $this->getCSSAnimation($css_animation);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$output .= "\n\t".'<div class="'.$css_class.'" >';
		$output .= "\n\t\t".'<div class="wpb_wrapper" ' . $animation_attr . '>';
		$output .= "\n\t\t\t".wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_singleimage_heading'));
		$output .= "\n\t\t\t".$image_string;
		$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
		$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_single_image');

		return $output;
	}
}


vc_map( array(
	"name" => __("Single Image", "js_composer"),
	"base" => "pt_single_image",
	"icon" => "icon-wpb-single-image",
	"category" => __('Content', 'js_composer'),
	"params" => array(
		array(
			"type" => "attach_image",
			"heading" => __("Image", "js_composer"),
			"param_name" => "image",
			"value" => "",
			"description" => __("Select image from media library.", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Image Caption", "js_composer"),
			"param_name" => "caption",
			"description" => __("Leave empty if you do not want to use.", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Image size", "js_composer"),
			"param_name" => "img_size",
			"value" => "full",
			"description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "js_composer")
			),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select Image align", "js_composer"),
			"param_name" => "image_align",
			"value" => $pt_array_text_align,
			"description" => ""
			),
		array(
			"type" => "dropdown",
			"heading" => __("On click", "js_composer"),
			"param_name" => "onclick",
			"value" => array(__("Do nothing", "js_composer") => "", __("Open Link", "js_composer") => "open_link", __("Open with Swipebox", "js_composer") => "swipebox", __("Open with Magnific Popup", "js_composer") => "magnificPopup"),
			),
		array(
			"type" => "textfield",
			"heading" => __("Link href", "js_composer"),
			"param_name" => "img_link_href",
			"value" => "",
			"dependency" => Array('element' => "onclick", 'value' => "open_link")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Link target", "js_composer"),
			"param_name" => "links_target",
			"description" => __('Select where to open  custom links.', 'js_composer'),
			"dependency" => Array('element' => "onclick", 'value' => array('open_link')),
			'value' => $target_arr
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