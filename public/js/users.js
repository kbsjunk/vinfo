$('[data-selectize="country"]').selectize({
	onChange: function(value) {
		if (value) {
			$.get('/api/country/'+value+'/settings', function(data) {
				console.log(data);
			});
		}
	}
});