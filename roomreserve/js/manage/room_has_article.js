var room_has_article_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=room_has_article&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=room_has_article&m=edit";
	});
};