<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="assign";
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
			text-align:center;
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
      		<?php echo $assign_tab;?>
      		<div class="col-lg-8 col-lg-offset-2">
      			<br>
      			<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<span>คลิกที่ <i class="fa fa-circle fa-success"></i> เพื่อยกเลิกการโอนสิทธิ์</span>
				</div>
      			<?php echo $table_assign_list;?>
      		</div><!-- col-lg-12 (2) -->
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/assign.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		active_tab();
		assign_tab();
		$(".fa-circle").click(function(){
			var id = $(this).attr("id").substring(0,2);
			var aid = $(this).attr("id").substring(3,7);
			if(id == "s0")//canceled = 0 ยังไม่ได้ยกเลิก
			{
				$(this).attr("id","s1-"+aid);
				$(this).toggleClass("fa-success fa-danger");
				$.ajax({
					url:"?d=privilege&c=<?=$controller?>&m=allow_assign",
					data:{c:id, assign_id:aid},
					type:"POST",
					dataType:"json",
					success:function(resp){
						bootbox.alert(resp.assign_status);
					},
					error:function(error){
						//alert("Error : "+error);
					}
				});
			}
			else return false;
		});
		/*
		$(".label-assign").click(function(){
			var c;
			if($(this).prev().attr("class") == "allow_assign0")
			{
				c=$(this).prev().attr("class");
				$(this).prev().attr("class","allow-assign1");
				$.ajax({
					url:"?d=privilege&c=<?=$controller?>&m=allow_assign",
					data:{c:c,assign_id:$(this).prev().val()},
					type:"POST",
					dataType:"json",
					success:function(resp){
						bootbox.alert(resp.assign_status);
					},
					error:function(error){
						//alert("Error : "+error);
					}
				});
			}
			else return false;
		});*/
	});
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;