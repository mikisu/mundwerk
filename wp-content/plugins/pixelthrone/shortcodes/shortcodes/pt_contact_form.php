<?php

class WPBakeryShortCode_pt_contact_form extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		global $post;

		$page_options = get_fields($post->ID);

		$output = '';
		$css_animation = $animation_attr = '';

		extract( shortcode_atts( array(
			'name_placeholder' => '',
			'required_name' => '',
			'email_placeholder' => '',
			'required_email' => '',
			'subject_placeholder' => '',
			'required_subject' => '',
			'message_placeholder' => '',
			'required_message' => '',
			'required_label' => '',
			'button_text' => '',
			'success_msg' => '',
			'error_msg' => '',
			'mail_to' => '',
			'color' => '',
			'color_active' => '',
			'el_class' => '',
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
		
		$uniq_id = "pt-contact-form-".uniqid();

		if ( $color || $color_active )
		{
			$output .= '<style>';

			if ( $color )
			{
				$output .= '
				#'.$uniq_id.' { color: '. $color .'; }
				#'.$uniq_id.' input, #'.$uniq_id.' textarea, #'.$uniq_id.' button {
					border-color: rgba(' . pt_hex2rgb($color) . ', 0.10);
					color: rgba(' . pt_hex2rgb($color) . ', 0.50);
				}';
			}
			
			if ( $color_active )
			{
				$output .= '
				#'.$uniq_id.' input:hover, #'.$uniq_id.' textarea:hover, #'.$uniq_id.' button:hover {
					border-color: rgba(' . pt_hex2rgb($color_active) . ', 0.20);
					color: rgba(' . pt_hex2rgb($color_active) . ', 0.60);
				}
				#'.$uniq_id.' input:focus, #'.$uniq_id.' textarea:focus, #'.$uniq_id.' button:focus {
					border-color: ' . $color_active . ';
					color: ' . $color_active . ';
				}';
			}

			$output .= '</style>';
		}
		// elseif( $page_options['text_color'] ) {
		// 	$output .= '<style>
		// 	#'.$uniq_id.' input, #'.$uniq_id.' textarea, #'.$uniq_id.' button {
		// 		border-color: rgba(' . pt_hex2rgb($page_options['text_color']) . ',0.10);
		// 		color: rgba(' . pt_hex2rgb($page_options['text_color']) . ',0.50);
		// 	}
		// 	#'.$uniq_id.' input:hover, #'.$uniq_id.' textarea:hover, #'.$uniq_id.' button:hover {
		// 		border-color: rgba(' . pt_hex2rgb($page_options['text_color']) . ',0.20);
		// 		color: rgba(' . pt_hex2rgb($page_options['text_color']) . ',0.60);
		// 	}
		// 	#'.$uniq_id.' input:focus, #'.$uniq_id.' textarea:focus, #'.$uniq_id.' button:focus {
		// 		border-color: ' . $page_options['text_color'] . ';
		// 		color: ' . $page_options['text_color'] . ';
		// 	}
		// 	</style>';
		// }

		$id_name = 'name_'. uniqid();
		$id_email = 'email_'. uniqid();
		$id_subject = 'subject_'. uniqid();
		$id_message = 'message_'. uniqid();

		$output .= '
			<form method="post" action="#" id="'. $uniq_id .'" class="pt-contact-form row'. $el_class .'" role="form" ' . $animation_attr . '>
				<input type="hidden" name="pt_mail_to" value="'. $mail_to .'" readonly>
				
				<div class="col-sm-6">
					<label class="sr-only" for="'. $id_name .'">'. $name_placeholder .'</label>
					<input type="text" id="'. $id_name .'" class="form-control input-lg pt_contact_name" name="pt_contact_name" placeholder="'. $name_placeholder . ($required_name ? ' ('. $required_label .')' : '' ).'" '. ($required_name ? 'required' : '') .'>

					<label class="sr-only" for="'. $id_email .'">'. $email_placeholder .'</label>
					<input type="email" id="'. $id_email .'" class="form-control input-lg pt_contact_email" name="pt_contact_email" placeholder="'. $email_placeholder .'('. $required_label .')" " required >

					<label class="sr-only" for="'. $id_subject .'">'. $subject_placeholder .'</label>
					<input type="text" id="'. $id_subject .'" class="form-control input-lg pt_contact_subject" name="pt_contact_subject" placeholder="'. $subject_placeholder . ($required_subject ? ' ('. $required_label .')' : '' ).'" '. ($required_subject ? 'required' : '' ) .'>
				</div>
				
				<div class="col-sm-6">
					<label class="sr-only" for="'. $id_message .'">'. $message_placeholder .'</label>
					<textarea rows="8" id="'. $id_message .'" class="form-control pt_contact_message" name="pt_contact_message" placeholder="'. $message_placeholder .'('. $required_label .')" " required ></textarea>
				</div>

				<div class="col-sm-12 text-center">
					<div class="hide msg-success msg"><small class="smaller op50"><em>'. $success_msg .'</em></small></div>
					<div class="hide msg-error msg"><small class="smaller op50"><em>'. $error_msg .'</em></small></div>

					<button class="btn btn-lg ">'. $button_text .'</button>
				</div>

			</form>';

		return $output;
	}
}

wpb_map( array(
	"name" => __("Contact Form", "js_composer"),
	"base" => "pt_contact_form",
	"icon" => "fa fa-envelope",
	"category" => __('Forms', 'js_composer'),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __("Send to email", "js_composer"),
			"param_name" => "mail_to",
			"value" => "your@email.com",
			"description" => "Email to receive this form"
			),
		array(
			"type" => "textfield",
			"heading" => __("Name Placeholder", "js_composer"),
			"param_name" => "name_placeholder",
			"value" => __("Your Name", "js_composer"),
			),
		array(
			"type" => "checkbox",
			"heading" => __("Name field is required", "js_composer"),
			"param_name" => "required_name",
			"value" => array ("Yes" => "required")
			),
		array(
			"type" => "textfield",
			"heading" => __("Email Placeholder", "js_composer"),
			"param_name" => "email_placeholder",
			"value" => __("Your Email", "js_composer"),
			),
		// array(
		// 	"type" => "checkbox",
		// 	"heading" => __("Email field is required", "js_composer"),
		// 	"param_name" => "required_email",
		// 	"value" => array ("Yes" => "required")
		// 	),
		array(
			"type" => "textfield",
			"heading" => __("Subject Placeholder", "js_composer"),
			"param_name" => "subject_placeholder",
			"value" => __("Subject", "js_composer"),
			),
		array(
			"type" => "checkbox",
			"heading" => __("Subject field is required", "js_composer"),
			"param_name" => "required_subject",
			"value" => array ("Yes" => "required")
			),
		array(
			"type" => "textfield",
			"heading" => __("Message Placeholder", "js_composer"),
			"param_name" => "message_placeholder",
			"value" => __("Message", "js_composer"),
			),
		// array(
		// 	"type" => "checkbox",
		// 	"heading" => __("Message field is required", "js_composer"),
		// 	"param_name" => "required_message",
		// 	"value" => array ("Yes" => "required")
		// 	),
		array(
			"type" => "textfield",
			"heading" => __("Required label", "js_composer"),
			"param_name" => "required_label",
			"value" => __("Required", "js_composer"),
			),
		array(
			"type" => "textfield",
			"heading" => __("Button text", "js_composer"),
			"param_name" => "button_text",
			"value" => __("Send Message", "js_composer"),
			"description" => ""
			),
		array(
			"type" => "textfield",
			"heading" => __("Contact form success message", "js_composer"),
			"param_name" => "success_msg",
			"value" => __("Thank you for your contact. We'll be in touch soon.", "js_composer"),
			),
		array(
			"type" => "textfield",
			"heading" => __("Contact form error message", "js_composer"),
			"param_name" => "error_msg",
			"value" => __("There was a problem while sending your message. Please try again.", "js_composer"),
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Form Color", "js_composer"),
			"param_name" => "color",
			"value" => '', 
			"description" => __("Pick color", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Form Active Color", "js_composer"),
			"param_name" => "color_active",
			"value" => '', 
			"description" => __("Pick color", "js_composer")
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