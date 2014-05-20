<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$m_name="article_type";
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
      	<?php echo $article_type_tab;?>
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
	      		 			"in_article_type"=>$this->lang->line("in_article_type")
	      		 	);
      		 		//echo form_error($this->lang->line("in_article_type"));
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่มประเภทครุภัณฑ์/อุปกรณ์</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=article_type&m=add" method="post" autocomplete="off" id="add_article_type">
							<?php
							echo $in_article_type;
							echo "<span id='".$this->lang->line("in_article_type")."_error' class='hidden'>".form_error($this->lang->line("in_article_type"))."</span>";
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/article_type.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#add_article_type").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("in_article_type");?>": {
					required:true,
					maxlength:30,
					THEN:true
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
		
		//Show bootbox alert after 
		<?php 
		if($this->session->flashdata($m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata($m_name."_message");?>"); 
		<?php
		}?>
		
		active_tab();
		article_type_tab();
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;