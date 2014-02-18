<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="assign";
$m_name="";
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
      		<?php echo $assign_tab;?>
      		<div class="col-lg-8 col-lg-offset-2">
      			<br/>
	      		<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">โอนสิทธิ์</h3>
						</div>
						<div class="panel-body">
							<form class="" action="<?php echo base_url();?>?d=privilege&c=<?=$controller?>&m=add" method="post" autocomplete="off">
			      				<div class="form-group">
			      					<label for="">สิทธิ์</label>
			      					<select class="form-control" name="privilege_list" id="privilege_list">
			      						<option value="">เลือก</option>
			      						<?php 
			      							foreach($privilege_list as $p)
			      							{
			      								echo "<option value='".$p['privilege_id']."'>".$p['privilege_name']."</option>";
			      							}
			      						?>
			      					</select>
			      				</div>
			      				<div class="form-group">
			      					<label for="">ผู้รับสิทธิ์</label>
			      					<select class="form-control" name="user_list" id="user_list">
			      						<option value="">เลือก</option>
			      					</select>
			      				</div>
			      				<br>
			      				<div class="form-group text-right">
			      					<?php echo $eml->btn('submit','');?>
			      				</div>
			      			</form>
						</div>
					</div>
      		</div><!-- col-lg-12 (2) -->
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/assign.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#privilege_list").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=privilege&c=<?=$controller?>&m=get_user_list",
					data:{privilege_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#user_list").find("option:gt(0)").remove();
						if(resp.username!=null)	$("#user_list").append(resp.username);
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#user_list").find("option:gt(0)").remove();
			}
		});
		/**
		Show bootbox alert after added
		*/
		<?php 
		if($this->session->flashdata("add_p_a_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("add_p_a_message");?>"); 
		<?php
		}?>
		active_tab();
		assign_tab();
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;