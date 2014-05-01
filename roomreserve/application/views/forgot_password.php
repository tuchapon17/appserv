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
      		<div class="col-lg-6 col-lg-offset-3" id="loginform">
      			<h2>ลืมรหัสผ่าน</h2>
      			<form role="form" id="forgot_password_form" action="?c=login&m=forgot_password" method="post" autocomplete="off">
				<div class="form-group">
				    <label for="input_username">ชื่อผู้เข้าใช้ (Username)<span class="red-text"> *</span></label>
				    <input type="text" class="form-control" name="input_username" id="input_username" placeholder="" value="<?php echo set_value("input_username");?>">
			  	</div>
			  	<div class="form-group">
				    <label for="input_email">อีเมล<span class="red-text"> *</span></label>
				    <input type="text" class="form-control" name="input_email" id="input_email" placeholder="">
				    <span class="help-block">ระบบจะทำการส่งลิงค์สำหรับกำหนดรหัสผ่านใหม่ไปยังอีเมลที่ท่านระบุ</span>
				    
			  	</div>
			  	<div class="text-right"><?php echo $eml->btn('submit','');?></div>
		  	</div>
		  	
		  	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="sendEmailModal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content" >
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="sendEmailModalHeader">รีเซตรหัสผ่าน</h4>
					    </div>
					    <div class="modal-body" id="sendEmailModalBody">
					    	<p>กรุณารอสักครู่...<br>ระบบกำลังดำเนินการรีเซตรหัสผ่าน และส่งอีเมล</p>
					    </div>
						<!-- <div class="modal-footer" id="sendEmailModalFooter">
							
				      	</div> -->
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
	<script type="text/javascript">
	<!--
	$(function(){

		
		$("#forgot_password_form").submit(function(e){
			$("#sendEmailModalBody").html("<p>กรุณารอสักครู่...<br>ระบบกำลังดำเนินการส่งลิงค์สำหรับกำหนดรหัสผ่านใหม่ทางอีเมล...</p>");
			$("#sendEmailModal").modal('show');
			$.ajax({
				url:"?c=login&m=mail_reset_password",
				data:{username:$("#input_username").val(),email:$("#input_email").val()},
				type:"POST",
				dataType:"json",
				success:function(resp){
					if(resp[0]=="error")
					{
						$("#sendEmailModalBody").html(resp[1]);
						$("#sendEmailModal").modal('show');
					}
					else if(resp[0]=="sent")
					{
						$("#sendEmailModalBody").html(resp[1]);
						$("#sendEmailModal").modal('show');
						$("#input_username,#input_email").val("");
					}
				},
				error:function(error){
					//alert("Error : "+error);
					$("#sendEmailModalBody").html("เกิดข้อผิดพลาด");
					$("#sendEmailModal").modal('show');
				}
			});
			
			e.preventDefault();
		});

		
		$("#testmail").click(function(){
			$.ajax({
				url:"?c=test&m=mail",
				data:"",
				type:"POST",
				dataType:"json",
				success:function(resp){
					if(resp[0]=="error") alert(resp[1]);
					else if(resp[0]=="sent") alert(resp[1]);
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
		});
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;