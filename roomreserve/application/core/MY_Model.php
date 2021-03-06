<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		$this->default_admin_account();
		$this->lang->load("db_error/error","thailand");
	}
	
	function default_admin_account()
	{
		$this->db->select()->from("tb_user")->where(array("tb_usergroup_id"=>"01"));
		$ugroup=$this->db->get();
		$this->db->select()->from("tb_user")->where(array("username"=>"admin"));
		$admin=$this->db->get();
		
		$this->db->select()->from("tb_titlename")->limit(1);
		$titlename=$this->db->get()->result_array();
		
		if($ugroup->num_rows()<1 && $admin->num_rows()<1)
		{
			$set=array(
					"username"=>"admin",
					"password"=>md5("admin@reserve"),
					"email"=>"tuchapon33@hotmail.com",
					"regis_on"=>date('Y-m-d H:i:s'),
					"regis_ip"=>"127.0.0.1",
					"tb_usergroup_id"=>"01",
					"tb_titlename_id"=>$titlename[0]['titlename_id'],
					"firstname"=>"admin",
					"lastname"=>"admin",
					"tb_occupation_id"=>"00",
					"phone"=>"0881515680",
					"house_no"=>"87/3",
					"village_no"=>"2",
					"tb_province_id"=>"73",
					"tb_district_id"=>"7303",
					"tb_subdistrict_id"=>"730319",
					"user_status"=>1
			);
			$this->db->trans_begin();
				$this->db->insert("tb_user",$set);
			if($this->db->trans_status()===FALSE):
				$this->db->trans_rollback();
			else:
				$this->db->trans_commit();
			endif;
			
		}
	}
	
	function get_maxid($zero_num,$field_id,$table)
	{
		$current_max_id_arr=$this->db->select("MAX($field_id) AS $field_id")->from($table)->limit(1)->get()->result_array();
		$current_max_id=(int)$current_max_id_arr[0][$field_id];
	
		//%0 = เติม0 2d=2หลัก เช่น 08
		$new_id=sprintf("%0".$zero_num."d",($current_max_id+1));
		return $new_id;
	}
	
	/*#################################################
	 * $data=ข้อมูลในรูปแบบ array
	 * $table_name=ชื่อตาราง
	 * $success_link=redirect เมื่อ insert สำเร็จ
	 * $error_link=redirect เมื่อ insert ไม่สำเร็จ
	 * $message_type=ชื่อ session จะต่อด้วย _message สำหรับแสดง alert หน้าเพิ่มข้อมูล
	 * $success_message=ข้อความแจ้งเตือนใน alert เมื่อสำเร็จ
	 * $error_message=ข้อความแจ้งเตือนใน alert เมื่อไม่สำเร็จ
	#################################################*/
	function manage_add($data, $table_name, $success_link, $error_link, $message_type="", $success_message="", $error_message="")
	{
		$this->db->trans_begin();
		// Set for session flashdata
		$session_message_type=$message_type."_message";
			$this->db->set($data)->insert($table_name);
		if($this->db->trans_status()===FALSE):
			$this->db->trans_rollback();
			$this->session->set_flashdata($session_message_type,"<p class='text-danger'>".$error_message."</p>");
			redirect(base_url().$error_link);
		else:
			$this->db->trans_commit();
			$this->session->set_flashdata($session_message_type,"<p class='text-success'>".$success_message."</p>");
			redirect(base_url().$success_link);
		endif;
	}
	
	function manage_add2($data, $table_name)
	{
		//*$this->db->trans_begin();
			// Set for session flashdata
			//$session_message_type=$message_type."_message";
		$this->db->set($data)->insert($table_name);
		//*if($this->db->trans_status()===FALSE):
		//*$this->db->trans_rollback();
			//$this->session->set_flashdata($session_message_type,"<p class='text-danger'>".$error_message."</p>");
			//redirect(base_url().$error_link);
		//*else:
		//*$this->db->trans_commit();
			//$this->session->set_flashdata($session_message_type,"<p class='text-success'>".$success_message."</p>");
			//redirect(base_url().$success_link);
		//*endif;
	}
	
	function manage_edit($set, $where, $table_name, $session_edit_id, $message_type, $success_message='success', $error_message='error', $main_url='', $prev_url)
	{
		/*
		 * $filed_PK , $table_name , $session_edit_id , $message_type , $success_message , $error_message , $main_link='' 
		 * 
		 */
		//$session_edit_id
		if($this->session->userdata($session_edit_id))
		{
			$this->db->trans_begin();
			$this->db->update($table_name,$set,$where);
			if($this->db->trans_status()===FALSE):
				$this->db->trans_rollback();
			
				$this->session->set_flashdata($message_type."_message","<p class='text-danger'>".$error_message."</p>");
				redirect($prev_url);
			else:
				$this->db->trans_commit();
				$this->session->unset_userdata($session_edit_id);
				$this->session->set_flashdata($message_type."_message","<p class='text-success'>".$success_message."</p>");
				redirect($prev_url);
			endif;
		}
		else
		{
			$this->session->set_flashdata($message_type."_message","<p class='text-danger'>".$error_message."</p>");
			redirect(base_url().$main_url);
		}
	}
	function manage_edit2($set, $where, $table_name, $message_type, $success_message='success', $error_message='error', $prev_url)
	{
		$this->db->trans_begin();
		$this->db->update($table_name,$set,$where);
		if($this->db->trans_status()===FALSE):
		$this->db->trans_rollback();
		$this->session->set_flashdata($message_type."_message","<p class='text-danger'>".$error_message."</p>");
		redirect($prev_url);
		else:
		$this->db->trans_commit();
		$this->session->set_flashdata($message_type."_message","<p class='text-success'>".$success_message."</p>");
		redirect($prev_url);
		endif;
	}
	function manage_delete($arr_id, $table, $field_PK, $select_field, $message_type='', $main_url='')
	{
		$edit_titlename_message='';
		$this->db->trans_begin();
		foreach($arr_id AS $id):
			$where=array(
					$field_PK=>$id
			);
			$name=$this->db->select($select_field)->from($table)->where($where)->limit(1)->get()->result_array();
			$this->db->delete($table,$where);
			if($this->db->trans_status()===FALSE):
			
				$err_num=$this->db->_error_number();
			
				$this->db->trans_rollback();
				if($table=="tb_user")
					$edit_titlename_message.="<p class='text-danger'>ลบ ".$id." ไม่สำเร็จ</p><p class='text-danger'>- ".$id." ".$this->lang->line("e".$err_num)."</p>";
				else
					$edit_titlename_message.="<p class='text-danger'>ลบ ".$id." ".$name[0][$select_field]." ไม่สำเร็จ</p><p class='text-danger'>- ".$id." ".$name[0][$select_field]." ".$this->lang->line("e".$err_num)."</p>";
			else:
				$this->db->trans_commit();
				if($table=="tb_user")
					$edit_titlename_message.="<p class='text-success'>ลบ ".$id." สำเร็จ</p>";
				else 
					$edit_titlename_message.="<p class='text-success'>ลบ ".$id." ".$name[0][$select_field]." สำเร็จ</p>";
			endif;
		endforeach;
		$this->session->set_flashdata($message_type."_message",$edit_titlename_message);
		redirect(base_url().$main_url);
	}
	function get_all_numrows($table,$liketext='',$like_field)
	{
		if($liketext=='')return $this->db->count_all($table);
		else
		{
			return $this->db->from($table)->like($like_field,$liketext,"both")->get()->num_rows();
		}
	}
	function manage_allow($allow_list,$disallow_list, $table, $field_PK, $select_field, $message_type='', $main_url='')
	{
		$edit_titlename_message='';
		$this->db->trans_begin();
		foreach($allow_list AS $allow):
			$where=array(
					$field_PK=>$allow
			);
			if($table=="tb_reserve")$data=array("approve"=>"1","approve_on"=>date('Y-m-d H:i:s'),"approve_by"=>$this->session->userdata("rs_username"));
			else $data=array("checked"=>"1");
			
			if($table=="tb_user")$data=array("user_status"=>"1");
			if($table=="tb_room")$data=array("room_status"=>"1");
			$name=$this->db->select($select_field)->from($table)->where($where)->limit(1)->get()->result_array();
			$this->db->where($where);
			$this->db->update($table,$data);
			
			if($this->db->trans_status()===FALSE):
			$this->db->trans_rollback();
			$edit_titlename_message.="<p class='text-danger'>อนุมัติ ".$allow." ".$name[0][$select_field]." ไม่สำเร็จ</p>";
			else:
			$this->db->trans_commit();
			$edit_titlename_message.="<p class='text-success'>อนุมัติ ".$allow." ".$name[0][$select_field]." สำเร็จ</p>";
			endif;
		endforeach;
		foreach($disallow_list AS $disallow):
			$where=array(
					$field_PK=>$disallow
			);
			if($table=="tb_reserve")$data=array("approve"=>"0");
			else $data=array("checked"=>"0");
			if($table=="tb_user")$data=array("user_status"=>"0");
			if($table=="tb_room")$data=array("room_status"=>"0");
			$name=$this->db->select($select_field)->from($table)->where($where)->limit(1)->get()->result_array();
			$this->db->where($where);
			$this->db->update($table,$data);
				
			if($this->db->trans_status()===FALSE):
			$this->db->trans_rollback();
			$edit_titlename_message.="<p class='text-danger'>ยกเลิก ".$disallow." ".$name[0][$select_field]." ไม่สำเร็จ</p>";
			else:
			$this->db->trans_commit();
			$edit_titlename_message.="<p class='text-success'>ยกเลิก ".$disallow." ".$name[0][$select_field]." สำเร็จ</p>";
			endif;
		endforeach;
		$this->session->set_flashdata($message_type."_message",$edit_titlename_message);
		//redirect(base_url().$main_url);
	}
	
	function check_searchfield($sess_name,$default_field)
	{
		if($this->session->userdata($sess_name)) return $this->session->userdata($sess_name);
		else
		{
			$this->session->set_userdata($sess_name,$default_field);
			return $default_field;
		}
	}
	function get_all_field($table_name)
	{
		return $this->db->list_fields($table_name);
	}
	
	
}