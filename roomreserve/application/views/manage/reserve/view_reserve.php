<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="reserve";
$m_name="reserve";
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
		#toggle-arrow{
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
      	<?php //echo $reserve_tab;
		?>
      		<div class="col-lg-12" id="loginform">
				<?php 
				/*$ad=$article_data;
				$dd=$datetime_data;
				$fd=$file_data;
				*/
				$rd=$reserve_data;
				
				if($rd['approve']==0)$approve="<span class='text-warning'>รออนุมัติ</span>";
				else if($rd['approve']==1)$approve="<span class='text-success'>อนุมัติแล้ว</span>";
				else if($rd['approve']==2)$approve="<span class='text-primary'>ส่งให้ผู้บริหารอนุมัติ</span>";
				else if($rd['approve']==3)$approve="<span class='text-danger'>ไม่อนุมัติ</span>";
				
				?>
      		 	<div class="container">
      		 		<div class="row">
      		 			<div class="col-lg-4 wordw">
      		 			<h3 class="text-center">รายละเอียดการจอง</h3>
	      		 			<dl class="dl-horizontal">
	      		 				<dt>รหัสการจอง</dt>
	      		 				<dd><?php echo $rd['reserve_id'];?></dd>
	      		 				<dt>ชื่อโครงการ</dt>
	      		 				<dd><?php echo $rd['project_name'];?></dd>
	      		 				<dt>ห้องที่จอง</dt>
	      		 						<!-- edit room button <a href="<?php echo base_url();?>?d=manage&c=reserve&m=edit_detail&id=<?php echo $rd['reserve_id'];?>&t=room"><i class="fa fa-edit"></i></a> -->
	      		 				<dd><a href="<?php echo base_url();?>?d=front&c=room&m=view&rmid=<?php echo $rd['room_id'];?>" target="_blank"><?php echo $rd['room_name'];?></a>&nbsp;</dd>
	      		 				<dt>จำนวนคนที่เข้าใช้</dt>
	      		 				<dd><?php echo $rd['num_of_people'];?></dd>
	      		 				<dt>วันที่จอง</dt>
	      		 				<dd><?php echo $rd['reserve_on'];?></dd>
	      		 				<dt>วัตถุประสงค์การใช้</dt>
	      		 				<dd ><?php echo $rd['for_use'];?></dd>
	      		 				<dt>ผู้จอง</dt>
	      		 				<dd><a href="<?php echo base_url();?>?c=user_profile&m=view_profile&vuser=<?php echo $rd['tb_user_username'];?>" target="_blank"><?php echo $rd['tb_user_username'];?></a></dd>
	      		 				<dt>ส่วนลด</dt>
	      		 				<dd><?php echo $rd['discount'];?> %</dd>
	      		 				<dt>การอนุมัติ</dt>
	      		 				<dd><?php echo $approve;?></dd>
	      		 				<dt>วันที่อนุมัติ</dt>
	      		 				<dd><?php echo $rd['approve_on'];?></dd>
	      		 				<dt>ผู้อนุมัติ</dt>
	      		 				<dd><a href="<?php echo base_url();?>?c=user_profile&m=view_profile&vuser=<?php echo $rd['approve_by'];?>" target="_blank"><?php echo $rd['approve_by'];?></a></dd>
	      		 			</dl>
      		 			</div>
      		 			<div class="col-lg-4 wordw">
      		 			<h3 class="text-center">วัน/เวลาการจอง</h3>
      		 				<dl>
	      		 				<?php 
	      		 				foreach($datetime_data as $index=>$val)
	      		 				{
	      		 					//echo "<dt>".($index+1)."</dt>";
	      		 					//echo "<dd>".$val['reserve_datetime_begin']."</dd>";
	      		 					//echo "<dt>".$val['reserve_datetime_begin']."</dt>";
	      		 					//echo "<dd>- ".$val['reserve_datetime_end']."</dd>";
	      		 					echo "<dd>".($index+1).".
									<a href='".base_url()."?c=calendar&m=bydate&cdate=".
									substr($val['reserve_datetime_begin'],0,10)."' target='_blank'>".
	      		 					compress_two_datetime($val['reserve_datetime_begin'], $val['reserve_datetime_end']).
	      		 					"</a>&nbsp;
      								<a href='".base_url()."?d=manage&c=reserve&m=edit_detail&id="
									.$rd["reserve_id"]."&t=datetime&did=".$val["datetime_id"]."'>
									<i class='fa fa-edit'></i></a>
      								</dd>";
	      		 				}
	      		 				?>
	      		 			</dl>
      		 			</div>
      		 			<div class="col-lg-4 wordw">
      		 			<h3 class="text-center"><?php echo $this->lang->line("text_article");?>ที่ใช้</h3>
	      		 			<dl class="dl-horizontal">
		      		 			<?php 
		      		 			foreach($article_data as $index=>$val)
		      		 			{
		      		 				echo "<dt>".$val['article_name']."</dt>";
		      		 				echo "<dd>จำนวน ".$val['unit_num']."</dd>";
		      		 			}
		      		 			?>
		      		 			<dt><?php echo $this->lang->line("text_article");?>อื่นๆ</dt>
		      		 			<dd><?php echo $rd['other_article'];?></dd>
	      		 			</dl>
      		 			</div>
      		 		</div><!-- row -->
      		 		<div class="row">
      		 			<div class="col-lg-4 wordw">
							<h3 class="text-center">ข้อมูลบุคคล</h3>
							<dl class="dl-horizontal">
								<dt>บุคคล</dt>
	      		 				<dd><?php echo $rd['person_type'];?></dd>
	      		 				<dt>ประเภทบุคคล</dt>
	      		 				<dd><?php echo $rd['person'];?></dd>
	      		 				<dt>เบอร์โทรศัพท์</dt>
	      		 				<dd><?php echo $rd['phone'];?></dd>
	      		 				<dt>หน่วยงาน</dt>
	      		 				<dd><?php echo $rd['office_name'];?></dd>
	      		 				<dt>ตำแหน่งงาน</dt>
	      		 				<dd><?php echo $rd['job_position_name'];?></dd>
	      		 				<dt>คณะ</dt>
	      		 				<dd><?php echo $rd['faculty_name'];?></dd>
	      		 				<dt>สาขา/งาน</dt>
	      		 				<dd><?php echo $rd['department_name'];?></dd>
	      		 				<dt>รหัสนักศึกษา</dt>
	      		 				<dd><?php echo $rd['std_id'];?></dd>
	      		 			</dl>		 			
      		 			</div>
      		 			<div class="col-lg-4 wordw">
      		 			<h3 class="text-center">ไฟล์โครงการ</h3>
      		 				<dl>
		      		 			<?php 
		      		 			foreach($file_data as $index=>$val)
		      		 			{
		      		 				//echo "<dt>".$val['old_file_name']."</dt>";
		      		 				echo "<dd>".($index+1).". <a href='".base_url()."upload/docs/".$val['file_name']."' target='_blank'>".$val['old_file_name']."</a></dd>";
		      		 			}
		      		 			?>
		      		 		</dl>
      		 			</div>
      		 		</div>
      		 	</div>
      		 	<?php 
      		 	//แสดงสำหรับบุคคลภายนอก
      		 	if($rd["person_type_id"] == "02")
      		 	{
      		 	?>
      		 	<div class="panel panel-default">
					<div class="panel-heading" >
						<h3 class="panel-title">ค่าบริการ</h3>
					</div>
					<div class="panel-body">
						<!-- <p><strong>รวมทั้งสิ้น  <span class="red-text"><?php echo $total_price;?></span> บาท</strong></p>
						<p><strong>รวมส่วนลดทั้งสิ้น <span class="red-text"><?php echo $discount_person01;?></span> บาท</strong></p>
						 -->
						<?php echo $discount_text;?>
					</div>
				</div>
      		 	<div class="panel panel-default">
					<div class="panel-heading" id="detail-heading">
						<h3 class="panel-title">รายละเอียดค่าบริการ<div id="toggle-arrow"><i class="fa fa-caret-square-o-down"></i></div></h3>
					</div>
					<div class="panel-body" id="detail-body">
						<div class="text-center"><h4>ค่าบริการ<?php echo $this->lang->line("text_article");?></h4></div>
						<div class="row">
							<?php 
							foreach($reserve_fee as $r)
							{
								echo '<div class="col-lg-6">';
								echo $r;
								echo '</div>';
							}
							?>
						</div>
						<div class="text-center"><h4>ค่าบริการห้อง</h4></div>
						<div class="row">
							<?php 
							foreach($room_fee as $r)
							{
								echo '<div class="col-lg-6">';
								echo $r;
								echo '</div>';
							}
							?>
						</div>
					</div>
				</div><!-- panel price detail -->
				<?php 
      		 	}//if person_type_id
				?>
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
		/*#################################################
		Show bootbox alert after edited profile1
		###################################################*/
		<?php 
		if($this->session->flashdata("edit_reserve_datetime_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("edit_reserve_datetime_message");?>"); 
		<?php
		}?>
		
		//ซ่อน/แสดง รายละเอียดการจอง
		$("#detail-body").hide();
		$("#detail-heading").click(function(){
			if($("#detail-body").is(":hidden"))
			{
				$("#detail-body").slideDown();
				$("#toggle-arrow").children().attr("class","fa fa-caret-square-o-up");
			}
			else
			{	
				$("#detail-body").slideUp();
				$("#toggle-arrow").children().attr("class","fa fa-caret-square-o-down");
			}
		});
	});
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