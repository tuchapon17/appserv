<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Department_model extends MY_Model
{
	private $sess_orderby_department;
	function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_department"))
			$this->sess_orderby_department=$this->session->userdata("orderby_department");
	}
	function get_department_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_department["field"];
		$orderby_type=$this->sess_orderby_department["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_department", "department_name");
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_department")->like($searchfield,$liketext,"both")->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_department")->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)->limit($perpage,$getpage)->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function load_department($id)
	{
		//for json
		//set session for update
		$this->session->set_userdata("edit_department_id",$id);
		$this->db->select()->from("tb_department")->where("department_id",$id)->limit(1);
		return $this->db->get()->result_array();
	}
}