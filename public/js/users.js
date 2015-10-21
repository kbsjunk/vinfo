$('[data-selectize="country"]').selectize({
	onChange: function(value) {
		if (value) {
			$.get(base_url('/api/country/'+value+'/settings'), function(data) {
				$('#currency_id').selectize()[0].selectize.setValue(data.currency_id);
				$('#language_id').selectize()[0].selectize.setValue(data.language_id);
			});
		}
	}
});

$('[data-email]').each(function() {
	var btn = $(this);
	var field = $(this).data('email');

	var val = $(field).val();
	btn.toggleClass('disabled', val.length == 0);

	if (val.length == 0) {
		btn.prop('href', '');
	}
	else {		
		btn.prop('href', 'mailto:' + val);
	}

	$(field).on('keyup', function() {
		var val = $(this).val();
		btn.toggleClass('disabled', val.length == 0);
		if (val.length == 0) {
			btn.prop('href', '');
		}
		else {
			btn.prop('href', 'mailto:' + val);
		}
	});
});