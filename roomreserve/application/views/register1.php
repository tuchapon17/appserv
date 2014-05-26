<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="register";
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
		.hidden{
			display:none;
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
      		 	<h2>ลงทะเบียน</h2>
      		 	<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><span class="red-text"> *</span> จำเป็นต้องกรอก</strong>
					<br>
					<strong><i class="fa fa-question-circle pointer"></i> คำแนะนำการกรอกข้อมูล</strong>
				</div>
      		 	<?php /*
      		 	<ul class="nav nav-tabs" id="steptab">
      		 	  <!-- data-toggle มี pill/tab -->
				  <li><a href="#" data-toggle="pill" id="step1">1</a></li>
				  <li><a href="#" data-toggle="pill" id="step2">2</a></li>
				  <li><a href="#" data-toggle="pill" id="step3">3</a></li>
				</ul>
				*/?>
      		 	<div class="alert-danger" id="login-alert">
      			<?php 
      				$em_name=array(
      						"username"=>$this->lang->line("in_username"),
							"password"=>$this->lang->line("in_password"),
							"password2"=>$this->lang->line("in_password2"),
							"email"=>$this->lang->line("in_email"),
							"titlename"=>$this->lang->line("se_titlename"),
							"firstname"=>$this->lang->line("in_firstname"),
							"lastname"=>$this->lang->line("in_lastname"),
							"phone"=>$this->lang->line("in_phone"),
							"occupation1"=>$this->lang->line("se_occupation"),
							"occupation2"=>$this->lang->line("in_occupation"),
							"house_no"=>$this->lang->line("in_house_no"),
							"village_no"=>$this->lang->line("in_village_no"),
							"alley"=>$this->lang->line("in_alley"),
							"road"=>$this->lang->line("in_road"),
							"province"=>$this->lang->line("se_province"),
      						"district"=>$this->lang->line("se_district"),
      						"subdistrict"=>$this->lang->line("se_subdistrict"),
      						"id_card_number"=>$this->lang->line("in_id_card_number")
      				);
      				/*
      				echo form_error($this->lang->line("in_username"));
      				echo form_error($this->lang->line("in_password"));
      				echo form_error($this->lang->line("in_password2"));
      				echo form_error($this->lang->line("in_email"));
      				echo form_error($this->lang->line("se_titlename"));
      				echo form_error($this->lang->line("in_firstname"));
      				echo form_error($this->lang->line("in_lastname"));
      				echo form_error($this->lang->line("in_phone"));
      				echo form_error($this->lang->line("se_occupation"));
      				echo form_error($this->lang->line("in_occupation"));
      				echo form_error($this->lang->line("in_house_no"));
      				echo form_error($this->lang->line("in_village_no"));
      				echo form_error($this->lang->line("in_alley"));
      				echo form_error($this->lang->line("in_road"));
      				echo form_error($this->lang->line("se_province"));
      				echo form_error($this->lang->line("se_district"));
      				echo form_error($this->lang->line("se_subdistrict"));
      				*/
      			?>
      			</div>
      			
	          	<form role="form" action="?c=<?=$controller?>&m=step1" method="post" id="register_form">
		          	<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>ข้อมูลการเข้าใช้ระบบ</strong></h3>
						</div>
						<div class="panel-body">
							<?php 
							echo $in_username;
								echo "<span id='".$this->lang->line("in_username")."_error' class='hidden'>".form_error($this->lang->line("in_username"))."</span>";
							echo $in_password;
								echo "<span id='".$this->lang->line("in_password")."_error' class='hidden'>".form_error($this->lang->line("in_password"))."</span>";
							echo $in_password2;
								echo "<span id='".$this->lang->line("in_password2")."_error' class='hidden'>".form_error($this->lang->line("in_password2"))."</span>";
							echo $in_email;
								echo "<span id='".$this->lang->line("in_email")."_error' class='hidden'>".form_error($this->lang->line("in_email"))."</span>";
							?>		
						</div>
					</div>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>ข้อมูลส่วนตัว</strong></h3>
						</div>
						<div class="panel-body">
							<?php
							echo $in_id_card_number;
								echo "<span id='".$this->lang->line("in_id_card_number")."_error' class='hidden'>".form_error($this->lang->line("in_id_card_number"))."</span>";
							echo $se_titlename;
								echo "<span id='".$this->lang->line("se_titlename")."_error' class='hidden'>".form_error($this->lang->line("se_titlename"))."</span>";
							echo $in_firstname;
								echo "<span id='".$this->lang->line("in_firstname")."_error' class='hidden'>".form_error($this->lang->line("in_firstname"))."</span>";
							echo $in_lastname;
								echo "<span id='".$this->lang->line("in_lastname")."_error' class='hidden'>".form_error($this->lang->line("in_lastname"))."</span>";
							echo $in_phone;
								echo "<span id='".$this->lang->line("in_phone")."_error' class='hidden'>".form_error($this->lang->line("in_phone"))."</span>";
							echo $se_occupation;
								echo "<span id='".$this->lang->line("se_occupation")."_error' class='hidden'>".form_error($this->lang->line("se_occupation"))."</span>";
							echo $in_occupation;
								echo "<span id='".$this->lang->line("in_occupation")."_error' class='hidden'>".form_error($this->lang->line("in_occupation"))."</span>";
							?>		
						</div>
					</div>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>ข้อมูลที่อยู่</strong></h3>
						</div>
						<div class="panel-body">
							<?php 
							echo $in_house_no;
								echo "<span id='".$this->lang->line("in_house_no")."_error' class='hidden'>".form_error($this->lang->line("in_house_no"))."</span>";
							echo $in_village_no;
								echo "<span id='".$this->lang->line("in_village_no")."_error' class='hidden'>".form_error($this->lang->line("in_village_no"))."</span>";
							echo $in_alley;
								echo "<span id='".$this->lang->line("in_alley")."_error' class='hidden'>".form_error($this->lang->line("in_alley"))."</span>";
							echo $in_road;
								echo "<span id='".$this->lang->line("in_road")."_error' class='hidden'>".form_error($this->lang->line("in_road"))."</span>";
							echo $se_province;
								echo "<span id='".$this->lang->line("se_province")."_error' class='hidden'>".form_error($this->lang->line("se_province"))."</span>";
							echo $se_district;
								echo "<span id='".$this->lang->line("se_district")."_error' class='hidden'>".form_error($this->lang->line("se_district"))."</span>";
							echo $se_subdistrict;
								echo "<span id='".$this->lang->line("se_subdistrict")."_error' class='hidden'>".form_error($this->lang->line("se_subdistrict"))."</span>";
							?>		
						</div>
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
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.numeric.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript">
	<!--
	
	$(function(){
		
		/**
		*jquery validation
		*/
		$.validator.addMethod("username_regex", function(value, element){
			//รูปแบบ username ขึ้นต้นด้วยอังกฤษ abc abc123
			var regex=/^([a-zA-Z0-9])+$/;
			return regex.test(value);
		}, "รูปแบบไม่ถูกต้อง");
		$.validator.addMethod("password_match", function(value, element){
			//ตรวจสอบรหัสผ่านทั้งสองต้องเหมือนกัน
			if($("#<?php echo $this->lang->line("in_password");?>").val()==$("#<?php echo $this->lang->line("in_password2");?>").val())
			{
				//remove error message
				pwd_rm_error_msg();
				return true;
			}
			else return false;
		}, "รหัสผ่าน และยืนยันรหัสผ่านไม่ตรงกัน.");
		$.validator.addMethod("email_regex", function(value, element){
			//regex email เอามาจาก library ของ codeigniter
			///^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix
			var regex=/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i;
			return regex.test(value);
		}, "รูปแบบไม่ถูกต้อง");
		$.validator.addMethod("noSpace", function(value, element){
			//ตรวจสอบช่องว่างในข้อความ
			return value.indexOf(" ") < 0;
		}, "ไม่อนุญาตให้มีช่องว่าง");
		$.validator.addMethod("firstlast_name", function(value, element){
			//รูปแบบ firstname lastname เฉพาะอักษรอังกฤษ/ไทย
			var regex=/^[a-zA-Zก-ํ ]+$/g;
			return regex.test(value);
		}, "กรอกได้เฉพาะอักษรไทย/อังกฤษ และวรรค เท่านั้น");
		$.validator.addMethod("phone", function(value, element){
			//รูปแบบหมายเลขโทรศัพท์ 0 นำหน้า
			var regex=/^[0][0-9]+$/g;
			return regex.test(value);
		}, "รูปแบบไม่ถูกต้อง");
		$.validator.addMethod("house_no", function(value, element){
			//รูปแบบบ้านเลขที่  12 12/1 
			var regex=/^([0-9]|([0-9]\/[0-9]))+$/;
			return regex.test(value);
		}, "รูปแบบไม่ถูกต้อง");
		$.validator.addMethod("select_other_occupation", function(value, element){
			//เมื่อเลือกอาชีพอื่นๆ
			if(value=='00')
			{
				$("#<?php echo $this->lang->line("in_occupation");?>").focus();
				return true;
			}
			return true;
		}, "กรุณาระบุอาชีพอื่นๆ");
		$.validator.addMethod("<?php echo $this->lang->line("in_occupation");?>", function(value, element){
			//เมื่อมีการเลือกอาชีพอื่นๆ
			if($("#<?php echo $this->lang->line("se_occupation");?>").val()=='00')
			{
				//ลบช่องว่าง หน้า หลัง string
				$("#<?php echo $this->lang->line("in_occupation");?>").val($.trim($("#<?php echo $this->lang->line("in_occupation");?>").val()));
				if($("#<?php echo $this->lang->line("in_occupation");?>").val().length > 0)
					return true;
			}
			else return true;
		}, "โปรดระบุข้อมูล");
		$.validator.addMethod("id_card", function(value, element){
			var num = 13;
			var sum=0;
			var char13;
			var result;
			for(var i=0;i<=12;i++)
			{
				if(i!=12)
				{
					sum = sum+(num*value.charAt(i));
					num--;
				}
				else char13 = value.charAt(i);
			}
			var x = sum%11;
			if(x <= 1) result = 1-x;
			else if(x > 1) result = 11-x;
			if(result == char13) return true;
			else return false;
		}, "รหัสบัตรประชาชนไม่ถูกต้อง");
		$("#register_form").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("in_username");?>":{
					required:true,
					username_regex:true,
					noSpace:true,
					minlength:5,
					maxlength:15,
					//ตรวจสอบว่ามี username ซ้ำหรือไม่
					remote:{
						// จะ return true / false
						// ชื่อ data ใช้ input_username
						url:b_url+"?c=register&m=already_exist_ajax",
						type:"POST"
					}
				},
				"<?php echo $this->lang->line("in_password");?>":{
					required:true,
					minlength:5,
					maxlength:15,
					password_match:true,
					noSpace:true
				},
				"<?php echo $this->lang->line("in_password2");?>":{
					required:true,
					minlength:5,
					maxlength:15,
					password_match:true,
					noSpace:true
				},
				"<?php echo $this->lang->line("in_email");?>":{
					required:true,
					//email:true,
					email_regex:true,
					noSpace:true,
					maxlength:128
				},
				"<?php echo $this->lang->line("se_titlename");?>":{
					required:true
				},
				"<?php echo $this->lang->line("in_firstname");?>":{
					required:true,
					firstlast_name:true,
					maxlength:40
				},
				"<?php echo $this->lang->line("in_lastname");?>":{
					required:true,
					firstlast_name:true,
					maxlength:40
				},
				"<?php echo $this->lang->line("in_phone");?>":{
					required:true,
					phone:true,
					maxlength:10,
					minlength:9
				},
				"<?php echo $this->lang->line("se_occupation");?>":{
					required:true,
					select_other_occupation:true
				},
				"<?php echo $this->lang->line("in_occupation");?>":{
					input_occupation:true,
					maxlength:30
				},
				"<?php echo $this->lang->line("in_house_no");?>":{
					required:true,
					house_no:true,
					maxlength:10
				},
				"<?php echo $this->lang->line("in_village_no");?>":{
					required:true,
					digits:true,
					maxlength:2
				},
				"<?php echo $this->lang->line("in_alley");?>":{
					maxlength:30
				},
				"<?php echo $this->lang->line("in_road");?>":{
					maxlength:25
				},
				"<?php echo $this->lang->line("se_province");?>":{
					required:true
				},
				"<?php echo $this->lang->line("se_district");?>":{
					required:true
				},
				"<?php echo $this->lang->line("se_subdistrict");?>":{
					required:true
				},
				"<?php echo $this->lang->line("in_id_card_number");?>":{
					minlength:13,
					maxlength:13,
					digits:true,
					id_card:true
				}
			},
			messages:{
				"<?php echo $this->lang->line("in_username");?>": {
					remote:"ชื่อผู้ใช้นี้ถูกใช้แล้ว"
				}
			}
		});

		/**
		* on form submit
		*/
		$("#register_form").submit(function(e){
			$("#<?php echo $this->lang->line("in_firstname");?>").val($.trim($("#<?php echo $this->lang->line("in_firstname");?>").val()));
			$("#<?php echo $this->lang->line("in_lastname");?>").val($.trim($("#<?php echo $this->lang->line("in_lastname");?>").val()));
			$("#<?php echo $this->lang->line("in_alley");?>").val($.trim($("#<?php echo $this->lang->line("in_alley");?>").val()));
			$("#<?php echo $this->lang->line("in_road");?>").val($.trim($("#<?php echo $this->lang->line("in_road");?>").val()));
			//e.preventDefault();
		});

		/**
		* disabled spacebar
		*/
		$("input[type='text']\
				#<?php echo $this->lang->line("in_username");?>,#<?php echo $this->lang->line("in_password");?>,\
				#<?php echo $this->lang->line("in_password2");?>,#<?php echo $this->lang->line("in_email");?>,\
				#<?php echo $this->lang->line("in_phone");?>,#<?php echo $this->lang->line("in_house_no");?>,\
				#<?php echo $this->lang->line("in_village_no");?>"
		).keydown(function(e){
			if(e.keyCode==32)
			{
				return false;
			}
		});
		
		/**
		* disabled unwanted characters
		*/
		$("#<?php echo $this->lang->line("in_firstname");?>,#<?php echo $this->lang->line("in_lastname");?>").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^a-zA-Zก-ํ ]/gi,''));
		});
		$("#<?php echo $this->lang->line("in_username");?>").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^a-zA-Z0-9]/gi,''));
		});
		$("#<?php echo $this->lang->line("in_phone");?>").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9]/gi,''));
		});
		$("#<?php echo $this->lang->line("in_house_no");?>").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9\/]/gi,''));
		});
		$("#<?php echo $this->lang->line("in_village_no");?>").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9]/gi,''));
		});

		
		/**
		* คำแนะนำ การกรอกข้อมูล
		*/
		$("#<?php echo $this->lang->line("in_username");?>").prev().before('<span id="input_username_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_username_hint").click(function(){
			bootbox.alert("\
					<strong>ชื่อผู้เข้าใช้</strong><br>\
					- ความยาวระหว่าง 5-15 ตัวอักษร<br>\
					- กรอกได้เฉพาะอักษรภาษาอังกฤษ และตัวเลขเท่านั้น<br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง example, example12, exampleexample9\
					");
		});
		$("#<?php echo $this->lang->line("in_password");?>").prev().before('<span id="input_password_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_password_hint").click(function(){
			bootbox.alert("\
					<strong>รหัสผ่าน</strong><br>\
					- ความยาวระหว่าง 5-15 ตัวอักษร<br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง 123456789, 11example11, example@#%$\
					");
		});
		$("#<?php echo $this->lang->line("in_firstname");?>").prev().before('<span class="input_firstlast_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#<?php echo $this->lang->line("in_lastname");?>").prev().before('<span class="input_firstlast_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$(".input_firstlast_hint").click(function(){
			bootbox.alert("\
					<strong>ชื่อ, นามสกุล</strong><br>\
					- ความยาวระหว่าง 1-40 ตัวอักษร<br>\
					- กรอกได้เฉพาะอักษรภาษาไทย/อังกฤษ<br>\
					ตัวอย่าง example, ตัวอย่างชื่อ\
					");
		});
		$("#<?php echo $this->lang->line("in_phone");?>").prev().before('<span id="input_phone_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_phone_hint").click(function(){
			bootbox.alert("\
					<strong>รหัสผ่าน</strong><br>\
					- ความยาวระหว่าง 9-10 ตัวอักษร<br>\
					- กรอกได้เฉพาะตัวเลข<br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง 055123456, 0812345678\
					");
		});
		$("#<?php echo $this->lang->line("in_house_no");?>").prev().before('<span id="input_house_no_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_house_no_hint").click(function(){
			bootbox.alert("\
					<strong>รหัสผ่าน</strong><br>\
					- ความยาวระหว่าง 1-10 ตัวอักษร<br>\
					- กรอกได้เฉพาะตัวเลข และ / <br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง 1, 1/123\
					");
		});
		$("#<?php echo $this->lang->line("in_village_no");?>").prev().before('<span id="input_village_no_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_village_no_hint").click(function(){
			bootbox.alert("\
					<strong>รหัสผ่าน</strong><br>\
					- ความยาวระหว่าง 1-2 ตัวอักษร<br>\
					- กรอกได้เฉพาะตัวเลข<br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง 1, 99\
					");
		});

		/**
		* show popover
		*/
		$("span#input_username_hint").popover({
			content:"คลิกที่นี่เพื่อรับ<br>คำแนะนำการกรอกข้อมูล",
			placement:"left",
			html:true
		});
		// show and settimeout to hide popover
		$("span#input_username_hint").popover('show'),
		setTimeout(function () {
	        $("span#input_username_hint").popover('destroy');
	    }, 10000);
	    $("#exitpopover").click(function(){
	    	$("span#input_username_hint").popover('hide');
		 });
		
		/**
		Show bootbox alert(confirm) after passed form validation
		*/
		<?php 
		if($this->session->flashdata("register_message"))
		{
			if($this->session->flashdata("register_status")==true)
			{?>
				bootbox.confirm("<?php echo $this->session->flashdata("register_message");?><br/>คุณต้องการไปยังหน้าเข้าสู่ระบบหรือไม่? ", function(result) {
					if(result == true)window.location="?c=login&m=auth";
				}); 
			<?php
			}
			else if ($this->session->flashdata("register_status")==false) {
			?>
				bootbox.alert("<?php echo $this->session->flashdata("register_message");?> ");
			<?php	
			}
		}?>
		
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
		Get district list
		*/
		$("#<?php echo $this->lang->line("se_province");?>").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?c=register&m=select_district",
					data:{province_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#<?php echo $this->lang->line("se_district");?>").find("option:gt(0)").remove();
						if(resp.district_list!=null)$("#<?php echo $this->lang->line("se_district");?>").append(resp.district_list);
						
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#<?php echo $this->lang->line("se_district");?>").find("option:gt(0)").remove();
			}
		});

		/**
		Get subdistrict list
		*/
		$("#<?php echo $this->lang->line("se_district");?>").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?c=register&m=select_subdistrict",
					data:{district_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#<?php echo $this->lang->line("se_subdistrict");?>").find("option:gt(0)").remove();
						if(resp.subdistrict_list!=null)$("#<?php echo $this->lang->line("se_subdistrict");?>").append(resp.subdistrict_list);
						
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#<?php echo $this->lang->line("se_subdistrict");?>").find("option:gt(0)").remove();
			}
		});
		
		/**
		Get district list on startup if province is selected
		*/
		if($("#<?php echo $this->lang->line("se_province");?>").find("option:selected").val()!=""){
			setTimeout(function(){
				$("#<?php echo $this->lang->line("se_province");?>").trigger("change");
			});
		}

		/**
		- find div parent of #input_occupation and add ID(otherOccupation) to this div
		- if selected otherOccupation #input_occupation has been visible
		*/
		$("#<?php echo $this->lang->line("in_occupation");?>").parent().attr('id','otherOccupation');
		$("#otherOccupation").hide();
		$("#<?php echo $this->lang->line("se_occupation");?>").on("keyup change",function(){
			if($(this).find('option:selected').val()=="00")
			{
				$("#otherOccupation").show();
			}
			else
			{
				$("#<?php echo $this->lang->line("in_occupation");?>").val('');
				$("#otherOccupation").hide();
			}
		});
		if($("#<?php echo $this->lang->line("se_occupation");?>").find("option:selected").val()=="00")
		{
			$("#<?php echo $this->lang->line("se_occupation");?>").trigger("change");
		}
	});
	//remove erorr message for password & password2
	function pwd_rm_error_msg()
	{
		if($("#<?php echo $this->lang->line("in_password");?>").val()==$("#<?php echo $this->lang->line("in_password2");?>").val())
		{
			$("#<?php echo $this->lang->line("in_password");?>").next('label.my-error-class').remove();
			$("#<?php echo $this->lang->line("in_password");?>").removeClass('my-error-class');
			$("#<?php echo $this->lang->line("in_password2");?>").next('label.my-error-class').remove();
			$("#<?php echo $this->lang->line("in_password2");?>").removeClass('my-error-class');
		}
	}
	
	/**
	GetURLParameter such as ?c=aaa&m=bbb
	this method can get aaa or bbb from URL
	*/
	function getURLParameter(name) {
	    return decodeURI(
	        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
	    );
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;