<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="user";
$m_name="privilege";
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
      	<?php echo $user_tab;?>
      		<div class="col-lg-8 col-lg-offset-2">
      		 	<!-- <h2>เพิ่มครุภัณฑ์/อุปกรณ์</h2> -->
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
	      		 			"se_privilege"=>$this->lang->line("se_privilege"),
							"se_user"=>$this->lang->line("se_user")
	      		 	);
      		 		/*
      		 		echo form_error($this->lang->line("se_privilege"));
      		 		echo form_error($this->lang->line("se_user"));
      		 		*/
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่มสิทธิ์</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=add_privilege" method="post" autocomplete="off" id="add_privilege">
								<?php 
								echo $se_privilege;
								echo "<span id='".$this->lang->line("se_privilege")."_error' class='hidden'>".form_error($this->lang->line("se_privilege"))."</span>";
								echo $se_user;
								echo "<span id='".$this->lang->line("se_user")."_error' class='hidden'>".form_error($this->lang->line("se_user"))."</span>";
								
								?>	
							<div class="text-right"><?php echo $eml->btn('submit','id="btn-add_privilege"');?></div>
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/user.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#add_privilege").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("se_privilege");?>": {
					required:true
				},
				"<?php echo $this->lang->line("se_user");?>": {
					required:true
				}
			}
		});
		//Show bootbox alert after 
		<?php 
		if($this->session->flashdata($m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata($m_name."_message");?>"); 
		<?php
		}?>
		$(".cd").on("change",function(){
			if($("#select_privilege").find("option:selected").val()!='' && $("#select_user").find("option:selected").val()!='')
			{
				$("#btn-add_privilege").removeClass("disabled");
			}
			else $("#btn-add_privilege").addClass("disabled");
		});
		$(".cd").change();
		
		$("#<?php echo $this->lang->line("se_privilege"); ?>").on("change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=manage&c=<?=$controller?>&m=add_privilege_get_user",
					data:{pid:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#<?php echo $this->lang->line("se_user"); ?>").find("option:gt(0)").remove();
						if(resp.user_list!=null)$("#<?php echo $this->lang->line("se_user"); ?>").append(resp.user_list);
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#<?php echo $this->lang->line("se_user"); ?>").find("option:gt(0)").remove();
			}
		});
		active_tab();
		user_tab();
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;