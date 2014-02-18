var occupation_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=occupation&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=occupation&m=edit";
	});
};