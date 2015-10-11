$('#code').change(function() {
	if ($(this).val() && $('#name').val() == '') {
		$.get('/api/language/'+$(this).val()+'/name', function(data) {
			$('#name').val(data.name);
		});
	}
});