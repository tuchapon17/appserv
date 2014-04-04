<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
echo $htmlopen;
echo $head;
?>
    <!-- Custom styles -->
    <link href="<?php echo base_url();?>plugins/bootstrap3_datetime/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
      	<?php echo $reserve_tab;?>
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
				
      		 	<h2>จองห้อง</h2>
      		 	<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><span class="red-text"> *</span> จำเป็นต้องกรอก</strong>
					<br>
					<strong><i class="fa fa-question-circle pointer"></i> คำแนะนำการกรอกข้อมูล</strong>
				</div>
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php
	      		 	$em_name=array(
	      		 			"input_std_id"=>"input_std_id",
							"input_phone"=>"input_phone",
							"input_num_of_people"=>"input_num_of_people",
							"input_project_name"=>"input_project_name",
							"textarea_for_use"=>"textarea_for_use",
							"select_faculty"=>"select_faculty",
							"select_department"=>"select_department",
							"select_job_position"=>"select_job_position",
							"select_room_type"=>"select_room_type",
							"select_room"=>"select_room",
							"select_office"=>"select_office"
	      		 	);
      		 		/*echo form_error($em_name["in_article"]);
      		 		echo form_error($em_name["se_article_type"]);
      		 		echo form_error($em_name["in_fee_unit_hour"]);
      		 		echo form_error($em_name["in_fee_unit_lump_sum"]);
      		 		echo form_error($em_name["in_fee_over_unit_lump_sum"]);*/
      		 	?>
      			</div>
      			<form role="form" action="?d=manage&c=reserve&m=add" method="post" id="reserve_add" enctype="multipart/form-data" autocomplete="on">  
      			<!--<form role="form" action="?c=test" method="post" id="reserve_add" enctype="multipart/form-data" autocomplete="off">-->
      			
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>ข้อมูลผู้จอง</strong></h3>
					</div>
					<div class="panel-body">
						
						<?php 
						echo $se_person_type;
						echo $se_person;
						echo $se_faculty;
							echo "<fieldset class='scheduler-border'>".$in_faculty."</fieldset>";
						echo $se_department;
							echo "<fieldset class='scheduler-border'>".$in_department."</fieldset>";
						echo $se_job_position;
							echo "<fieldset class='scheduler-border'>".$in_job_position."</fieldset>";
						echo $se_office;
							echo "<fieldset class='scheduler-border'>".$in_office."</fieldset>";
						echo $in_std_id;
						echo $in_phone;
						?>
					</div>
				</div>
				<!-- 
      				<fieldset class="scheduler-border">
						<legend class="scheduler-border">ข้อมูลผู้จอง</legend>
						
						<?php 
						echo $se_person_type;
						echo $se_person;
						echo $se_faculty;
							echo "<fieldset class='scheduler-border'>".$in_faculty."</fieldset>";
						echo $se_department;
							echo "<fieldset class='scheduler-border'>".$in_department."</fieldset>";
						echo $se_job_position;
							echo "<fieldset class='scheduler-border'>".$in_job_position."</fieldset>";
						echo $se_office;
							echo "<fieldset class='scheduler-border'>".$in_office."</fieldset>";
						echo $in_std_id;
						echo $in_phone;
						?>
					</fieldset>
				 -->
				 <div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>มีความประสงค์ขอใช้</strong></h3>
					</div>
					<div class="panel-body">
						<?php 
						echo $se_room_type;
						echo $se_room;
						echo $in_num_of_people;
						echo $te_for_use;
						?>
					</div>
				</div>
				<!-- 
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">มีความประสงค์ขอใช้</legend>
						<?php 
						echo $se_room_type;
						echo $se_room;
						echo $in_num_of_people;
						echo $te_for_use;
						?>
					</fieldset>
				 -->
				 <div class="panel panel-success" >
					<div class="panel-heading">
						<h3 class="panel-title"><strong>ครุภัณฑ์/อุปกรณ์ที่ใช้</strong></h3>
					</div>
					<div class="panel-body" id="used_article">
						<br>
						<div class="checkbox">
						<label>
							<input type="checkbox" name="other_article_checkbox" value="">ครุภัณฑ์/อุปกรณ์เพิ่มเติม
						</label>
						<span>
							<br/>
							<textarea name="other_article" class="form-control "></textarea>
						</span>
						</div>
						
						
					</div>
				</div>
				
				 
				 <div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>ข้อมูลโครงการ</strong></h3>
					</div>
					<div class="panel-body">
						<?php 
						echo $in_project_name;
						?>
					</div>
				</div>
				<!-- 
	      			<fieldset class="scheduler-border">
						<legend class="scheduler-border"></legend>
						<?php 
						echo $in_project_name;
						//echo "<span id='".$em_name["in_article"]."_error' class='hidden'>".form_error($em_name["in_article"])."</span>";
						?>	
					</fieldset>
				 -->	
				
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>กำหนดเวลา</strong></h3>
					</div>
					<div class="panel-body">
						<div class="radio" id="div_time1">
							<label>
								<input type="radio" name="reserve_time" id="reserve_time1" value="reserve_time1">
								<strong>กำหนดระยะเวลารายวัน</strong>
							</label>
						</div>
						<span id="span-time-radio1">
							<div class="radio">
								<label>
									<input type="radio" name="reserve_time-sub1" id="reserve_time1-1" value="reserve_time1-1">
									แบบ วันที่
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="reserve_time-sub1" id="reserve_time1-2" value="reserve_time1-2">
									แบบ คาบเรียน
								</label>
							</div>
						</span>
						
						<span id="span-time1-1">
			                <fieldset class="scheduler-border fieldset-time1-1" >
			                	<legend class="scheduler-border"><span>วันที่</span><span class="daynum">1</span></legend>
				                <label for="input-time1-1-date1">วันที่<span class="red-text">*</span></label>
				                <div class='input-group date datetimepickerBegin-Date1-1'>
				                    <input type='text' class="form-control" name="input-time1-1-date1[]" readonly/>
				                    <span class="input-group-addon">
				                    	<span class=""></span>
				                    </span>
				                </div>
				                <label for="input-begin-time1-1">เวลาเริ่ม <span class="red-text">*</span></label>
								<div class='input-group date datetimepickerBegin-time1'>
				                    <input type='text' class="form-control" name="input-begin-time1-1[]" readonly/>
				                    <span class="input-group-addon">
				                    	<span class=""></span>
				                    </span>
				                </div>
				                <label for="input-end-time1-1">เวลาสิ้นสุด <span class="red-text">*</span></label>
								<div class='input-group date datetimepickerEnd-time1'>
				                    <input type='text' class="form-control" name="input-end-time1-1[]" readonly/>
				                    <span class="input-group-addon">
				                    	<span class=""></span>
				                    </span>
				                </div>
			                </fieldset>
		                	<div class="text-right" ><i style="cursor:pointer;" class="fa fa-plus-square fa-lg" id="add-time1-1"></i> กำหนดวันเพิ่ม</div>
		                </span>
		                <span id="span-time1-2">
			                <fieldset class="scheduler-border fieldset-time1-2" >
			                	<input type='hidden' class="form-control input-period-datetime" name="input-period-datetime-begin1[]"/>
			                	<input type='hidden' class="form-control input-period-datetime" name="input-period-datetime-end1[]"/>
			                	<legend class="scheduler-border"><span>วันที่</span><span class="daynum">1</span></legend>
			                	<label for="input-period-date1">วันที่ <span class="red-text">*</span></label>
			                	<div class='input-group date datetimepickerPeriod-Date1-2'>
				                    <input type='text' class="form-control" name="input-period-date1[]" readonly/>
				                    <span class="input-group-addon">
				                    	<span class=""></span>
				                    </span>
				                </div>
				                <label for="time1-period-begin">คาบเรียนเริ่ม <span class="red-text">*</span></label>
								<div class='form-group'>
				                    <select class="form-control" name="time1-period-begin[]">
				                    	<option value="">เลือกคาบเรียน</option>
				                    	<option value="08:30:00">คาบเรียน 1 (08.30 - )</option>
				                    	<option value="09:20:00">คาบเรียน 2 (09.20 - )</option>
				                    	<option value="10:15:00">คาบเรียน 3 (10.15 - )</option>
				                    	<option value="11:05:00">คาบเรียน 4 (11.05 - )</option>
				                    	<option value="12:00:00">คาบเรียน 5 (12.00 - )</option>
				                    	<option value="12:50:00">คาบเรียน 6 (12.50 - )</option>
				                    	<option value="13:45:00">คาบเรียน 7 (13.45 - )</option>
				                    	<option value="14:35:00">คาบเรียน 8 (14.35 - )</option>
				                    	<option value="15:30:00">คาบเรียน 9 (15.30 - )</option>
				                    	<option value="16:20:00">คาบเรียน 10 (16.20 - )</option>
				                    	<option value="17:15:00">คาบเรียน 11 (17.15 - )</option>
				                    	<option value="18:05:00">คาบเรียน 12 (18.05 - )</option>
				                    	<option value="19:00:00">คาบเรียน 13 (19.00 - )</option>
				                    	<option value="19:50:00">คาบเรียน 14 (19.50 - )</option>
				                    </select>
				                </div>
				                <label for="time1-period-end">คาบเรียนสิ้นสุด <span class="red-text">*</span></label>
								<div class='form-group'>
				                    <select class="form-control" name="time1-period-end[]">
				                    	<option value="">เลือกคาบเรียน</option>
				                    	<option value="09:20:00">คาบเรียน 1 ( - 09.20)</option>
				                    	<option value="10:10:00">คาบเรียน 2 ( - 10.10)</option>
				                    	<option value="11:05:00">คาบเรียน 3 ( - 11.05)</option>
				                    	<option value="11:55:00">คาบเรียน 4 ( - 11.55)</option>
				                    	<option value="12:50:00">คาบเรียน 5 ( - 12.50)</option>
				                    	<option value="13:40:00">คาบเรียน 6 ( - 13.40)</option>
				                    	<option value="14:35:00">คาบเรียน 7 ( - 14.35)</option>
				                    	<option value="15:25:00">คาบเรียน 8 ( - 15.25)</option>
				                    	<option value="16:20:00">คาบเรียน 9 ( - 16.20)</option>
				                    	<option value="17:10:00">คาบเรียน 10 ( - 17.10)</option>
				                    	<option value="18:05:00">คาบเรียน 11 ( - 18.05)</option>
				                    	<option value="18:55:00">คาบเรียน 12 ( - 18.55)</option>
				                    	<option value="19:50:00">คาบเรียน 13 ( - 19.50)</option>
				                    	<option value="20:40:00">คาบเรียน 14 ( - 20.40)</option>
				                    </select>
				                </div>
			                </fieldset>
			                <div class="text-right" ><i style="cursor:pointer;" class="fa fa-plus-square fa-lg" id="add-time1-2"></i> กำหนดวันเพิ่ม</div>
		                </span><!-- span-time1-2 -->
		                
		                
						<div class="radio" id="div_time2">
							<label>
								<input type="radio" name="reserve_time" id="reserve_time2" value="reserve_time2">
								<strong>กำหนดระยะเวลา ระยะยาว</strong>
							</label>
						</div>
						<span id="span-time-radio2">
							<div class="radio">
								<label>
									<input type="radio" name="reserve_time-sub2" id="reserve_time2-1" value="reserve_time2-1">
									แบบ วันที่
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="reserve_time-sub2" id="reserve_time2-2" value="reserve_time2-2">
									แบบ คาบเรียน
								</label>
							</div>
						</span>
						<span id="span-time2">
							<span id="span-time2-1">
				                <fieldset class="scheduler-border fieldset-time2" >
				                	<label for="input-time2-1-date1Begin">วันที่เริ่ม<span class="red-text">*</span></label>
					                <div class='input-group date datetimepickerBegin-Date2-1'>
					                    <input type='text' class="form-control" name="input-time2-1-date1Begin" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
					                <label for="input-time2-1-date1End">วันที่สิ้นสุด<span class="red-text">*</span></label>
					                <div class='input-group date datetimepickerEnd-Date2-1'>
					                    <input type='text' class="form-control" name="input-time2-1-date1End" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
					                <label for="input-begin">เวลาเริ่ม <span class="red-text">*</span></label>
									<div class='input-group date datetimepickerBegin-time2'>
					                    <input type='text' class="form-control" name="input-begin-time2" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
					                <label for="input-begin">เวลาสิ้นสุด <span class="red-text">*</span></label>
									<div class='input-group date datetimepickerEnd-time2'>
					                    <input type='text' class="form-control" name="input-end-time2" readonly/>
					                    <span class="input-group-addon"><span class=""></span>
					                    </span>
					                </div>
					            
				                </fieldset>
			                </span><!-- span-time2-1 -->
			                
			                <span id="span-time2-2">
				                <fieldset class="scheduler-border fieldset-time2-2" >
				                	<input type='hidden' class="form-control input-period-datetime" name="input-period-datetime-begin2"/>
				                	<input type='hidden' class="form-control input-period-datetime" name="input-period-datetime-end2"/>
				                	<legend class="scheduler-border"></legend>
					                <label for="input-time2-1-date1Begin">วันที่เริ่ม<span class="red-text">*</span></label>
					                <div class='input-group date datetimepickerBegin-Date2-2'>
					                    <input type='text' class="form-control" name="input-time2-2-date1Begin" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
					                <label for="input-time2-1-date1End">วันที่สิ้นสุด<span class="red-text">*</span></label>
					                <div class='input-group date datetimepickerEnd-Date2-2'>
					                    <input type='text' class="form-control" name="input-time2-2-date1End" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
					                <label for="time1-period-begin">คาบเรียนเริ่ม <span class="red-text">*</span></label>
									<div class='form-group'>
					                    <select class="form-control" name="time2-period-begin">
					                    	<option value="">เลือกคาบเรียน</option>
					                    	<option value="08:30:00">คาบเรียน 1 (08.30 - )</option>
					                    	<option value="09:20:00">คาบเรียน 2 (09.20 - )</option>
					                    	<option value="10:15:00">คาบเรียน 3 (10.15 - )</option>
					                    	<option value="11:05:00">คาบเรียน 4 (11.05 - )</option>
					                    	<option value="12:00:00">คาบเรียน 5 (12.00 - )</option>
					                    	<option value="12:50:00">คาบเรียน 6 (12.50 - )</option>
					                    	<option value="13:45:00">คาบเรียน 7 (13.45 - )</option>
					                    	<option value="14:35:00">คาบเรียน 8 (14.35 - )</option>
					                    	<option value="15:30:00">คาบเรียน 9 (15.30 - )</option>
					                    	<option value="16:20:00">คาบเรียน 10 (16.20 - )</option>
					                    	<option value="17:15:00">คาบเรียน 11 (17.15 - )</option>
					                    	<option value="18:05:00">คาบเรียน 12 (18.05 - )</option>
					                    	<option value="19:00:00">คาบเรียน 13 (19.00 - )</option>
					                    	<option value="19:50:00">คาบเรียน 14 (19.50 - )</option>
					                    </select>
					                </div>
					                <label for="time1-period-end">คาบเรียนสิ้นสุด <span class="red-text">*</span></label>
									<div class='form-group'>
					                    <select class="form-control" name="time2-period-end">
					                    	<option value="">เลือกคาบเรียน</option>
					                    	<option value="09:20:00">คาบเรียน 1 ( - 09.20)</option>
					                    	<option value="10:10:00">คาบเรียน 2 ( - 10.10)</option>
					                    	<option value="11:05:00">คาบเรียน 3 ( - 11.05)</option>
					                    	<option value="11:55:00">คาบเรียน 4 ( - 11.55)</option>
					                    	<option value="12:50:00">คาบเรียน 5 ( - 12.50)</option>
					                    	<option value="13:40:00">คาบเรียน 6 ( - 13.40)</option>
					                    	<option value="14:35:00">คาบเรียน 7 ( - 14.35)</option>
					                    	<option value="15:25:00">คาบเรียน 8 ( - 15.25)</option>
					                    	<option value="16:20:00">คาบเรียน 9 ( - 16.20)</option>
					                    	<option value="17:10:00">คาบเรียน 10 ( - 17.10)</option>
					                    	<option value="18:05:00">คาบเรียน 11 ( - 18.05)</option>
					                    	<option value="18:55:00">คาบเรียน 12 ( - 18.55)</option>
					                    	<option value="19:50:00">คาบเรียน 13 ( - 19.50)</option>
					                    	<option value="20:40:00">คาบเรียน 14 ( - 20.40)</option>
					                    </select>
					                </div>
				                </fieldset>
		                	</span><!-- span-time2-2 -->
			                <span id="span-day-time2">
					            	<p><strong>ระบุวันที่ต้องการจอง</strong></p>
				                	<div class="checkbox">
										<label>
									    	<input type="checkbox" name="day-time2[]" value="0">อาทิตย์
										</label>
									</div>
									<div class="checkbox">
										<label>
									    	<input type="checkbox" name="day-time2[]" value="1">จันทร์
										</label>
									</div>
									<div class="checkbox">
										<label>
									    	<input type="checkbox" name="day-time2[]" value="2">อังคาร
										</label>
									</div>
									<div class="checkbox">
										<label>
									    	<input type="checkbox" name="day-time2[]" value="3">พุธ
										</label>
									</div>
									<div class="checkbox">
										<label>
									    	<input type="checkbox" name="day-time2[]" value="4">พฤหัสบดี
										</label>
									</div>
									<div class="checkbox">
										<label>
									    	<input type="checkbox" name="day-time2[]" value="5">ศุกร์
										</label>
									</div>
									<div class="checkbox">
										<label>
									    	<input type="checkbox" name="day-time2[]" value="6">เสาร์
										</label>
									</div>
				            </span><!-- span-day-time2 -->
			        	</span><!-- span-time2 -->
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
	<script type="text/javascript" src="<?php echo base_url();?>js/user_profile_script.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/bootstrap3_datetime/js/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/bootstrap3_datetime/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/bootstrap3_datetime/js/locales/bootstrap-datetimepicker.th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.numeric.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	
	<script type="text/javascript">
	<!--

	$(function(){

		
		$.validator.addMethod("phone", function(value, element){
			return this.optional(element) || /^[0]{1}([0-9]{8}|[0-9]{9})+$/.test(value);
		}, "รูปแบบไม่ถูกต้อง.");
		$.validator.addMethod("num_of_people", function(value, element){
			$("#input_num_of_people").val(parseInt(value));
			var new_val=$("#input_num_of_people").val();
			if(parseInt(new_val)>0) return true;
		}, "โปรดระบุจำนวนคนที่เข้าร่วม.");
		$.validator.addMethod("std_id", function(value, element){
			if($("#select_person").val()=='02')//นักศึกษา
			{
				if($("#select_person").val()=='02')//นักศึกษา
				{
					if(value.length<11)return false;
					else return true;
				}
			}
		}, "โปรดกรอกรหัสนักศึกษาอย่างน้อย 11 หลัก");
		$.validator.addMethod("faculty", function(value, element){
			if($("#select_person").val()=='02' || $("#select_person").val()=='01')//02นักศึกษา || 01อาจารย์
			{
				if($("#select_faculty").val()=='') return false;
				else return true;
			}
		}, "โปรดระบุ");
		$.validator.addMethod("otherfaculty", function(value, element){
			if($("#select_faculty").val()=='00')
			{
				if($("#input_faculty").val().length<1) return false;
				else return true;
			}
		}, "โปรดระบุคณะอื่นๆ");
		$.validator.addMethod("department", function(value, element){
			if($("#select_person").val()=='02' || $("#select_person").val()=='01')//02นักศึกษา || 01อาจารย์
			{
				if($("#select_department").val()=='') return false;
				else return true;
			}
		}, "โปรดระบุ");
		$.validator.addMethod("otherdepartment", function(value, element){
			if($("#select_department").val()=='00')
			{
				if($("#input_department").val().length<1) return false;
				else return true;
			}
		}, "โปรดระบุสาขา/งานอื่นๆ");
		$.validator.addMethod("job_position", function(value, element){
			if($("#select_person").val()=='03' || $("#select_person").val()=='01')//03ทั่วไป || 01อาจารย์
			{
				if($("#select_job_position").val()=='') return false;
				else return true;
			}
		}, "โปรดระบุ");
		$.validator.addMethod("otherjob_position", function(value, element){
			if($("#select_job_position").val()=='00')
			{
				if($("#input_job_position").val().length<1) return false;
				else return true;
			}
		}, "โปรดระบุตำแหน่งอื่นๆ");
		$.validator.addMethod("office", function(value, element){
			if($("#select_person").val()=='03')//03ทั่วไป
			{
				if($("#select_office").val()=='') return false;
				else return true;
			}
		}, "โปรดระบุ");
		$.validator.addMethod("otheroffice", function(value, element){
			if($("#select_office").val()=='00')
			{
				if($("#input_office").val().length<1) return false;
				else return true;
			}
		}, "โปรดระบุหน่วยงานอื่นๆ");
		$.validator.addMethod('filesize', function(value, element, param) {
		    // param = size (en bytes) 
		    // element = element to validate (<input>)
		    // value = value of the element (file name)
		    return this.optional(element) || (element.files[0].size <= param) 
		});

		
		$("#reserve_add").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"select_person_type": {
					required:true
				},
				"select_person":{
					required:true
				},
				"input_phone": {
					required:true,
					phone:true
				},
				"select_room_type":{
					required:true
				},
				"select_room":{
					required:true
				},
				"input_num_of_people":{
					required:true,
					num_of_people:true,
					digits:true
				},
				"textarea_for_use":{
					required:true
				},
				"input_project_name":{
					required:true
				},
				"input_std_id":{
					digits:true,
					std_id:true
				},
				"select_faculty":{
					required:true,
					faculty:true
				},
				"input_faculty":{
					otherfaculty:true
				},
				"select_department":{
					required:true,
					department:true
				},
				"input_department":{
					otherdepartment:true
				},
				"select_job_position":{
					job_position:true
				},
				"input_job_position":{
					otherjob_position:true
				},
				"select_office":{
					office:true
				},
				"input_office":{
					otheroffice:true
				},
				"project_file[]":{
					required:true,
					filesize:2097152,
					extension:"docx|doc|pdf"
				}
			},
			messages:{
				"select_person_type": {
					//required:"กรอกๆ"
				}
			}
		});

		/*#################################################
		* จำนวนครุภัณฑ์อุปกรณ์ : เฉพาะตัวเลข 
		###################################################*/
		$(document.body).on('focus', 'input[name="article_num[]"]' ,function(){
			$("input[name='article_num[]']").numeric({ decimal: false, negative: false });
		});

		$(document.body).on('change', 'input[name="article_num[]"]' ,function(){
			//ลบ error เดิมออก
			if($(this).next('label.articlenum-error').length>0) $(this).next("label.articlenum-error").remove();
			//ตรวจสอบ
			if($(this).val().length < 1 || /^[0-9]{1,4}$/.test($(this).val())==false)
			{
				$(this).after("<label class='articlenum-error my-error-class'>โปรดระบุจำนวนที่ถูกต้อง</label>");
			}
			else if(parseInt($(this).val()) > parseInt($(this).parent().prev().children('span').children('span>.has_article_num').text()))
			{
				$(this).after("<label class='articlenum-error my-error-class'>จำนวนอุปกรณ์ที่ระบุมีมากกว่าจำนวนอุปกรณ์ที่มีอยู่</label>");
			}
			else $(this).next("label.articlenum-error").remove();
			
		});
		
		/*#################################################
		* เมื่อ submit form การจอง
		###################################################*/
		$("#reserve_add").submit(function(e){
			$("input[name='input-period-datetime-begin1']").val($("input[name='input-period-date1']").val()+" "+$("select[name='time1-period-begin']").val());
			$("input[name='input-period-datetime-end1']").val($("input[name='input-period-date1']").val()+" "+$("select[name='time1-period-end']").val());
			
			//ตรวจสอบจำนวน อุปกรณ์ที่เลือก
			var checked=0;
			$("input[name='article[]']").each(function(){
				if($(this).is(":checked"))
				{
					checked++;
					//input ที่ผู้ใช้ระบุจำนวนอุปกรณ์
					var user_input_num=$(this).parents().next().children('input');
					//span class = has_article_num ทำหน้าที่เก็บจำนวนอุปกรณ์ไว้ตรวจสอบกับจำนวนที่ผู้ใช้กรอก
					var span_store_num=$(this).parents().children('span').children('span>.has_article_num');
					if(user_input_num.val().length < 1 || /^[0-9]{1,4}$/.test(user_input_num.val())==false)
					{
						$(this).parents().next().children('input').after("<label class='articlenum-error my-error-class'>โปรดระบุจำนวนที่ถูกต้อง</label>");
						e.preventDefault();
					}
					else if(parseInt(user_input_num.val()) > parseInt(span_store_num.text()))
					{
						$(this).parents().next().children('input').after("<label class='articlenum-error my-error-class'>จำนวนอุปกรณ์ที่ระบุมีมากกว่าจำนวนอุปกรณ์ที่มีอยู่</label>");
						e.preventDefault();
					}
					else $(this).parents().next().children('input').next("label.articlenum-error").remove();
				}
			});
			//ถ้าไม่มีการเลือกอุปกรณ์
			if(checked==0)
			{
				if($("input[name='article[]']").length>0)
				{
					$("#used_article").prepend("<label class='article-error my-error-class'>โปรดเลือก</label>");
					e.preventDefault();
				}
			}
			
			//file upload
			$("input[name='project_file[]']").each(function(){
				var maxfilesize=2*1024*1024;//2MB
				var pdf="application/pdf";
				var docx="application/vnd.openxmlformats-officedocument.wordprocessingml.document";
				var doc="application/msword";
				var showtype=0;
				for(var i=0; i<this.files.length; i++)
				{
					if(this.files[i].type==doc){}
					else if(this.files[i].type==docx){}
					else if(this.files[i].type==pdf){}
					else
					{
						//$("label.file-error").remove();
						showtype=1;
						$(this).after("<div><label class='file-error my-error-class'>ตรวจสอบประเภทไฟล์</label></div>");
						e.preventDefault();
					}
					if(this.files[i].size>maxfilesize )//&& showtype==0
					{
						//$("label.file-error").remove();
						$(this).after("<div><label class='file-error my-error-class'>ตรวจสอบขนาดไฟล์</label></div>");
						e.preventDefault();
					}
				}
			});
			
			/*
			* for datetime
			*/
			//จองระยะสั้น
			if($("#reserve_time1").is(":checked"))
			{
				if($("#reserve_time1-1").is(":checked"))
				{
					$("#span-time1-1").show();
					var message=new Array();
					var alertmessage='';
					var begindate=new Array();
					var enddate=new Array();
					var begintime=new Array();
					var endtime=new Array();
					$.each($("input[name='input-time1-1-date1[]']"),function(i,value){
						begindate[i]=match_date($(this).val());
						enddate[i]=match_date($(this).val());
					});
					//ตรวจสอบ pattern ของวัน/เวลา เริ่มต้น
					$.each($("input[name='input-begin-time1-1[]']"),function(i,value){
						//begindate[i]=match_date($(this).val());
						begintime[i]=match_time($(this).val());
					});
					//ตรวจสอบ pattern ของวัน/เวลา สิ้นสุด
					$.each($("input[name='input-end-time1-1[]']"),function(i,value){
						//enddate[i]=match_date($(this).val());
						endtime[i]=match_time($(this).val());
					});
					//ถ้า string length เริ่ม = สิ้นสุด
					if(begindate.length==enddate.length)
					{
						var datestat=0;
						for(var i=0;i<begindate.length;i++)
						{
							//วันเริ่มเท่ากับวันสิ้นสุด มากว่าหรือน้อยกว่าไม่ได้
							if(begindate[i]==enddate[i])
							//if(compare_date(begindate[i],enddate[i]))
							{
									if(!compare_two_time(begintime[i],endtime[i]))
										message[i]="โปรดตรวจสอบ เวลาเริ่มต้น และเวลาสิ้นสุด";
									/*if(begintime[i]==endtime[i])
									{
										message[i]="โปรดตรวจสอบ เวลาเริ่มต้น และเวลาสิ้นสุด";
									}*/
							}
							else 
							{
								message[i]="โปรดตรวจสอบวันเริ่มต้น และวันสิ้นสุด";
							}
						}
					}
					//แสดง error message ในแต่ละ datetime picker
					$.each(message,function(index,val){
						if(val)
						{
							$(".fieldset-time1-1").each(function(){
								if($(this).find('legend>.daynum').text()==(index+1))
								{
									//แสดงต่อจาก .datetimepickerEnd-time1
									$(this).find('.datetimepickerEnd-time1').after("<label class='my-error-class'>"+val+"</label>");
								}
							});
							e.preventDefault();
						}
					});
				}//time1-1 checked
				else if($("#reserve_time1-2").is(":checked"))
				{
					$.each($("input[name='input-period-date1[]']"),function(i,value){
						//check date format dd-mm-yyyy
						if(/(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}/i.test($(this).val()))
						{
							if($("select[name='time1-period-begin[]']").eq(i).val()=="" || $("select[name='time1-period-end[]']").eq(i).val()=="")
							{
								$("select[name='time1-period-end[]']").eq(i).after("<label class='my-error-class'>โปรดเลือกคาบเรียน</label>");
								e.preventDefault();
							}
						}
						else
						{
							$(this).after("<label class='my-error-class'>โปรดเลือกวันที่</label>");
							e.preventDefault();
						}

						if(!compare_two_time($("select[name='time1-period-begin[]']").eq(i).val(),$("select[name='time1-period-end[]']").eq(i).val()))
						{
							$("select[name='time1-period-end[]']").eq(i).after("<label class='my-error-class'>คาบเรียนเริ่มต้นต้องน้อยกว่าคาบเรียนสิ้นสุด</label>");
							e.preventDefault();
						}
						
					});
				}//time1-2 checked
				else
				{
					$("#reserve_time1-2").parent().parent().after("<label class='my-error-class'>โปรดเลือก</label>");
				}
			}
			
			//จองระยะยาว
			else if($("#reserve_time2").is(":checked"))
			{
				if($("#reserve_time2-1").is(":checked"))
				{
					if($("input[name='input-time2-1-date1Begin']").val()=='' || $("input[name='input-time2-1-date1Begin']").val()=='')
					{
						$(".datetimepickerEnd-Date2-1").after("<label class='my-error-class'>โปรดเลือกวัน</label><p class='my-error-class'></p>");
						e.preventDefault();
					}
					if($("input[name='input-begin-time2']").val()!='' || $("input[name='input-end-time2']").val()!='')
					{
						//$("#span-time2").show();
						var alertmessage='';
						//matchdate = ตัดเอาเฉพาะวันที่มาใช้ ได้เป็นรูปแบบ 01-12-2013
						//reverse_date สลับจาก 01-12-2013 เป็น 2013-12-01
						//var begindate=new Date(reverse_date(match_date($("input[name='input-begin-time2']").val())));
						//var enddate=new Date(reverse_date(match_date($("input[name='input-end-time2']").val())));
						var begindate=new Date(reverse_date(match_date($("input[name='input-time2-1-date1Begin']").val())));
						var enddate=new Date(reverse_date(match_date($("input[name='input-time2-1-date1End']").val())));
						var begintime=match_time($("input[name='input-begin-time2']").val()).toString();
						var endtime=match_time($("input[name='input-end-time2']").val()).toString();
						var datestat=0;
						var timestat=0;
						if(begindate<=enddate)
						{
							if(begindate==enddate)
							{
								if(begintime==endtime)
								{
									$(".datetimepickerEnd-time2").after("<label class='my-error-class'>โปรดตรวจสอบ เวลาเริ่มต้น และเวลาสิ้นสุด</label>");
									e.preventDefault();
								}
							}
							//ถ้า เริ่ม น้อยกว่า สิ้นสุด
							else
							{
								//ถ้าเวลาเริ่มมากกว่า แสดง message
								if(begintime>endtime)
								{
									$(".datetimepickerEnd-time2").after("<label class='my-error-class'>โปรดตรวจสอบ เวลาเริ่มต้น และเวลาสิ้นสุด</label>");
									e.preventDefault();
								}
							}
						}
						else
						{
							$(".datetimepickerEnd-Date2-1").after("<label class='my-error-class'>โปรดตรวจสอบวันเริ่มต้น และวันสิ้นสุด</label><br>");
							e.preventDefault();
						}
						
					}
					else
					{
						$(".datetimepickerEnd-time2").after("<label class='my-error-class'>โปรดเลือกเวลา</label>");
						e.preventDefault();
					}
				}
				//แบบคาบเรียน 2-2
				else if($("#reserve_time2-2").is(":checked"))
				{
					if($("input[name='input-time2-2-date1Begin']").val()=='' || $("input[name='input-time2-2-date1End']").val()=='' )
					{
						$(".datetimepickerEnd-Date2-2").after("<label class='my-error-class'>โปรดเลือกวัน</label><p class='my-error-class'></p>");
						e.preventDefault();
					}
					if($("select[name='time2-period-begin']").val()=='' || $("select[name='time2-period-end']").val()=='')
					{
						$("select[name='time2-period-end']").after("<label class='my-error-class'>โปรดเลือกคาบเรียน</label>");
						e.preventDefault();
					}
					else
					{
						var begindate=new Date(reverse_date(match_date($("input[name='input-time2-2-date1Begin']").val())));
						var enddate=new Date(reverse_date(match_date($("input[name='input-time2-2-date1End']").val())));
						if(begindate<=enddate)
						{
							if(begindate==enddate)
							{
								if(!compare_two_time($("select[name='time2-period-begin']").val(),$("select[name='time2-period-end']").val()))
								{
									$("select[name='time2-period-end']").after("<label class='my-error-class'>คาบเรียนเริ่มต้นต้องน้อยกว่าคาบเรียนสิ้นสุด</label>");
									e.preventDefault();
								}
							}
							//ถ้า เริ่ม น้อยกว่า สิ้นสุด
							else
							{
								if(!compare_two_time($("select[name='time2-period-begin']").val(),$("select[name='time2-period-end']").val()))
								{
									$("select[name='time2-period-end']").after("<label class='my-error-class'>คาบเรียนเริ่มต้นต้องน้อยกว่าคาบเรียนสิ้นสุด</label>");
									e.preventDefault();
								}
							}
						}
						else
						{
							$(".datetimepickerEnd-Date2-2").after("<label class='my-error-class'>โปรดตรวจสอบวันเริ่มต้น และวันสิ้นสุด</label><br>");
							e.preventDefault();
						}
					}
				}
				else
				{
					$("#reserve_time2-2").parent().parent().after("<label class='my-error-class'>โปรดเลือก</label>");
				}
				//ตรวจสอบการเลือกวันในสัปดาห์
				var daystat=0;
				$.each($("input[name='day-time2[]']"),function(){
					if($(this).is(':checked')) daystat++;
				});
				//แสดง error ของ การเลือกวันในสัปดาห์
				if(daystat==0)
				{
					$("#span-day-time2").find(".checkbox").last().after("<label class='my-error-class'>โปรดเลือกอย่างน้อยหนึ่งวัน</label>");
					e.preventDefault();
				}
			}
			//แสดง error เมื่อไม่ได้เลือกระยะเวลาการจอง
			else
			{
				$("#div_time1").before("<label class='my-error-class'>โปรดเลือก</label>");
				e.preventDefault();
			}
			
			//------------------------------------------------------
		});//end on submit event

		

		
		
		/*#################################################
		Highlight the <input> <select> 
		If span text length > 0 change input border color to red
		###################################################*/
		<?php 
		foreach ($em_name AS $key=>$value):
		?>
			if($("#<?php echo $em_name[$key];?>_error").text().length>0){
				$("#<?php echo $em_name[$key];?>").css("border","1px solid #bb0000");
			}
		<?php
		endforeach;
		?>
		/*#################################################
		Show bootbox alert after 
		###################################################*/
		<?php 
		if($this->session->flashdata("reserve_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("reserve_message");?>"); 
		<?php
		}?>
		
		/*----------------------------------- 
		* ข้อมูลผู้จอง
		-----------------------------------*/
		/*
		*แสดงข้อมูลบุคคลใน dropdown (Get person list)
		*/
		$("#select_person_type").on("keyup change",function(){
			hide_in_ex();
			//01 = บุคคลภายใน
			if($(this).find("option:selected").val()=="01")
			{
				$("#div_time2").show();
			}
			else
			{
				$("#reserve_time1").click();
				$("#div_time2").hide();
			} 
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=manage&c=reserve&m=select_person_list",
					data:{person_type_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$("#select_person").find("option:gt(0)").remove();
						if(resp.person_list!=null)$("#select_person").append(resp.person_list);
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else
			{
				$("#select_person").find("option:gt(0)").remove();
			}
		});
		/*
		//ถ้ามีการเลือกอยู่แล้วตอนเปิดหน้า ให้ทำการเรียกใช้ event
		if($("#select_person_type").find("option:selected").val()!="")
		{
			$("#select_person_type").trigger("change");
		}
		*/
		
		/*
		*แสดง/ซ่อน คณะ (faculty)
		*/
		//add id to fieldset
		$("#input_faculty").parent('div').parent('fieldset').attr('id','otherfaculty');
		//แสดง/ซ่อน input อื่นๆ
		$("#select_faculty").on("keyup change",function(){
			if($(this).find('option:selected').val()=="00")
			{
				$("#otherfaculty").show();
			}
			else
			{
				$("#input_faculty").val('');
				$("#otherfaculty").hide();
			}
		});

		/*
		*แสดง/ซ่อน สาขา/งาน (department)
		*/
		//add id to fieldset
		$("#input_department").parent('div').parent('fieldset').attr('id','otherdepartment');
		//แสดง/ซ่อน input อื่นๆ
		$("#select_department").on("keyup change",function(){
			if($(this).find('option:selected').val()=="00")
			{$("#otherdepartment").show();}
			else
			{
				$("#input_department").val('');
				$("#otherdepartment").hide();
			}
		});

		/*
		*แสดง/ซ่อน ตำแหน่งงาน (job_position)
		*/
		//add id to fieldset
		$("#input_job_position").parent('div').parent('fieldset').attr('id','otherjob_position');
		//แสดง/ซ่อน input อื่นๆ
		$("#select_job_position").on("keyup change",function(){
			if($(this).find('option:selected').val()=="00")
			{$("#otherjob_position").show();}
			else
			{
				$("#input_job_position").val('');
				$("#otherjob_position").hide();
			}
		});

		/*
		*แสดง/ซ่อน หน่วยงาน (office)
		*/
		//add id to fieldset
		$("#input_office").parent('div').parent('fieldset').attr('id','otheroffice');
		//แสดง/ซ่อน input อื่นๆ
		$("#select_office").on("keyup change",function(){
			if($(this).find('option:selected').val()=="00")
			{$("#otheroffice").show();}
			else
			{
				$("#input_office").val('');
				$("#otheroffice").hide();
			}
		});

		//reset ค่าของข้อมูลบุคคล dropdown
		$("#select_person").on("keyup change",function(){
			$("#select_faculty").val('');
			$("#select_department").val('');
			$("#select_job_position").val('');
			$("#select_office").val('');
		});

		//ซ่อนแสดงเมื่อเลือกบุคคลภายนอก/ภายใน
		hide_in_ex();
		
		//$("#select_person_type").on("keyup change",function(){ hide_in_ex(); });
		$("#select_person").on("keyup change",function(){
			hide_in_ex();
			//อาจารย์
			if($(this).find("option:selected").val()=="01")person_in_staff();
			//student
			else if($(this).find("option:selected").val()=="02")person_in_std();
			//บุคคลภายนอก
			else if($(this).find("option:selected").val()=="03")person_ex();
		});

		/*----------------------------------- 
		* มีความประสงค์ขอใช้
		-----------------------------------*/
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
		//ถ้ามีการเลือกอยู่แล้วตอนเปิดหน้า ให้ทำการเรียกใช้ event
		if($("#select_room_type").find("option:selected").val()!="")
		{
			$("#select_room_type").trigger('change');
		}

		/*----------------------------------- 
		* ครุภัณฑ์/อุปกรณ์ที่ใช้
		-----------------------------------*/

		//ถ้ามีการกรอกเลข 0 ขึ้นต้นจำนวนอุปกรณ์ ให้ลบเลข 0 ตัวหน้าสุดออก
		$(document.body).on('keyup change', 'input[name="article_num[]"]' ,function(){
				var value = $(this).val();
			    value = value.replace(/^(0*)/,"");
			    $(this).val(value);
		});
		
		
		//show/hide ครุภัณฑ์/อุปกรณ์ เพิ่มเติม 
		$("textarea[name='other_article']").hide();
		$("input[name='other_article_checkbox']").click(function(){
			if($(this).is(":checked")) $("textarea[name='other_article']").show();
			else $("textarea[name='other_article']").hide();
		});
		/*
		*แสดงรายชื่ออุปกรณ์ของห้องที่เลือก (Get room_has_article)
		*/
		$("#select_room").on("keyup change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=manage&c=reserve&m=get_room_has_article",
					data:{room_id:$(this).find("option:selected").val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						$.each(resp,function(index,value){
							$("#used_article").prepend(value);
						});
					},
					error:function(error){
						alert("Error : "+error);
					}
				});
			}
			else{}
		});

		/*
		เมื่อมีการเลือกห้องอื่น ให้ลบ checkbox เดิมออก (Remove all checkbox in #used_article)
		*/
		$("#select_room_type , #select_room").on("keyup change",function(){
			$("#used_article").children(".del-checkbox").each(function(){
				$(this).remove();
			});
		});

		/*
		เมื่อคลิกเลือกอุปกรณ์ ถ้ายังไม่มีเลือกอุปกรณ์ใดๆ ให้แสดงข้อความเตือน
		เมื่อมีการเลือกหลังแสดงข้อความเตือนให้ลบข้อความเตือนออก
		*/
		$(document.body).on('click', 'input[name="article[]"]' ,function(){
			var checked=0;
			$("input[name='article[]']").each(function(){
				if($(this).is(":checked"))
				{
					$("label.article-error").remove();
					checked++;
				}
			});
			if(checked==0)
			{
				$("#used_article").prepend("<label class='article-error my-error-class'>โปรดเลือก</label>");
				//e.preventDefault();
			}
		});

		/*
		เมื่อมีการเลือกอุปกรณ์ ให้ทำการเพิ่ม input สำหรับระบุจำนวนอุปกรณ์
		*/
		$(document.body).on('change', '#used_article input[type="checkbox"][name="article[]"]' ,function(){
			if(this.checked)
			{	
				var oldtext=$(this).parent().text();
				var html='<span class="input_num"><br/>ระบุจำนวน';
				html+='<input type="text" name="article_num[]" class="form-control" maxlength="4"></span>';
				$(this).parent().after(html);
			}
			else
			{
				$(this).parent().parent().find('span[class="input_num"]').remove();
			}
		});

		/*----------------------------------- 
		* ข้อมูลเกี่ยวกับโครงการ
		-----------------------------------*/
		//add upload file
		$('#select_person_type').on('change keyup',function(){
			if($(this).find("option:selected").val()=="01")
			{
				if(!$("div").hasClass("div_project_file"))
				{
					var html='<div class="form-group div_project_file">';
					html+='<label for="project_file">ไฟล์เอกสารโครงการ</label>';
					html+='<input type="file" id="project_file" multiple name="project_file[]">';
					html+='</div>';
					//html+='<div class="div_project_file"><i class="fa fa-plus-square fa-lg" id="plusfile"></i></div>';
					$("input#input_project_name").parent().after(html);
				}
			}
			else $(".div_project_file").remove();
		});
		if($('#select_person_type').find("option:selected").val()=="01")
		{
			$('#select_person_type').trigger("change");
		}
		$(document.body).on('click', '#plusfile' ,function(){
			var html='<div class="form-group div_project_file">';
			//html+='<label for="project_file">ไฟล์เอกสารโครงการ</label><i class="fa fa-minus-square fa-lg" id="minusfile"></i>';
			html+='<label for="project_file">ไฟล์เอกสารโครงการ</label>';
			html+='<input type="file" id="project_file" name="project_file[]">';
			html+='</div>';
			$(this).before(html);
		});
		//ลบ input file upload
		$(document.body).on('click', '#minusfile' ,function(){
			$(this).parent().remove();
		});

		
		/*-----------------------------------
		* กำหนดเวลา
		-----------------------------------*/
		//ซ่อนการจองระยะยาว จองระยะยาวให้สำหรับบุคคลภายในเท่านั้น
		$("#div_time2").hide();
		$("#span-time-radio1,#span-time1-1,#span-time1-2").hide();
		$("#reserve_time1").change(function(){
			if($("#reserve_time1").is(":checked"))
			{
				$("#span-time-radio1").show();
				$("#span-time2,#span-time-radio2").hide();
			}
			else $("#span-time-radio1,#span-time1-1,#span-time1-2").hide();
		});
		$("#reserve_time1-1,#reserve_time1-2").change(function(){
			if($("#reserve_time1-1").is(":checked"))
			{
				$("#span-time1-1").show();
				$("#span-time1-2").hide();
				//show popover for calendar button
				$(".datetimepickerBegin-Date1-1 span.input-group-addon").popover({
					content:"คลิกที่นี่เพื่อเลือกวัน/เวลาการจอง",
					placement:"top"
				});
				//show popover and destroy after 7 sec
				$(".datetimepickerBegin-Date1-1 span.input-group-addon").popover('show'),
				setTimeout(function(){
			        $(".datetimepickerBegin-Date1-1 span.input-group-addon").popover('destroy');
			    }, 7000);
			}
			else if($("#reserve_time1-2").is(":checked"))
			{
				$("#span-time1-2").show();
				$("#span-time1-1").hide();
				//show popover for calendar button
				$(".datetimepickerPeriod-Date1-2 span.input-group-addon").popover({
					content:"คลิกที่นี่เพื่อเลือกวันการจอง",
					placement:"top"
				});
				//show popover and destroy after 7 sec
				$(".datetimepickerPeriod-Date1-2 span.input-group-addon").popover('show'),
				setTimeout(function(){
			        $(".datetimepickerPeriod-Date1-2 span.input-group-addon").popover('destroy');
			    }, 7000);
			}
		});
		
		$("#span-time-radio2,#span-time2,#span-day-time2,#span-time2-1,#span-time2-2").hide();
		$("#reserve_time2").change(function(){
			if($("#reserve_time2").is(":checked"))
			{
				$("#span-time-radio2,#span-day-time2,#span-time2").show();
				$("#span-time1,#span-time-radio1,#span-time1-1,#span-time1-2").hide();
			}
			else $("#span-time-radio1,#span-time2-1,#span-time2-2").hide();
			
			/*if($("#reserve_time2").is(":checked"))
			{
				$("#span-time2").show();$("#span-time1-1").hide();
				//show popover for calendar button
				$(".datetimepickerBegin-time2 span.input-group-addon").popover({
					content:"คลิกที่นี่เพื่อเลือกวัน/เวลาการจอง",
					placement:"top"
				});
				//show popover and destroy after 7 sec
				$(".datetimepickerBegin-time2 span.input-group-addon").popover('show'),
				setTimeout(function () {
			        $(".datetimepickerBegin-time2 span.input-group-addon").popover('destroy');
			    }, 7000);
			}
			else $("#span-time2").hide();*/
		});
		$("#reserve_time2-1,#reserve_time2-2").change(function(){
			if($("#reserve_time2-1").is(":checked"))
			{
				$("#span-time2-1").show();
				$("#span-time2-2").hide();
				
				//show popover for calendar button
				$(".datetimepickerBegin-Date2-1 span.input-group-addon").popover({
					content:"คลิกที่นี่เพื่อเลือกวันการจอง",
					placement:"top"
				});
				//show popover and destroy after 7 sec
				$(".datetimepickerBegin-Date2-1 span.input-group-addon").popover('show'),
				setTimeout(function(){
			        $(".datetimepickerBegin-Date2-1 span.input-group-addon").popover('destroy');
			    }, 7000);
			}
			else if($("#reserve_time2-2").is(":checked"))
			{
				$("#span-time2-2").show();
				$("#span-time2-1").hide();
				//show popover for calendar button
				$(".datetimepickerPeriod-Date2-2 span.input-group-addon").popover({
					content:"คลิกที่นี่เพื่อเลือกวันการจอง",
					placement:"top"
				});
				//show popover and destroy after 7 sec
				$(".datetimepickerPeriod-Date2-2 span.input-group-addon").popover('show'),
				setTimeout(function(){
			        $(".datetimepickerPeriod-Date2-2 span.input-group-addon").popover('destroy');
			    }, 7000);
			}
		});

		
		$(document.body).on('click', '#del-time1-1' ,function(){
			$(this).parent().parent().remove();
		});
		$(document.body).on('click', '#del-time1-2' ,function(){
			$(this).parent().parent().remove();
		});
		//คลิกเพิ่ม ช่องกำหนดเวลาของ reserve-time1-1
		$('#add-time1-1').click(function(){
			//destroy popover
			$(".datetimepickerBegin-time1 span.input-group-addon").popover('destroy');

			var num=parseInt($('.fieldset-time1-1').last().find('legend>.daynum').text())+1;
			//$('.fieldset-time1-1:first').clone().appendTo('#span-time1-1');
			$('.fieldset-time1-1').last().after($('.fieldset-time1-1:first').clone());
			$('.fieldset-time1-1').last().find('div input[class="form-control"]').val('');	
			$('.fieldset-time1-1').last().find('legend>.daynum').text(num);
			$('.fieldset-time1-1').last().find('label.my-error-class').remove();
			$('<br><div class="text-right"><i style="cursor:pointer;" class="fa fa-minus-square fa-lg" id="del-time1-1"></i> ลบ</div>').appendTo('.fieldset-time1-1:last');
			init_datetimepicker();
		});
		//คลิกเพิ่ม ช่องกำหนดเวลาของ reserve-time1-2
		$('#add-time1-2').click(function(){
			//destroy popover
			$(".datetimepickerPeriod-Date1-2 span.input-group-addon").popover('destroy');

			var num=parseInt($('.fieldset-time1-2').last().find('legend>.daynum').text())+1;
			//$('.fieldset-time1-2:first').clone().appendTo('#span-time1-2');
			$('.fieldset-time1-2').last().after($('.fieldset-time1-2:first').clone());
			$('.fieldset-time1-2').last().find('div input[class="form-control"]').val('');	
			$('.fieldset-time1-2').last().find('legend>.daynum').text(num);
			$('.fieldset-time1-2').last().find('label.my-error-class').remove();
			$('<div class="text-right"><i style="cursor:pointer;" class="fa fa-minus-square fa-lg" id="del-time1-2"></i> ลบ</div>').appendTo('.fieldset-time1-2:last');
			init_datetimepicker();
		});
		init_datetimepicker();
		

		//------------------------------------------------------

		/**
		* Disabled spacebar
		*/
		$("input[type='text']:not(#input_project_name)").keydown(function(e){
			if(e.keyCode==32)
			{
				return false;
			}
		});

		/**
		* disabled unwanted characters
		*/
		$("#input_phone").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9]/gi,''));
		});
		$("#input_std_id,#input_num_of_people").on("keydown keyup",function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9]/gi,''));
		});
		$(document.body).on('keydown keyup', 'input[name="article_num[]"]' ,function(){
			var name = $(this).val();
			$(this).val(name.replace(/[^0-9]/gi,''));
		});
		
		/**
		* คำแนะนำ การกรอกข้อมูล
		*/
		$("#input_phone").prev().before('<span id="input_phone_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_phone_hint").click(function(){
			bootbox.alert("\
					<strong>เบอร์โทรศัพท์ที่ติดต่อได้</strong><br>\
					- กรอกได้เฉพาะตัวเลข<br>\
					ตัวอย่าง 0881234567\
					");
		});
		$("#input_num_of_people").prev().before('<span id="input_num_of_people_hint"><i class="fa fa-question-circle pointer"></i></span> ');
		$("#input_num_of_people_hint").click(function(){
			bootbox.alert("\
					<strong>จำนวนคนที่เข้าร่วม</strong><br>\
					- กรอกได้เฉพาะตัวเลข<br>\
					ตัวอย่าง 5, 40, 100\
					");
		});
	});
	//ซ่อนแสดงเมื่อเลือกบุคคลภายนอก/ภายใน
	function hide_in_ex()
	{
		$("#select_faculty").parent().hide();
		$("#select_department").parent().hide();
		$("#select_job_position").parent().hide();
		$("#input_std_id").parent().hide();
		$("#select_office").parent().hide();
		$("#otherfaculty").hide();
		$("#otherdepartment").hide();
		$("#otherjob_position").hide();
		$("#otheroffice").hide();
	}
	//บุคคลภายใน เจ้าหน้าที่
	function person_in_staff()
	{
		$("#select_faculty").parent().show();
		$("#select_department").parent().show();
		$("#select_job_position").parent().show();
	}
	//บุคคลภายใน นศ
	function person_in_std()
	{
		$("#select_faculty").parent().show();
		$("#select_department").parent().show();
		$("#input_std_id").parent().show();
	}
	//บุคคลภายนอก
	function person_ex()
	{
		$("#select_job_position").parent().show();
		$("#select_office").parent().show();
	}

	/*#################################################
	* for datetime
	###################################################*/
	function init_datetimepicker()
	{
		$('.datetimepickerBegin-Date1-1,.datetimepickerBegin-Date2-1,.datetimepickerEnd-Date2-1,.datetimepickerBegin-Date2-2,.datetimepickerEnd-Date2-2').datetimepicker({
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
		$('.datetimepickerBegin-time1,.datetimepickerBegin-time2').datetimepicker({
			pickDate:false,
			pick12HourFormat: false,
            language: 'th',
            icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			},
			format:"LT"
        });
		$('.datetimepickerEnd-time1,.datetimepickerEnd-time2').datetimepicker({
			pickDate:false,
			pick12HourFormat: false,
            language: 'th',
            icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			},
			format:"LT"
        });
		/*$('.datetimepickerBegin-time2').datetimepicker({
			pick12HourFormat: false,
            language: 'th',
            icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			},
			format:"LLLL"
        });
		$('.datetimepickerEnd-time2').datetimepicker({
			pick12HourFormat: false,
            language: 'th',
            icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			},
			format:"LLLL"
        });*/
		
		$('.datetimepickerPeriod-Date1-2,.datetimepickerPeriod-Date2-2').datetimepicker({
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
	function match_date(in_date)
	{
		var dateval;
		if(in_date.match(/(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}/))
			dateval=in_date.match(/(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}/)[0];
		//else dateval='';
		return dateval;
	}
	function match_time(in_time)
	{
		var timeval;
		var regex=/(0[0-9]|1[0-9]|2[0-4]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0])/;
		if(in_time.match(regex))
			timeval=in_time.match(regex)[0];
		//else timeval='';
		return timeval;
	}
	function compare_date(begindate,enddate)
	{
		if(begindate<=enddate)return true;
		else return false;
	}
	function reverse_date(inDate)
	{
		var a = inDate.split("-");
		a.reverse();
		var reversed = a.join("-");
		return reversed;
	}
	
	/*
	* compare two time format like : hh:ii:ss
	* bt = beginTime, et=endTime
	*/
	function compare_two_time(bt, et)
	{
		if(typeof(bt)==='undefined') bt = '';
		if(typeof(et)==='undefined') et = '';
		var hBegin=bt.substr(0,2);
		var hEnd=et.substr(0,2);
		var iBegin=bt.substr(3,2);
		var iEnd=et.substr(3,2);
		var sBegin=bt.substr(6,2); 
		var sEnd=et.substr(6,2);
		if(hBegin<hEnd) return true;
		else if(hBegin==hEnd)
		{
			if(iBegin<iEnd) return true;
			else return false;
		}
		else return false;
	}
	//------------------------------------------------------
	
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;