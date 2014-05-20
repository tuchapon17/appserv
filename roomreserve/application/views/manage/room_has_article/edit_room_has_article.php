<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_room_has_article=$this->session->userdata("orderby_room_has_article");
$controller="room_has_article";
$m_name="room_has_article";
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
      	<?php echo $room_has_article_tab;?>
      		<div class="col-lg-12" id="loginform">
      		 	<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search" method="post" autocomplete="off">
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<?php echo $table_edit;?>
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php 
	      		 	$em_name=array(
	      		 			"input_article"=>$this->lang->line("in_article"),
							"input_room"=>$this->lang->line("in_room"),
							"select_fee_type"=>$this->lang->line("se_fee_type"),
							"input_article_num"=>$this->lang->line("in_article_num"),
							"input_lump_sum_base_unit"=>$this->lang->line("in_lump_sum_base_unit")
	      		 	);
      		 		/*
					echo form_error($this->lang->line("se_article_type"));
					echo form_error($this->lang->line("se_article"));
					echo form_error($this->lang->line("se_room"));
					echo form_error($this->lang->line("se_fee_type"));
					echo form_error($this->lang->line("in_article_num"));
					echo form_error($this->lang->line("in_lump_sum_base_unit"));
					*/
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>แก้ไขครุภัณฑ์/อุปกรณ์สำหรับห้อง</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=edit" method="post" autocomplete="off" id="edit_room_has_article">
								<?php
								echo $in_article;
								echo "<span id='".$this->lang->line("in_article")."_error' class='hidden'>".form_error($this->lang->line("in_article"))."</span>";
								echo $in_room;
								echo "<span id='".$this->lang->line("in_room")."_error' class='hidden'>".form_error($this->lang->line("in_room"))."</span>";
								echo $in_article_num;
								echo "<span id='".$this->lang->line("in_article_num")."_error' class='hidden'>".form_error($this->lang->line("in_article_num"))."</span>";
								echo $se_fee_type;
								echo "<span id='".$this->lang->line("se_fee_type")."_error' class='hidden'>".form_error($this->lang->line("se_fee_type"))."</span>";
								echo $in_lump_sum_base_unit;
								echo "<span id='".$this->lang->line("in_lump_sum_base_unit")."_error' class='hidden'>".form_error($this->lang->line("in_lump_sum_base_unit"))."</span>";
								?>	
							<div class="text-right"><?php echo $eml->btn('submit','');?></div>
						</form>		
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/room_has_article.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#edit_room_has_article").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("se_fee_type");?>": {
					required:true
				},
				"<?php echo $this->lang->line("in_article_num");?>": {
					required:true,
					digits:true
				},
				"<?php echo $this->lang->line("in_lump_sum_base_unit");?>": {
					digits:true
				}
			}
		});
		
		
		//Highlight the <input> <select> 
		//If span text length > 0 change input border color to red
		<?php 
		foreach ($em_name AS $key=>$value):
		?>
			if($("#<?php echo $em_name[$key];?>_error").text().length>0){
				$("#<?php echo $em_name[$key];?>").css("border","1px solid #bb0000");
			}
		<?php
		endforeach;
		?>
		//Checked/Unchecked all checkbox
		del_all_checkbox("<?=$m_name?>");
		//add num_rows to pagination 
		$("#pagination_num_rows").html("<a>ทั้งหมด <?php echo $pagination_num_rows;?> แถว</a>");
		
		//Reset search result
		$("#clearSearch").click(function(){
			clearSearchCenter("<?=$controller?>", b_url);
		}); 
		//Show bootbox alert after edited profile1
		<?php 
		if($this->session->flashdata("edit_".$m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("edit_".$m_name."_message");?>"); 
		<?php
		}?>
		active_tab();
		room_has_article_tab();
	});
	
	function load_room_has_article(tid)
	{
		//show data
		var ArrayData = tid.split(',').map(String);
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=load_room_has_article",
			data:{room_id:ArrayData[0],article_id:ArrayData[1]},
			type:"POST",
			dataType:"json",
			success:function(resp){
				//$("#select_room").val(resp.tb_room_id);
				//$("#select_article").val(resp.tb_article_id);
				$("#<?php echo $this->lang->line("in_room"); ?>").val($("#room"+resp.tb_room_id).text());
				$("#<?php echo $this->lang->line("in_article"); ?>").val($("#article"+resp.tb_article_id).text());
				$("#<?php echo $this->lang->line("se_fee_type"); ?>").val(resp.tb_fee_type_id);
				$("#<?php echo $this->lang->line("in_article_num"); ?>").val(resp.article_num);
				$("#<?php echo $this->lang->line("in_lump_sum_base_unit"); ?>").val(resp.lump_sum_base_unit);
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
		$("#input_room_has_article").focus();
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
		var select_field='<option value="room_name">ชื่อห้อง</option>';
		select_field+='<option value="article_name">ชื่อครุภัณฑ์/อุปกรณ์</option>';
		select_field+='<option value="fee_type_name">ประเภทค่าบริการ</option>';
		select_field+='<option value="article_num">จำนวนครุภัณฑ์/อุปกรณ์</option>';
		select_field+='<option value="lump_sum_base_unit">ค่าบริการพื้นฐาน(เหมา)</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_f="<?php echo $sess_orderby_room_has_article["field"];?>";
		var sess_t="<?php echo $sess_orderby_room_has_article["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function select_searchfield()
	{
		var select_field='<option value="room_id">รหัสห้อง</option>';
		select_field+='<option value="room_name">ห้อง</option>';
		select_field+='<option value="room_type_name">ประเภทห้อง</option>';
		select_field+='<option value="fee_type_name">ประเภทค่าบริการ</option>';
		select_field+='<option value="room_fee_hour">ค่าบริการต่อชั่วโมง</option>';
		select_field+='<option value="room_fee_lump_sum">ค่าบริการแบบเหมา</option>';
		select_field+='<option value="discount">ส่วนลด</option>';
		//var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_s="<?php echo $this->session->userdata("searchfield_".$m_name);?>";
		select_search_center(select_field, b_url, s_link, c_main_link, sess_s);
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;