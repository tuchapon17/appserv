<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$m_name="login";
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
      			
      		 	<h2>ลงชื่อเข้าใช้</h2>
      		 	<div class="alert-danger" id="login-alert">
      			<?php 
      				echo form_error("input_username");
      				echo form_error("input_password");
      				if($this->session->flashdata("login_message")) echo $this->session->flashdata("login_message");
      			?>
      			</div>    
	          	<form role="form" action="?c=login&m=auth" method="post" autocomplete="off">
	          	<?php 
	          		echo $in_username;
	          		echo $in_password;
	          	?>
				  <!-- <div class="form-group">
				    <label for="input_username">ชื่อผู้เข้าใช้<span class="red-text"> *</span></label>
				    <input type="text" class="form-control" name="input_username" id="input_username" placeholder="" value="<?php echo set_value("input_username");?>">
				  </div>
				  <div class="form-group">
				    <label for="input_password">รหัสผ่าน<span class="red-text"> *</span></label>
				    <input type="password" class="form-control" name="input_password" id="input_password" placeholder="">
				  </div> -->
				  <div class="text-center"><a href="<?php echo base_url();?>?c=register&m=step1">ลงทะเบียน</a> | <a href="<?php echo base_url();?>?c=login&m=forgot_password">ลืมรหัสผ่าน</a></div>
				  <br>
				  <div class="text-right"><button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button></div>
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
	<script type="text/javascript">
	<!--
	$(function(){
		$("#input_username").focus();
		
		/*#################################################
		Show bootbox alert after 
		###################################################*/
		<?php 
		if($this->session->flashdata($m_name."_message_from_reset"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata($m_name."_message_from_reset");?>"); 
		<?php
		}?>
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;