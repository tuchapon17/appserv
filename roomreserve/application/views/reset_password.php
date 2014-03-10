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
      		<div class="col-lg-6 col-lg-offset-3" id="loginform">
      			<h2>ลืมรหัสผ่าน</h2>
      			<div class="alert-danger" id="login-alert">
	      			<?php 
		      			echo form_error("input_password");
		      			echo form_error("input_password2");
	      			?>
      			</div>
      			<form role="form" id="reset_password_form" action="" method="post" autocomplete="off">
	      			<div class="form-group">
	      				<label for="input_username">ชื่อผู้ใช้ (Username) <span class="red-text"> *</span></label>
						<input type="text" maxlength="15" value="<?php echo $_GET['u'];?>" placeholder="" id="input_username" name="input_username" class="form-control" readonly>
					</div>
	      			<div class="form-group">
	      				<label for="input_password">รหัสผ่านใหม่ <span class="red-text"> *</span></label>
						<input type="password" maxlength="15" placeholder="" id="input_password" name="input_password" class="form-control">
						<span class="help-block">5-15 ตัวอักษร</span>
					</div>
					<div class="form-group">
						<label for="input_password2">ยืนยันรหัสผ่านใหม่ <span class="red-text"> *</span></label>
						<input type="password" maxlength="15" placeholder="" id="input_password2" name="input_password2" class="form-control">
						<span class="help-block">5-15 ตัวอักษร</span>
					</div>
				  	<div class="text-right"><?php echo $eml->btn('submit','');?></div>
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
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$.validator.addMethod("password_match", function(value, element){
			//ตรวจสอบรหัสผ่านทั้งสองต้องเหมือนกัน
			if($("#input_password").val()==$("#input_password2").val())
			{
				//remove error message
				pwd_rm_error_msg();
				return true;
			}
			else return false;
		}, "รหัสผ่าน และยืนยันรหัสผ่านไม่ตรงกัน.");
		$.validator.addMethod("noSpace", function(value, element){
			//ตรวจสอบช่องว่างในข้อความ
			return value.indexOf(" ") < 0;
		}, "ไม่อนุญาตให้มีช่องว่าง");
		$("#reset_password_form").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"input_password":{
					required:true,
					minlength:5,
					maxlength:15,
					password_match:true,
					noSpace:true
				},
				"input_password2":{
					required:true,
					minlength:5,
					maxlength:15,
					password_match:true,
					noSpace:true
				}
			},
			messages:{
				"input_username": {
					remote:"ชื่อผู้ใช้นี้ถูกใช้แล้ว"
				}
			}
		});
		$("#reset_password_form").submit(function(e){
			//e.preventDefault();
		});
	});
	//remove erorr message for password & password2
	function pwd_rm_error_msg()
	{
		if($("#input_password").val()==$("#input_password2").val())
		{
			$("#input_password").next('label.my-error-class').remove();
			$("#input_password").removeClass('my-error-class');
			$("#input_password2").next('label.my-error-class').remove();
			$("#input_password2").removeClass('my-error-class');
		}
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;