<?php 
echo $htmlopen;
echo $head;
?>
    <!-- Custom styles -->
    <style type="text/css">
	    .s_img{
	    	max-height:300px;
	    }
	    .fleft{
	    	float: left;
	    }
    </style>
<?php
echo $bodyopen;
echo $navbar;
?>
<!-- Custom Content -->
	<!-- 
	<div class="jumbotron">
      <div class="container">
        <h2>ระบบจัดการการจองห้อง ศูนย์คอมพิวเตอร์ มหาวิทยาลัยราชภัฏอุตรดิตถ์</h2>
        <p></p>
      </div>
    </div>
    -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center" >
        	
        	<h3><span class="label label-primary">ระบบจัดการการจองห้อง ศูนย์คอมพิวเตอร์ มหาวิทยาลัยราชภัฏอุตรดิตถ์</span></h3>
        	<br>
        	<img src="<?php echo base_url();?>images/reservation.jpg" width="600" class="img-rounded" usemap="#reservation">
        	<map name="reservation">
        		<!-- for image width 600px -->
        		<area shape="circle" coords="75,125,75" href="<?php echo base_url();?>?c=register&m=step1" title="ลงทะเบียน" >
        		<area shape="circle" coords="75,328,50" href="<?php echo base_url();?>?c=login&m=auth" title="เข้าสู่ระบบ" >
        		<area shape="circle" coords="300,328,50" href="<?php echo base_url();?>?c=calendar&m=main" title="ปฏิทินการจองห้อง"  >
        		<area shape="circle" coords="300,125,50" href="<?php echo base_url();?>?d=front&c=room&m=view" title="ข้อมูลห้อง" >
        		<area shape="circle" coords="525,125,50" href="<?php echo base_url();?>?d=manage&c=reserve&m=add" title="จองห้อง" >
        	</map>
	    </div>
      </div>
      <hr>
      <?php echo $footer;?>
    </div>
<?php 
echo $js;
?>
<!-- Custom Javascript -->
	<script type="text/javascript" src="<?php echo base_url();?>plugins/bootstrap3.0/js/carousel.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;