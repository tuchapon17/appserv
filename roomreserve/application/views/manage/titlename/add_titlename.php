<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="titlename";
$m_name="titlename";
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
      	<?php echo $titlename_tab;?>
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
	      		 			"in_titlename"=>$this->lang->line("in_titlename")
	      		 	);
      		 		//echo form_error($this->lang->line("in_titlename"));
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่ม<?php echo $this->lang->line("text_titlename");?></strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=add" method="post" autocomplete="off" id="add_titlename">
								<?php 
								echo $in_titlename;
								echo "<span id='".$this->lang->line("in_titlename")."_error' class='hidden'>".form_error($this->lang->line("in_titlename"))."</span>";
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/titlename.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#add_titlename").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("in_titlename");?>": {
					required:true,
					maxlength:30,
					THEN:true
				}
			}
		});
		/**
		Highlight the <input> <select> 
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
		Show bootbox alert
		*/
		<?php 
		if($this->session->flashdata($m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata($m_name."_message");?>");
		<?php
		}?>
		active_tab();
		titlename_tab();
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;