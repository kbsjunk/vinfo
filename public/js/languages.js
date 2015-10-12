$('#code').change(function() {
	if ($(this).val() && $('#name').val() == '') {
		$.get(base_url('api/language/'+$(this).val()+'/name'), function(data) {
			$('#name').val(data.name);
		});
	}
});