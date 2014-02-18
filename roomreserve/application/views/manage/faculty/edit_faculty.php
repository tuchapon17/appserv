<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_faculty=$this->session->userdata("orderby_faculty");
$controller="faculty";
$m_name="faculty";
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
      	<?php echo $faculty_tab;?>
      		<div class="col-lg-12" id="loginform">
      		 	<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search" method="post" autocomplete="off">
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<?php echo $table_edit;?>
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php 
	      		 	$em_name=array(
	      		 			"in_faculty_name"=>"input_faculty_name"
	      		 	);
      		 		echo form_error($em_name["in_faculty_name"]);
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>แก้ไข คณะ/กอง</strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=edit" method="post" autocomplete="off">
								<?php
								echo $in_faculty_name;
								echo "<span id='".$em_name["in_faculty_name"]."_error' class='hidden'>".form_error($em_name["in_faculty_name"])."</span>";
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/faculty.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		allow_red_to_green("<?=$m_name?>");
		disallow_green_to_red("<?=$m_name?>");
		
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
		faculty_tab();
	});
	
	function load_faculty(tid)
	{
		//show data in input
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=load_faculty",
			data:"tid="+tid,
			type:"POST",
			dataType:"json",
			success:function(resp){
				$("#input_faculty_name").val(resp.faculty_name);
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
		$("#input_faculty_name").focus();
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
		var select_field='<option value="faculty_id">รหัส คณะ/กอง</option>';
		select_field+='<option value="faculty_name">คณะ/กอง</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_f="<?php echo $sess_orderby_faculty["field"];?>";
		var sess_t="<?php echo $sess_orderby_faculty["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function show_allow_list()
	{
		this.b_url="<?php echo base_url();?>";
		this.p_url="?d=manage&c=<?=$controller?>&m=allow";
		this.m_link="?d=manage&c=<?=$controller?>&m=edit";
		show_allow_list_center("<?=$m_name?>", b_url, p_url, m_link);
	}
	function select_searchfield()
	{
		var select_field='<option value="faculty_id">รหัส คณะ/กอง</option>';
		select_field+='<option value="faculty_name">คณะ/กอง</option>';
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