<?php

class WPBakeryShortCode_pt_pie_chart extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$title = $el_class = $value = $label_value= $units = '';
		extract(shortcode_atts(array(
			'title' => '',
			'el_class' => '',
			'value' => '50',
			'units' => '',
			'color' => '',
			'label_value' => '',
			'pt_hidden_viewport' => ''
			), $atts));

		wp_enqueue_script('vc_pie');

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_pie_chart wpb_content_element'.$el_class, $this->settings['base']);

		$output = "\n\t".'<div class= "'.$css_class.'" data-pie-value="'.$value.'" data-pie-label-value="'.$label_value.'" data-pie-units="'.$units.'" data-pie-color="rgb('. pt_hex2rgb($color) .')">';
		$output .= "\n\t\t".'<div class="wpb_wrapper">';
		$output .= "\n\t\t\t".'<div class="vc_pie_wrapper">';
		$output .= "\n\t\t\t".'<span class="vc_pie_chart_back" style="border:20px solid '. $color .';"></span>';
		$output .= "\n\t\t\t".'<span class="vc_pie_chart_value" style="color: ' . $color . '"></span>';
		$output .= "\n\t\t\t".'<canvas width="101" height="101"></canvas>';
		$output .= "\n\t\t\t".'</div>';
		if ($title!='') {
			$output .= '<h4 class="wpb_heading wpb_pie_chart_heading" style="color: ' . $color . '">'.$title.'</h4>';
		}
        //wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_pie_chart_heading'));
		$output .= "\n\t\t".'</div>'.$this->endBlockComment('.wpb_wrapper');
		$output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";

		return $output;

	}
}


wpb_map( array(
	"base"      => "pt_pie_chart",
	"name"      => __("Pie Chart", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-pie-chart",
	"category"  => __('Misc', "js_composer"),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __("title", "js_composer"),
			"param_name" => "title",
			"description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer"),
			"admin_label" => true
			),
		array(
			"type" => "textfield",
			"heading" => __("Pie value", "js_composer"),
			"param_name" => "value",
			"description" => __('Input graph value here. Witihn a range 0-100.', 'js_composer'),
			"value" => "50",
			"admin_label" => true
			),
		array(
			"type" => "textfield",
			"heading" => __("Pie label value", "js_composer"),
			"param_name" => "label_value",
			"description" => __('Input integer value for label. If empty "Pie value" will be used.', 'js_composer'),
			"value" => ""
			),
		array(
			"type" => "textfield",
			"heading" => __("Units", "js_composer"),
			"param_name" => "units",
			"description" => __("Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			),
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),
		)
) );