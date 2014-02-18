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
      		<h3>จัดการรูป</h3>
      		<div class="panel panel-default">
				<div class="panel-heading" id="room-list-heading">
					<h3 class="panel-title">เลือกห้อง</h3>
				</div>
				<div class="panel-body" id="room-list-body">
					<?php 
						echo $se_room_type;
						echo $se_room;
					?>
					<div class="text-right"><?php echo $eml->btn('submit','');?></div>
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
	<script type="text/javascript">
	<!--

	$(function(){
		/*
		*แสดงข้อมูลห้องใน dropdown (Get room list)
		*/
		$("#select_room_type").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=manage&c=room&m=select_room_list",
					data:{room_type_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#select_room").find("option:gt(0)").remove();
						if(resp.room_list!=null)$("#select_room").append(resp.room_list);
						//ถ้ามี option ให้เลือก 1 ตัว
						if($("#select_room").children().size()==1 && $("#select_room option:eq(0)").val()=='')
							$("button").addClass('disabled');
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("button").addClass('disabled');
				$("#select_room").find("option:gt(0)").remove();
			}
		});
		
		$("button").addClass('disabled');
		$("#select_room").change(function(){
			if($(this).find("option:selected").val()!='')
				$("button").removeClass('disabled');
			else
				$("button").addClass('disabled');
		});
		$("button").click(function(){
			window.location="<?php echo base_url();?>?d=manage&c=<?=$controller?>&m=pic&rmid="+$("#select_room").find("option:selected").val();
		});
	});
	//-->
	
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;