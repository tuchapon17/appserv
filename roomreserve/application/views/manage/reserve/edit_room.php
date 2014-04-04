<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
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
		.my-error-class {
		    color:#BB0000;  /* red */
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
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
      			<form action="" method="post" id="reserve_edit_room" autocomplete="off">
	      			<br>
	      			<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>เปลี่ยนแปลงห้อง</strong></h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
			      				<label>รหัสการจอง&nbsp;&nbsp;<a href="http://localhost/roomreserve/?d=manage&c=reserve&m=view&id=<?php echo $nr[0]["reserve_id"];?>"><?php echo $nr[0]["reserve_id"];?></a></label>
			      			</div>
			      			<div class="form-group">
			      				<label>ชื่อโครงการ&nbsp;&nbsp;<?php echo $nr[0]["project_name"];?></label>
			      			</div>
			      			<div class="form-group">
			      				<label>ห้องเดิม&nbsp;&nbsp;<?php echo $nr[0]["room_name"];?></label>
			      			</div>
			      			<?php 
			      				echo $se_room_type;
			      				echo $se_room;
			      			?>
			      			<div class="text-right"><?php echo $eml->btn('submit','');?></div>
						</div>
					</div>
				</form>
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
	<script type="text/javascript">
	<!--
	$(function(){
		$("#reserve_edit_room").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"select_room_type":{
					required:true
				},
				"select_room":{
					required:true
				}
			},
			messages:{
				"select_person_type": {
					//required:"กรอกๆ"
				}
			}
		});
		/*
		*แสดงข้อมูลห้องใน dropdown (Get room list)
		*/
		$("#select_room_type").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=manage&c=reserve&m=select_room_list",
					data:{room_type_id:$(this).find("option:selected").val()},
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
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;