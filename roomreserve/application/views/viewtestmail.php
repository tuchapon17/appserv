<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$m_name="article";
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
    </style>
<?php
	echo $bodyopen;
	echo $navbar;
?>
<!-- Custom Content -->

    <div class="container">
      <div class="row">
      	<div class="col-lg-12">
      	<button id="testmail">send</button>
      			
      		
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
		$("#testmail").click(function(){
			$.ajax({
				url:"?c=test&m=mail",
				data:"",
				type:"POST",
				dataType:"json",
				success:function(resp){
					if(resp[0]=="error") alert(resp[1]);
					else if(resp[0]=="sent") alert(resp[1]);
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
		});
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;