<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends MY_Controller
{
	public $rgm;
	function __construct()
	{
		parent::__construct();
		$this->load->model("register_model");
		$this->rgm=$this->register_model;
		$this->load->library("page_element_lib");
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add new user
	 */
	function step1()
	{
		
		if($this->session->userdata("rs_username") && $this->fl->check_group_privilege(array("06"))) 
			redirect(base_url());
		$config=array(
				array(
						"field"=>$this->lang->line("in_username"),
						"label"=>$this->lang->line("t_in_username"),
						"rules"=>"required|max_length[15]|min_length[5]|callback_regex_charfirst|callback_already_exist"
				),
				array(
						"field"=>$this->lang->line("in_password"),
						"label"=>$this->lang->line("t_in_password"),
						"rules"=>"required|max_length[15]|min_length[5]|callback_find_space"
				),
				array(
						"field"=>$this->lang->line("in_password2"),
						"label"=>$this->lang->line("t_in_password2"),
						//"rules"=>"required|max_length[15]|min_length[5]|matches[input_password]"
						"rules"=>"required|max_length[15]|min_length[5]|matches[".$this->lang->line("in_password")."]"
				),
				array(
						"field"=>$this->lang->line("in_email"),
						"label"=>$this->lang->line("t_in_email"),
						"rules"=>"required|valid_email|max_length[128]"
				),
				array(
						"field"=>$this->lang->line("in_firstname"),
						"label"=>$this->lang->line("t_in_firstname"),
						"rules"=>"required|max_length[40]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				),
				array(
						"field"=>$this->lang->line("in_lastname"),
						"label"=>$this->lang->line("t_in_lastname"),
						"rules"=>"required|max_length[40]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				),
				array(
						"field"=>$this->lang->line("in_phone"),
						"label"=>$this->lang->line("t_in_phone"),
						"rules"=>"required|max_length[10]|min_length[9]|callback_call_lib[regex_lib,regex_zerofirst,%s - รูปแบบไม่ถูกต้อง]"
				),
				array(
						"field"=>$this->lang->line("in_house_no"),
						"label"=>$this->lang->line("t_in_house_no"),
						"rules"=>"required|max_length[10]|callback_call_lib[regex_lib,regex_house_no,%s - รูปแบบไม่ถูกต้อง]"
				),
				array(
						"field"=>$this->lang->line("in_village_no"),
						"label"=>$this->lang->line("t_in_village_no"),
						"rules"=>"max_length[2]|numeric"
				),
				array(
						"field"=>$this->lang->line("in_alley"),
						"label"=>$this->lang->line("t_in_alley"),
						"rules"=>"max_length[30]"
				),
				array(
						"field"=>$this->lang->line("in_road"),
						"label"=>$this->lang->line("t_in_road"),
						"rules"=>"max_length[25]"
				),
				array(
						"field"=>$this->lang->line("in_occupation"),
						"label"=>$this->lang->line("t_in_occupation"),
						"rules"=>"max_length[30]"
				),
				array(
						"field"=>$this->lang->line("in_titlename"),
						"label"=>$this->lang->line("t_in_othertitlename"),
						"rules"=>"max_length[30]"
				),
				array(
						"field"=>$this->lang->line("se_titlename"),
						"label"=>$this->lang->line("t_se_titlename"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_occupation"),
						"label"=>$this->lang->line("t_se_occupation"),
						"rules"=>"required|callback_selected_other"
				),
				array(
						"field"=>$this->lang->line("se_province"),
						"label"=>$this->lang->line("t_se_province"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_district"),
						"label"=>$this->lang->line("t_se_district"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_subdistrict"),
						"label"=>$this->lang->line("t_se_subdistrict"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("in_id_card_number"),
						"label"=>$this->lang->line("t_in_id_card_number"),
						"rules"=>"required|max_length[13]|min_length[13]|numeric|callback_id_card_already_exist"
				)
				
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			/*initial  create element with element_lib*/

			$in_username=array(
					"LB_text"=>$this->lang->line("t_in_username"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_username"),
					"IN_id"=>$this->lang->line("in_username"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_username")),
					"IN_attr"=>'maxlength="15"',
					"help_text"=>'5-15 ตัวอักษร และขึ้นต้นด้วยตัวอักษรภาษาอังกฤษ เช่น username, user123'
			);
			$in_password=array(
					"LB_text"=>$this->lang->line("t_in_password"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'password',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_password"),
					"IN_id"=>$this->lang->line("in_password"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_password")),
					"IN_attr"=>'maxlength="15"',
					"help_text"=>$this->lang->line("5_15char")
			);
			$in_password2=array(
					"LB_text"=>$this->lang->line("t_in_password2"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'password',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_password2"),
					"IN_id"=>$this->lang->line("in_password2"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_password2")),
					"IN_attr"=>'maxlength="15"',
					"help_text"=>$this->lang->line("5_15char")
			);
			$in_email=array(
					"LB_text"=>$this->lang->line("t_in_email"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_email"),
					"IN_id"=>$this->lang->line("in_email"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_email")),
					"IN_attr"=>'maxlength="128"',
					"help_text"=>'เช่น example@hotmail.com, example@gmail.com'
			);
			$in_firstname=array(
					"LB_text"=>$this->lang->line("t_in_firstname"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_firstname"),
					"IN_id"=>$this->lang->line("in_firstname"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_firstname")),
					"IN_attr"=>'maxlength="40"',
					"help_text"=>$this->lang->line("THENchar")
			);
			$in_lastname=array(
					"LB_text"=>$this->lang->line("t_in_lastname"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_lastname"),
					"IN_id"=>$this->lang->line("in_lastname"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_lastname")),
					"IN_attr"=>'maxlength="40"',
					"help_text"=>$this->lang->line("THENchar")
			);
			$in_occupation=array(
					"LB_text"=>$this->lang->line("t_in_otheroccupation"),
					"LB_attr"=>"",
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_occupation"),
					"IN_id"=>$this->lang->line("in_occupation"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_occupation")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>''
			);
			$in_phone=array(
					"LB_text"=>$this->lang->line("t_in_phone"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_phone"),
					"IN_id"=>$this->lang->line("in_phone"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_phone")),
					"IN_attr"=>'maxlength="10"',
					"help_text"=>'เช่น 087653210, 055123456'
			);
			$in_house_no=array(
					"LB_text"=>$this->lang->line("t_in_house_no"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_house_no"),
					"IN_id"=>$this->lang->line("in_house_no"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_house_no")),
					"IN_attr"=>'maxlength="10"',
					"help_text"=>'เช่น 78, 87/3, 1234/987'
			);
			$in_village_no=array(
					"LB_text"=>$this->lang->line("t_in_village_no"),
					"LB_attr"=>'',
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_village_no"),
					"IN_id"=>$this->lang->line("in_village_no"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_village_no")),
					"IN_attr"=>'maxlength="2"',
					"help_text"=>'เช่น 1, 99'
			);
			$in_alley=array(
					"LB_text"=>$this->lang->line("t_in_alley"),
					"LB_attr"=>'',
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_alley"),
					"IN_id"=>$this->lang->line("in_alley"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_alley")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>''
			);
			$in_road=array(
					"LB_text"=>$this->lang->line("t_in_road"),
					"LB_attr"=>'',
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_road"),
					"IN_id"=>$this->lang->line("in_road"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_road")),
					"IN_attr"=>'maxlength="25"',
					"help_text"=>''
			);
			$in_titlename=array(
					"LB_text"=>$this->lang->line("t_in_othertitlename"),
					"LB_attr"=>"",
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_titlename"),
					"IN_id"=>$this->lang->line("in_titlename"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_titlename")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>''
			);
			$se_titlename=array(
					"LB_text"=>$this->lang->line("t_se_titlename"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_titlename"),
					"S_id"=>$this->lang->line("se_titlename"),
					"S_old_value"=>$this->input->post($this->lang->line("se_titlename")),
					"S_data"=>$this->emm->select_titlename(),
					"S_id_field"=>"titlename_id",
					"S_name_field"=>"titlename",
					"help_text"=>''
			);
			$se_occupation=array(
					"LB_text"=>$this->lang->line("t_se_occupation"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_occupation"),
					"S_id"=>$this->lang->line("se_occupation"),
					"S_old_value"=>$this->input->post($this->lang->line("se_occupation")),
					"S_data"=>$this->emm->select_occupation(),
					"S_id_field"=>"occupation_id",
					"S_name_field"=>"occupation_name",
					"help_text"=>''
			);
			$se_province=array(
					"LB_text"=>$this->lang->line("t_se_province"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_province"),
					"S_id"=>$this->lang->line("se_province"),
					"S_old_value"=>$this->input->post($this->lang->line("se_province")),
					"S_data"=>$this->emm->select_province(),
					"S_id_field"=>"province_id",
					"S_name_field"=>"province_name",
					"help_text"=>''
			);
			$se_district=array(
					"LB_text"=>$this->lang->line("t_se_district"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_district"),
					"S_id"=>$this->lang->line("se_district"),
					"S_old_value"=>$this->input->post($this->lang->line("se_district")),
					"S_data"=>"",
					"S_id_field"=>"district_id",
					"S_name_field"=>"district_name",
					"help_text"=>''
			);
			$se_subdistrict=array(
					"LB_text"=>$this->lang->line("t_se_subdistrict"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_subdistrict"),
					"S_id"=>$this->lang->line("se_subdistrict"),
					"S_old_value"=>$this->input->post($this->lang->line("se_subdistrict")),
					"S_data"=>"",
					"S_id_field"=>"subdistrict_id",
					"S_name_field"=>"subdistrict_name",
					"help_text"=>''
			);
			$in_id_card_number=array(
					"LB_text"=>$this->lang->line("t_in_id_card_number"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_id_card_number"),
					"IN_id"=>$this->lang->line("in_id_card_number"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_id_card_number")),
					"IN_attr"=>'maxlength="13"',
					"help_text"=>'ตัวเลข 13 หลัก'
			);
			
			/*-*initial attr for create element with element_lib*/
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("สมัครสมาชิก"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					
					"in_username"=>$this->eml->form_input($in_username),
					"in_password"=>$this->eml->form_input($in_password),
					"in_password2"=>$this->eml->form_input($in_password2),
					"in_email"=>$this->eml->form_input($in_email),
					"in_firstname"=>$this->eml->form_input($in_firstname),
					"in_lastname"=>$this->eml->form_input($in_lastname),
					"in_occupation"=>$this->eml->form_input($in_occupation),
					"in_phone"=>$this->eml->form_input($in_phone),
					"in_house_no"=>$this->eml->form_input($in_house_no),
					"in_village_no"=>$this->eml->form_input($in_village_no),
					"in_alley"=>$this->eml->form_input($in_alley),
					"in_road"=>$this->eml->form_input($in_road),
					"in_titlename"=>$this->eml->form_input($in_titlename),
					"se_titlename"=>$this->eml->form_select($se_titlename),
					"se_occupation"=>$this->eml->form_select($se_occupation),
					"se_province"=>$this->eml->form_select($se_province),
					"se_district"=>$this->eml->form_select($se_district),
					"se_subdistrict"=>$this->eml->form_select($se_subdistrict),
					"in_id_card_number"=>$this->eml->form_input($in_id_card_number)
			);
			$this->load->view("register1",$data);
		}
		else 
		{	
			$this->rgm->add_user();
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * Return district list as JSON 
	 * SELECT * FROM tb_district WHERE district_id LIKE 'province_id%' ORDER BY ....
	 */
	function select_district()
	{
		if($this->input->post("province_id")!=''):
			$query=$this->emm->select_district($this->input->post("province_id"));
			$data='';
			if($query>0):
				foreach($query AS $ar):
					$data.="<option value='".$ar['district_id']."'>".$ar['district_name']."</option>";
				endforeach;
			endif;
			echo json_encode(array("district_list"=>$data));
		else: echo "";
		endif;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Return subdistrict list as JSON
	 * SELECT * FROM tb_subdistrict WHERE subdistrict_id LIKE 'district_id%' ORDER BY ....
	 */
	function select_subdistrict()
	{
		if($this->input->post("district_id")!=''):
			$query=$this->emm->select_subdistrict($this->input->post("district_id"));
			$data='';
			if($query>0):
				foreach($query AS $ar):
					$data.="<option value='".$ar['subdistrict_id']."'>".$ar['subdistrict_name']."</option>";
				endforeach;
			endif;
			echo json_encode(array("subdistrict_list"=>$data));
			else: echo "";
		endif;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Begin with EN charactor for Username
	 * @param String $data
	 * @return boolean
	 */
	function regex_charfirst($data)
	{
		$pattern="/^[a-zA-Z][a-zA-Z0-9]+$/";
		$this->form_validation->set_message('regex_charfirst',"%s - ต้องขึ้นต้นด้วยอักษรภาษาอังกฤษ");
		$rs=preg_match($pattern,$data,$matchOutput);
		if($rs == 1):
			return true;
		else:
			return false;
		endif;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Allow ENG & TH Charactor for Firstname & Lastname
	 * @param String $data
	 * @return boolean
	 */
	function regex_charTHEN($data)
	{
		$pattern="/^[a-zA-Zก-ํ]+$/u";
		$this->form_validation->set_message('regex_charTHEN',"%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ");
		$rs=preg_match($pattern,$data,$matchOutput);
		if($rs == 1):
			return true;
		else:
			return false;
		endif;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * $param = library_name , method_in_library , error_message
	 * $param_value = array(library_name , method_in_library , error_message);
	 * Example use like this >> callback_call_lib[regex_lib,regex_house_no,%s - รูปแบบไม่ถูกต้อง]
	 * @see MY_Controller::call_lib()
	 */
	function call_lib($data,$param)
	{
		$param_value=explode(',',$param);
		$this->form_validation->set_message("call_lib",$param_value[2]);
		$this->load->library($param_value[0]);
		//send $data to method in library
		return $this->$param_value[0]->$param_value[1]($data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * If seleced otherOccupation from <select>
	 * @param String $data
	 * @return boolean
	 */
	function selected_other($data)
	{
		$this->form_validation->set_message("selected_other","%s - กรุณาระบุอาชีพอื่นๆ");
		if($data=="00") 
		{
			if(strlen(trim($this->input->post($this->lang->line("in_occupation"))))<1)return false;
			else return true;
		}
		else if($data!="00" && $data!="")
		{
			return true;
		}
		else return false;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Find space in string
	 * @param String $data
	 * @return boolean
	 */
	function find_space($data)
	{
		$this->form_validation->set_message("find_space","%s - มีช่องว่าง");
		if(strpos($data," ")==true) return false;
		else return true;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check Username already exist
	 * @param String $data
	 */
	function already_exist($data)
	{
		$this->form_validation->set_message("already_exist","%s - ข้อมูลถูกใช้แล้วไม่สามารถใช้ได้");
		return $this->rgm->username_already_exist($data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check id_card_number already exist
	 * @param String $data
	 */
	function id_card_already_exist($data)
	{
		$this->form_validation->set_message("already_exist","%s - ข้อมูลถูกใช้แล้วไม่สามารถใช้ได้");
		return $this->rgm->id_card_already_exist($data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check Username already exist with ajax
	 */
	function already_exist_ajax()
	{
		//return $rgm->username_already_exist($this->input->post("input_username"));
		echo json_encode($this->rgm->username_already_exist($this->input->post($this->lang->line("in_username"))));
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check id_card_number already exist with ajax
	 */
	function id_card_already_exist_ajax()
	{
		echo json_encode($this->rgm->id_card_already_exist($this->input->post($this->lang->line("in_id_card_number"))));
	}
}