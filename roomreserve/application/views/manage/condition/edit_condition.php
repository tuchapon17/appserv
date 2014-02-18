<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$controller="condition";
$m_name="condition";
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
      	<?php echo $condition_tab;?>
      		<div class="col-lg-12" id="loginform">
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php 
	      		 	$em_name=array(
	      		 			"te_condition"=>"textarea_condition"
	      		 	);
      		 		echo form_error($em_name["te_condition"]);
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>แก้ไขระเบียบการใช้งานระบบ</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=edit" method="post" autocomplete="off">
								<?php
								echo $te_condition;
								echo "<span id='".$em_name["te_condition"]."_error' class='hidden'>".form_error($em_name["te_condition"])."</span>";
								?>	
							<div class="text-right"><?php echo $eml->btn('submit','');?></div>
						</form>
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
	<script type="text/javascript" src="<?php echo base_url();?>plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	<!--
	tinymce.init({
		selector:'#textarea_condition',
		encoding:'xml',
		entity_encoding: "raw"
	});
	$(function(){
		/**
		Highlight the <input> <select> 
		If span text length > 0 change input border color to red
		*/
		<?php 
		foreach ($em_name AS $key=>$value):
		?>
			if($("#<?php echo $em_name[$key];?>_error").text().length>0){
				$("#<?php echo $em_name[$key];?>").css("border","1px solid #bb0000");
			}
		<?php
		endforeach;
		?>
		/**
		Show bootbox alert after edited profile1
		*/
		<?php 
		if($this->session->flashdata("edit_".$m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("edit_".$m_name."_message");?>"); 
		<?php
		}?>
		active_tab();
		/**
		Tab menu link
		*/
		$("#add").on("click",function(){
			window.location="?d=manage&c=<?=$controller?>&m=add";
		});
		$("#edit").on("click",function(){
			window.location="?d=manage&c=<?=$controller?>&m=edit";
		});
		load_condition("");//""=condition_id
	});
	
	/**
	Unescape string
	&lt;p&gt; => <p>
	*/
	function htmlUnescape(value){
	    return String(value)
	        .replace(/&quot;/g, '"')
	        .replace(/&#39;/g, "'")
	        .replace(/&lt;/g, '<')
	        .replace(/&gt;/g, '>')
	        .replace(/&amp;/g, '&');
	}
	function load_condition(tid)
	{
		//show data in input
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=load_condition",
			data:"tid="+tid,
			type:"POST",
			dataType:"json",
			success:function(resp){
				tinymce.get('textarea_condition').setContent(htmlUnescape(resp.condition));
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;