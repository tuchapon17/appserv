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
      						"username"=>$this->lang->line("regis_in_username"),
							"password"=>$this->lang->line("regis_in_password"),
							"password2"=>$this->lang->line("regis_in_password2"),
							"email"=>$this->lang->line("regis_in_email"),
							"titlename"=>$this->lang->line("regis_se_titlename"),
							"firstname"=>$this->lang->line("regis_in_firstname"),
							"lastname"=>$this->lang->line("regis_in_lastname"),
							"phone"=>$this->lang->line("regis_in_phone"),
							"occupation1"=>$this->lang->line("regis_se_occupation"),
							"occupation2"=>$this->lang->line("regis_in_occupation"),
							"house_no"=>$this->lang->line("regis_in_house_no"),
							"village_no"=>$this->lang->line("regis_in_village_no"),
							"alley"=>$this->lang->line("regis_in_alley"),
							"road"=>$this->lang->line("regis_in_road"),
							"province"=>$this->lang->line("regis_se_province"),
      						"district"=>$this->lang->line("regis_se_district"),
      						"subdistrict"=>$this->lang->line("regis_se_subdistrict")
      				);
      				echo form_error($em_name["username"]);
      				echo form_error($em_name["password"]);
      				echo form_error($em_name["password2"]);
      				echo form_error($em_name["email"]);
      				echo form_error($em_name["titlename"]);
      				echo form_error($em_name["firstname"]);
      				echo form_error($em_name["lastname"]);
      				echo form_error($em_name["phone"]);
      				echo form_error($em_name["occupation1"]);
      				echo form_error($em_name["occupation2"]);
      				echo form_error($em_name["house_no"]);
      				echo form_error($em_name["village_no"]);
      				echo form_error($em_name["alley"]);
      				echo form_error($em_name["road"]);
      				echo form_error($em_name["province"]);
      				echo form_error($em_name["district"]);
      				echo form_error($em_name["subdistrict"]);
      			?>
      			</div>
      			
	          	<form role="form" action="?c=<?=$controller?>&m=step1" method="post" autocomplete="off" id="register_form">
		          	<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>ข้อมูลการเข้าใช้ระบบ</strong></h3>
						</div>
						<div class="panel-body">
							<?php 
							echo $in_username;
								echo "<span id='".$em_name["username"]."_error' class='hidden'>".form_error($em_name["username"])."</span>";
							echo $in_password;
								echo "<span id='".$em_name["password"]."_error' class='hidden'>".form_error($em_name["password"])."</span>";
							echo $in_password2;
								echo "<span id='".$em_name["password2"]."_error' class='hidden'>".form_error($em_name["password2"])."</span>";
							echo $in_email;
								echo "<span id='".$em_name["email"]."_error' class='hidden'>".form_error($em_name["email"])."</span>";
							?>		
						</div>
					</div>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>ข้อมูลส่วนตัว</strong></h3>
						</div>
						<div class="panel-body">
							<?php
							echo $se_titlename;
								echo "<span id='".$em_name["titlename"]."_error' class='hidden'>".form_error($em_name["titlename"])."</span>";
							echo $in_firstname;
								echo "<span id='".$em_name["firstname"]."_error' class='hidden'>".form_error($em_name["firstname"])."</span>";
							echo $in_lastname;
								echo "<span id='".$em_name["lastname"]."_error' class='hidden'>".form_error($em_name["lastname"])."</span>";
							echo $in_phone;
								echo "<span id='".$em_name["phone"]."_error' class='hidden'>".form_error($em_name["phone"])."</span>";
							echo $se_occupation;
								echo "<span id='".$em_name["occupation1"]."_error' class='hidden'>".form_error($em_name["occupation1"])."</span>";
							echo $in_occupation;
								echo "<span id='".$em_name["occupation2"]."_error' class='hidden'>".form_error($em_name["occupation2"])."</span>";
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
								echo "<span id='".$em_name["house_no"]."_error' class='hidden'>".form_error($em_name["house_no"])."</span>";
							echo $in_village_no;
								echo "<span id='".$em_name["village_no"]."_error' class='hidden'>".form_error($em_name["village_no"])."</span>";
							echo $in_alley;
								echo "<span id='".$em_name["alley"]."_error' class='hidden'>".form_error($em_name["alley"])."</span>";
							echo $in_road;
								echo "<span id='".$em_name["road"]."_error' class='hidden'>".form_error($em_name["road"])."</span>";
							echo $se_province;
								echo "<span id='".$em_name["province"]."_error' class='hidden'>".form_error($em_name["province"])."</span>";
							echo $se_district;
								echo "<span id='".$em_name["district"]."_error' class='hidden'>".form_error($em_name["district"])."</span>";
							echo $se_subdistrict;
								echo "<span id='".$em_name["subdistrict"]."_error' class='hidden'>".form_error($em_name["subdistrict"])."</span>";
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
			if($("#input_password").val()==$("#input_password2").val())
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
				$("#input_occupation").focus();
				return true;
			}
			return true;
		}, "กรุณาระบุอาชีพอื่นๆ");
		$.validator.addMethod("input_occupation", function(value, element){
			//เมื่อมีการเลือกอาชีพอื่นๆ
			if($("#select_occupation").val()=='00')
			{
				//ลบช่องว่าง หน้า หลัง string
				$("#input_occupation").val($.trim($("#input_occupation").val()));
				if($("#input_occupation").val().length > 0)
					return true;
			}
			else return true;
		}, "โปรดระบุข้อมูล");
		
		$("#register_form").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"input_username":{
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
				},
				"input_email":{
					required:true,
					//email:true,
					email_regex:true,
					noSpace:true,
					maxlength:128
				},
				"select_titlename":{
					required:true
				},
				"input_firstname":{
					required:true,
					firstlast_name:true,
					maxlength:40
				},
				"input_lastname":{
					required:true,
					firstlast_name:true,
					maxlength:40
				},
				"input_phone":{
					required:true,
					phone:true,
					maxlength:10,
					minlength:9
				},
				"select_occupation":{
					required:true,
					select_other_occupation:true
				},
				"input_occupation":{
					input_occupation:true,
					maxlength:30
				},
				"input_house_no":{
					required:true,
					house_no:true,
					maxlength:10
				},
				"input_village_no":{
					required:true,
					digits:true,
					maxlength:2
				},
				"input_alley":{
					maxlength:30
				},
				"input_road":{
					maxlength:25
				},
				"select_province":{
					required:true
				},
				"select_district":{
					required:true
				},
				"select_subdistrict":{
					required:true
				},
			},
			messages:{
				"input_username": {
					remote:"ชื่อผู้ใช้นี้ถูกใช้แล้ว"
				}
			}
		});

		/**
		* on form submit
		*/
		$("#register_form").submit(function(e){
			$("#input_firstname").val($.trim($("#input_firstname").val()));
			$("#input_lastname").val($.trim($("#input_lastname").val()));
			$("#input_alley").val($.trim($("#input_alley").val()));
			$("#input_road").val($.trim($("#input_road").val()));
			//e.preventDefault();
		});

		/**
		* disabled spacebar
		*/
		$("input[type='text']\
				#input_username,#input_password,#input_password2,#input_email,\
				#input_phone,#input_house_no,#input_village_no"
		).keydown(function(e){
			if(e.keyCode==32)
			{
				return false;
			}
		});
		
		/**
		* disabled unwanted characters
		*/
		$("#input_firstname,#input_lastname").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^a-zA-Zก-ํ ]/gi,''));
		});
		$("#input_username").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^a-zA-Z0-9]/gi,''));
		});
		$("#input_phone").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9]/gi,''));
		});
		$("#input_house_no").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9\/]/gi,''));
		});
		$("#input_village_no").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9]/gi,''));
		});

		
		/**
		* คำแนะนำ การกรอกข้อมูล
		*/
		$("#input_username").prev().before('<span id="input_username_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_username_hint").click(function(){
			bootbox.alert("\
					<strong>ชื่อผู้เข้าใช้</strong><br>\
					- ความยาวระหว่าง 5-15 ตัวอักษร<br>\
					- กรอกได้เฉพาะอักษรภาษาอังกฤษ และตัวเลขเท่านั้น<br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง example, example12, exampleexample9\
					");
		});
		$("#input_password").prev().before('<span id="input_password_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_password_hint").click(function(){
			bootbox.alert("\
					<strong>รหัสผ่าน</strong><br>\
					- ความยาวระหว่าง 5-15 ตัวอักษร<br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง 123456789, 11example11, example@#%$\
					");
		});
		$("#input_firstname").prev().before('<span class="input_firstlast_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_lastname").prev().before('<span class="input_firstlast_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$(".input_firstlast_hint").click(function(){
			bootbox.alert("\
					<strong>ชื่อ, นามสกุล</strong><br>\
					- ความยาวระหว่าง 1-40 ตัวอักษร<br>\
					- กรอกได้เฉพาะอักษรภาษาไทย/อังกฤษ<br>\
					ตัวอย่าง example, ตัวอย่างชื่อ\
					");
		});
		$("#input_phone").prev().before('<span id="input_phone_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_phone_hint").click(function(){
			bootbox.alert("\
					<strong>รหัสผ่าน</strong><br>\
					- ความยาวระหว่าง 9-10 ตัวอักษร<br>\
					- กรอกได้เฉพาะตัวเลข<br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง 055123456, 0812345678\
					");
		});
		$("#input_house_no").prev().before('<span id="input_house_no_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_house_no_hint").click(function(){
			bootbox.alert("\
					<strong>รหัสผ่าน</strong><br>\
					- ความยาวระหว่าง 1-10 ตัวอักษร<br>\
					- กรอกได้เฉพาะตัวเลข และ / <br>\
					- ห้ามมีช่องว่าง<br>\
					ตัวอย่าง 1, 1/123\
					");
		});
		$("#input_village_no").prev().before('<span id="input_village_no_hint"><i class="fa fa-question-circle pointer"></i></span> ');
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
		$("#select_province").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?c=register&m=select_district",
					data:{province_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#select_district").find("option:gt(0)").remove();
						if(resp.district_list!=null)$("#select_district").append(resp.district_list);
						
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#select_district").find("option:gt(0)").remove();
			}
		});

		/**
		Get subdistrict list
		*/
		$("#select_district").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?c=register&m=select_subdistrict",
					data:{district_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#select_subdistrict").find("option:gt(0)").remove();
						if(resp.subdistrict_list!=null)$("#select_subdistrict").append(resp.subdistrict_list);
						
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#select_district").find("option:gt(0)").remove();
			}
		});
		
		/**
		Get district list on startup if province is selected
		*/
		if($("#select_province").find("option:selected").val()!=""){
			setTimeout(function(){
				$("#select_province").trigger("change");
			});
		}

		/**
		- find div parent of #input_occupation and add ID(otherOccupation) to this div
		- if selected otherOccupation #input_occupation has been visible
		*/
		$("#input_occupation").parent().attr('id','otherOccupation');
		$("#otherOccupation").hide();
		$("#select_occupation").on("keyup change",function(){
			if($(this).find('option:selected').val()=="00")
			{
				$("#otherOccupation").show();
			}
			else
			{
				$("#input_occupation").val('');
				$("#otherOccupation").hide();
			}
		});
		if($("#select_occupation").find("option:selected").val()=="00")
		{
			$("#select_occupation").trigger("change");
		}
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