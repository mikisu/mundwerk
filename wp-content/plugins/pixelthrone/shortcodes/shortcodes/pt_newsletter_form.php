<?php

class WPBakeryShortCode_pt_newsletter_form extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$css_animation = $animation_attr = '';

		extract( shortcode_atts( array(
			'name_placeholder' => '',
			'email_placeholder' => '',
			'success_msg' => '',
			'error_msg' => '',
			'button_text' => '',
			'el_class'   => '',
			'css_animation' => '',
			'css_delay' => '',
			'pt_hidden_viewport' => ''
		), $atts ) );

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$id_name = 'name_'. uniqid();
		$id_email = 'email_'. uniqid();

		$output = '
			<form method="post" action="#" class="row pt-newsletter-form'. $el_class .'" '. $animation_attr . ' role="form">
				<div class="formWrapper">
					<div class="form-group col-sm-3">
						<label class="sr-only" for="'. $id_name .'">'. $name_placeholder .'</label>
						<span class="input-group-addon"><i class="ion-ios7-person-outline"></i></span>
						<input type="text" id="'. $id_name .'" class="form-control input-lg" name="newsletter_name" placeholder="'. $name_placeholder .'">
					</div>
					<div class="form-group col-sm-6">
						<label class="sr-only" for="'. $id_email .'">'. $email_placeholder .'</label>
						<span class="input-group-addon"><i class="ion-ios7-email-outline"></i></span>
						<input type="email" id="'. $id_email .'" class="form-control input-lg" name="newsletter_email" placeholder="'. $email_placeholder .'" required>
					</div>
					<div class="form-group col-sm-3">
						<button type="submit" class="btn btn-default btn-lg">'. $button_text .'</button>
					</div>
				</div>
				<div class="msgWrapper">
					<small class="smaller success hide">'. $success_msg .'</small>
					<small class="smaller error hide">'. $error_msg .'
						<br>
						<a href="#" class="newsletter_trayAgain">Try Again</a>
					</small>
				</div>
			</form>
		';

		return $output;
	}
}

wpb_map( array(
	"name" => __("Newsletter Form", "js_composer"),
	"base" => "pt_newsletter_form",
	"icon" => "fa fa-envelope-o",
	"category" => __('Forms', 'js_composer'),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __("Name Placeholder", "js_composer"),
			"param_name" => "name_placeholder",
			"value" => __("Your Name", "js_composer"),
			),
		array(
			"type" => "textfield",
			"heading" => __("Email Placeholder", "js_composer"),
			"param_name" => "email_placeholder",
			"value" => __("Email Address", "js_composer"),
			),
		array(
			"type" => "textfield",
			"heading" => __("Button Text", "js_composer"),
			"param_name" => "button_text",
			"value" => __("SUBSCRIBE", "js_composer"),
			),
		array(
			"type" => "textfield",
			"heading" => __("Newsletter form success message", "js_composer"),
			"param_name" => "success_msg",
			"value" => __("— Thank you for subscribing.", "js_composer"),
			),
		array(
			"type" => "textfield",
			"heading" => __("Newsletter form error message", "js_composer"),
			"param_name" => "error_msg",
			"value" => __("— Please enter a valid email", "js_composer"),
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