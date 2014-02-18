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
	<div class="jumbotron">
      <div class="container">
        <h2>ระบบจัดการการจองห้อง ศูนย์คอมพิวเตอร์ มหาวิทยาลัยราชภัฏอุตรดิตถ์</h2>
        <p></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      
      <div class="row">
        <div class="col-lg-4">
          	<h2>ลงทะเบียน</h2>
          	<p></p>
          	<p><a class="btn btn-default" href="?c=register&m=step1">เพิ่มเติม &raquo;</a></p>
        </div>
	    <div class="col-lg-4">
	    	<h2>ปฏิทินการจองห้อง</h2>
	        <p></p>
	        <p><a class="btn btn-default" href="?c=calendar&m=main">เพิ่มเติม &raquo;</a></p>
		</div>
		<div class="col-lg-4">
	        <h2>ข้อมูลห้อง</h2>
	        <p></p>
	        <p><a class="btn btn-default" href="?d=front&c=room&m=view">เพิ่มเติม &raquo;</a></p>
	    </div>
      </div>
      <div class="row">
      <div class="col-lg-4">
	        <h2>จองห้อง</h2>
	        <p></p>
	        <p><a class="btn btn-default" href="?d=manage&c=reserve&m=add">เพิ่มเติม &raquo;</a></p>
		</div>
        <div class="col-lg-4">
          	<h2>ระเบียบการใช้งาน</h2>
	        <p></p>
	        <p><a class="btn btn-default" href="?d=front&c=condition&m=view">เพิ่มเติม &raquo;</a></p>
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