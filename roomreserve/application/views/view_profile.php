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
		fieldset.scheduler-border {
	    border: 1px solid #105B63 !important;
	    border-radius:5px;
	    padding: 0 1.4em 1.4em 1.4em !important;
	    margin: 0 0 1.5em 0 !important;    
		}
		legend.scheduler-border {
			
		    font-size: 14px !important;
		    font-weight: bold !important;
		    text-align: left !important;
		    width:auto; /* Or auto */
		    !padding:0 10px; /* To give a bit of padding on the left and right */
			border:none;
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
      	<?php echo $profile_tab;?>
      		<div class="col-lg-6 col-lg-offset-3" id="loginform">
				
      		 	<br>
      		 	<div class="alert-danger" id="login-alert">
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>ข้อมูลการเข้าใช้ระบบ</strong></h3>
					</div>
					<div class="panel-body">
						<dl class="dl-horizontal">
						<dt>ชื่อผู้เข้าใช้</dt>
							<dd><?php echo $username;?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>อีเมล</dt>
							<dd><?php echo $email;?></dd>
						</dl>
					</div>
				</div>
      			
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>ข้อมูลส่วนตัว</strong></h3>
					</div>
					<div class="panel-body">
						<dl class="dl-horizontal">
							<dt>ชื่อ-สกุล</dt>
							<dd><?php echo $titlename.$firstname.nbs(2).$lastname;?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>เบอร์โทรศัพท์</dt>
							<dd><?php echo $phone;?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>อาชีพ</dt>
							<dd><?php echo $occupation_name;?></dd>
						</dl>	
					</div>
				</div>
				
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>ข้อมูลที่อยู่</strong></h3>
					</div>
					<div class="panel-body">
						<dl class="dl-horizontal">
							<dt>บ้านเลขที่</dt>
							<dd><?php echo $house_no;?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>หมู่ที่ </dt>
							<dd><?php echo $village_no;?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>ตรอก/ซอย </dt>
							<dd><?php echo $alley;?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>ถนน</dt>
							<dd></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>ตำบล/แขวง</dt>
							<dd><?php echo $subdistrict_name;?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>อำเภอ/เขต</dt>
							<dd><?php echo $district_name;?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>จังหวัด</dt>
							<dd><?php echo $province_name;?></dd>
						</dl>	
					</div>
				</div>
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
		nav_bar_link();
		active_tab();
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;