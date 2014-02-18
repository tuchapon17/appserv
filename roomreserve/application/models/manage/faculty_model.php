<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faculty_model extends MY_Model
{
	private $sess_orderby_faculty;
	function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_faculty"))
			$this->sess_orderby_faculty=$this->session->userdata("orderby_faculty");
	}
	function get_faculty_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_faculty["field"];
		$orderby_type=$this->sess_orderby_faculty["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_faculty", "faculty_name");
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_faculty")->like($searchfield,$liketext,"both")->order_by("CONVERT(".$orderby_filed." USING UTF8)",$orderby_type)->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_faculty")->order_by("CONVERT(".$orderby_filed." USING UTF8)",$orderby_type)->limit($perpage,$getpage)->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function load_faculty($id)
	{
		//for json
		//set session for update
		$this->session->set_userdata("edit_faculty_id",$id);
		$this->db->select()->from("tb_faculty")->where("faculty_id",$id)->limit(1);
		return $this->db->get()->result_array();
	}
}