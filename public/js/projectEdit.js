$(function(){
	$('#startdate').datepicker({
			format: 'yyyy/mm/dd'
	});

	$('[data-category]').on('click', editCategoryModal);
	$('[data-level]').on('click', editLevelModal);
});

function editCategoryModal(){
	//id
	var category_id = $(this).data('category');
	$('#category_id').val(category_id);

	//name
	var name = $(this).parent().prev().text();
	$('#category_name').val(name);

	//show
	$('#EditCategoryModal').modal('show');
}

function editLevelModal(){
	//id
	var level_id = $(this).data('level');
	$('#level_id').val(level_id);

	//name
	var name = $(this).parent().prev().text();
	$('#level_name').val(name);

	//show
	$('#editLevelModal').modal('show');
}