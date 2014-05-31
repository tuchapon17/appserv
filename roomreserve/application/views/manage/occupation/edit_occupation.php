<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_occupation=$this->session->userdata("orderby_occupation");
$controller="occupation";
$m_name="occupation";
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
		.status0,.status1{
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
      	<?php echo $occupation_tab;?>
      		<div class="col-lg-12" id="loginform">
      		 	<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search" method="post" autocomplete="off">
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<?php echo $table_edit;?>
      		 	<div class="alert-danger" id="login-alert">
      		 	<?php 
	      		 	$em_name=array(
	      		 			"in_occupation"=>$this->lang->line("in_occupation")
	      		 	);
      		 		echo form_error($this->lang->line("in_occupation"));
      		 	?>
      			</div>
      			<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>แก้ไข<?php echo $this->lang->line("text_occupation");?></strong></h3>
					</div>
					<div class="panel-body">
						<form role="form" action="?d=manage&c=<?=$controller?>&m=edit" method="post" autocomplete="off" id="edit_occupation">
								<?php
								echo $in_occupation;
								echo "<span id='".$this->lang->line("in_occupation")."_error' class='hidden'>".form_error($this->lang->line("in_occupation"))."</span>";
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/occupation.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/localization/messages_th.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>plugins/jquery-validation-1.11.1/dist/my-additional-methods.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#edit_occupation").validate({
			lang:'th',
			errorClass: "my-error-class",
			rules: {
				"<?php echo $this->lang->line("in_occupation");?>": {
					required:true,
					maxlength:30,
					THEN:true,
					remote:{
						// จะ return true / false
						url:b_url+"?d=manage&c=occupation&m=already_exist_ajax",
						type:"POST"
					}
				}
			},
			messages:{
				"<?php echo $this->lang->line("in_occupation");?>":{
					remote:"<?php echo $this->lang->line("t_in_occupation");?>นี้ถูกใช้แล้ว"
				}
			}
		});
		allow_red_to_green("<?=$m_name?>");
		disallow_green_to_red("<?=$m_name?>");
		
		/*#################################################
		Highlight the <input> <select> 
		If span text length > 0 change input border color to red
		###################################################*/
		<?php 
		foreach ($em_name AS $key=>$value):
		?>
			if($("#<?php echo $em_name[$key];?>_error").text().length>0){
				$("#<?php echo $em_name[$key];?>").css("border","1px solid #bb0000");
			}
		<?php
		endforeach;
		?>
		/*#################################################
		Checked/Unchecked all checkbox
		###################################################*/
		del_all_checkbox("<?=$m_name?>");
		
		/*#################################################
		add num_rows to pagination 
		###################################################*/
		$("#pagination_num_rows").html("<a>ทั้งหมด <?php echo $pagination_num_rows;?> แถว</a>");
		
		/*#################################################
		Reset search result
		###################################################*/
		$("#clearSearch").click(function(){
			clearSearchCenter("<?=$controller?>", b_url);
		}); 
		/*#################################################
		Show bootbox alert after edited profile1
		###################################################*/
		<?php 
		if($this->session->flashdata("edit_".$m_name."_message"))
		{?>
			bootbox.alert("<?php echo $this->session->flashdata("edit_".$m_name."_message");?>"); 
		<?php
		}?>
		
		active_tab();
		occupation_tab();
	});
	
	function load_occupation(tid)
	{
		//show data in input
		$.ajax({
			url:"?d=manage&c=<?=$controller?>&m=load_occupation",
			data:"tid="+tid,
			type:"POST",
			dataType:"json",
			success:function(resp){
				$("#input_occupation").val(resp.occupation_name);
			},
			error:function(error){
				alert("Error : "+error);
			}
		});
		$("#input_occupation").focus();
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
		var select_field='<option value="occupation_id">รหัส<?php echo $this->lang->line("text_occupation");?></option>';
		select_field+='<option value="occupation_name"><?php echo $this->lang->line("text_occupation");?></option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_f="<?php echo $sess_orderby_occupation["field"];?>";
		var sess_t="<?php echo $sess_orderby_occupation["type"];?>";
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
		var select_field='<option value="occupation_id">รหัส<?php echo $this->lang->line("text_occupation");?></option>';
		select_field+='<option value="occupation_name"><?php echo $this->lang->line("text_occupation");?></option>';
		//var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_s="<?php echo $this->session->userdata("searchfield_".$m_name);?>";
		select_search_center(select_field, b_url, s_link, c_main_link, sess_s);
	}
	function toggle_checked(id)
	{
		//enable
		if($("#checked"+id+".status0").length > 0)
		{
			$.ajax({
				url:"?d=manage&c=occupation&m=toggle_checked",
				data:{"id":id,"s":"enable"},
				type:"POST",
				dataType:"text",
				success:function(resp){
					if(resp=="1")
					{
						$("#checked"+id).toggleClass("fa-danger fa-success");
						$("#checked"+id).toggleClass("status0 status1");
					}
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
		}
		//disable
		else if($("#checked"+id+".status1").length > 0)
		{
			$.ajax({
				url:"?d=manage&c=occupation&m=toggle_checked",
				data:{"id":id,"s":"disable"},
				type:"POST",
				dataType:"text",
				success:function(resp){
					if(resp=="1")
					{
						$("#checked"+id).toggleClass("fa-success fa-danger");
						$("#checked"+id).toggleClass("status1 status0");
					}
				},
				error:function(error){
					alert("Error : "+error);
				}
			});
		}
	}
	//-->
	
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;