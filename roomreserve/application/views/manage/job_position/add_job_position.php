<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="job_position";
$m_name="job_position";
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
      	<?php echo $job_position_tab;?>
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
	      		 			"in_job_position"=>$this->lang->line("in_job_position")
	      		 	);
      		 		//echo form_error($this->lang->line("in_job_position"));
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่ม<?php echo $this->lang->line("text_job_position");?></strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=add" method="post" autocomplete="off" id="add_job_position">
								<?php
								echo $in_job_position;
								echo "<span id='".$this->lang->line("in_job_position")."_error' class='hidden'>".form_error($this->lang->line("in_job_position"))."</span>";
								?>
							<div class="text-right"><?php echo $eml->btn('submit','');?></div>
						</form>		
					</div>
				</div>
      			
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong><?php echo $this->lang->line("text_job_position");?>ที่มี</strong></h3>
					</div>
					<div class="panel-body">
						<?php echo $current_job_position;?>
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/job_position.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#add_job_position").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("in_job_position");?>": {
					required:true,
					maxlength:30,
					THEN:true,
					remote:{
						// จะ return true / false
						url:b_url+"?d=manage&c=job_position&m=already_exist_ajax",
						type:"POST"
					}
				}
			},
			messages:{
				"<?php echo $this->lang->line("in_job_position");?>":{
					remote:"<?php echo $this->lang->line("t_in_job_position");?>นี้ถูกใช้แล้ว"
				}
			}
		});
		
		/*#################################################
		Highlight the <input> <select> 
		If span text length > 0 change input border color to red
		###################################################*/
		<?php 
		foreach ($em_name AS $key=>$value):
		?>
			if($("#<?php echo $em_name[$key];?>_error").text().length>0){
				$("#<?php echo $em_name[$key];?>").css("border","1px solid #bb0000");
			}
		<?php
		endforeach;
		?>
		/*#################################################
		Show bootbox alert after 
		###################################################*/
		<?php 
		if($this->session->flashdata("job_".$m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("job_".$m_name."_message");?>"); 
		<?php
		}?>
		
		active_tab();
		job_position_tab();
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;