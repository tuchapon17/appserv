<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Occupation_model extends MY_Model
{
	private $sess_orderby_occupation;
	function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_occupation"))
			$this->sess_orderby_occupation=$this->session->userdata("orderby_occupation");
	}
	function get_occupation_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_occupation["field"];
		$orderby_type=$this->sess_orderby_occupation["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_occupation", "occupation_name");
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_occupation")->like($searchfield,$liketext,"both")->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_occupation")->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)->limit($perpage,$getpage)->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function load_occupation($id)
	{
		//for json
		//set session for update
		$this->session->set_userdata("edit_occupation_id",$id);
		$this->db->select()->from("tb_occupation")->where("occupation_id",$id)->limit(1);
		return $this->db->get()->result_array();
	}
}