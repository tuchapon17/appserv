<?php 
$sess_orderby_auth_log=$this->session->userdata("orderby_auth_log");
$controller="auth_log";
$m_name="auth_log";
echo $htmlopen;
echo $head;
?>
<!-- Custom styles -->
<style type="text/css">
	.fixed-table tr th:first-child, tr td:first-child, th:last-child, tr td:last-child{
		width:auto;
		text-align:left;
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
      	<?php echo $auth_log_tab;?>
      		<div class="col-lg-12" id="loginform">
      		 	<br>
      		 	<form role="form" class="form-inline" action="?d=manage&c=<?=$controller?>&m=search" method="post" autocomplete="off">
      		 		<?php echo $manage_search_box;?>
      		 	</form>
      		 	<?php echo $table_edit;?>
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
		/**
		* add num_rows to pagination 
		*/
		$("#pagination_num_rows").html("<a>ทั้งหมด <?php echo $pagination_num_rows;?> แถว</a>");
		
		/**
		* Reset search result
		*/
		$("#clearSearch").click(function(){
			clearSearchCenter("<?=$controller?>", b_url);
		});
		
		active_tab();
		
		/**
		* Tab menu link
		*/
		$("#edit").on("click",function(){
			window.location="?d=manage&c=<?=$controller?>&m=edit";
		});
	});
	
	function set_per_page(num)
	{
		set_page_num_center(num, b_url, "?d=manage&c=<?=$controller?>&m=edit");
	}
	function select_orderby()
	{
		var select_field='<option value="auth_log_id">รหัสบันทึกการเข้าสู่ระบบ</option>';
		select_field+='<option value="tb_user_username">ชื่อผู้ใช้</option>';
		//var b_url="<?php echo base_url();?>";
		var set_order_link="?d=manage&c=<?=$controller?>&m=set_orderby";
		var c_main_link="?d=manage&c=<?=$controller?>&m=edit";
		var sess_f="<?php echo $sess_orderby_auth_log["field"];?>";
		var sess_t="<?php echo $sess_orderby_auth_log["type"];?>";
		select_orderby_center(select_field, b_url, set_order_link, c_main_link, sess_f, sess_t);
	}
	function select_searchfield()
	{
		var select_field='<option value="auth_log_id">รหัสบันทึกการเข้าสู่ระบบ</option>';
		select_field+='<option value="tb_user_username">ชื่อผู้ใช้</option>';
		select_field+='<option value="ip_address">IPที่เข้าสู่ระบบ</option>';
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