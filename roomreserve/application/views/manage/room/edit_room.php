<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_room=$this->session->userdata("orderby_room");
$controller="room";
$m_name="room";
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
      	<?php echo $room_tab;?>
      		<div class="col-lg-12" id="loginform">
				<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=room&m=search" method="post" autocomplete="off">
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<?php echo $table_edit;?>
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php 
	      		 	$em_name=array(
	      		 			"in_room_name"=>$this->lang->line("in_room_name"),
							"se_room_type"=>$this->lang->line("se_room_type"),
							"te_room_detail"=>$this->lang->line("te_room_detail"),
							//"in_discount_percent"=>$this->lang->line("in_discount_percent"),
							//"in_room_fee"=>"input_room_fee",
							"se_fee_type"=>$this->lang->line("se_fee_type"),
							"in_room_fee_hour"=>$this->lang->line("in_room_fee_hour"),
							"in_room_fee_lump_sum"=>$this->lang->line("in_room_fee_lump_sum")
	      		 	);
	      		 	/*
      		 		echo form_error($em_name["in_room_name"]);
      		 		echo form_error($em_name["se_room_type"]);
      		 		echo form_error($em_name["te_room_detail"]);
      		 		//echo form_error($em_name["in_discount_percent"]);
      		 		//echo form_error($em_name["in_room_fee"]);
      		 		echo form_error($em_name["se_fee_type"]);
      		 		echo form_error($em_name["in_room_fee_hour"]);
      		 		echo form_error($em_name["in_room_fee_lump_sum"]);
      		 		*/
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>แก้ไขห้อง</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=room&m=edit" method="post" autocomplete="off" id="edit_room">
								<?php
								echo $in_room_name;
								echo "<span id='".$this->lang->line("in_room_name")."_error' class='hidden'>".form_error($this->lang->line("in_room_name"))."</span>";
								echo $se_room_type;
								echo "<span id='".$this->lang->line("se_room_type")."_error' class='hidden'>".form_error($this->lang->line("se_room_type"))."</span>";
								echo $te_room_detail;
								//echo $in_discount_percent;
								//echo "<span id='".$this->lang->line("in_discount_percent")."_error' class='hidden'>".form_error($this->lang->line("in_discount_percent"))."</span>";
								//echo $in_room_fee;
								//echo "<span id='".$em_name["in_room_fee"]."_error' class='hidden'>".form_error($em_name["in_room_fee"])."</span>";
								echo $in_max_people;
								echo "<span id='".$this->lang->line("in_max_people")."_error' class='hidden'>".form_error($this->lang->line("in_max_people"))."</span>";
								echo $se_fee_type;
								echo "<span id='".$this->lang->line("se_fee_type")."_error' class='hidden'>".form_error($this->lang->line("se_fee_type"))."</span>";
								echo $in_room_fee_hour;
								echo "<span id='".$this->lang->line("in_room_fee_hour")."_error' class='hidden'>".form_error($this->lang->line("in_room_fee_hour"))."</span>";
								echo $in_room_fee_lump_sum;
								echo "<span id='".$this->lang->line("in_room_fee_lump_sum")."_error' class='hidden'>".form_error($this->lang->line("in_room_fee_lump_sum"))."</span>";
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
	<script type="text/javascript" src="<?php echo base_url();?>plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/room.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	tinymce.init({
		selector:'#<?php echo $this->lang->line("te_room_detail");?>',
		encoding:'xml',
		entity_encoding: "raw",
		language:'th_TH'
	});
	$(function(){
		$("#edit_room").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("in_room_name");?>": {
					required:true,
					maxlength:50
				},
				"<?php echo $this->lang->line("se_room_type");?>": {
					required:true
				},
				/*
				"<?php echo $this->lang->line("in_discount_percent");?>": {
					required:true,
					maxlength:6,
					percentage:true
				},*/
				"<?php echo $this->lang->line("se_fee_type");?>": {
					required:true
				},
				"<?php echo $this->lang->line("in_room_fee_hour");?>": {
					//required:true,
					maxlength:9,
					decimal62:true
				},
				"<?php echo $this->lang->line("in_room_fee_lump_sum");?>": {
					//required:true,
					maxlength:9,
					decimal62:true
				}
			}
		});
		//allow_red_to_green("<?=$m_name?>");
		//disallow_green_to_red("<?=$m_name?>");
		
		/**
		* Highlight the <input> <select> 
		If span text length > 0 change input border color to red
		*/
		<?php 
		foreach ($em_name AS $key=>$value):
		?>
			if($("#<?php echo $em_name[$key];?>_error").text().length>0){
				$("#<?php echo $em_name[$key];?>").css("border","1px solid #bb0000");
			}
		<?php
		endforeach;
		?>
		/**
		* Checked/Unchecked all checkbox
		*/
		//del_all_checkbox("<?=$m_name?>");
		
		/**
		* add num_rows to pagination 
		*/
		$("#pagination_num_rows").html("<a>ทั้งหมด <?php echo $pagination_num_rows;?> แถว</a>");
		
		/**
		* Reset search result
		*/
		$("#clearSearch").click(function(){
			clearSearchCenter("<?=$controller?>", b_url);
		}); 
		
		/**
		* Show bootbox alert after edited profile1
		*/
		<?php 
		if($this->session->flashdata("edit_".$m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("edit_".$m_name."_message");?>"); 
		<?php
		}?>
		active_tab();
		room_tab();
	});
	/**
	Unescape string
	&lt;p&gt; => <p>
	*/
	function htmlUnescape(value){
	    return String(value)
	        .replace(/&quot;/g, '"')
	        .replace(/&#39;/g, "'")
	        .replace(/&lt;/g, '<')
	        .replace(/&gt;/g, '>')
	        .replace(/&amp;/g, '&');
	}
	/**
	load data from controller
	*/
	function load_room(tid)
	{
		//show data in input
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=load_room",
			data:"tid="+tid,
			type:"POST",
			dataType:"json",
			success:function(resp){
				$("#<?php echo $this->lang->line("in_room_name"); ?>").val(resp.room_name);
				$("#<?php echo $this->lang->line("se_room_type"); ?>").val(resp.tb_room_type_id);
				tinymce.get('<?php echo $this->lang->line("te_room_detail"); ?>').setContent(htmlUnescape(resp.room_detail));
				$("#<?php echo $this->lang->line("in_discount_percent"); ?>").val(resp.discount_percent);
				//$("#input_room_fee").val(resp.room_fee);
				$("#<?php echo $this->lang->line("se_fee_type"); ?>").val(resp.tb_fee_type_id);
				$("#<?php echo $this->lang->line("in_room_fee_hour"); ?>").val(resp.room_fee_hour);
				$("#<?php echo $this->lang->line("in_room_fee_lump_sum"); ?>").val(resp.room_fee_lump_sum);
				$("#<?php echo $this->lang->line("in_max_people");?>").val(resp.max_people);
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
		$("#<?php echo $this->lang->line("in_room_name"); ?>").focus();
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
		var select_field='<option value="room_id">รหัสห้อง</option>';
		select_field+='<option value="room_name">ห้อง</option>';
		select_field+='<option value="room_type_name">ประเภทห้อง</option>';
		select_field+='<option value="fee_type_name">ประเภทค่าบริการ</option>';
		select_field+='<option value="room_fee_hour">ค่าบริการต่อชั่วโมง</option>';
		select_field+='<option value="room_fee_lump_sum">ค่าบริการแบบเหมา</option>';
		select_field+='<option value="discount">ส่วนลด</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_f="<?php echo $sess_orderby_room["field"];?>";
		var sess_t="<?php echo $sess_orderby_room["type"];?>";
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

	function toggle_status(id)
	{
		//เปิดสถานะห้อง (0 > 1)
		if($("#rs"+id+".status0").length >0)
		{
			$.ajax({
				url:"?d=manage&c=room&m=enable_status",
				data:{"rid":id},
				type:"POST",
				dataType:"json",
				success:function(resp){
					if(resp=="1")
					{
						$("#rs"+id).toggleClass("fa-success fa-danger");
						$("#rs"+id).toggleClass("status0 status1");
					}
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
		}
		//ปิดสถานะห้อง (1 > 0)
		else if($("#rs"+id+".status1").length >0)
		{
			bootbox.prompt("โปรดระบุสาเหตุที่ต้องการปิดห้อง", function(msg) {                
				if (msg === null) {    
					//alert("Prompt dismissed");                              
				} else {
					$.ajax({
						url:"?d=manage&c=room&m=disable_status",
						data:{"rid":id,"msg":msg},
						type:"POST",
						dataType:"text",
						success:function(resp){
							if(resp == "1")
							{
								$("#rs"+id).toggleClass("fa-danger fa-success");
								$("#rs"+id).toggleClass("status1 status0");
							}
						},
						error:function(error){
							alert("Error : "+error);
						}
					});                        
				}//else
			});
		}
	}
	//-->
	
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;