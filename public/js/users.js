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