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
		#search-arrow{
			float:right;
			cursor:pointer;
		}
		.room-pic{
			cursor:pointer;
		}
    </style>
<?php
	echo $bodyopen;
	echo $navbar;
	
	if(sizeof($get_room_list)!=0)
		$rl=$get_room_list[0];
	else $rl='';
?>
<!-- Custom Content -->
    <div class="container">
      <div class="row">
      	
      	<div class="col-lg-12">
      		<h2>ข้อมูลห้อง</h2>
      		<div class="panel panel-default">
				<div class="panel-heading" id="search-heading">
					<h3 class="panel-title">ค้นหาห้อง<div id="search-arrow"><i class="fa fa-caret-square-o-down"></i></div></h3>
				</div>
				<div class="panel-body" id="search-body">
					<?php echo $form_select_room;?>
				</div>
			</div>
      	</div>
      	<!--
      	<div class="col-lg-12">
			<div style="float:left;"><button id="room-prev" class="btn btn-default" type="button"><i class="fa fa-angle-double-left"></i></button></div>
			<div style="float:right;"><button id="room-next" class="btn btn-default" type="button"><i class="fa fa-angle-double-right"></i></button></div>
		</div>
		-->
      	<div class="col-lg-6">
      		<dl class="dl-horizontal">			
	      		<dt>ชื่อห้อง</dt>
	      		<dd><?php echo get_rl_data($get_room_list,'room_name');?></dd>
	      		<dt>ประเภทห้อง</dt>
	      		<dd><?php echo get_rl_data($get_room_list,'room_type_name');?></dd>
	      		<dt>สถานะ</dt>
	      		<dd><?php 
	      			if(get_rl_data($get_room_list,'room_status')==0)echo "<span class='text-danger'>ปิดให้บริการ</span>";
	      			else echo "<span class='text-success'>เปิดให้บริการ</span>";
	      		?></dd>
	      		<dt>ส่วนลด (%)</dt>
	      		<dd><?php echo get_rl_data($get_room_list,'discount_percent');?>%</dd>
	      		<dt>ค่าบริการ</dt>
	      		<dd><?php
	      			if(get_rl_data($get_room_list,'fee_type_id')=="01") echo get_rl_data($get_room_list,'room_fee_lump_sum')." บาท/วัน";
	      			else if(get_rl_data($get_room_list,'fee_type_id')=="02") echo get_rl_data($get_room_list,'room_fee_hour')." บาท/ชั่วโมง";
	      		?></dd>
	      		<dt></dt>
	      		<dd><?php ?></dd>
	      	</dl>

        </div>
        <div class="col-lg-6">
		<div class="text-center"><strong>รูปห้อง</strong></div>
        <?php 
        foreach($get_pic_list as $g)
        {
        	$src=base_url().'upload/pic/'.$g['pic_name'];
        	echo '<img class="img-thumbnail room-pic" style="width:33%;height:auto;" src="'.$src.'" onclick=large_pic("'.$src.'","'.$g["pic_descript"].'"); title="คลิกเพื่อดูรูปขนาดใหญ่">'; 
        }
        ?>
        </div>
        <div class="col-lg-12">
	      	<div class="panel panel-default">
				<div class="panel-heading">
					<strong>รายละเอียดห้อง</strong>
				</div>
				<div id="room_detail" class="panel-body"><?php echo get_rl_data($get_room_list,'room_detail');?></div>
			</div>
        </div>
        <!--
        <div class="col-lg-12">
        <?php echo $pagination;?>
        </div>
        -->
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

		//search room btn disable
		if($("#select_room").find("option:selected").val()=="")
			$("#view-btn").addClass("disabled");
		$("#select_room").on("change",function(){
			if($("#select_room").find("option:selected").val()!="")
				$("#view-btn").removeClass("disabled");
		});
		
		//replace room_detail content
		var room_detail = $("#room_detail").text();
		$("#room_detail").html(room_detail);
		
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

		/*
		*แสดงข้อมูลห้องใน dropdown (Get room list)
		*/
		$("#select_room_type").on("change",function(){
			if($(this).find("option:selected").val()!=""){
				$.ajax({
					url:"?d=front&c=room&m=select_room_list",
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
		if($("#select_room_type").find("option:selected").val()!="") $("#select_room_type").change();

		
	});
	function large_pic(src, descript)
	{
		bootbox.alert('<img class="img-thumbnail" src='+src+' style="width:100%;height:auto;"><p class="text-center">'+descript+'</p>');
	}
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;

/**
 * Check sizeof array and return value from array
 * @param array $get_room_list
 * @param string $arr_key
 * @return boolean
 */
function get_rl_data($get_room_list, $arr_key)
{
	if(sizeof($get_room_list)!=0)
		return $get_room_list[0][$arr_key];
	else return false;
}
