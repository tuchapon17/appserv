<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Insert register information to tb_user , Insert user privilege to tb_user_has_privilege
	 */
	function add_user()
	{
		$username=$this->input->post($this->lang->line("in_username"));
		$password=md5($this->input->post($this->lang->line("in_password")));
		$email=$this->input->post($this->lang->line("in_email"));
		$titlename=$this->input->post($this->lang->line("se_titlename"));
		$firstname=$this->input->post($this->lang->line("in_firstname"));
		$lastname=$this->input->post($this->lang->line("in_lastname"));
		$occupation=$this->input->post($this->lang->line("se_occupation"));
		$phone=$this->input->post($this->lang->line("in_phone"));
		
		$data=array(
				"username"=>strtolower($username),
				"password"=>$password,
				"email"=>strtolower($email),
				"regis_on"=>date('Y-m-d H:i:s'),
				"regis_ip"=>$this->input->ip_address(),
				"tb_usergroup_id"=>"04",
				"tb_titlename_id"=>$titlename,
				"firstname"=>$firstname,
				"lastname"=>$lastname,
				"tb_occupation_id"=>$occupation,
				"phone"=>$phone,
				"house_no"=>$this->input->post($this->lang->line("in_house_no")),
				"village_no"=>$this->input->post($this->lang->line("in_village_no")),
				"alley"=>$this->input->post($this->lang->line("in_alley")),
				"road"=>$this->input->post($this->lang->line("in_road")),
				"tb_province_id"=>$this->input->post($this->lang->line("se_province")),
				"tb_district_id"=>$this->input->post($this->lang->line("se_district")),
				"tb_subdistrict_id"=>$this->input->post($this->lang->line("se_subdistrict")),
				"id_card_number"=>$this->input->post($this->lang->line("in_id_card_number"))
		);
		//if data is '' ,spaceToNull convert '' to NULL before insert to DB
		foreach($data AS $key=>$val):
			$data[$key]=$this->toNull($data[$key]);
		endforeach;
		$this->db->trans_begin();
			//insert otheroccupation to tb_occupation
			if($this->input->post("select_occupation")=="00")
			{
				//ถ้ามีอาชีพชื่อซ้ำกัน ให้อ้างอิงอาชีพที่มีอยู่
				$this->db->select()->from("tb_occupation")
				->where("occupation_name",trim($this->input->post("input_occupation")));
				$query = $this->db->get();
				$current_occupation = $query->result_array();
				if($query->num_rows() > 0)
				{
					$data["tb_occupation_id"] = $current_occupation[0]["occupation_id"];
				}
				else 
				{
					//get current max id from MY_Model
					$new_id=$this->get_maxid(2, "occupation_id", "tb_occupation");
					$data_occupation=array(
							"occupation_id"=>$new_id,
							"occupation_name"=>trim($this->input->post( $this->lang->line("in_occupation") )),
							//เปิดให้แสดงอาชีพที่เพิ่มใหม่ ให้เจ้าหน้าที่ตรวจสอบ ยกเลิกออกภายหลัง
							"checked"=>"0"
					);
					$this->db->set($data_occupation)->insert("tb_occupation");
					//set new occupation id
					$data["tb_occupation_id"]=$new_id;
				}
			}
			
			//insert othertitlename to tb_titlename
			if($this->input->post("select_titlename")=="00")
			{
				//ถ้ามีคำนำหน้าชื่อชื่อซ้ำกัน ให้อ้างอิงคำนำหน้าชื่อที่มีอยู่
				$this->db->select()->from("tb_titlename")
				->where("titlename",trim($this->input->post( $this->lang->line("in_titlename")) ));
				$query = $this->db->get();
				$current_titlename = $query->result_array();
				if($query->num_rows() > 0)
				{
					$data["tb_titlename_id"] = $current_titlename[0]["titlename_id"];
				}
				else
				{
					//get current max id from MY_Model
					$new_id=$this->get_maxid(2, "titlename_id", "tb_titlename");
					$data_titlename=array(
							"titlename_id"=>$new_id,
							"titlename"=>trim($this->input->post( $this->lang->line("in_titlename")) ),
							//เปิดให้แสดงคำนำหน้าชื่อที่เพิ่มใหม่ ให้เจ้าหน้าที่ตรวจสอบ ยกเลิกออกภายหลัง
							"checked"=>"0"
					);
					$this->db->set($data_titlename)->insert("tb_titlename");
					//set new titlename id
					$data["tb_titlename_id"]=$new_id;
				}
			}
			//insert new user to tb_user
			$this->db->set($data)->insert('tb_user');
			
			/*
			//select privilege from usergroup and insert to tb_user_has_privilege
			/* ไม่ได้ใช้ มี trigger แล้ว = "add_user_has_privilege"
			$this->db->select()->from("tb_usergroup_has_privilege");
			$group_privilege = $this->db->where("tb_usergroup_id","04")->get()->result_array();
			foreach($group_privilege as $g)
			{
				$gp = array(
						"tb_privilege_id"=>$g['tb_privilege_id'],
						"tb_user_username"=>$username
				);
				$this->db->set($gp)->insert("tb_user_has_privilege");
			}*/
				
		if($this->db->trans_status()===FALSE):
			$this->db->trans_rollback();
			$this->session->set_flashdata("register_status",false);
			$this->session->set_flashdata("register_message",$this->db->last_query()."ลงทะเบียนไม่สำเร็จ");
			redirect(base_url()."?c=register&m=step1");
		else:
			$this->db->trans_commit();
			$this->session->set_flashdata("register_status",true);
			$this->session->set_flashdata("register_message","ลงทะเบียนสำเร็จ");
			redirect(base_url()."?c=register&m=step1");
		endif;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * convert '' to NULL before insert to DB
	 * @param $data
	 * @return NULL|old_data
	 */
	function toNull($data)
	{
		if($data=='')return null;
		else return $data;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check Username in tb_user, Return true if username not exists
	 * @param $username
	 * @return boolean
	 */
	function username_already_exist($username)
	{
		$this->db->select()->from("tb_user")->where("username",$username);
		$num_rows=$this->db->get()->num_rows();
		if($num_rows>0)return false;
		else if($num_rows==0)return true;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check id_card_number in tb_user is exist or doesn't exist?
	 * @param String $id
	 * @return boolean
	 */
	function id_card_already_exist($id)
	{
		$this->db->select()->from("tb_user")->where("id_card_number",$id);
		$num_rows=$this->db->get()->num_rows();
		if($num_rows>0)return false;
		else if($num_rows==0)return true;
	}
	
}