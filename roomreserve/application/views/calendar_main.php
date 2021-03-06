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
		/*
		.table-calendar{
			!width:100%;
			border:1px solid #ccc;
		}
		.table-calendar td,th{
			width:120px;
			border:1px solid #ccc;
		}
		.table-calendar th{
			text-align:center;
		}
		.table-calendar tr:nth-child(2){
			text-align:center;
			font-weight:bold;
		}
		.table-calendar tr td:first-child, tr td:last-child{
			width:120px;
		}
		.table-calendar tr:nth-child(3) td,tr:nth-child(4) td,tr:nth-child(5) td,tr:nth-child(6) td,tr:nth-child(7) td,tr:nth-child(8) td{
			height:100px;
			text-align:right;
			vertical-align:top;
		}*/
		.highlight{
			font-weight:bold;
			text-decoration:underline;
		}
		.table-calendar tr td:last-child{
			color:red;
		}
		.table-calendar tr:nth-child(2){
			font-weight:bold;
		}
		.table-calendar tr td:first-child, tr td:last-child{
			width:auto;
		}
		
		
		.table-calendar {
		overflow:hidden;
		border:1px solid #d3d3d3;
		background:#fefefe;
		width:100%;
		margin:0% auto 0;
		-moz-border-radius:5px; /* FF1+ */
		-webkit-border-radius:5px; /* Saf3-4 */
		border-radius:5px;
		!-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
		!-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
		}
	
		.table-calendar th, td {padding:0px; text-align:center; }
		
		.table-calendar th {padding-top:0px; !background:#e8eaeb;}
		
		.table-calendar td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
		
		.table-calendar tr {}
		
		.table-calendar td.first, th.first {!text-align:left}
		
		.table-calendar td.last {border-right:none;}
		
		/*
		I know this is annoying, but we need additional styling so webkit will recognize rounded corners on background elements.
		Nice write up of this issue: http://www.onenaught.com/posts/266/css-inner-elements-breaking-border-radius
		
		And, since we've applied the background colors to td/th element because of IE, Gecko browsers also need it.
		*/
		
		.table-calendar tr:first-child th.first {
			-moz-border-radius-topleft:5px;
			-webkit-border-top-left-radius:5px; /* Saf3-4 */
		}
		
		.table-calendar tr:first-child th.last {
			-moz-border-radius-topright:5px;
			-webkit-border-top-right-radius:5px; /* Saf3-4 */
		}
		
		.table-calendar tr:last-child td.first {
			-moz-border-radius-bottomleft:5px;
			-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
		}
		
		.table-calendar tr:last-child td.last {
			-moz-border-radius-bottomright:5px;
			-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
		}
		.table-calendar tr:not(:nth-child(2)) td{
			vertical-align:top;
			text-align:left;
		}
		.reserve_detail{
			border:1px solid #ccc;
			padding:5px;
		}
		.time-small{
			text-align:right;
			overflow: hidden;
		}
		
		#search-arrow{
			float:right;
			cursor:pointer;
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
      		<div class="col-lg-10 col-lg-offset-1" id="loginform">
				
      		 	<h2>ปฏิทิน</h2>
      		 	<?php if(isset($_GET['resid'])) echo "<h4>รหัสการจอง ".$_GET['resid']."</h4>";?>
      		 	<div class="panel panel-default">
						<div class="panel-heading" id="search-heading">
							<h3 class="panel-title">ค้นหา<div id="search-arrow"><i class="fa fa-caret-square-o-down"></i></div></h3>
						</div>
						<div class="panel-body" id="search-body">
							<?php echo $customviewbox;?>
						</div>
					</div>
      		 	<div class="alert-danger" id="login-alert">
      			</div>
      			<?php echo $calendar;?>
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
		/*
		* วนลูปทุก td เพื่อ ลบ <div class='time-small'> ให้เหลือแค่ 2 แถว แถวที่ 3 ให้เป็น ... 
		*/
		$(".table-calendar td").each(function(){
			var count=0;
			//.time-small loop
			$(this).children("div.time-small").each(function(){
				count++;
				if(count==3)$(this).html("<strong>...</strong>");
				if(count>3)$(this).remove();
			});
		});

		
		$("#search-body").hide();
		$("#search-heading").click(function(){
			if($("#search-body").is(":hidden"))
			{
				$("#search-body").slideDown();
				$("#search-arrow").children().attr("class","fa fa-caret-square-o-up");
			}
			else
			{	
				$("#search-body").slideUp();
				$("#search-arrow").children().attr("class","fa fa-caret-square-o-down");
			}
		});
		<?php
		if($this->session->userdata("bct-approve"))
		{
		?>
			$("#bct-approve").val("<?php echo $this->session->userdata("bct-approve");?>");
		<?php 
		}		
		?>
		<?php
		if($this->session->userdata("bct-month"))
		{
		?>
			$("#bct-month").val("<?php echo $this->session->userdata("bct-month");?>");
		<?php 
		}		
		?>
		<?php
		if($this->session->userdata("bct-year"))
		{
		?>
			$("#bct-year").val("<?php echo $this->session->userdata("bct-year");?>");
		<?php 
		}		
		?>
		<?php
		if($this->session->userdata("bct-room"))
		{
		?>
			$("#bct-room").val("<?php echo $this->session->userdata("bct-room");?>");
		<?php 
		}		
		?>
		//ทำเป็นเรียงอยู่บรรทัดเดียวกัน
		//$("#bct-room,#bct-year,#bct-month").css({width:"auto"});

		/*$("#bct-room").val(getURLParameter("rmid"));
		$("#bct-year").val(getURLParameter("year"));
		$("#bct-month").val(getURLParameter("month"));
		$("#bct-btn").click(function(){
			var room=$("#bct-room").find(":selected").val();
			var year=$("#bct-year").find(":selected").val();
			var month=$("#bct-month").find(":selected").val();
			var url="<?php echo base_url();?>?c=calendar&m=main&year="+year+"&month="+month+"&rmid="+room;
			if(getURLParameter("resid")!="null") url+="&resid="+getURLParameter("resid");
			window.location=url;
		});*/
		if(getURLParameter("resid")!="null")
		{
			$(".date").each(function(){
				var a = $(this).parent();
				var href=a.attr("href");
				//a.attr("href",href+"&resid="+getURLParameter("resid"));
				//http://localhost/roomreserve/?c=calendar&m=bydate&cdate=2013-12-2
			});
		}
		

		/*$(".table-calendar td").on("mouseover",function(){
			$(this).css("background-color","red");
		},function(){
			$(this).css("background-color","green");
		});*/
		/*$(".table-calendar td").on("",function(){
			$(this).css("background-color","none");
		});*/
		$(".table-calendar tr:not(:nth-child(2)) td").css("height",$(".table-calendar").height()/3);
		$(".table-calendar td").css("width",$(".table-calendar").width()/7);
		$(".table-calendar tr:not(:nth-child(2)) td").hover(function(){
			$(this).css("background-color","#ACD7FC");
		},function(){
			$(this).css("background-color","");
		});
		
		/*$("span.date").parent().click(function(){
			var get_date=$(this).children("span.date").attr("id");
			var ym=get_date.substr(0,8);
			var d=get_date.substr(8,2);
			if(d.length==1) d="0"+d;
			$.ajax({
				url:"?c=calendar&m=get_date_detail",
				data:{ymd:ym+d},
				type:"POST",
				dataType:"json",
				success:function(resp){
					//alert(resp.reserve_datetime_begin);
					var datetimetext="";
					datetimetext+="";
					$.each(resp,function(i,item)
					{
						datetimetext+="<blockquote>";
						datetimetext+="โครงการ "+resp[i].project_name+"";
						datetimetext+="<small>ห้อง "+resp[i].room_name+"</small>";
						datetimetext+="<small>วัน/เวลา "+resp[i].reserve_datetime_begin+" ถึง "+resp[i].reserve_datetime_end+"</small>";
						datetimetext+="</blockquote>";
					});
					datetimetext+="";
					if(datetimetext!="")bootbox.alert(datetimetext);
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
		});*/
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;