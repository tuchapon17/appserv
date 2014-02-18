<?php 

echo $htmlopen;
echo $head;
?>
	<link href="<?php echo base_url();?>plugins/bootstrap3_datetime/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style type="text/css">
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
      		<h2>ประเภทรายงาน</h2>
      		<div class="panel panel-default">
      			<div class="panel-heading">
      			เลือกประเภทรายงาน
      			</div>
      			<div class="panel-body">
	      			<form role="form" id="form_report_type" action="<?php echo base_url();?>?d=report&c=report&m=report_type_process" method="post" autocomplete="off">
		      			<div class="form-group">
		      				<label for="se_report_type" >ประเภทรายงาน</label>
		      				<select class="form-control" name="se_report_type" id="se_report_type">
		      					<option value="">เลือก</option>
		      					<option value="report_reserve">รายงานการจอง</option>
		      					<option selected value="report_room_use">รายงานการใช้ห้อง</option>
		      				</select>
		      			</div>
		      			<div class="form-group" id="c_room">
		      				<label for="se_room" >ห้อง</label>
		      				<select class="form-control" name="se_room" id="se_room">
		      					<option value="">เลือก</option>
		      					<option selected value="01">C201</option>
		      					<option value="02">C202</option>
		      				</select>
		      			</div>
		      			<div class="form-group">
		      				<label for="">ระยะเวลา</label>
	      					<select class="form-control" name="se_time_length" id="se_time_length">
	      						<option value="">เลือก</option>
	      						<option value="tl_month">รายเดือน</option>
	      						<option value="tl_quarter">รายไตรมาส</option>
	      						<option value="tl_term">รายเทอม</option>
	      						<option selected value="tl_year">รายปี</option>
	      						<option value="tl_custom">กำหนดเอง</option>
	      					</select>
		      			</div>
		      			<div class="form-group" id="c_month">
		      				<label for="">เลือกเดือน</label>
	      					<select class="form-control" name="se_month" id="se_month">
	      						<option value="01">01</option>
	      						<option value="02">02</option>
	      						<option value="03">03</option>
	      						<option value="04">04</option>
	      						<option value="05">05</option>
	      					</select>
		      			</div>
		      			
		      			<div class="form-group" id="c_quarter">
		      				<label for="">เลือกไตรมาส</label>
	      					<select class="form-control" name="se_quarter" id="se_quarter">
	      						<option value="quarter1">ไตรมาส1 (ธ.ค.-ก.พ.)</option>
	      						<option value="quarter2">ไตรมาส2 (มี.ค.-พ.ค.)</option>
	      						<option value="quarter3">ไตรมาส3 (มิ.ย.-ส.ค.)</option>
	      						<option value="quarter4">ไตรมาส4 (ก.ย.-พ.ย.)</option>
	      					</select>
		      			</div>
		      			<div class="form-group" id="c_term">
		      				<label for="">เลือกเทอม</label>
	      					<select class="form-control" name="se_term" id="se_term">
	      						<option value="term1">เทอม1</option>
	      						<option value="term2">เทอม2</option>
	      						<option value="term3">เทอม3</option>
	      					</select>
		      			</div>
		      			<div class="form-group" id="c_year">
		      				<label for="">เลือกปี</label>
	      					<select class="form-control" name="se_year" id="se_year">
	      						<option value="2013">2013</option>
	      						<option value="2014" selected>2014</option>
	      					</select>
		      			</div>
		      			<div class="form-group" id="c_custom_begin">
		      				<label for="c_begin">เวลาเริ่มต้น</label>
	      					<div class='input-group date c_begin'>
			                    <input type='text' class="form-control" name="input_c_begin" readonly/>
			                    <span class="input-group-addon"><span class=""></span>
			                </div>
		      			</div>
		      			<div class="form-group" id="c_custom_end">
		      				<label for="c_begin">เวลาสิ้นสุด</label>
	      					<div class='input-group date c_end'>
			                    <input type='text' data-name="input_c_end" class="form-control" name="input_c_end" readonly/>
			                    <span class="input-group-addon"><span class=""></span>
			                </div>
		      			</div>
		      			
		      			<div class="form-group">
		      				<button type="submit" class="btn btn-primary">submit</button>
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
	<script type="text/javascript" src="<?php echo base_url();?>plugins/bootstrap3_datetime/js/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/bootstrap3_datetime/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/bootstrap3_datetime/js/locales/bootstrap-datetimepicker.th.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		/**
		*jquery validation
		*/
		$.validator.addMethod("check_se_room", function(value, element){
			if($("#se_report_type").val()=="report_room_use")
			{
				if(value=="") return false;
				else return true;
			}
			else return true;
		}, "โปรดระบุข้อมูล.");
		$("#form_report_type").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"se_report_type":{
					required:true
				},
				"se_room":{
					check_se_room:true
				},
				"se_time_length":{
					required:true
				}
			},
			messages:{
				"input_username":{
					remote:""
				}
			}
		});

		/**
		* show hide select option
		*/
		$("#c_room").hide();
		$("#se_report_type").on("change keyup",function(){
			var val = $(this).find("option:selected").val();
			if(val=="report_room_use")
			{
				$("#c_room").show();
			}
			else 
			{
				$("#c_room").hide();
			}
		});
		
		hide_all_time_length();
		$("#se_time_length").on("change keyup",function(){
			var val = $(this).find("option:selected").val();
			if(val=="tl_month")
			{
				hide_all_time_length();
				$("#c_month,#c_year").show();
			}
			else if(val=="tl_quarter")
			{
				hide_all_time_length();
				$("#c_quarter,#c_year").show();
			}
			else if(val=="tl_term")
			{
				hide_all_time_length();
				$("#c_term,#c_year").show();
			}
			else if(val=="tl_year")
			{
				hide_all_time_length();
				$("#c_year").show();
			}
			else if(val=="tl_custom")
			{
				$("#c_custom_begin,#c_custom_end").show();
			}
		});

		$("#se_report_type").change();
		$("#se_room").change();

		init_datetimepicker();
	});
	//ซ่อนระยะเวลาทุกอัน
	function hide_all_time_length()
	{
		$("#c_year,#c_month,#c_quarter,#c_term").hide();
		$("#c_custom_begin,#c_custom_end").hide();
	}
	function init_datetimepicker()
	{
		$('.c_begin').datetimepicker({
			pickTime:false,
			pick12HourFormat: false,
            language: 'th',
            icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			},
			format:"LL"
        });
		$('.c_end').datetimepicker({
			pickTime:false,
			pick12HourFormat: false,
            language: 'th',
            icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			},
			format:"LL"
        });
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;