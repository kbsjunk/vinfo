$('[data-addrow]').on('click', function() {
	var addrow = $(this).data('addrow');
	
	var template = $('[data-addrow-template="'+addrow+'"]');
	var newrow = template.clone().attr('data-addrow-template', null);
	newrow.find('select').selectize();
	template.before(newrow.show());
});
$('[data-addrow-table]').on('click', '[data-addrow-delete]', function() {
	console.log($(this));
	$(this).closest('tr').remove();
});