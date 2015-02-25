jQuery(document).ready(function() {
	
	// jQuery(".redux-dimensions-longitude, .redux-dimensions-latitude").numeric();

	jQuery(".redux-dimensions-units").select2({
		width: 'resolve',
		triggerChange: true,
		allowClear: true
	});

	jQuery('.redux-dimensions-input').on('change', function() {
		var units = jQuery(this).parents('.redux-field:first').find('.redux-dimensions-units option:selected').val();
		var id = jQuery(this).attr('rel');
		jQuery('#'+id).val(jQuery(this).val());
	});

});