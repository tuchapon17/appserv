var article_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=article&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=article&m=edit";
	});
};