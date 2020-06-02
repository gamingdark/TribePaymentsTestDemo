$(function () {
	$('body').on('click', 'form button', function() {
		let form = $(this).closest('form');
		let formId = form.attr('id');

		let values = getFormData(form);
		values.form = formId;

		$.ajax('index.php', {
			method: 'post',
			data: values,
			success: function(data) {
				$('body').html(data);
			},
			error: function(data) {
				alert(data.responseText);
			}
		});

		return false;
	});
})

function getFormData(form) {
    let unindexed_array = form.serializeArray();
    let indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}