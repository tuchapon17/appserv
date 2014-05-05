<?php 
$ci=&get_instance();
$ci->load->library("element_lib");
$eml=$ci->element_lib;
$sess_orderby_view_privilege=$this->session->userdata("orderby_view_privilege");
$controller="user";
$m_name="view_privilege";
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
		.table th{
			text-align:center;
		}
		.fixed-table tr th:first-child, tr td:first-child, th:last-child, tr td:last-child{
			width:auto;
			text-align:auto;
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
      	<?php echo $user_tab;?>
      		<br>
      		<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search_view_privilege" method="post" autocomplete="off">
      		<?php echo $manage_search_box;?>
      		</form>
      		<?php echo $user_table;	?>
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
	<script type="text/javascript" src="<?php echo base_url();?>js/manage/user.js"></script>
	<script type="text/javascript">
	<!--
	$(function(){
		active_tab();
		user_tab();
		$("#clearSearch").click(function(){
			s_url="?d=manage&c=<?=$controller?>&m=search_view_privilege";
			r_url="?d=manage&c=<?=$controller?>&m=view_privilege";
			clearSearchCenter2(b_url, s_url, r_url);
		});
	});
	function set_per_page(num)
	{
		set_page_num_center(num, b_url, "?d=manage&c=<?=$controller?>&m=view_privilege");
	}
	function select_orderby()
	{
		var select_field='<option value="username">ชื่อผู้ใช้</option>';
		select_field+='<option value="group_name">กลุ่มผู้ใช้</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby_view_privilege";
		var c_main_link="?d=manage&c=<?=$controller?>&m=view_privilege";
		var sess_f="<?php echo $sess_orderby_view_privilege["field"];?>";
		var sess_t="<?php echo $sess_orderby_view_privilege["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function select_searchfield()
	{
		var select_field='<option value="username">ชื่อผู้ใช้</option>';
		select_field+='<option value="firstname">ชื่อ</option>';
		select_field+='<option value="lastname">นามสกุล</option>';
		//var b_url="<?php echo base_url();?>";
		var s_link="?d=manage&c=<?=$controller?>&m=set_searchfield_view_privilege";
		var c_main_link="?d=manage&c=<?=$controller?>&m=view_privilege";
		var sess_s="<?php echo $this->session->userdata("searchfield_".$m_name);?>";
		select_search_center(select_field, b_url, s_link, c_main_link, sess_s);
	}
	//-->
	</script>
<?php 
echo $bodyclose;
echo $htmlclose;