<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Room_model extends MY_Model
{
	private $sess_orderby_room;
	function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_room"))
			$this->sess_orderby_room=$this->session->userdata("orderby_room");
	}
	function get_room_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_room["field"];
		$orderby_type=$this->sess_orderby_room["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_room", "room_name");
		
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_room")
			->join("tb_room_type","tb_room_type.room_type_id=tb_room.tb_room_type_id")
			->join("tb_fee_type","tb_fee_type.fee_type_id=tb_room.tb_fee_type_id")
			->like($searchfield,$liketext,"both")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_room")
			->join("tb_room_type","tb_room_type.room_type_id=tb_room.tb_room_type_id")
			->join("tb_fee_type","tb_fee_type.fee_type_id=tb_room.tb_fee_type_id")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	/*
	 * หน้า edit ข้อมูลห้อง
	 */
	function load_room($id)
	{
		//for json
		//set session for update
		$this->session->set_userdata("edit_room_id",$id);
		$this->db->select()->from("tb_room")->where("room_id",$id)->limit(1);
		return $this->db->get()->result_array();
	}
	function room_pic($per_page,$page)
	{
		$this->db->select()->from("tb_room_has_pic");
		$this->db->where(array("tb_room_id"=>$_GET['rmid']))->order_by("room_pic_id")->limit($per_page,$page);
		return $query = $this->db->get()->result_array();
	}
	/*
	 * หน้าจัดการรูป
	 */
	function get_room_data($room_id)
	{
		$this->db->select()->from("tb_room");
		$this->db->where("room_id",$room_id)->limit(1);
		return $this->db->get()->result_array();
	}
	function get_pic_file_name($room_pic_id)
	{
		$this->db->select()->from("tb_room_has_pic");
		$this->db->where("room_pic_id",$room_pic_id)->limit(1);
		return $this->db->get()->result_array();
	}
	function get_room_list_upload()
	{
		return $this->db->select()->from("tb_room")->get()->result_array();
	}
	function get_room_list_upload2($room_type_id)
	{
		$this->db->select()->from("tb_room");
		$this->db->where('tb_room_type_id',$room_type_id)
		->order_by("CONVERT(room_name USING ".$this->mysql_charset.")","ASC");
		$query=$this->db->get();
		return $query->result_array();
	}
}