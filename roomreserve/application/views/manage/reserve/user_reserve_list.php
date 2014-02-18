<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_reserve=$this->session->userdata("orderby_reserve_list");
$controller="reserve";
$m_name="reserve";
$m_name_list="reserve_list";
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
    </style>
<?php
	echo $bodyopen;
	echo $navbar;
?>
<!-- Custom Content -->
    <div class="container">
      <div class="row">
      	<div class="col-lg-12">
      		<div class="col-lg-12" id="loginform">
      		 	<h2>ประวัติการจองห้อง</h2>
      		 	<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search_reserve_list" method="post" autocomplete="off">
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<?php echo $table_edit;?>
      		 	<div class="alert-danger" id="login-alert">
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/reserve.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		/**
		Checked/Unchecked all checkbox
		*/
		$("#cancel_all_reserve").click(function(e){
			if(this.checked)
			{
				$(".cancel_reserve").prop("checked",true);
			}
			else $(".cancel_reserve").prop("checked",false);		
		});
		/**
		add num_rows to pagination 
		*/
		$("#pagination_num_rows").html("<a>ทั้งหมด <?php echo $pagination_num_rows;?> แถว</a>");
		/**
		Reset search result
		*/
		$("#clearSearch").click(function(){
			s_url="?d=manage&c=<?=$controller?>&m=search_reserve_list";
			r_url="?d=manage&c=<?=$controller?>&m=reserve_list";
			clearSearchCenter2(b_url, s_url, r_url);
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
	});
	function set_per_page(num)
	{
		set_page_num_center(num, b_url, "?d=manage&c=<?=$controller?>&m=reserve_list");
	}
	function show_cancel_list()
	{
		//show cancel list in bootbox confirm
		var checked_num = $(".cancel_reserve:checked").length;
		var text = "ยกเลิกทั้งหมด "+checked_num+" รายการ?<br/>";
		text+="<ul>";
		$(".cancel_reserve").each(function(){
			if(this.checked)
			text+="<li>"+$(this).val()+" "+$("#reserve"+$(this).val()).text()+"</li>";
		});
		text+="</ul>";
		bootbox.confirm(text,function(result){
			if(result==true && checked_num>0)$("#form_cancel_reserve").submit();
		});
	}
	
	function select_orderby()
	{
		var select_field='<option value="reserve_id">รหัสการจอง</option>';
		select_field+='<option value="project_name">ชื่อโครงการ</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby_list";
		var c_main_link="?d=manage&c=<?=$controller?>&m=reserve_list";
		var sess_f="<?php echo $sess_orderby_reserve["field"];?>";
		var sess_t="<?php echo $sess_orderby_reserve["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function select_searchfield()
	{
		var select_field='<option value="reserve_id">รหัสการจอง</option>';
		select_field+='<option value="project_name">ชื่อโครงการ</option>';
		//var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield_list";
		var c_main_link="?d=manage&c=<?=$controller?>&m=reserve_list";
		var sess_s="<?php echo $this->session->userdata("searchfield_".$m_name_list);?>";
		select_search_center(select_field, b_url, s_link, c_main_link, sess_s);
	}
	function show_all_data(reserve_id)
	{
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=show_all_data",
			data:{reserve_id:reserve_id,get:"article"},
			type:"POST",
			dataType:"json",
			success:function(r1){
				$.ajax({
					url:"?d=manage&c=<?=$controller?>&m=show_all_data",
					data:{reserve_id:reserve_id,get:"datetime"},
					type:"POST",
					dataType:"json",
					success:function(r2){
						$.ajax({
							url:"?d=manage&c=<?=$controller?>&m=show_all_data",
							data:{reserve_id:reserve_id,get:"file"},
							type:"POST",
							dataType:"json",
							success:function(r3){
								$.ajax({
									url:"?d=manage&c=<?=$controller?>&m=show_all_data",
									data:{reserve_id:reserve_id,get:"reserve"},
									type:"POST",
									dataType:"json",
									success:function(r4){
										var text='\
											<strong>ข้อมูลการจอง</strong>\
											<dl class="dl-horizontal">\
												<dt>รหัสการจอง</dt>\
												<dd>'+r4.reserve_id+'</dd>\
												<dt>ชื่อโครงการ</dt>\
												<dd>'+r4.project_name+'</dd>\
												<dt>ห้องที่จอง</dt>\
												<dd>'+r4.room_name+'</dd>\
												<dt>จำนวนคนเข้าใช้</dt>\
												<dd>'+r4.num_of_people+'</dd>\
												<dt>วันที่จอง</dt>\
												<dd>'+r4.reserve_on+'</dd>\
												<dt>วัตถุประสงค์การใช้งาน</dt>\
												<dd>'+r4.for_use+'</dd>\
												<dt>ผู้จอง</dt>\
												<dd>'+r4.tb_user_username+'</dd>\
												<dt>ส่วนลด</dt>\
												<dd>'+r4.discount+'</dd>\
												<dt>การอนุมัติ</dt>\
												<dd>'+r4.approve+'</dd>\
												<dt>อนุมัติเมื่อ</dt>\
												<dd>'+r4.approve_on+'</dd>\
												<dt>อนุมัติโดย</dt>\
												<dd>'+r4.approve_by+'</dd>\
											</dl>\
											';
										bootbox.alert(text);
										
									},
									error:function(error){
										alert("Error : "+error);
									}
								});//ajax4
							},
							error:function(error){
								alert("Error : "+error);
							}
						});//ajax3
					},
					error:function(error){
						alert("Error : "+error);
					}
				});//ajax2
			},
			error:function(error){
				alert("Error : "+error);
			}
		});//ajax1
	}
	
	//-->
	
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;