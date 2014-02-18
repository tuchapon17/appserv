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
				
      		 	<!-- <h2>เพิ่มครุภัณฑ์/อุปกรณ์</h2> -->
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
	      		 			"in_article"=>"input_article",
							"in_fee_unit_hour"=>"input_fee_unit_hour",
							"in_fee_unit_lump_sum"=>"input_fee_unit_lump_sum",
							"in_fee_over_unit_lump_sum"=>"input_fee_over_unit_lump_sum",
							"se_article_type"=>"select_article_type"
	      		 	);
      		 		echo form_error($em_name["in_article"]);
      		 		echo form_error($em_name["se_article_type"]);
      		 		echo form_error($em_name["in_fee_unit_hour"]);
      		 		echo form_error($em_name["in_fee_unit_lump_sum"]);
      		 		echo form_error($em_name["in_fee_over_unit_lump_sum"]);
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่มครุภัณฑ์/อุปกรณ์</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=article&m=add" method="post" autocomplete="off">
								<?php 
								echo $in_article;
								echo "<span id='".$em_name["in_article"]."_error' class='hidden'>".form_error($em_name["in_article"])."</span>";
								echo $se_article_type;
								echo "<span id='".$em_name["se_article_type"]."_error' class='hidden'>".form_error($em_name["se_article_type"])."</span>";
								echo $in_fee_unit_hour;
								echo "<span id='".$em_name["in_fee_unit_hour"]."_error' class='hidden'>".form_error($em_name["in_fee_unit_hour"])."</span>";
								echo $in_fee_unit_lump_sum;
								echo "<span id='".$em_name["in_fee_unit_lump_sum"]."_error' class='hidden'>".form_error($em_name["in_fee_unit_lump_sum"])."</span>";
								echo $in_fee_over_unit_lump_sum;
								echo "<span id='".$em_name["in_fee_over_unit_lump_sum"]."_error' class='hidden'>".form_error($em_name["in_fee_over_unit_lump_sum"])."</span>";
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