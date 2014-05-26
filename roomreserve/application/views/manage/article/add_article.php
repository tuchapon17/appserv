<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
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
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
	      		 			"in_article"=>$this->lang->line("in_article"),
							"in_fee_unit_hour"=>$this->lang->line("in_fee_unit_hour"),
							"in_fee_unit_lump_sum"=>$this->lang->line("in_fee_unit_lump_sum"),
							"in_fee_over_unit_lump_sum"=>$this->lang->line("in_fee_over_unit_lump_sum"),
							"se_article_type"=>$this->lang->line("se_article_type")
	      		 	);
      		 		/*echo form_error($this->lang->line("in_article"));
      		 		echo form_error($this->lang->line("se_article_type"));
      		 		echo form_error($this->lang->line("in_fee_unit_hour"));
      		 		echo form_error($this->lang->line("in_fee_unit_lump_sum"));
      		 		echo form_error($this->lang->line("in_fee_over_unit_lump_sum"));*/
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่ม<?php echo $this->lang->line("text_article");?></strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=article&m=add" id="add_article" method="post" autocomplete="off">
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
		$("#add_article").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("in_article");?>": {
					required:true,
					maxlength:30,
					remote:{
						// จะ return true / false
						url:b_url+"?d=manage&c=article&m=already_exist_ajax",
						type:"POST"
					}
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
			},
			messages:{
				"<?php echo $this->lang->line("in_article");?>":{
					remote:"<?php echo $this->lang->line("t_in_article");?>นี้ถูกใช้แล้ว"
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
			if($("#<?php echo $em_name[$key];?>_error").text().length>0) {
				$("#<?php echo $em_name[$key];?>").css("border","1px solid #bb0000");
			}
		<?php
		endforeach;
		?>
		
		//Show bootbox alert after 
		<?php 
		if($this->session->flashdata($m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata($m_name."_message");?>"); 
		<?php
		}?>
		active_tab();
		article_tab();
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;