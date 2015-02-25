<?php

class WPBakeryShortCode_pt_progress_bar extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$output = $bar_options = $progress_css = $bar_css = $bg = '';
		$css_animation = $animation_attr = '';
		
		extract( shortcode_atts( array(
			'pt_progress_template'  => '',
			'values'    	=> '',
			'color'     	=> '',
			'textcolor' 	=> '',
			'bgcolor'   	=> '',
			'options'   	=> '',
			'el_class'		=> '',
			'css_animation' => '',
			'css_delay' 	=> '',
			'pt_hidden_viewport' => ''
			), $atts ) );

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		$graph_lines = explode(",", $values);

		$options = explode(",", $options);

		if (in_array("progress-striped", $options)) $bar_options .= " progress-striped";
		else $bg = ' bg-img-none';
		if (in_array("active", $options)) $bar_options .= " active";

		if ( $textcolor || $color || $bgcolor ) {
			$progress_css = 'style="background-color: '. $bgcolor .'; color: '. $textcolor .';"';
			$bar_css = 'style="color: '. $textcolor .'; background-color: '. $color .';"';
		}

		foreach ($graph_lines as $line) {
			$single_val = explode("|", $line);

			$output .= '<div class="pt-progress-bar progress template'. (int)$pt_progress_template . $bar_options . $el_class .'" '. $progress_css .' ' . $animation_attr . '>';

			if ( (int)$pt_progress_template === 1 ) {				
				$output .= '<div class="progress-bar'. $bg .'" '. $bar_css .' data-value="'. (int)$single_val[0] .'"></div>';
				$output .= '<div class="legend"><span>'. $single_val[0] .'%</span> <i class="fa fa-long-arrow-right"></i> '. $single_val[1] .'</div>';
			}

			if ( (int)$pt_progress_template === 2 ) {
				$output .= '<div class="progress-bar'. $bg .'" '. $bar_css .' data-value="'. (int)$single_val[0] .'"><i class="'. $single_val[1] .' "></i></div>';
				$output .= '<div class="legend">'. $single_val[0] .'% </div>';
			}

			if ( (int)$pt_progress_template === 3 ) {
				$output .= '<div class="progress-bar'. $bg .'" '. $bar_css .' data-value="'. (int)$single_val[0] .'"></div>';
			}

			$output .= '</div>';
		}

		return $output;
	}
}

wpb_map( array(
	"name" => __("Progress Bar", "js_composer"),
	"base" => "pt_progress_bar",
	"icon" => "fa fa-tasks",
	"category" => __('Misc', 'js_composer'),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __("Select template", "js_composer"),
			"param_name" => "pt_progress_template",
			"value" => array('Template 1'=>'1', 'Template 2'=>'2', 'Template 3'=>'3'),
			"description" => __("", "js_composer")
			),
		array(
			"type" => "exploded_textarea",
			"heading" => __("Graphic values", "js_composer"),
			"holder" => "span",
			"class" => "",
			"param_name" => "values",
			"description" => __('Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', 'js_composer'),
			"value" => "90|Development,80|Design,70|Marketing"
			),
		array(
			"type" => "textfield",
			"heading" => __("Select an icon", "js_composer"),
			"param_name" => "font_icons",
			"value" => "",
			"description" => __("Select an Icon", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Bar Color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text Color", "js_composer"),
			"param_name" => "textcolor",
			"value" => '', //Default color
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Background Color", "js_composer"),
			"param_name" => "bgcolor",
			"value" => '', //Default color
			),
		array(
			"type" => "checkbox",
			"heading" => __("Options", "js_composer"),
			"param_name" => "options",
			"value" => array(__("Add Stripes?", "js_composer") => "progress-striped", __("Add animation? Will be visible with striped bars.", "js_composer") => "active")
			),
		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),
		)
) );