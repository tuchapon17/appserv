var job_position_tab = function()
{
	$("#add").on("click",function(){
		window.location="?d=manage&c=job_position&m=add";
	});
	$("#edit").on("click",function(){
		window.location="?d=manage&c=job_position&m=edit";
	});
};
