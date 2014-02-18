<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_reserve=$this->session->userdata("orderby_reserve2");
$controller="reserve";
$m_name="reserve";
$m_name2="reserve2";
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
      	<?php echo $reserve_tab;?>
      		<div class="col-lg-12" id="loginform">
      		 	<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search2" method="post" autocomplete="off">
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
		del_all_checkbox("<?=$m_name?>");
		
		/**
		add num_rows to pagination 
		*/
		$("#pagination_num_rows").html("<a>ทั้งหมด <?php echo $pagination_num_rows;?> แถว</a>");
		
		/**
		Reset search result
		*/
		$("#clearSearch").click(function(){
			s_url="?d=manage&c=<?=$controller?>&m=search2";
			r_url="?d=manage&c=<?=$controller?>&m=edit2";
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
		reserve_tab();
	});
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
		var select_field='<option value="reserve_id">รหัสการจอง</option>';
		select_field+='<option value="project_name">ชื่อโครงการ</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby2";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit2";
		var sess_f="<?php echo $sess_orderby_reserve["field"];?>";
		var sess_t="<?php echo $sess_orderby_reserve["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function select_searchfield()
	{
		var select_field='<option value="reserve_id">รหัสการจอง</option>';
		select_field+='<option value="project_name">ชื่อโครงการ</option>';
		//var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield2";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit2";
		var sess_s="<?php echo $this->session->userdata("searchfield_".$m_name2);?>";
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
	function approve_alert(r_id,base_url)
	{
		var html='';
		html +='<form role="form" id="form_approve" action="'+base_url+'?d=manage&c=<?=$controller?>&m=reserve_approve&id='+r_id+'" method="post" autocomplete="off">';
		html +='<select id="select_approve" name="select_approve" class="form-control">';
		html +='<option value="0">รออนุมัติ</option>';
		html +='<option value="3">ไม่อนุมัติ</option>';
		html += '</select>';
		html +='</form>';
		bootbox.dialog({
			message: html,
			title: "อนุมัติการจอง",
			buttons: {
				success: {
					label: "ตกลง",
					className: "btn-success",
					callback: function() {
						$("#form_approve").submit();
					}
				},
				danger: {
					label: "ยกเลิก",
					className: "btn-danger",
					callback: function() {
					
					}
				}
			}
		});
	}
	//-->
	
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;