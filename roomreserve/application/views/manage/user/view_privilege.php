<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_view_privilege=$this->session->userdata("orderby_view_privilege");
$controller="user";
$m_name="view_privilege";
echo $htmlopen;
echo $head;
?>
    <!-- Custom styles -->
    <style type="text/css">
		#login-alert{
			border-radius: 4px 4px 4px 4px;
			margin-bottom: 20px;
    		padding:0px 15px 0px 15px;
		}
		.table th{
			text-align:center;
		}
		.fixed-table tr th:first-child, tr td:first-child, th:last-child, tr td:last-child{
			width:auto;
			text-align:auto;
		}
		.no_privilege,.had_privilege{
			cursor:pointer;
		}
		#search-arrow{
			float:right;
			cursor:pointer;
		}
    </style>
<?php
	echo $bodyopen;
	echo $navbar;
?>
<!-- Custom Content -->
    <div class="container">
      <div class="row">
      	<div class="col-lg-12">
      	<?php echo $user_tab;?>
      		<br>
      		<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search_view_privilege" method="post" autocomplete="off">
      		<?php echo $manage_search_box;?>
      		</form>
      		<div class="panel panel-default">
				<div class="panel-heading" id="search-heading">
					<b>รายการสิทธิ์ตามกลุ่มผู้ใช้งาน</b>
					<div id="search-arrow"><i class="fa fa-caret-square-o-down"></i></div>
				</div>
				<div class="panel-body" id="search-body">
					<?php echo $usergroup_table;?>
				</div>
			</div>
      		
      		<?php echo $user_table;	?>
      		
      		
      		<div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      			<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<br>
						<h3><i class="fa fa-circle-o-notch fa-spin fa-primary"></i> กำลังดำเนินการ กรุณารอสักครู่...</h3>
					</div>
				</div>
			</div>
		    
		    
        </div>
      </div>
      <hr>
      <?php echo $footer; ?>
    </div>
<?php 
echo $js;
?>
<!-- Custom Javascript -->
	<script type="text/javascript" src="<?php echo base_url();?>js/user_profile_script.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/user.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		active_tab();
		user_tab();
		$("#clearSearch").click(function(){
			s_url="?d=manage&c=<?=$controller?>&m=search_view_privilege";
			r_url="?d=manage&c=<?=$controller?>&m=view_privilege";
			clearSearchCenter2(b_url, s_url, r_url);
		});

		$("#search-body").hide();
		$("#search-heading").click(function(){
			if($("#search-body").is(":hidden"))
			{
				$("#search-body").slideDown();
				$("#search-arrow").children().attr("class","fa fa-caret-square-o-up");
			}
			else
			{	
				$("#search-body").slideUp();
				$("#search-arrow").children().attr("class","fa fa-caret-square-o-down");
			}
		});
	});
	function set_per_page(num)
	{
		set_page_num_center(num, b_url, "?d=manage&c=<?=$controller?>&m=view_privilege");
	}
	function select_orderby()
	{
		var select_field='<option value="username">ชื่อผู้ใช้</option>';
		select_field+='<option value="group_name">กลุ่มผู้ใช้</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby_view_privilege";
		var c_main_link="?d=manage&c=<?=$controller?>&m=view_privilege";
		var sess_f="<?php echo $sess_orderby_view_privilege["field"];?>";
		var sess_t="<?php echo $sess_orderby_view_privilege["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function select_searchfield()
	{
		var select_field='<option value="username">ชื่อผู้ใช้</option>';
		select_field+='<option value="firstname">ชื่อ</option>';
		select_field+='<option value="lastname">นามสกุล</option>';
		//var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield_view_privilege";
		var c_main_link="?d=manage&c=<?=$controller?>&m=view_privilege";
		var sess_s="<?php echo $this->session->userdata("searchfield_".$m_name);?>";
		select_search_center(select_field, b_url, s_link, c_main_link, sess_s);
	}
	function add_privilege(p,u)
	{
		myApp.showPleaseWait();
		$.ajax({
			url:"?d=manage&c=user&m=add_privilege2",
			data:{"p":p,"u":u},
			type:"POST",
			dataType:"json",
			success:function(resp){
				if(resp=="1")
				{
					$("#"+u+p).toggleClass("fa-ban fa-check");
					$("#"+u+p).toggleClass("fa-danger fa-success");
					$("#"+u+p).addClass("fa-lg");
					myApp.hidePleaseWait();
				}
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
	}

	function remove_privilege(p,u)
	{
		myApp.showPleaseWait();
		$.ajax({
			url:"?d=manage&c=user&m=remove_privilege2",
			data:{"p":p,"u":u},
			type:"POST",
			dataType:"json",
			success:function(resp){
				if(resp=="1")
				{
					$("#"+u+p).toggleClass("fa-check fa-ban");
					$("#"+u+p).toggleClass("fa-success fa-danger");
					$("#"+u+p).removeClass("fa-lg");
					myApp.hidePleaseWait();
				}
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
	}

	var myApp;
	myApp = myApp || (function () {
	    var pleaseWaitDiv = $("#pleaseWaitDialog");
	    return {
	        showPleaseWait: function() {
	            pleaseWaitDiv.modal();
	        },
	        hidePleaseWait: function () {
	            pleaseWaitDiv.modal('hide');
	        },

	    };
	})();

	function add_privilege_by_usergroup(u)
	{
		$.ajax({
			url:"?d=manage&c=user&m=json_get_usergroup",
			data:"",
			type:"POST",
			dataType:"json",
			success:function(resp){
				var html='';
				html +='<select id="se_usergroup" name="se_usergroup" class="form-control">';
				$.each(resp, function(i, item) {
					html+='<option value="'+resp[i].usergroup_id+'">'+resp[i].group_name+'</option>';
				});
				html += '</select>';
				
				bootbox.dialog({
					message: html,
					title: "กำหนดสิทธิ์ตามกลุ่มผู้ใช้",
					buttons: {
						success: {
							label: "ตกลง",
							className: "btn-success",
							callback: function() {
								$.ajax({
									url:"?d=manage&c=user&m=add_privilege_by_usergroup",
									data:{"u":u,"ug":$("#se_usergroup").val()},
									type:"POST",
									dataType:"text",
									success:function(resp){
										if(resp=="1")
										{
											window.location.reload();
										}
									},
									error:function(error){
										alert("Error add privilege by usergroup: "+error);
									}
								});
							}
						},
						danger: {
							label: "ยกเลิก",
							className: "btn-danger",
							callback: function() {
							
							}
						}
					}
				});//bootbox dialog
			},
			error:function(error){
				alert("Error get_usergroup: "+error);
			}
		});
		
		
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;