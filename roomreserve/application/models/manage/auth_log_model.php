<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_log_model extends MY_Model
{
	private $sess_orderby_auth_log;
	function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_auth_log"))
			$this->sess_orderby_auth_log=$this->session->userdata("orderby_auth_log");
	}
	function get_auth_log_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_auth_log["field"];
		$orderby_type=$this->sess_orderby_auth_log["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_auth_log", "tb_user_username");
		$sql_select="*,DATE_FORMAT(login_on,'%d/%m/%Y %H:%i:%s') AS login_on";
		$table_name="tb_auth_log";
		if($liketext!='')
		{
			$query=$this->db->select($sql_select,FALSE)->from($table_name)->like($searchfield,$liketext,"both")->order_by("CONVERT(".$orderby_filed." USING UTF8)",$orderby_type)->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select($sql_select,FALSE)->from($table_name)->order_by("CONVERT(".$orderby_filed." USING UTF8)",$orderby_type)->limit($perpage,$getpage)->get();
		}
		$num_rows=$query->num_rows();
		if($num_rows>0)
		{
			return $query->result_array();
		}
		else return false;
	}
}