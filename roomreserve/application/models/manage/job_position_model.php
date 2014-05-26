<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_position_model extends MY_Model
{
	private $sess_orderby_job_position;
	function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_job_position"))
			$this->sess_orderby_job_position=$this->session->userdata("orderby_job_position");
	}
	function get_job_position_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_job_position["field"];
		$orderby_type=$this->sess_orderby_job_position["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_job_position", "job_position_name");
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_job_position")->like($searchfield,$liketext,"both")->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_job_position")->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)->limit($perpage,$getpage)->get();
		}
		//echo $query->num_rows();
		//echo $this->db->count_all_results($this->db->last_query());
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function load_job_position($id)
	{
		//for json
		//set session for update
		$this->session->set_userdata("edit_job_position_id",$id);
		$this->db->select()->from("tb_job_position")->where("job_position_id",$id)->limit(1);
		return $this->db->get()->result_array();
	}
}