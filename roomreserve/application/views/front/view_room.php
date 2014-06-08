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
			<a id="prevroom" class="btn btn-primary btn-sm"><i class="fa fa-angle-double-left fa-white"></i> ห้องก่อนหน้า</a>
		</div>
		<div class="col-lg-6 text-right">
			<a id="nextroom" class="btn btn-primary btn-sm">ห้องถัดไป <i class="fa fa-angle-double-right fa-white"></i></a>
		</div>
      	<div class="col-lg-6">
      		
      		<dl class="dl-horizontal">			
	      		<dt><?php echo $this->lang->line("t_in_room_name");?></dt>
	      		<dd><?php echo get_rl_data($get_room_list,'room_name');?></dd>
	      		
	      		<dt><?php echo $this->lang->line("t_se_room_type");?></dt>
	      		<dd><?php echo get_rl_data($get_room_list, "room_type_name");?></dd>
	      		
	      		<dt>ความจุห้อง</dt>
	      		<dd><?php
	      		if(get_rl_data($get_room_list, "max_people") == 0)
	      			echo "ไม่ระบุ";
	      		else echo get_rl_data($get_room_list, "max_people")." คน";
	      		
	      		?></dd>
	      		
	      		<dt>สถานะ</dt>
	      		<dd><?php 
	      			if(get_rl_data($get_room_list,'room_status')==0)echo "<span class='text-danger'>ปิดให้บริการ (".get_rl_data($get_room_list, "room_status_msg").")</span>";
	      			else echo "<span class='text-success'>เปิดให้บริการ</span>";
	      		?></dd>
	      		
	      		<!--
	      		<dt><?php echo $this->lang->line("t_in_discount_percent");?></dt>
	      		<dd><?php echo get_rl_data($get_room_list,'discount_percent');?>%</dd>
	      		-->
	      		</dd>
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
        
        <div class="col-lg-12">
	      	<div class="panel panel-default">
				<div class="panel-heading">
					<strong>รายละเอียดค่าบริการ</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
								<div><h4>ค่าบริการ<?php echo $this->lang->line("text_room");?></h4></div>
									<dl class="dl-horizontal">
										<?php 
										if(get_rl_data($get_room_list,'fee_type_id')=="00")//ไม่คิดค่าบริการ
										{
											echo '<dt>ค่าบริการห้อง</dt>';
											echo '<dd>ไม่คิดค่าบริการ</dd>';
										}
										else if(get_rl_data($get_room_list,'fee_type_id')=="01")//เหมา
										{
											echo '<dt>ค่าบริการห้อง</dt>';
											echo '<dd>'.get_rl_data($get_room_list, "room_fee_lump_sum").' บาท / วัน</dd>';
										}
										else if(get_rl_data($get_room_list,'fee_type_id')=="02")//ชม.
										{
											echo '<dt>ค่าบริการห้อง</dt>';
											echo '<dd>'.get_rl_data($get_room_list, "room_fee_hour").' บาท / ชั่วโมง</dd>';
										}
										?>
									</dl>
								<div><h4>ค่าบริการ<?php echo $this->lang->line("text_article");?></h4></div>
								<?php 
								foreach ($article_data as $a)
								{
									echo '<dl class="dl-horizontal">';
									echo '<dt>ชื่อวัสดุครุภัณฑ์</dt>';
									echo '<dd>'.$a["article_name"].'</dd>';
									echo '<dt>จำนวน</dt>';
									echo '<dd>'.$a["article_num"].' หน่วย</dd>';
									echo '<dt>ประเภทค่าบริการ</dt>';
									echo '<dd>'.$a["fee_type_name"].'</dd>';
									
									echo '<dt>ค่าบริการ</dt>';
									if($a["tb_fee_type_id"] == "00")
										echo '<dd>ฟรี</dd>';
									else if($a["tb_fee_type_id"] == "01")//เหมา
									{
										echo '<dd>'.$a["fee_unit_lump_sum"].' บาท / วัน / วัสดุครุภัณฑ์จำนวน '.$a["lump_sum_base_unit"].' หน่วย</dd>';
										echo '<dt>ค่าบริการส่วนเกิน</dt>';
										echo '<dd>'.$a["fee_over_unit_lump_sum"].' บาท / หน่วย (กรณีใช้งานมากกว่า '.$a["lump_sum_base_unit"].' หน่วย)</dd>';
									}
									else if($a["tb_fee_type_id"] == "02")//ชม
										echo '<dd>'.$a["fee_unit_hour"].' บาท / หน่วย / ชั่วโมง</dd>';
									
									echo '</dl>';
								}
								?>
						</div>
					</div>
					
				</div>
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
		$("#nextroom").click(function(){
			if($("#select_room option").size() > 1)
			{
				var currentIndex = $("#select_room")[0].selectedIndex;
				if($("#select_room option").eq(currentIndex+1).val() != null && $("#select_room option").eq(currentIndex+1).val() != "")
				{
					$("#select_room option").eq(currentIndex+1).prop("selected",true);
					//$("#select_room").change();
					$("#searchroom").submit();
				}
			}
		});
		$("#prevroom").click(function(){
			if($("#select_room option").size() > 1)
			{
				var currentIndex = $("#select_room")[0].selectedIndex;
				if($("#select_room option").eq(currentIndex-1).val() != null && $("#select_room option").eq(currentIndex-1).val() != "")
				{
					$("#select_room option").eq(currentIndex-1).prop("selected",true);
					//$("#select_room").change();
					$("#searchroom").submit();
				}
			}
		});
		
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
						<?php 
						//set select room
						if($this->session->userdata("view-room"))
						{
						?>
							$("#select_room").val("<?php echo $this->session->userdata("view-room");?>");
						<?php 	
						}
						?>
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
