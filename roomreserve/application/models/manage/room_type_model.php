<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Room_type_model extends MY_Model
{
	private $sess_orderby_room_type;
	public function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_room_type"))
			$this->sess_orderby_room_type=$this->session->userdata("orderby_room_type");
	}
	function get_room_type_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_room_type["field"];
		$orderby_type=$this->sess_orderby_room_type["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_room_type", "room_type_name");
		
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_room_type")->like($searchfield,$liketext,"both")->order_by("CONVERT(".$orderby_filed." USING UTF8)",$orderby_type)->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_room_type")->order_by("CONVERT(".$orderby_filed." USING UTF8)",$orderby_type)->limit($perpage,$getpage)->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function load_room_type($id)
	{
		//for json
		//set session for update
		$this->session->set_userdata("edit_room_type_id",$id);
		$this->db->select()->from("tb_room_type")->where("room_type_id",$id)->limit(1);
		return $this->db->get()->result_array();
	}
}