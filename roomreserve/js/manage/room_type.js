var room_type_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=room_type&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=room_type&m=edit";
	});
};