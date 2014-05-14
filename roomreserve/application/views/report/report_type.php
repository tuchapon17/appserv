<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
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
      		<div class="row">
      			<div class="col-lg-8 col-lg-offset-2">
      				<h2>รายงาน</h2>
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
					      					<option value="report_room_use">รายงานการใช้ห้อง</option>
					      					<option value="report_room_stat">รายงานสถิติการใช้ห้อง</option>
					      				</select>
					      			</div>
					      			<?php 
					      			echo $se_room_type;
					      			echo $se_room;
					      			?>
					      			<div class="form-group">
					      				<label for="">ระยะเวลา</label>
				      					<select class="form-control" name="se_time_length" id="se_time_length">
				      						<option value="">เลือก</option>
				      						<option value="tl_month">รายเดือน</option>
				      						<option value="tl_quarter">รายไตรมาส</option>
				      						<option value="tl_term">รายเทอม</option>
				      						<option value="tl_year">รายปี</option>
				      						<option value="tl_custom">กำหนดเอง</option>
				      					</select>
					      			</div>
					      			<div class="form-group" id="c_month">
					      				<label for="">เลือกเดือน</label>
				      					<select class="form-control" name="se_month" id="se_month">
				      					<?php 
				      					$html='';
				      					for($i=1;$i<=12;$i++)
				      					{
					      					$month_th=array("ม.ค.","ก.พ.","มี.ค.","เม.ษ.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			      							$month_th_full=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
											$text=str_pad($i,2,0,STR_PAD_LEFT);
			      							$selected=($text==str_pad($month,2,0,STR_PAD_LEFT)) ? 'selected="selected"' : '';
	      									$html.='<option value="'.$text.'" '.$selected.'>'.$month_th_full[$i-1].'</option>';
										}
										echo $html;
				      					?>
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
				      						<?php echo $option_year;?>
				      					</select>
					      			</div>
					      			<div class="form-group" id="c_custom_begin">
					      				<label for="c_begin">เวลาเริ่มต้น</label>
				      					<div class='input-group date c_begin'>
						                    <input type='text' class="form-control" name="input_c_begin" id="input_c_begin" readonly />
						                    <span class="input-group-addon"><span class=""></span>
						                </div>
					      			</div>
					      			<div class="form-group" id="c_custom_end">
					      				<label for="c_begin">เวลาสิ้นสุด</label>
				      					<div class='input-group date c_end'>
						                    <input type='text' id="input_c_end" class="form-control" name="input_c_end" readonly/>
						                    <span class="input-group-addon"><span class=""></span>
						                </div>
					      			</div>
					      				<div class="text-right"><?php echo $eml->btn('submit','');?></div>
				      			</form>
			      			</div>
			      		</div><!-- panel -->
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
		$.validator.addMethod("check_room_type", function(value, element){
			if($("#se_report_type").val()=="report_room_use" || $("#se_report_type").val()=="report_room_stat")
			{
				if(value=="") return false;
				else return true;
			}
			else return true;
		}, "โปรดระบุข้อมูล.");
		$.validator.addMethod("check_room", function(value, element){
			if($("#se_report_type").val()=="report_room_use" || $("#se_report_type").val()=="report_room_stat")
			{
				if(value=="") return false;
				else return true;
			}
			else return true;
		}, "โปรดระบุข้อมูล.");
		$.validator.addMethod("input_custom_time_required", function(value, element){
			if($("#se_time_length").val()=="tl_custom")
			{
				if(value=="") return false;
				else return true;
			}
			else return true;
		}, "โปรดระบุข้อมูล.");
		$.validator.addMethod("input_custom_time_compare_begin", function(value, element){
			if($("#se_time_length").val()=="tl_custom")
			{
				var begin=new Date(reverse_date($("#input_c_begin").val()));
				var end=new Date(reverse_date($("#input_c_end").val()));
				if(begin>end) return false;
				else return true;
			}
			else return true;
		}, "โปรดระบุวันเริ่มต้นให้น้อยกว่าวันสิ้นสุด.");
		$("#form_report_type").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"se_report_type":{
					required:true
				},
				"select_room":{
					check_room:true
				},
				"se_time_length":{
					required:true
				},
				"select_room_type":{
					check_room_type:true
				},
				"input_c_begin":{
					input_custom_time_required:true,
					input_custom_time_compare_begin:true
				},
				"input_c_end":{
					input_custom_time_required:true
				}
			},
			messages:{
				"input_username":{
					remote:""
				}
			}
		});

		$("#form_report_type").submit(function(e){
			
		});
		/**
		* show hide select option
		*/
		$("#select_room,#select_room_type").parent('div').hide();
		$("#se_report_type").on("change keyup",function(){
			var val = $(this).find("option:selected").val();
			if(val=="report_room_use" || val=="report_room_stat")
			{
				$("#select_room,#select_room_type").parent().show();
			}
			else 
			{
				$("#select_room,#select_room_type").parent().hide();
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
				hide_all_time_length();
				$("#c_custom_begin,#c_custom_end").show();
			}
		});

		/*
		*แสดงข้อมูลห้องใน dropdown (Get room list)
		*/
		$("#select_room_type").prepend('<option value="all">ทั้งหมด</option>');
		$("#select_room_type").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				if($(this).find("option:selected").val()=="all")
				{
					$("#select_room").parent().hide();
				}
				else
				{
					$("#select_room").parent().show();
					$.ajax({
						url:"?d=report&c=report&m=select_room_list",
						data:{room_type_id:$(this).find("option:selected").val()},
						type:"POST",
						dataType:"json",
						success:function(resp){
							$("#select_room").find("option:gt(0)").remove();
							if(resp.room_list!=null)
							{
								$("#select_room").append('<option value="all">ทั้งหมด</option>');
								$("#select_room").append(resp.room_list);
							}
						},
						error:function(error){
							alert("Error : "+error);
						}
					});
				}
			}
			else
			{
				$("#select_room").find("option:gt(0)").remove();
			}
		});
		
		//test
		//$("#se_report_type").change();

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
	function reverse_date(inDate)
	{
		var a = inDate.split("-");
		a.reverse();
		var reversed = a.join("-");
		return reversed;
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;