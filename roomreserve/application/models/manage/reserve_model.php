<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reserve_model extends MY_Model
{
	private $sess_orderby_reserve;
	private $sess_orderby_reserve2;
	private $sess_orderby_reserve3;
	private $sess_orderby_reserve4;
	private $sess_orderby_reserve_list;
	public function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_reserve"))
			$this->sess_orderby_reserve=$this->session->userdata("orderby_reserve");
		if($this->session->userdata("orderby_reserve2"))
			$this->sess_orderby_reserve2=$this->session->userdata("orderby_reserve2");
		if($this->session->userdata("orderby_reserve3"))
			$this->sess_orderby_reserve3=$this->session->userdata("orderby_reserve3");
		if($this->session->userdata("orderby_reserve_list"))
			$this->sess_orderby_reserve_list=$this->session->userdata("orderby_reserve_list");
		if($this->session->userdata("orderby_reserve4"))
			$this->sess_orderby_reserve4=$this->session->userdata("orderby_reserve4");
	}
	function get_room_has_article($room_id)
	{
		$select_feild="tb_room_has_article.*,tb_article.article_id,tb_article.article_name,tb_article.auto_select";
		$this->db->select($select_feild)->from("tb_room_has_article")->join("tb_article","tb_room_has_article.tb_article_id=tb_article.article_id")->where("tb_room_id",$room_id);
		return $this->db->get()->result_array();
	}
	function find_one($table, $where)
	{
		$this->db->select()->from($table)->where($where)->limit(1);
		return $this->db->get()->result_array();
	}
	function get_reserve_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_reserve["field"];
		$orderby_type=$this->sess_orderby_reserve["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_reserve", "reserve_id");
		
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->where("approve",0)->or_where("approve",3)
			->like($searchfield,$liketext,"both")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->where("approve",0)->or_where("approve",3)
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
	function get_reserve_list2($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_reserve2["field"];
		$orderby_type=$this->sess_orderby_reserve2["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_reserve2", "reserve_id");
		
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->where("approve",1)
			->like($searchfield,$liketext,"both")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->where("approve",1)->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function get_reserve_list3($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_reserve3["field"];
		$orderby_type=$this->sess_orderby_reserve3["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_reserve3", "reserve_id");
		
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->where("approve",2)->like($searchfield,$liketext,"both")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->where("approve",2)->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function get_reserve_list4($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_reserve["field"];
		$orderby_type=$this->sess_orderby_reserve["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_reserve4", "reserve_id");
	
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->like($searchfield,$liketext,"both")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
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
	function get_article_data($reserve_id)
	{
		$this->db->select(
				"tb_reserve.reserve_id,
				tb_reserve_has_article.*,
				tb_article.*"
		)->from("tb_reserve");
		$this->db->join("tb_reserve_has_article","tb_reserve_has_article.tb_reserve_id=tb_reserve.reserve_id");
		$this->db->join("tb_article","tb_article.article_id=tb_reserve_has_article.tb_article_id");
		$this->db->where("tb_reserve.reserve_id",$reserve_id);
		$query=$this->db->get()->result_array();
		return $query;
	}
	function get_datetime_data($reserve_id)
	{
		$this->db->select(
				"tb_reserve.reserve_id,
				tb_reserve_has_datetime.*"
		)->from("tb_reserve");
		$this->db->join("tb_reserve_has_datetime","tb_reserve_has_datetime.tb_reserve_id=tb_reserve.reserve_id");
		$this->db->where("tb_reserve.reserve_id",$reserve_id);
		$query=$this->db->get()->result_array();
		return $query;
	}
	function get_file_data($reserve_id)
	{
		$this->db->select(
				"tb_reserve.reserve_id,
				tb_reserve_has_file.*"
		)->from("tb_reserve");
		$this->db->join("tb_reserve_has_file","tb_reserve_has_file.tb_reserve_id=tb_reserve.reserve_id");
		$this->db->where("tb_reserve.reserve_id",$reserve_id);
		$query=$this->db->get()->result_array();
		return $query;
	}
	function get_reserve_data($reserve_id)
	{
		$this->db->select()->from("tb_reserve");
		$this->db->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id");
		$this->db->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id");
		$this->db->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id");
		$this->db->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id");
		$this->db->join("tb_job_position","tb_job_position.job_position_id=tb_reserve_has_person.tb_job_position_id","left");
		$this->db->join("tb_office","tb_office.office_id=tb_reserve_has_person.tb_office_id","left");
		$this->db->join("tb_department","tb_department.department_id=tb_reserve_has_person.tb_department_id","left");
		$this->db->join("tb_faculty","tb_faculty.faculty_id=tb_reserve_has_person.tb_faculty_id","left");
		$this->db->where("tb_reserve.reserve_id",$reserve_id);
		$query=$this->db->get()->result_array();
		return $query;
	}
	function get_all_reserve_numrows($table,$liketext='',$like_field)
	{
		if($liketext=='')return $this->db->from($table)->where("approve",0)->get()->num_rows();
		else
		{
			return $this->db->from($table)->where("approve",0)->like($like_field,$liketext,"both")->get()->num_rows();
		}
	}
	function get_all_reserve_numrows2($table,$liketext='',$like_field)
	{
		if($liketext=='')return $this->db->from($table)->where("approve",1)->get()->num_rows();
		else
		{
			return $this->db->from($table)->where("approve",1)->like($like_field,$liketext,"both")->get()->num_rows();
		}
	}
	function get_all_reserve_numrows3($table,$liketext='',$like_field)
	{
		if($liketext=='')return $this->db->from($table)->where("approve",2)->get()->num_rows();
		else
		{
			return $this->db->from($table)->where("approve",2)->like($like_field,$liketext,"both")->get()->num_rows();
		}
	}
	function get_all_reserve_numrows4($table,$liketext='',$like_field)
	{
		if($liketext=='')return $this->db->from($table)->get()->num_rows();
		else
		{
			return $this->db->from($table)->like($like_field,$liketext,"both")->get()->num_rows();
		}
	}
	/**
	 * นับจำนวนแถว สำหรับหน้า รายการจองของผู้จอง
	 * @param string $table
	 * @param string $liketext
	 * @param string $like_field
	 */
	function user_reserve_list_numrows($table,$liketext='',$like_field)
	{
		if($liketext=='')
		{
			return $this->db->from($table)->where("tb_user_username",$this->session->userdata("rs_username"))->get()->num_rows();
		}
		else
		{
			return $this->db->from($table)->where("tb_user_username",$this->session->userdata("rs_username"))->like($like_field,$liketext,"both")->get()->num_rows();
		}
	}
	
	/**
	 * query รายการจอง สำหรับหน้า reserve_list
	 * @param number $perpage
	 * @param number $getpage
	 * @param string $liketext
	 * @return boolean
	 */
	function user_reserve_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_reserve_list["field"];
		$orderby_type=$this->sess_orderby_reserve_list["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_reserve_list", "reserve_id");
		if($liketext!='')
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->where("tb_user_username",$this->session->userdata("rs_username"))
			->like($searchfield,$liketext,"both")
			->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)
			->limit($perpage,$getpage)
			->get();
		}
		else
		{
			$query=$this->db->select()->from("tb_reserve")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->where("tb_user_username",$this->session->userdata("rs_username"))
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
	function cancel_reserve($arr_id, $table, $select_field, $message_type='', $main_url='')
	{
		$message='';
		$this->db->trans_begin();
		foreach($arr_id AS $id):
			//table set where limit
			$where=array("reserve_id"=>$id);
			$this->db->update($table,array("canceled"=>1),$where,1);
			/*$where=array(
					$field_PK=>$id
			);*/
			$name=$this->db->select()->from($table)->where($where)->limit(1)->get()->result_array();
			
			if($this->db->trans_status()===FALSE):
			$err_num=$this->db->_error_number();
			$this->db->trans_rollback();
				if($table=="tb_user")
					$message.="<p class='text-danger'>ยกเลิก ".$id." ไม่สำเร็จ</p><p class='text-danger'>- ".$id." ".$this->lang->line("e".$err_num)."</p>";
				else
					$message.="<p class='text-danger'>ยกเลิก ".$id." ".$name[0]["project_name"]." ไม่สำเร็จ</p><p class='text-danger'>- ".$id." ".$name[0]["project_name"]." ".$this->lang->line("e".$err_num)."</p>";
				else:
			$this->db->trans_commit();
				if($table=="tb_user")
					$message.="<p class='text-success'>ยกเลิก ".$id." สำเร็จ</p>";
				else
					$message.="<p class='text-success'>ยกเลิก ".$id." ".$name[0]["project_name"]." สำเร็จ</p>";
				endif;
		endforeach;
		$this->session->set_flashdata($message_type."_message",$message);
		redirect(base_url().$main_url);
	}
	function del_reserve($arr_id, $prev_url)
	{
		$message='';
		foreach($arr_id AS $id)
		{
			$this->db->trans_begin();
			$this->db->delete("tb_reserve_has_article",array("tb_reserve_id"=>$id));
			$this->db->delete("tb_reserve_has_datetime",array("tb_reserve_id"=>$id));
			$this->db->delete("tb_reserve_has_person",array("tb_reserve_id"=>$id));
			$reserve_file = $this->db->select()->from("tb_reserve_has_file")
			->where(array("tb_reserve_id"=>$id))->get()->result_array();
			foreach($reserve_file as $r)
			{
				if(file_exists("upload/docs/".$r['file_name']))
				{
					unlink("upload/docs/".$r['file_name']);
				}
			}
			$this->db->delete("tb_reserve_has_file",array("tb_reserve_id"=>$id));
			$reserve_msg = $this->db->select("project_name")->from("tb_reserve")
			->where("reserve_id",$id)->get()->result_array();
			
			$this->db->delete("tb_reserve",array("reserve_id"=>$id));
			if($this->db->trans_status()===FALSE)
			{
				//get mysql error number
				$err_num=$this->db->_error_number();
				$this->db->trans_rollback();
				$message.="<p class='text-danger'>ลบ ".$id." ".$reserve_msg[0]["project_name"]." ไม่สำเร็จ</p>";
				$message.="<p class='text-danger'>- ".$id." ".$reserve_msg[0]["project_name"]." ".$this->lang->line("e".$err_num)."</p>";
			}
			else 
			{
				$this->db->trans_commit();
				$message.="<p class='text-success'>ลบ ".$id." ".$reserve_msg[0]["project_name"]." สำเร็จ</p>";
			}
		}//foreach
		$this->session->set_flashdata("edit_reserve_message",$message);
		redirect(base_url()."?".$prev_url);
	}
}