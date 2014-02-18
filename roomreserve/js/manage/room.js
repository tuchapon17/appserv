var room_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=room&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=room&m=edit";
	});
};