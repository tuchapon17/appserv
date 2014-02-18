<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_titlename=$this->session->userdata("orderby_titlename");
$controller="titlename";
$m_name="titlename";
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
      	<?php echo $titlename_tab;?>
      		<div class="col-lg-12" id="loginform">
      		 	<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=titlename&m=search" method="post" autocomplete="off">
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<?php echo $table_edit;?>
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php 
	      		 	$em_name=array(
	      		 			"in_titlename"=>"input_titlename"
	      		 	);
      		 		echo form_error($em_name["in_titlename"]);
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>แก้ไขคำนำหน้าชื่อ</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=titlename&m=edit" method="post" autocomplete="off">
								<?php
								echo $in_titlename;
								echo "<span id='".$em_name["in_titlename"]."_error' class='hidden'>".form_error($em_name["in_titlename"])."</span>";
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/titlename.js"></script>
	<script type="text/javascript">
	<!--
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
		Checked/Unchecked all checkbox
		*/
		del_all_checkbox("<?=$m_name?>");
		/**
		add num_rows to pagination 
		*/
		$("#pagination_num_rows").html("<a>ทั้งหมด <?php echo $pagination_num_rows;?> แถว</a>");
		/**
		Reset search result
		*/
		$("#clearSearch").click(function(){
			clearSearchCenter("<?=$controller?>", b_url);
		}); 
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
		titlename_tab();
	});
	function load_titlename(tid)
	{
		//show data in input
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=load_titlename",
			data:"tid="+tid,
			type:"POST",
			dataType:"json",
			success:function(resp){
				$("#input_titlename").val(resp.titlename);
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
		$("#input_titlename").focus();
	}
	function set_per_page(num)
	{
		set_page_num_center(num, b_url, "?d=manage&c=<?=$controller?>&m=edit");
	}
	function show_del_list()
	{
		show_del_list_center("<?=$m_name?>");
	}
	function select_orderby()
	{
		var select_field='<option value="titlename_id">รหัสคำนำหน้าชื่อ</option>';
		select_field+='<option value="titlename">คำนำหน้าชื่อ</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_f="<?php echo $sess_orderby_titlename["field"];?>";
		var sess_t="<?php echo $sess_orderby_titlename["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function select_searchfield()
	{
		var select_field='<option value="titlename_id">รหัสคำนำหน้าชื่อ</option>';
		select_field+='<option value="titlename">คำนำหน้าชื่อ</option>';
		//var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_s="<?php echo $this->session->userdata("searchfield_".$m_name);?>";
		select_search_center(select_field, b_url, s_link, c_main_link, sess_s);
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;