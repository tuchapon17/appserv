<?php 
$sess_orderby_user=$this->session->userdata("orderby_user");
$controller="user";
$m_name="user";
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
		.status0,.status1{
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
      		<div class="col-lg-12" id="loginform">
      		 	<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search" method="post" autocomplete="off">
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<p><a href="<?php echo base_url();?>?c=register&m=step1" target="_blank" class="btn btn-primary btn-xs" role="button"><i class="fa fa-plus fa-white"></i> เพิ่มผู้ใช้งาน</a></p>
      		 	<?php echo $table_edit;?>
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php 
	      		 	/*$em_name=array(
	      		 			"in_username"=>"input_username"
	      		 	);
      		 		echo form_error($em_name["in_username"]);*/
      		 	?>
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
		//allow_red_to_green("<?=$m_name?>");
		//disallow_green_to_red("<?=$m_name?>");
		/**
		Checked/Unchecked all checkbox
		*/
		//del_all_checkbox("<?=$m_name?>");
		
		/**
		add num_rows to pagination 
		*/
		$("#pagination_num_rows").html("<a>ทั้งหมด <?php echo $pagination_num_rows;?> แถว</a>");
		
		/**
		Reset search result
		*/
		$("#clearSearch").click(function(){
			clearSearchCenter("<?=$controller?>", b_url);
		}); 
		/**
		Show bootbox alert after edited profile1
		*/
		<?php 
		if($this->session->flashdata("edit_".$m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("edit_".$m_name."_message");?>"); 
		<?php
		}?>
		active_tab();
		user_tab();
	});

	function show_all_data(username)
	{
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=show_all_data",
			data:"username="+username,
			type:"POST",
			dataType:"json",
			success:function(r){
				var text='<dl class="dl-horizontal">';
				text+='<dt>ชื่อผู้ใช้</dt>';
					text+='<dd>'+r["username"]+'</dd>';
				text+='<dt>อีเมล</dt>';
					text+='<dd>'+r["email"]+'</dd>';
				text+='<dt>วัน/เวลาที่ลงทะเบียน</dt>';
					text+='<dd>'+r["regis_on"]+'</dd>';
				text+='<dt>IP ที่ลงทะเบียน</dt>';
					text+='<dd>'+r["regis_ip"]+'</dd>';
				text+='<dt>กลุ่มผู้ใช้</dt>';
					text+='<dd>'+r["group_name"]+'</dd>';
				text+='<dt>คำนำหน้าชื่อ</dt>';
					text+='<dd>'+r["titlename"]+'</dd>';
				text+='<dt>ชื่อ</dt>';
					text+='<dd>'+r["firstname"]+'</dd>';
				text+='<dt>นามสกุล</dt>';
					text+='<dd>'+r["lastname"]+'</dd>';
				text+='<dt>อาชีพ</dt>';
					text+='<dd>'+r["occupation_name"]+'</dd>';
				text+='<dt>เบอร์โทรศัพท์</dt>';
					text+='<dd>'+r["phone"]+'</dd>';
				text+='<dt>บ้านเลขที่</dt>';
					text+='<dd>'+r["house_no"]+'</dd>';
				text+='<dt>หมู่ที่</dt>';
					text+='<dd>'+r["village_no"]+'</dd>';
				text+='<dt>ตรอก/ซอย</dt>';
					text+='<dd>'+r["alley"]+'</dd>';
				text+='<dt>ถนน</dt>';
					text+='<dd>'+r["road"]+'</dd>';
				text+='<dt>ตำบล</dt>';
					text+='<dd>'+r["subdistrict_name"]+'</dd>';
				text+='<dt>อำเภอ</dt>';
					text+='<dd>'+r["district_name"]+'</dd>';
				text+='<dt>จังหวัด</dt>';
					text+='<dd>'+r["province_name"]+'</dd>';
				text+='</dl>';
				bootbox.alert(text);
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
	}

	function set_per_page(num)
	{
		set_page_num_center(num, b_url, "?d=manage&c=<?=$controller?>&m=edit");
	}
	function show_del_list()
	{
		show_del_list_center("<?=$m_name?>");
	}
	function select_orderby()
	{
		var select_field='<option value="username">ชื่อผู้ใช้</option>';
		select_field+='<option value="group_name">กลุ่มผู้ใช้</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_f="<?php echo $sess_orderby_user["field"];?>";
		var sess_t="<?php echo $sess_orderby_user["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function show_allow_list()
	{
		this.b_url="<?php echo base_url();?>";
		this.p_url="?d=manage&c=<?=$controller?>&m=allow";
		this.m_link="?d=manage&c=<?=$controller?>&m=edit";
		show_allow_list_center("<?=$m_name?>", b_url, p_url, m_link);
	}
	function select_searchfield()
	{
		var select_field='<option value="username">ชื่อผู้ใช้</option>';
		select_field+='<option value="firstname">ชื่อ</option>';
		select_field+='<option value="lastname">นามสกุล</option>';
		//var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_s="<?php echo $this->session->userdata("searchfield_".$m_name);?>";
		select_search_center(select_field, b_url, s_link, c_main_link, sess_s);
	}

	function toggle_user_status(u)
	{
		//enable
		if($("#u_"+u+".status0").length > 0)
		{
			$.ajax({
				url:"?d=manage&c=user&m=toggle_user_status",
				data:{"u":u,"s":"enable"},
				type:"POST",
				dataType:"json",
				success:function(resp){
					if(resp=="1")
					{
						$("#u_"+u).toggleClass("fa-danger fa-success");
						$("#u_"+u).toggleClass("status0 status1");
					}
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
		}
		//disable
		else if($("#u_"+u+".status1").length > 0)
		{
			$.ajax({
				url:"?d=manage&c=user&m=toggle_user_status",
				data:{"u":u,"s":"disable"},
				type:"POST",
				dataType:"json",
				success:function(resp){
					if(resp=="1")
					{
						$("#u_"+u).toggleClass("fa-success fa-danger");
						$("#u_"+u).toggleClass("status1 status0");
					}
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
		}
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;