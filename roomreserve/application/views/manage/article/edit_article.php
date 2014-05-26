<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_article=$this->session->userdata("orderby_article");
$controller="article";
$m_name="article";
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
      	<?php echo $article_tab;?>
      		<div class="col-lg-12" id="loginform">
      		 	<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search" method="post" autocomplete="off" >
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<?php echo $table_edit;?>
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php 
	      		 	$em_name=array(
	      		 			"in_article"=>$this->lang->line("in_article"),
	      		 			"in_fee_unit_hour"=>$this->lang->line("in_fee_unit_hour"),
	      		 			"in_fee_unit_lump_sum"=>$this->lang->line("in_fee_unit_lump_sum"),
	      		 			"in_fee_over_unit_lump_sum"=>$this->lang->line("in_fee_over_unit_lump_sum"),
	      		 			"se_article_type"=>$this->lang->line("se_article_type")
	      		 	);
	      		 	/*
	      		 	echo form_error($this->lang->line("in_article"));
	      		 	echo form_error($this->lang->line("se_article_type"));
	      		 	echo form_error($this->lang->line("in_fee_unit_hour"));
	      		 	echo form_error($this->lang->line("in_fee_unit_lump_sum"));
	      		 	echo form_error($this->lang->line("in_fee_over_unit_lump_sum"));
	      		 	*/
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>แก้ไข<?php echo $this->lang->line("text_article");?></strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=edit" method="post" autocomplete="off" id="edit_article">
								<?php
								echo $in_article;
								echo "<span id='".$this->lang->line("in_article")."_error' class='hidden'>".form_error($this->lang->line("in_article"))."</span>";
								echo $se_article_type;
								echo "<span id='".$this->lang->line("se_article_type")."_error' class='hidden'>".form_error($this->lang->line("se_article_type"))."</span>";
								?>
							<div class="chexkbox">
								<label>
									<input type="checkbox" value="is_equipment" name="is_equipment" id="is_equipment">
									เป็นครุภัณฑ์
								</label>
								<span class="help-block"></span>
							</div>								
								<?php 
								echo $in_equipment_number;
								echo $in_fee_unit_hour;
								echo "<span id='".$this->lang->line("in_fee_unit_hour")."_error' class='hidden'>".form_error($this->lang->line("in_fee_unit_hour"))."</span>";
								echo $in_fee_unit_lump_sum;
								echo "<span id='".$this->lang->line("in_fee_unit_lump_sum")."_error' class='hidden'>".form_error($this->lang->line("in_fee_unit_lump_sum"))."</span>";
								echo $in_fee_over_unit_lump_sum;
								echo "<span id='".$this->lang->line("in_fee_over_unit_lump_sum")."_error' class='hidden'>".form_error($this->lang->line("in_fee_over_unit_lump_sum"))."</span>";
								?>	
							<div class="text-right"><?php echo $eml->btn('submit','');?></div>
						</form>
					</div>
				</div>
      		</div><!-- col-lg-12 -->
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/article.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$.validator.addMethod("equipment_number", function(value, element){
			if($("#is_equipment").is(":checked") && value.length < 1) return false;
			else if ($("#is_equipment").is(":checked") && value.length > 0) return true;
		}, "โปรดระบุ");
		$("#edit_article").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("in_article");?>": {
					required:true,
					maxlength:30
				},
				"<?php echo $this->lang->line("in_fee_unit_hour");?>": {
					maxlength:9,
					decimal62:true
				},
				"<?php echo $this->lang->line("in_fee_unit_lump_sum");?>": {
					maxlength:9,
					decimal62:true
				},
				"<?php echo $this->lang->line("in_fee_over_unit_lump_sum");?>": {
					maxlength:9,
					decimal62:true
				},
				"<?php echo $this->lang->line("se_article_type");?>": {
					required:true
				},
				"<?php echo $this->lang->line("in_equipment_number");?>": {
					maxlength:11,
					minlength:11,
					equipment_number:true,
					digits:true
				}
			}
		});
		
		$("#<?php echo $this->lang->line("in_equipment_number");?>").parent().hide();
		$("#is_equipment").change(function(){
			if($(this).is(":checked"))
				$("#<?php echo $this->lang->line("in_equipment_number");?>").parent().show();
			else 
				$("#<?php echo $this->lang->line("in_equipment_number");?>").parent().hide();
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
		article_tab();
	});
	
	function load_article(tid)
	{
		//show data in input
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=load_article",
			data:"tid="+tid,
			type:"POST",
			dataType:"json",
			success:function(resp){
				$("#<?php echo $this->lang->line("in_article");?>").val(resp.article_name);
				$("#<?php echo $this->lang->line("in_fee_unit_hour");?>").val(resp.fee_unit_hour);
				$("#<?php echo $this->lang->line("in_fee_unit_lump_sum");?>").val(resp.fee_unit_lump_sum);
				$("#<?php echo $this->lang->line("in_fee_over_unit_lump_sum");?>").val(resp.fee_over_unit_lump_sum);
				$("#<?php echo $this->lang->line("se_article_type");?>").val(resp.tb_article_type_id);
				if(resp.is_equipment == '1')
				{
					$("#is_equipment").prop("checked",true);
					$("#is_equipment").change();
					$("#<?php echo $this->lang->line("in_equipment_number");?>").val(resp.equipment_number);
				}
				else
				{
					if($("#is_equipment").is(":checked"))
					{
						$("#is_equipment").prop("checked",false);
						$("#is_equipment").change();
						$("#<?php echo $this->lang->line("in_equipment_number");?>").val("");
					}
				}
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
		$("#<?php echo $this->lang->line("in_article");?>").focus();
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
		var select_field='<option value="article_id">รหัส<?php echo $this->lang->line("text_article");?></option>';
		select_field+='<option value="article_name">ชื่อ<?php echo $this->lang->line("text_article");?></option>';
		select_field+='<option value="tb_article_type_id">ประเภท<?php echo $this->lang->line("text_article");?></option>';
		var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_f="<?php echo $sess_orderby_article["field"];?>";
		var sess_t="<?php echo $sess_orderby_article["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function select_searchfield()
	{
		var select_field='<option value="article_id">รหัส<?php echo $this->lang->line("text_article");?></option>';
		select_field+='<option value="article_name">ชื่อ<?php echo $this->lang->line("text_article");?></option>';
		var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_s="<?php echo $this->session->userdata("searchfield_article");?>";
		select_search_center(select_field, b_url, s_link, c_main_link, sess_s);
	}
	//-->
	
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;