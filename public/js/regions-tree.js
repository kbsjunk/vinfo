$(function () {

	var tooltipOptions = {
		container: 'body',
		placement: 'left',
		title: function() {
			return $(this).hasClass('collapsed') ? $(this).data('data-expand') : $(this).data('collapse');
		}
	};

	$('[data-toggle="tree-collapse"]')
		.tooltip(tooltipOptions)
		.on('click', function() {
		var btn = $(this);
		btn.toggleClass('collapsed').tooltip(tooltipOptions);

		var tr = $(this).closest('tr');
		var children = $(this).closest('table').find('tr');

		tr.toggleClass('folded', btn.hasClass('collapsed'));

		children.each(function(i, e) {
			e = $(e);
			if (e.data('root') == tr.data('root') && e.data('lft') > tr.data('lft') && e.data('rgt') < tr.data('rgt')) {
				e.toggleClass('in', !btn.hasClass('collapsed'));
			}
		});

	});
});