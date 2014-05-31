<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends MY_Model
{
	private $sess_orderby_user;
	private $sess_orderby_view_privilege;
	function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_user"))
			$this->sess_orderby_user=$this->session->userdata("orderby_user");
		if($this->session->userdata("orderby_view_privilege"))
			$this->sess_orderby_view_privilege=$this->session->userdata("orderby_view_privilege");
	}
	function get_user_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_user["field"];
		$orderby_type=$this->sess_orderby_user["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_user", "username");
		
		if($liketext!='')
		{
			$query=$this->db->select("tb_user.*,tb_usergroup.group_name,tb_titlename.*")->from("tb_user")
			->join("tb_usergroup","tb_usergroup.usergroup_id=tb_user.tb_usergroup_id")
			->join("tb_titlename","tb_titlename.titlename_id=tb_user.tb_titlename_id")
			->like($searchfield,$liketext,"both")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select("tb_user.*,tb_usergroup.group_name,tb_titlename.*")->from("tb_user")
			->join("tb_usergroup","tb_usergroup.usergroup_id=tb_user.tb_usergroup_id")
			->join("tb_titlename","tb_titlename.titlename_id=tb_user.tb_titlename_id")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function get_user_list_view_privilege($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_view_privilege["field"];
		$orderby_type=$this->sess_orderby_view_privilege["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_view_privilege", "username");
		if($liketext!='')
		{
			$query=$this->db->select("tb_user.*,tb_usergroup.group_name,tb_titlename.*")->from("tb_user")
			->join("tb_usergroup","tb_usergroup.usergroup_id=tb_user.tb_usergroup_id")
			->join("tb_titlename","tb_titlename.titlename_id=tb_user.tb_titlename_id")
			->like($searchfield,$liketext,"both")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select("tb_user.*,tb_usergroup.group_name,tb_titlename.*")->from("tb_user")
			->join("tb_usergroup","tb_usergroup.usergroup_id=tb_user.tb_usergroup_id")
			->join("tb_titlename","tb_titlename.titlename_id=tb_user.tb_titlename_id")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function get_all_data($username)
	{
		$this->db->select("	tb_user.username,
							tb_user.email,
							regis_on,
							tb_user.regis_ip,
							tb_user.tb_usergroup_id,
							tb_user.tb_titlename_id,
							tb_user.firstname,
							tb_user.lastname,
							tb_user.tb_occupation_id,
							tb_user.phone,
							tb_user.house_no,
							tb_user.village_no,
							tb_user.alley,
							tb_user.road,
							tb_user.tb_province_id,
							tb_user.tb_district_id,
							tb_user.tb_subdistrict_id,
							tb_usergroup.group_name,
							tb_titlename.titlename,
							tb_occupation.occupation_name,
							tb_province.province_name,
							tb_district.district_name,
							tb_subdistrict.subdistrict_name",FALSE)->from("tb_user");
		$this->db->join("tb_usergroup","tb_usergroup.usergroup_id=tb_user.tb_usergroup_id");
		$this->db->join("tb_titlename","tb_titlename.titlename_id=tb_user.tb_titlename_id");
		$this->db->join("tb_occupation","tb_occupation.occupation_id=tb_user.tb_occupation_id");
		$this->db->join("tb_province","tb_province.province_id=tb_user.tb_province_id");
		$this->db->join("tb_district","tb_district.district_id=tb_user.tb_district_id");
		$this->db->join("tb_subdistrict","tb_subdistrict.subdistrict_id=tb_user.tb_subdistrict_id");
		$this->db->where("username",$username)->limit(1);
		$query=$this->db->get()->result_array();
		return $query;
	}
	function get_full_name()
	{
		$query=$this->db->select("firstname,lastname")->from("tb_user")
		->where("username",$this->session->userdata("rs_username"))
		->limit(1)->get();
		return $query->result_array();
	}
	function add_privilege_get_user($pid)
	{
		$query=$this->db->query("SELECT username,firstname,lastname FROM tb_user
				WHERE username NOT IN
					(SELECT tb_user_username FROM tb_user_has_privilege
					WHERE tb_privilege_id = ".$pid.")",FALSE);
		return $query->result_array();
	}
	function delete_privilege_get_privilege($username)
	{
		$query=$this->db->select()->from("tb_user_has_privilege")
		->join("tb_privilege","tb_privilege.privilege_id=tb_user_has_privilege.tb_privilege_id")
		->where("tb_user_has_privilege.tb_user_username",$username)
		->group_by("tb_privilege.privilege_name")
		->get();
		return $query->result_array();
	}
	function delete_privilege_process($table,$where)
	{
		$edit_titlename_message='';
		$this->db->trans_begin();
		$this->db->delete($table, $where);
		if($this->db->trans_status()===FALSE):
		$err_num=$this->db->_error_number();
		$this->db->trans_rollback();
		if($table=="tb_user")
			$edit_titlename_message.="<p class='text-danger'>ลบสิทธิ์ไม่สำเร็จ</p><p class='text-danger'>".$this->lang->line("e".$err_num)."</p>";
		else
			$edit_titlename_message.="<p class='text-danger'>ลบสิทธิ์ไม่สำเร็จ</p><p class='text-danger'>".$this->lang->line("e".$err_num)."</p>";
		else:
		$this->db->trans_commit();
		if($table=="tb_user")
			$edit_titlename_message.="<p class='text-success'>ลบสิทธิ์สำเร็จ</p>";
		else
			$edit_titlename_message.="<p class='text-success'>ลบสิทธิ์สำเร็จ</p>";
		endif;
		$this->session->set_flashdata("privilege_message",$edit_titlename_message);
		redirect(base_url()."?d=manage&c=user&m=delete_privilege");
	}
	function delete_privilege_get_user()
	{
		$query = $this->db->query("select username,firstname,lastname 
				from tb_user 
				where username in 
				(select tb_user_username from tb_user_has_privilege)",FALSE);
		return $query->result_array();
	}
	
	function username_exist($username)
	{
		$this->db->select()->from("tb_user")->where("username",$username)->limit(1);
		$q = $this->db->get();
		if($q->num_rows() > 0) return true;
		else return false;
	}
	
	function user_has_privilege_exist($pid, $username)
	{
		$this->db->select()->from("tb_user_has_privilege")
		->where("tb_privilege_id",$pid)
		->where("tb_user_username",$username)
		->limit(1);
		$q = $this->db->get();
		if($q->num_rows() > 0) return false;
		else return true;
	}
}