<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Office_model extends MY_Model
{
	private $sess_orderby_office;
	function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_office"))
			$this->sess_orderby_office=$this->session->userdata("orderby_office");
	}
	function get_office_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_office["field"];
		$orderby_type=$this->sess_orderby_office["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_office", "office_name");
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_office")->like($searchfield,$liketext,"both")->order_by("CONVERT(".$orderby_filed." USING TIS620)",$orderby_type)->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_office")->order_by("CONVERT(".$orderby_filed." USING TIS620)",$orderby_type)->limit($perpage,$getpage)->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function load_office($id)
	{
		//for json
		//set session for update
		$this->session->set_userdata("edit_office_id",$id);
		$this->db->select()->from("tb_office")->where("office_id",$id)->limit(1);
		return $this->db->get()->result_array();
	}
}