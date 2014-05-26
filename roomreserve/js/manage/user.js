var user_tab = function()
{
	$("#edit").on("click",function(){
		window.location="?d=manage&c=user&m=edit";
	});
	/*
	$("#add_privilege").on("click",function(){
		window.location="?d=manage&c=user&m=add_privilege";
	});
	$("#delete_privilege").on("click",function(){
		window.location="?d=manage&c=user&m=delete_privilege";
	});
	*/
	$("#view_privilege").on("click",function(){
		window.location="?d=manage&c=user&m=view_privilege";
	});
};