<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="room_has_article";
$m_name="room_has_article";
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
      	<?php echo $room_has_article_tab;?>
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
							"select_article_type"=>$this->lang->line("se_article_type"),
	      		 			"select_article"=>$this->lang->line("se_article"),
							"select_room"=>$this->lang->line("se_room"),
							"select_fee_type"=>$this->lang->line("se_fee_type"),
							"input_article_num"=>$this->lang->line("in_article_num"),
							"input_lump_sum_base_unit"=>$this->lang->line("in_lump_sum_base_unit")
	      		 	);
	      		 	/*
					echo form_error($this->lang->line("se_article_type"));
      		 		echo form_error($this->lang->line("se_article"));
      		 		echo form_error($this->lang->line("se_room"));
      		 		echo form_error($this->lang->line("se_fee_type"));
      		 		echo form_error($this->lang->line("in_article_num"));
      		 		echo form_error($this->lang->line("in_lump_sum_base_unit"));
      		 		*/
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>เพิ่มครุภัณฑ์/อุปกรณ์สำหรับห้อง</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=add" method="post" autocomplete="off" id="add_room_has_article">
								<?php 
								echo $se_article_type;
								echo "<span id='".$this->lang->line("se_article_type")."_error' class='hidden'>".form_error($this->lang->line("se_article_type"))."</span>";
								echo $se_article;
								echo "<span id='".$this->lang->line("se_article")."_error' class='hidden'>".form_error($this->lang->line("se_article"))."</span>";
								echo $se_room;
								echo "<span id='".$this->lang->line("se_room")."_error' class='hidden'>".form_error($this->lang->line("se_room"))."</span>";
								echo $in_article_num;
								echo "<span id='".$this->lang->line("in_article_num")."_error' class='hidden'>".form_error($this->lang->line("in_article_num"))."</span>";
								echo $se_fee_type;
								echo "<span id='".$this->lang->line("se_fee_type")."_error' class='hidden'>".form_error($this->lang->line("se_fee_type"))."</span>";
								echo $in_lump_sum_base_unit;
								echo "<span id='".$this->lang->line("in_lump_sum_base_unit")."_error' class='hidden'>".form_error($this->lang->line("in_lump_sum_base_unit"))."</span>";
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/room_has_article.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#add_room_has_article").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("se_article");?>": {
					required:true
				},
				"<?php echo $this->lang->line("se_room");?>": {
					required:true
				},
				"<?php echo $this->lang->line("se_fee_type");?>": {
					required:true
				},
				"<?php echo $this->lang->line("in_article_num");?>": {
					required:true,
					digits:true
				},
				"<?php echo $this->lang->line("in_lump_sum_base_unit");?>": {
					digits:true
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
		Show bootbox alert after 
		*/
		<?php 
		if($this->session->flashdata($m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata($m_name."_message");?>"); 
		<?php
		}?>
		
		active_tab();
		room_has_article_tab();

		$("#select_article").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=manage&c=<?=$controller?>&m=select_room_list",
					data:{article_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#select_room").find("option:gt(0)").remove();
						if(resp.room_list!=null)$("#select_room").append(resp.room_list);
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#select_room").find("option:gt(0)").remove();
			}
		});

		$("#select_article_type").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=manage&c=<?=$controller?>&m=select_article_list",
					data:{article_type_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#select_article").find("option:gt(0)").remove();
						if(resp.article_list!=null)$("#select_article").append(resp.article_list);
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#select_room").find("option:gt(0)").remove();
			}
		});
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;