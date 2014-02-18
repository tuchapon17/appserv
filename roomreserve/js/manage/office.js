var office_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=office&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=office&m=edit";
	});
};