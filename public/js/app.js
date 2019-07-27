$(function(){
	$('#list_of_projects').on('change', onNewProjectSelected);
});

function onNewProjectSelected(){
	var project_id = $(this).val();
	location.href = '/select/project/'+project_id;
}