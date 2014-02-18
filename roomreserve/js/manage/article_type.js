var article_type_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=article_type&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=article_type&m=edit";
	});
};