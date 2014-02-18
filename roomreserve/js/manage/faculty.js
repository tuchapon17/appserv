var faculty_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=faculty&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=faculty&m=edit";
	});
};