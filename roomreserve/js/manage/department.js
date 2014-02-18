var department_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=department&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=department&m=edit";
	});
};