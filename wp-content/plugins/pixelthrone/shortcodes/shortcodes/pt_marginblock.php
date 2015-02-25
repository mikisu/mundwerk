<?php
class WPBakeryShortCode_pt_marginblock extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		extract(shortcode_atts(array(
			'margin'			=> '',
			'measure'			=> 'px',
			'el_class'			=> '',
			'pt_hidden_viewport' => ''
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		$output  = '<div class="'. $el_class .'" style="margin-top: '. (int)trim($margin) . trim($measure) . '"></div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_marginblock",
	"name"      => __("Margin Blocks", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-text-height",
	"category"  => __('Structure', 'js_composer'),
	"params"    => array(
		array(
			"type" => "textfield",
			"holder" => "span",
			"heading" => __("Spacing (px)", "js_composer"),
			"param_name" => "margin",
			"value" => "50",
			"description" => __("Only numbers", "js_composer")
			),
		array(
			"type" => "dropdown",
			"holder" => "i",
			"heading" => __("Select Measure", "js_composer"),
			"param_name" => "measure",
			"value" => array("px - pixel"=>"px", "% - percentage"=>"%")
			),
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		)
	) );