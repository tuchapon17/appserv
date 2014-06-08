<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$fl=$ci->function_lib;
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
      		<div class="col-lg-8 col-lg-offset-2" id="loginform">
      			<br>
      			<form action="" method="post" id="reserve_edit_datetime" autocomplete="off">
	      			<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>แก้ไขระยะเวลา</strong></h3>
						</div>
						<div class="panel-body">
			      			<span id="span-time-radio1">
			      				<p><strong>รหัสการจอง</strong>&nbsp;&nbsp;<?php echo $nr[0]["tb_reserve_id"];?></p>
			      				<p><strong>ชื่อโครงการ</strong>&nbsp;&nbsp;<?php echo $nr[0]["project_name"];?></p>
			      				<p><strong>ระยะเวลาเดิม</strong>&nbsp;&nbsp;<?php echo $fl->date1_time2($nr[0]["reserve_datetime_begin"], $nr[0]['reserve_datetime_end']);?></p>
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
				                	<legend class="scheduler-border"></legend>
					                <label for="input-time1-1-date1">วันที่<span class="red-text">*</span></label>
					                <div class='input-group date datetimepickerBegin-Date1-1'>
					                    <input type='text' class="form-control" name="input-time1-1-date1" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
					                <label for="input-begin-time1-1">เวลาเริ่ม <span class="red-text">*</span></label>
									<div class='input-group date datetimepickerBegin-time1'>
					                    <input type='text' class="form-control" name="input-begin-time1-1" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
					                <label for="input-end-time1-1">เวลาสิ้นสุด <span class="red-text">*</span></label>
									<div class='input-group date datetimepickerEnd-time1'>
					                    <input type='text' class="form-control" name="input-end-time1-1" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
				                </fieldset>
			                </span><!-- span-time1-1 -->
			                <span id="span-time1-2">
				                <fieldset class="scheduler-border fieldset-time1-2" >
				                	<input type='hidden' class="form-control input-period-datetime" name="input-period-datetime-begin1"/>
				                	<input type='hidden' class="form-control input-period-datetime" name="input-period-datetime-end1"/>
				                	<legend class="scheduler-border"></legend>
				                	<label for="input-period-date1">วันที่ <span class="red-text">*</span></label>
				                	<div class='input-group date datetimepickerPeriod-Date1-2'>
					                    <input type='text' class="form-control" name="input-period-date1" readonly/>
					                    <span class="input-group-addon">
					                    	<span class=""></span>
					                    </span>
					                </div>
					                <label for="time1-period-begin">คาบเรียนเริ่ม <span class="red-text">*</span></label>
									<div class='form-group'>
					                    <select class="form-control" name="time1-period-begin">
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
					                    <select class="form-control" name="time1-period-end">
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
			                </span><!-- span-time1-2 -->
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
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		
		$("#span-time1-1,#span-time1-2").hide();
		$("#reserve_time1-1,#reserve_time1-2").change(function(){
			if($("#reserve_time1-1").is(":checked"))
			{
				$("#span-time1-1").show();
				$("#span-time1-2").hide();
				//show popover for calendar button
				$(".datetimepickerBegin-Date1-1 span.input-group-addon").popover({
					content:"คลิกที่นี่เพื่อเลือกวัน/เวลา",
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
					content:"คลิกที่นี่เพื่อเลือกวัน",
					placement:"top"
				});
				//show popover and destroy after 7 sec
				$(".datetimepickerPeriod-Date1-2 span.input-group-addon").popover('show'),
				setTimeout(function(){
			        $(".datetimepickerPeriod-Date1-2 span.input-group-addon").popover('destroy');
			    }, 7000);
			}
		});
		init_datetimepicker();

		$("#reserve_edit_datetime").submit(function(e){
			$("label.my-error-class").remove();
			if($("#reserve_time1-1").is(":checked"))
			{
				$("#span-time1-1").show();
				var message=new Array();
				var alertmessage='';
				var begindate=new Array();
				var enddate=new Array();
				var begintime=new Array();
				var endtime=new Array();
				
				$.each($("input[name='input-time1-1-date1']"),function(i,value){
					begindate[i]=match_date($(this).val());
					enddate[i]=match_date($(this).val());
				});
				//ตรวจสอบ pattern ของวัน/เวลา เริ่มต้น
				$.each($("input[name='input-begin-time1-1']"),function(i,value){
					//begindate[i]=match_date($(this).val());
					begintime[i]=match_time($(this).val());
				});
				//ตรวจสอบ pattern ของวัน/เวลา สิ้นสุด
				$.each($("input[name='input-end-time1-1']"),function(i,value){
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
						//$(".fieldset-time1-1").each(function(){
							//if($(this).find('legend>.daynum').text()==(index+1))
							//{
								//แสดงต่อจาก .datetimepickerEnd-time1
								$('.datetimepickerEnd-time1').after("<label class='my-error-class'>"+val+"</label>");
							//}
						//});
						e.preventDefault();
					}
				});
			}//time1-1 checked
			else if($("#reserve_time1-2").is(":checked"))
			{
				$.each($("input[name='input-period-date1']"),function(i,value){
					//check date format dd-mm-yyyy
					if(/(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}/i.test($(this).val()))
					{
						if($("select[name='time1-period-begin']").eq(i).val()=="" || $("select[name='time1-period-end']").eq(i).val()=="")
						{
							$("select[name='time1-period-end']").eq(i).after("<label class='my-error-class'>โปรดเลือกคาบเรียน</label>");
							e.preventDefault();
						}
					}
					else
					{
						$(this).after("<label class='my-error-class'>โปรดเลือกวันที่</label>");
						e.preventDefault();
					}

					if(!compare_two_time($("select[name='time1-period-begin']").eq(i).val(),$("select[name='time1-period-end']").eq(i).val()))
					{
						$("select[name='time1-period-end']").eq(i).after("<label class='my-error-class'>คาบเรียนเริ่มต้นต้องน้อยกว่าคาบเรียนสิ้นสุด</label>");
						e.preventDefault();
					}
				});
			}//time1-2 checked
			else
			{
				$("#reserve_time1-2").parent().parent().after("<label class='my-error-class'>โปรดเลือก</label>");
				e.preventDefault();
			}
		});//on form submit
	});
	function init_datetimepicker()
	{
		$('.datetimepickerBegin-Date1-1').datetimepicker({
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
		$('.datetimepickerBegin-time1').datetimepicker({
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
		$('.datetimepickerEnd-time1').datetimepicker({
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
		$('.datetimepickerPeriod-Date1-2').datetimepicker({
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
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;
//แสดง วดป เวลา ให้สั้นลง
function compress_two_datetime($dateB, $dateE)
{
	$dateBegin=substr($dateB,0,10);
	$dateEnd=substr($dateE,0,10);
	$timeBegin=substr($dateB,11,8);
	$timeEnd=substr($dateE,11,8);
	//ถ้าวันเหมือนกัน แสดงวันเพียงครั้งเดียว
	if($dateBegin==$dateEnd)
	{
		return $timeBegin." - ".$timeEnd." (".$dateBegin.")";
	}
	else
	{
		return $timeBegin." (".$dateBegin.") - ".$timeEnd." (".$dateEnd.")";
	}
}