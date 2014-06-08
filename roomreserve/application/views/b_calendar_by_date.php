
<?php 

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
		#table_bydate2{
			border:1px solid #ccc;
		}
		#table_bydate2 th, tr, td{
			border:1px solid #ccc;
			padding:0;
		}
		#table_bydate2 tr:nth-child(1) td{
			width:45px;
			overflow: hidden;
			text-align:center;
		}
		div[id^="divcontent2-"]:hover,div[id*=" divcontent2-"]:hover{
			background-color:#fff;
			cursor:pointer;
		}
		div[id^="divcontent2-"],div[id*=" divcontent2-"]{
			text-align:center;
			white-space: nowrap;
			overflow:hidden;
			position:absolute;
			border:1px solid #E4EFF8;
			background-color:#E4EFF8;
			box-shadow:inset 1px 1px 0 rgba(0,0,0,.1),inset -1px -1px 0 rgba(0,0,0,.07);
			!border-width:0 0 0 7px;
			text-overflow: ellipsis;
			line-height:2em;
		}
		.fleft{
			float:left;
			border:solid 1px #ccc;
			text-align:center;
			position:absolute;
			z-index:99;
		}
		.pd{
			background-color:#E4EFF8;
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
      	<?php //echo $titlename_tab;?>				
      		 	<h3><span id="cdate"></span></h3>
      			<div>
      					<div class="fleft"><strong>คาบเรียนที่</strong></div>
      					<div class="fleft pd pointer" id="pd01">1</div>
      					<div class="fleft pd pointer" id="pd02">2</div>
      					<div class="fleft pd pointer" id="pd03">3</div>
      					<div class="fleft pd pointer" id="pd04">4</div>
      					<div class="fleft pd pointer" id="pd05">5</div>
      					<div class="fleft pd pointer" id="pd06">6</div>
      					<div class="fleft pd pointer" id="pd07">7</div>
      					<div class="fleft pd pointer" id="pd08">8</div>
      					<div class="fleft pd pointer" id="pd09">9</div>
      					<div class="fleft pd pointer" id="pd10">10</div>
      					<div class="fleft pd pointer" id="pd11">11</div>
      					<div class="fleft pd pointer" id="pd12">12</div>
      					<div class="fleft pd pointer" id="pd13">13</div>
      					<div class="fleft pd pointer" id="pd14">14</div>
      				<br>
					<table id="table_bydate2">
						
						<tr>
							<td id="00">00.00</td>
							<td id="01">01.00</td>
							<td id="02">02.00</td>
							<td id="03">03.00</td>
							<td id="04">04.00</td>
							<td id="05">05.00</td>
							<td id="06">06.00</td>
							<td id="07">07.00</td>
							<td id="08">08.00</td>
							<td id="09">09.00</td>
							<td id="10">10.00</td>
							<td id="11">11.00</td>
							<td id="12">12.00</td>
							<td id="13">13.00</td>
							<td id="14">14.00</td>
							<td id="15">15.00</td>
							<td id="16">16.00</td>
							<td id="17">17.00</td>
							<td id="18">18.00</td>
							<td id="19">19.00</td>
							<td id="20">20.00</td>
							<td id="21">21.00</td>
							<td id="22">22.00</td>
							<td id="23">23.00</td>
						</tr>
						<tr>
							<td colspan="24" class="content2"></td>
						</tr>
					</table>
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
	
	$(function(){
		
		//reverse Date from Y-m-d to d-m-Y
		var thday = new Array ("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัส","ศุกร์","เสาร์"); 
		var a = new Date(getParameterByName("cdate"));
		var date_array=getParameterByName("cdate").split('-');
		date_array.reverse();//Y-m-d to d-m-Y
		//var date_reversed=date_array.join('-');
		$("#cdate").text("วัน"+thday[a.getDay()]+" "+dateToText(date_array[0],date_array[1],date_array[2]));

		var period_time = new Array(
				"8.30 น. - 9.20 น.",//1
				"9.20 น. - 10.10 น.",//2
				"10.15 น. - 11.05 น.",//3
				"11.05 น. - 11.55 น.",//4
				"12.00 น. - 12.50 น.",//5
				"12.50 น. - 13.40 น.",//6
				"13.45 น. - 14.35 น.",//7
				"14.35 น. - 15.25 น.",//8
				"15.30 น. - 16.20 น.",//9
				"16.20 น. - 17.10 น.",//10
				"17.15 น. - 18.05 น.",//11
				"18.05 น. - 18.55 น.",//12
				"19.00 น. - 19.50 น.",//13
				"19.50 น. - 20.40 น."//14
				);

		//create event show period detail
		<?php
		 for($i=1; $i<=14; $i++):
		 	if($i<=9):
		?>
				$("#pd0<?=$i?>").click(function(){
					bootbox.dialog({
						message: period_time[<?=$i-1?>],
						title: "คาบเรียนที่ <?=$i?>",
						buttons: {
							success: {
								label: "ตกลง",
								className: "btn-primary",
								callback: function() {
		
								}
							}
						}
					});
				});
		<?php
			else:
		?>
				$("#pd<?=$i?>").click(function(){
					bootbox.dialog({
						message: period_time[<?=$i-1?>],
						title: "คาบเรียนที่ <?=$i?>",
						buttons: {
							success: {
								label: "ตกลง",
								className: "btn-primary",
								callback: function() {
		
								}
							}
						}
					});
				});
		<?php endif ?>
		<?php endfor; ?>
		
		var likedate=getParameterByName("cdate");
		var dateRegex = /[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/;
		if(dateRegex.test(likedate)==true)
		{
			var content2_height=0;
			
			//set period position1
			var w_td = $("#table_bydate2").width()/24;
			var ratio = w_td/60;//เดิมสูง 60px =60 min | width per minute
			$(".pd").width(ratio*50);
			$("#pd01").offset({left:($("td#08").offset().left+(30*ratio))});
			$("#pd02").offset({left:($("td#09").offset().left+(20*ratio))});
			$("#pd03").offset({left:($("td#10").offset().left+(15*ratio))});
			$("#pd04").offset({left:($("td#11").offset().left+(5*ratio))});
			$("#pd05").offset({left:($("td#12").offset().left+(0*ratio))});
			$("#pd06").offset({left:($("td#12").offset().left+(50*ratio))});
			$("#pd07").offset({left:($("td#13").offset().left+(45*ratio))});
			$("#pd08").offset({left:($("td#14").offset().left+(35*ratio))});
			$("#pd09").offset({left:($("td#15").offset().left+(30*ratio))});
			$("#pd10").offset({left:($("td#16").offset().left+(20*ratio))});
			$("#pd11").offset({left:($("td#17").offset().left+(15*ratio))});
			$("#pd12").offset({left:($("td#18").offset().left+(5*ratio))});
			$("#pd13").offset({left:($("td#19").offset().left+(0*ratio))});
			$("#pd14").offset({left:($("td#19").offset().left+(50*ratio))});
			
			
			$.ajax({
				url:"?c=b_calendar&m=getdatetime",
				data:{likedate:likedate},
				type:"POST",
				dataType:"json",
				success:function(resp){
					$.each(resp,function(i,item)
					{
						var room_name=resp[i].room_name;
						var	sBegin=resp[i].reserve_datetime_begin;
						var sEnd=resp[i].reserve_datetime_end;
						var year_start=sBegin.substr(0,4);
						var year_end=sEnd.substr(0,4);
							var month_start=sBegin.substr(5,2);
							var month_end=sEnd.substr(5,2);
								var date_start=sBegin.substr(8,2);
								var date_end=sEnd.substr(8,2);
						var hour_start=sBegin.substr(11,2);
						var hour_end=sEnd.substr(11,2);
							var min_start_string=sBegin.substr(14,2);
							var min_start=parseInt(sBegin.substr(14,2));
							var min_end_string=sEnd.substr(14,2);
							var min_end=parseInt(sEnd.substr(14,2));
	
						//var startDate = new Date(date_start+"/"+month_start+"/"+year_start+" "+hour_start+":"+min_start+":0");
						//var endDate = new Date(date_end+"/"+month_end+"/"+year_end+" "+hour_end+":"+min_end+":0");
						var startDate = new Date(year_start,month_start,date_start,hour_start,min_start);
						var endDate = new Date(year_end,month_end,date_end,hour_end,min_end);
	
						var diff=endDate-startDate; //diff in milliseconds
						s=diff;
						var ms = s % 1000;
						s = (s - ms) / 1000;
						var secs = s % 60;
						s = (s - secs) / 60;

						var a = $("#table_bydate2").parent().width();
						$("#table_bydate2 tr:nth-child(1) td").width(a/24);
						var w_td = $("#table_bydate2").width()/24;
						var ratio = w_td/60;//เดิมสูง 60px =60 min | width per minute
						
						//set period position2
						$(".pd").width(ratio*50);
						$("#pd01").offset({left:($("td#08").offset().left+(30*ratio))});
						$("#pd02").offset({left:($("td#09").offset().left+(20*ratio))});
						$("#pd03").offset({left:($("td#10").offset().left+(15*ratio))});
						$("#pd04").offset({left:($("td#11").offset().left+(5*ratio))});
						$("#pd05").offset({left:($("td#12").offset().left+(0*ratio))});
						$("#pd06").offset({left:($("td#12").offset().left+(50*ratio))});
						$("#pd07").offset({left:($("td#13").offset().left+(45*ratio))});
						$("#pd08").offset({left:($("td#14").offset().left+(35*ratio))});
						$("#pd09").offset({left:($("td#15").offset().left+(30*ratio))});
						$("#pd10").offset({left:($("td#16").offset().left+(20*ratio))});
						$("#pd11").offset({left:($("td#17").offset().left+(15*ratio))});
						$("#pd12").offset({left:($("td#18").offset().left+(5*ratio))});
						$("#pd13").offset({left:($("td#19").offset().left+(0*ratio))});
						$("#pd14").offset({left:($("td#19").offset().left+(50*ratio))});
						
						$(".content2").append("<div id='divcontent2-"+i+"' class='divbydate-"+resp[i].datetime_id+"'>"+room_name+" "+hour_start+":"+min_start_string+" - "+hour_end+":"+min_end_string+"</div>");
						
						$("#divcontent2-"+i).offset({left:($("td#"+hour_start).offset().left+(min_start*ratio)),top:($("#table_bydate2 tr:nth-child(1)").offset().top+$("#table_bydate2 tr:nth-child(1)").height())});
						
						if($("#divcontent2-"+(i-1)).length > 0)
						{
							var prev_pos=$("#divcontent2-"+(i-1)).offset().top+$("#divcontent2-"+(i-1)).height();
							$("#divcontent2-"+i).offset({left:($("td#"+hour_start).offset().left+(min_start*ratio)),top:prev_pos});
						}
						//width each td = 47px (47/60=0.78333333)
						$("#divcontent2-"+i).css({width:(s*ratio)});
						content2_height+=$("#divcontent2-"+i).height();

						
						//show reserve detail
						$("#divcontent2-"+i).bind("click",function(){
							$.ajax({
								url:"?c=b_calendar&m=get_datetime_detail",
								data:{datetime_id:resp[i].datetime_id},
								type:"POST",
								dataType:"json",
								success:function(rs){
									//var begin = convert_datetimeEN2TH(rs.reserve_datetime_begin);
									//var end = convert_datetimeEN2TH(rs.reserve_datetime_end);
									var text='\
										<dl class="dl-horizontal">\
											<dt>รหัส</dt>\
											<dd>'+rs.reserve_id+'</dd>\
											<dt>ชื่อห้อง</dt>\
											<dd>'+rs.room_name+'</dd>\
											<dt>เริ่ม</dt>\
											<dd>'+rs.reserve_datetime_begin+'</dd>\
											<dt>สิ้นสุด</dt>\
											<dd>'+rs.reserve_datetime_end+'</dd>\
											<dt>ชื่อโครงการ</dt>\
											<dd>'+rs.project_name+'</dd>\
											<dt>จำนวนคน</dt>\
											<dd>'+rs.num_of_people+' คน</dd>\
											<dt></dt>\
											<dd></dd>\
											<dt></dt>\
											<dd></dd>\
											<dt></dt>\
											<dd></dd>\
											<dt></dt>\
											<dd></dd>\
											<dt></dt>\
											<dd></dd>\
											<dt></dt>\
											<dd></dd>\
											<dt></dt>\
											<dd></dd>\
										</dl>\
									';
									bootbox.dialog({
										message: text,
										title: "",
										buttons: {
											success: {
												label: "ตกลง",
												className: "btn-primary",
												callback: function() {

												}
											},
											danger: {
												label: "รายละเอียดเพิ่มเติม",
												className: "btn-primary",
												callback: function() {
													window.open("<?php echo base_url();?>?d=manage&c=reserve&m=view&id="+rs.reserve_id,"_blank");
												}
											}
										}
									});
								},
								error:function(error){

								}
							});//ajax
						});//on click
					});//each
					$("td.content2").height(content2_height+2);
					
					
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
			
		}//end if test regex
	});
	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	function dateToText(d,m,y)
	{
		var thmonth = new Array ("","มกราคม","กุมภาพันธ์","มีนาคม",
				"เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
				"ตุลาคม","พฤศจิกายน","ธันวาคม"); 
		return parseInt(d)+" "+thmonth[parseInt(m)]+" "+(parseInt(y)+543);
	}
	function convert_datetimeEN2TH(date_time)
	{
		var date1 = date_time.match(/\d\d\d\d\-\d\d\-\d\d/).toString();
		date1 = date1.split('-');
		date1 = date1[2]+"/"+date1[1]+"/"+(parseInt(date1[0])+543)
		var time1 = date_time.match(/\d\d\:\d\d\:\d\d/);
		var dt = new Array();
		dt["date"] = date1;
		dt["time"] = time1;
		return dt;
	}
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;