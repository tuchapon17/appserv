<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
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
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
	      		 			"in_room_name"=>"input_room_name",
							"se_room_type"=>"select_room_type",
							"te_room_detail"=>"textarea_room_detail",
							"in_discount_percent"=>"input_discount_percent",
							//"in_room_fee"=>"input_room_fee",
							"se_fee_type"=>"select_fee_type",
							"in_room_fee_hour"=>"input_room_fee_hour",
							"in_room_fee_lump_sum"=>"input_room_fee_lump_sum"
	      		 	);
      		 		echo form_error($em_name["in_room_name"]);
      		 		echo form_error($em_name["se_room_type"]);
      		 		echo form_error($em_name["te_room_detail"]);
      		 		echo form_error($em_name["in_discount_percent"]);
      		 		//echo form_error($em_name["in_room_fee"]);
      		 		echo form_error($em_name["se_fee_type"]);
      		 		echo form_error($em_name["in_room_fee_hour"]);
      		 		echo form_error($em_name["in_room_fee_lump_sum"]);
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่มห้อง</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=room&m=add" method="post" autocomplete="off">
								<?php
								echo $in_room_name;
								echo "<span id='".$em_name["in_room_name"]."_error' class='hidden'>".form_error($em_name["in_room_name"])."</span>";
								echo $se_room_type;
								echo "<span id='".$em_name["se_room_type"]."_error' class='hidden'>".form_error($em_name["se_room_type"])."</span>";
								echo $te_room_detail;
								echo $in_discount_percent;
								echo "<span id='".$em_name["in_discount_percent"]."_error' class='hidden'>".form_error($em_name["in_discount_percent"])."</span>";
								//echo $in_room_fee;
								//echo "<span id='".$em_name["in_room_fee"]."_error' class='hidden'>".form_error($em_name["in_room_fee"])."</span>";
								echo $se_fee_type;
								echo "<span id='".$em_name["se_fee_type"]."_error' class='hidden'>".form_error($em_name["se_fee_type"])."</span>";
								echo $in_room_fee_hour;
								echo "<span id='".$em_name["in_room_fee_hour"]."_error' class='hidden'>".form_error($em_name["in_room_fee_hour"])."</span>";
								echo $in_room_fee_lump_sum;
								echo "<span id='".$em_name["in_room_fee_lump_sum"]."_error' class='hidden'>".form_error($em_name["in_room_fee_lump_sum"])."</span>";
								
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
	<script type="text/javascript">
	<!--
	//tinymce initialize 
	tinymce.init({
		selector:'#textarea_room_detail',
		encoding:'xml'
	});
	$(function(){
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
		Show bootbox alert after 
		*/
		<?php 
		if($this->session->flashdata($m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata($m_name."_message");?>"); 
		<?php
		}?>
		active_tab();
		room_tab();
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;