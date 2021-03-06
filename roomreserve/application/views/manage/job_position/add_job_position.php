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
	      		 			"in_job_position_name"=>"input_job_position_name"
	      		 	);
      		 		echo form_error($em_name["in_job_position_name"]);
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่มตำแหน่งงาน</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=add" method="post" autocomplete="off">
								<?php
								echo $in_job_position_name;
								echo "<span id='".$em_name["in_job_position_name"]."_error' class='hidden'>".form_error($em_name["in_job_position_name"])."</span>";
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/job_position.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
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