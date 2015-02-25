var _body = jQuery('body');

jQuery(document).ready(function() {


	/* Import Button  */
	jQuery(document).on('click', '#pt_theme_options-import_template li', function() {

		var r=confirm("Will import the dummy data! Proceed?")
	
		if (r==true)
		{
			var _this = jQuery(this);
			var _loader = jQuery('.loading_block');
			var _container = jQuery('.container_data');
			var _dummy = jQuery(this).find('input').val();

			form_data = '&action=pt-ajax-import&dummy='+_dummy;

			_this.addClass('button-disabled');

			_loader.show();

			jQuery.post(AjaxHelperAdmin.ajaxurl, form_data, function(data) {
				_loader.hide();
				//_this.parents('.option').find('.clear').html(data)
				_container.html(data)
			});
		}

		return false;
	});

	/* Download Rev Slider Button  */
	jQuery(document).on('click', '#pt_theme_options-import_revslider li', function() {

		var r=confirm("Will Download Revolution slider! Proceed?")
	
		if (r==true)
		{
			var _dummy = jQuery(this).find('input').val();

			//window.location = _dummy;
			window.open(_dummy);
		}

		return false;
	});



	/* Add Custom Class to js composer modal */
	jQuery(document).ajaxComplete(function(event, xhr, settings) {

		ele_input = jQuery('.modal input.wpb-textinput.pt_vc_dummy_textfield');
		ele_class = ele_input.attr('value');

		ele_wrapper = ele_input.parents('.vc_row-fluid.wpb_el_type_textfield');

		ele_wrapper.parents('.modal').addClass(ele_class);

		ele_wrapper.hide();
	});

	
	jQuery('[data-toggle="tooltip"]').tooltip();


	/* Iconpicker for Bootstrap - Para Menu */
	if (jQuery('body').hasClass('nav-menus-php')) {
	
		gen_icon_picker();

		var actualIcon = "";
		// icons shortcodes - disable other icons list
		jQuery('a.iconpicker').live('click', function(event) {
			
			actualIcon = jQuery(this).attr('data-pai');

			jQuery('a[data-pai="'+actualIcon+'"]').removeClass('btn-primary');
			jQuery(this).addClass('btn-primary');
		});

		jQuery('.popover-content tbody button').live('click', function(event) {
			var font_icons = jQuery(this).children('i').attr('class');
			jQuery('#'+actualIcon).val( font_icons );
			//console.log('#'+actualIcon);
		});

		jQuery('.btn-nav-icon-remove').on('click', function(event) {
			actualIcon = jQuery(this).attr('data-pai');
			jQuery('a[data-pai="'+actualIcon+'"]').removeClass('btn-primary');
			jQuery('#'+actualIcon).val('');
		});
	}

	
	/*
	Live Modal
	*/
	jQuery(document).ajaxComplete(function(event, xhr, settings) {
		
		/* Shortcode Team // Show/Hide item_id input */
		(jQuery('.wpb-select.number_items').val() == "1") ? jQuery('.wpb-textinput.item_id').parents('.wpb_el_type_textfield').show() : jQuery('.wpb-textinput.item_id').val('').parents('.wpb_el_type_textfield').hide();

		/* show/hide next element */
		jQuery('.checkbox.toggle_next').parents('.wpb_el_type_checkbox').next().hide();
		jQuery('.checkbox.toggle_next:checked').parents('.wpb_el_type_checkbox').next().show();

		/* Iconpicker for Bootstrap Para shortcodes	*/
		if (jQuery('body').hasClass('nav-menus-php')) {
			gen_icon_picker();
		}

		if (jQuery('body').hasClass('post-new-php') || jQuery('body').hasClass('post-php') || jQuery('body').hasClass('vc-editor'))
		{

			if ( !jQuery('.iconpicker').length) {
				jQuery('.wpb-textinput.font_icons').attr('readonly', 'readonly');
				var font_icons = jQuery('.wpb-textinput.font_icons').val();

				if (typeof font_icons !== "undefined") {
					var split_icon = font_icons.split(" ");

					font_family = split_icon[0];
					font_default = split_icon[1];

					jQuery('.wpb-textinput.font_icons').after(' <button class="btn btn-default iconpicker icons-mfglabs" data-iconset="mfglabs" data-icon="'+ font_default +'" role="iconpicker" data-toggle="tooltip" title="MFG Labs"></button>');
					jQuery('.wpb-textinput.font_icons').after(' <button class="btn btn-default iconpicker icons-el" data-iconset="elusive" data-icon="'+ font_default +'" role="iconpicker" data-toggle="tooltip" title="Elusive"></button>');
					jQuery('.wpb-textinput.font_icons').after(' <button class="btn btn-default iconpicker icons-ion" data-iconset="ionicon" data-icon="'+ font_default +'" role="iconpicker" data-toggle="tooltip" title="Ionicon"></button>');
					jQuery('.wpb-textinput.font_icons').after(' <button class="btn btn-default iconpicker icons-fa" data-iconset="fontawesome" data-icon="'+ font_default +'" role="iconpicker" data-toggle="tooltip" title="Font Awesome"></button>');
					jQuery('.wpb-textinput.font_icons').after(' <button class="btn btn-default iconpicker icons-glyphicon" data-iconset="glyphicon" data-icon="'+ font_default +'" role="iconpicker" data-toggle="tooltip" title="Glyphicon"></button>');

					jQuery('.iconpicker.icons-' + font_family).addClass('btn-primary');

					jQuery('.iconpicker').iconpicker({ rows: 8, cols: 12, placement: 'bottom' });
					jQuery('button[data-toggle="tooltip"]').tooltip();
				}
			}

			/* icons shortcodes */
			jQuery('.popover-content tbody button').live('click', function(event) {
				var font_icons = jQuery(this).children('i').attr('class');
				jQuery('.wpb-textinput.font_icons').val( font_icons );
			});

			/* icons shortcodes - disable other icons list */
			jQuery('button.iconpicker').live('click', function(event) {
				jQuery('button.iconpicker').removeClass('btn-primary');
				jQuery(this).addClass('btn-primary');
			});

			/* icons shortcodes - Destroy popover on modal close */
			jQuery('.wpb_bootstrap_modals').live('hidden', function () {
				//jQuery('.popover').popover('destroy');
				jQuery('.popover').remove();
			});
		}

		/* Progress Bar */
		if ( jQuery('.wpb-select.pt_progress_template').val()== 1 || jQuery('.wpb-select.pt_progress_template').val()== 3 ) {
			jQuery('.font_icons').parents('.wpb_el_type_textfield').hide();
		}

		/* pt_thumbs_gallery_dummy */
		if ( !jQuery('.alert').length ) {
			jQuery('.pt_thumbs_gallery_dummy .wpb_el_type_textfield:first').after('<div class="wpb_vc_message"><div class="alert" style="padding: 1px 10px; margin: 0 0 10px 0;"><p class="messagebox_text">You can only have one Thumbnails Gallery per page!</p></div></div>');
		}
	});


	/*
	JS Composer
	*/

	/* toggle */
	jQuery('.checkbox.toggle_next').live('click',function(){
		/* if checked show/hide next element */
		jQuery('.checkbox.toggle_next').parents('.wpb_el_type_checkbox').next().toggle();
	});


	/* Progress Bar */
	jQuery('.wpb-select.pt_progress_template').live('change', function(event) {
		if (jQuery(this).val() == "1") {
			jQuery('textarea.exploded_textarea.values').html("90|Development\n80|Design\n70|Marketing").next('span.description').html("Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development");
			jQuery('.font_icons').parents('.wpb_el_type_textfield').hide();
		}
		if (jQuery(this).val() == "2") {
			jQuery('textarea.exploded_textarea.values').html("90|fa fa-edit\n80|fa fa-thumbs-o-up\n70|fa fa-comment").next('span.description').html("Input graph values here. Divide values with linebreaks (Enter). Example: 90|fa-code");
			jQuery('.font_icons').show().parents('.wpb_el_type_textfield').show();
		}
		if (jQuery(this).val() == "3") {
			jQuery('textarea.exploded_textarea.values').html("90\n80\n70").next('span.description').html("Input graph values here. Divide values with linebreaks (Enter). Example: 90");
			jQuery('.font_icons').parents('.wpb_el_type_textfield').hide();
		}

	});

	/* Progress Bar */
	jQuery('.wpb-select.number_items').live('change', function(event) {
		(jQuery(this).val() == "1") ? jQuery('.wpb-textinput.item_id').parents('.wpb_el_type_textfield').show() : jQuery('.wpb-textinput.item_id').val('').parents('.wpb_el_type_textfield').hide();
	});

	/*
	Documentation/Support Menu
	*/
	if ( jQuery('body').hasClass('toplevel_page_pixelthrone_documentation') ) {
		
		get_content_height();
		
		jQuery( window ).resize(function() {
			get_content_height();
		});
	}

});


function get_content_height() {
	var wrap = jQuery( "#wpwrap").height();
	var footer = jQuery( "#wpfooter").outerHeight(true);
	jQuery('.documentation_iframe').height(wrap - footer);
	jQuery('.documentation_iframe').width(jQuery( ".wrap").width() + 40);
}

function gen_icon_picker() {

	// Menu Picker Call
	jQuery('.item-controls').on('click', function(event) {
		id = jQuery(this).attr('data-id');
		console.log("ola");
		jQuery('.iconpicker_'+id).iconpicker({ rows: 8, cols: 12, placement: 'right' });

	});

	jQuery('[data-toggle="tooltip"]').tooltip();

	jQuery('.menu-item-divider, .menu-item-dropdown_header').on('change', function(event) {
			
			var _this = jQuery(this);
			var checkbox_id = _this.attr('data-id');
			var ele;
			
			if (_this.hasClass('menu-item-divider'))
				ele = 'menu-item-dropdown_header';

			if (_this.hasClass('menu-item-dropdown_header'))
				ele = 'menu-item-divider';

			jQuery('#edit-menu-item-dropdown_header-' + checkbox_id + ', #edit-menu-item-divider-' + checkbox_id).parents('p').css({'opacity' : 1});

			if (_this.is(':checked')){
			
				jQuery('#edit-' + ele + '-' + checkbox_id).attr('checked', false).parents('p').css({'opacity' : 0.25});
			
			} else {

				jQuery('#edit-' + ele + '-' + checkbox_id).parents('p').css({'opacity' : 1});
			}

			if (jQuery('#edit-menu-item-dropdown_header-' + checkbox_id).is(':checked') || jQuery('#edit-menu-item-divider-' + checkbox_id).is(':checked'))
			{
				jQuery('#menu-nav-extra-options-' + checkbox_id).slideUp('fast');
			
			} else {

				jQuery('#menu-nav-extra-options-' + checkbox_id).slideDown('fast');
			}
		
	});
}
