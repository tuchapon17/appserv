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
		.fixed-table tr th:first-child, tr td:first-child, th:last-child, tr td:last-child{
		width:auto;
		text-align:left;
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
      		<div class="col-lg-12">
      			<h3>จัดการรูป ห้อง<?php echo $room_data[0]['room_name'];?></h3>
      			<button type="button" class="btn btn-link" onclick="window.location='<?php echo base_url();?>?d=manage&c=room&m=pic'"><i class="fa fa-angle-double-left"></i> เลือกห้อง</button>
	      		<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">เพิ่มรูป</h3>
					</div>
					<div class="panel-body">
						<form class="form-inline" role="form" action="?d=manage&c=room&m=pic&rmid=<?php echo $this->session->userdata("room_has_pic_id");?>" method="post" id="room_pic" enctype="multipart/form-data" autocomplete="off">
						<div id="error-msg">
							
						</div>
						<div class="form-group">
							<label class="sr-only" for="exampleInputEmail2">Email address</label>
							<input type="file" name="pic_file[]" multiple="" id="pic_file">
						</div>
						<div class="form-group">
							<input type="hidden" name="test">
		      		 		<?php echo $eml->btn('upload-submit','id="btn-upload"');?>
		      		 	</div>
	      		 		</form>
					</div>
				</div>
      		</div>
      		<div class="col-lg-12">
      			<form id="form_del_room_pic" action="<?php echo base_url();?>?d=manage&c=room&m=del_room_pic" method="post" autocomplete="off">
	      		 	<table class="table">
	      		 	<tr>
	      		 		<td>รหัส</td>
	      		 		<td>รูป</td>
	      		 		<td>คำบรรยายรูป</td>
	      		 		<td>บันทึก</td>
	      		 		<td>ลบ<br/><input type="checkbox" id="del_all_room_pic"></td>
	      		 	</tr>
	      		 	<?php 
	      		 	foreach($pic_table as $pt)
	      		 	{
	      		 		echo "<tr>";
	      		 		echo "<td>".$pt['room_pic_id']."</td>";
	      		 		echo "<td><img src='".base_url()."upload/pic/".$pt['pic_name']."' width='110' height='110' class='img-rounded'></td>";
	      		 		echo "<td><textarea id='textarea-".$pt['room_pic_id']."' class='form-control'>".$pt['pic_descript']."</textarea></td>";
	      		 		echo "<td>".$eml->btn('save','id="save-'.$pt['room_pic_id'].'" onclick=\'update_pic_descript("'.$pt['room_pic_id'].'")\'')."</td>";
	      		 		echo "<td><input type='checkbox' name='del_room_pic[]' class='del_room_pic' value='".$pt['room_pic_id']."'></td>";
	      		 		echo "</tr>";
	      		 	}
	      		 	?>
	      		 	<tr>
	      		 		<td></td>
	      		 		<td></td>
	      		 		<td></td>
	      		 		<td></td>
	      		 		<td><?php echo $eml->btn('delete','onclick="show_del_list();return false;"');?></td>
	      		 	</tr>
		      		</table>
	      		</form>
	      		<?php echo $pagination_link;?>
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
		/**
		Checked/Unchecked all checkbox
		*/
		$("#del_all_room_pic").click(function(e){
			if(this.checked)
			{
				$(".del_room_pic").prop("checked",true);
			}
			else $(".del_room_pic").prop("checked",false);		
		});

		//ปุ่มอัพโหลดรูป และการตรวจสอบประเภทไฟล์
		$("#btn-upload").addClass("disabled");
		$("#pic_file").change(function(){
			if($(this).get(0).files.length>0)
			{
				$("#btn-upload").removeClass("disabled");
			}
			else $("#btn-upload").addClass("disabled");
		});
		$("#btn-upload").click(function(e){
			var notallow=0;
			for(var i=0;i<=$("#pic_file").get(0).files.length;i++)
			{
				if($("#pic_file").get(0).files[i].type=="image/png"){}
				else if($("#pic_file").get(0).files[i].type=="image/jpeg"){}
				else if($("#pic_file").get(0).files[i].type=="image/jpg"){}
				else
				{
					notallow++;
					e.preventDefault();
				}
				if(notallow!=0)
				{
					 $("#error-msg").text("อัพโหลดได้เฉพาะไฟล์ประเภท PNG, JPG");
					 $("#error-msg").addClass("alert alert-danger");
				}
			}
		});
	});
	function show_del_list()
	{
		//show delete list in bootbox confirm
		var checked_num = $(".del_room_pic:checked").length;
		var text = "ลบทั้งหมด "+checked_num+" รายการ?<br/>";
		text+="<ul>";
		$(".del_room_pic").each(function(){
			if(this.checked)
			text+="<li>รหัส  "+$(this).val()+"</li>";
		});
		text+="</ul>";
		bootbox.confirm(text,function(result){
			if(result==true && checked_num>0)$("#form_del_room_pic").submit();
		});
	}
	function update_pic_descript(room_pic_id)
	{
		$.ajax({
			url:"?d=manage&c=room&m=update_pic_descript",
			data:{pic_descript:$("#textarea-"+room_pic_id).val(),room_pic_id:room_pic_id},
			type:"POST",
			dataType:"json",
			success:function(resp){
				if(resp[0]=="commit") bootbox.alert("บันทึก "+room_pic_id+" สำเร็จ");
			},
			error:function(error){
				bootbox.alert("Error");
			}
		});
	}
	//-->
	
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;