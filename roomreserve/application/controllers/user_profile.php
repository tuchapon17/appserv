<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_profile extends MY_Controller
{
	private $upm;
	function __construct()
	{
		parent::__construct();
		$this->load->model("user_profile_model");
		$this->upm=$this->user_profile_model;
	}
	function view_profile()
	{
		$this->fl->check_loggedin();
		/*#################################################
		 * access rules for view user profile
		#################################################*/
		//If don't have $_GET["vuser"] but has logged in > redirect with $_GET["vuser"]
		if(!isset($_GET["vuser"]) && $this->session->userdata("rs_username"))
			redirect(base_url()."?c=user_profile&m=view_profile&vuser=".$this->session->userdata("rs_username"));
		//If not set $_GET["vuser"] or not logged in
		if(!isset($_GET["vuser"]) || !$this->session->userdata("rs_username")) show_404();		
		
		$data=array(
				"htmlopen"=>$this->pel->htmlopen(),
				"head"=>$this->pel->head("ข้อมูลส่วนตัว"),
				"bodyopen"=>$this->pel->bodyopen(),
				"navbar"=>$this->pel->navbar(),
				"js"=>$this->pel->js(),
				"footer"=>$this->pel->footer(),
				"bodyclose"=>$this->pel->bodyclose(),
				"htmlclose"=>$this->pel->htmlclose(),
				"profile_tab"=>$this->profile_tab()
		);

		/*#################################################
		Check query result if no result(count=0) will show 404 page
		###################################################*/
		if(count($this->upm->user_profile($_GET["vuser"])) == 0)  show_404();
		else
		{
			$get_profile=$this->upm->user_profile($_GET["vuser"]);
			$data=array_merge($data,$get_profile[0]);
		}
		
		$this->load->view("view_profile",$data);
		
	}
	function edit_profile1()
	{
		$this->fl->check_loggedin();
		/*
		 * check ต้องมี session rs_username
		* */				
		$config=array(
				
				array(
						"field"=>$this->lang->line("in_email"),
						"label"=>$this->lang->line("t_in_email"),
						"rules"=>"required|valid_email|max_length[128]"
				)
		);
		
		if($this->input->post("change_password")=="checked_pwd")
		{
			$config2=array(
					array(
							"field"=>$this->lang->line("in_password0"),
							"label"=>$this->lang->line("t_in_password0"),
							"rules"=>"required|max_length[15]|min_length[5]|callback_check_current_password"
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
					)
			);
			$config=array_merge($config,$config2);
		}
		
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			/*initial  create element with element_lib*/
			$in_username=array(
					"LB_text"=>$this->lang->line("t_in_username"),
					"LB_attr"=>'',
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_username"),
					"IN_id"=>$this->lang->line("in_username"),
					"IN_PH"=>'',
					"IN_value"=>$this->session->userdata("rs_username"),
					"IN_attr"=>'maxlength="15" disabled',
					"help_text"=>''
			);
			$in_password0=array(
					"LB_text"=>$this->lang->line("t_in_password0"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'password',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_password0"),
					"IN_id"=>$this->lang->line("in_password0"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_password0")),
					"IN_attr"=>'maxlength="15"',
					"help_text"=>$this->lang->line("5_15char")
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
					"IN_id"=>$this->lang->line("in_password"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_password")),
					"IN_attr"=>'maxlength="15"',
					"help_text"=>$this->lang->line("5_15char")
			);
			$get_email=$this->upm->user_email($this->session->userdata("rs_username"));
			$in_email=array(
					"LB_text"=>$this->lang->line("t_in_email"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_email"),
					"IN_id"=>$this->lang->line("in_email"),
					"IN_PH"=>'',
					//get current email from user_profile_model->user_email()
					"IN_value"=>$get_email[0]["email"],
					"IN_attr"=>'maxlength="128"',
					"help_text"=>'เช่น example@hotmail.com, example@gmail.com'
			);
			/*-*initial attr for create element with element_lib*/
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("แก้ไขข้อมูลการเข้าใช้ระบบ"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"profile_tab"=>$this->profile_tab(),
					
					"in_username"=>$this->eml->form_input($in_username),
					"in_password0"=>$this->eml->form_input($in_password0),
					"in_password"=>$this->eml->form_input($in_password),
					"in_password2"=>$this->eml->form_input($in_password2),
					"in_email"=>$this->eml->form_input($in_email)
					
			);
			$this->load->view("edit_profile1",$data);
		}
		else 
		{	
			//$this->upm->
			$set=array(
					"email"=>$this->input->post($this->lang->line("in_email"))
			);
			if($this->input->post("change_password")=="checked_pwd")
			{
				$set2=array(
						"password"=>md5($this->input->post($this->lang->line("in_password")))
				);
				$set=array_merge($set,$set2);
			}
			$this->upm->update_edit_profile1($set,$this->session->userdata("rs_username"));
		}
	}
	function edit_profile2()
	{
		$this->fl->check_loggedin();
		/*
		 * check ต้องมี session rs_username
		 * */
		$config=array(
				array(
						"field"=>$this->lang->line("se_titlename"),
						"label"=>$this->lang->line("t_se_titlename"),
						"rules"=>"required"
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
						"field"=>$this->lang->line("in_occupation"),
						"label"=>$this->lang->line("t_in_occupation"),
						"rules"=>"max_length[30]"
				),
				array(
						"field"=>$this->lang->line("se_occupation"),
						"label"=>$this->lang->line("t_se_occupation"),
						"rules"=>"required|callback_selected_other"
				)
		);

		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$get_edit_profile2=$this->upm->get_edit_profile2($this->session->userdata("rs_username"));
			$current_data=$get_edit_profile2[0];
			//set session for occupation_id
			$this->session->set_userdata("update_profile2_occupation_id",$current_data["tb_occupation_id"]);
			/*initial  create element with element_lib*/
			$se_titlename=array(
					"LB_text"=>$this->lang->line("t_se_titlename"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_titlename"),
					"S_id"=>$this->lang->line("se_titlename"),
					"S_old_value"=>$current_data["tb_titlename_id"],
					"S_data"=>$this->emm->select_titlename(),
					"S_id_field"=>"titlename_id",
					"S_name_field"=>"titlename",
					"help_text"=>''
			);
			$in_firstname=array(
					"LB_text"=>$this->lang->line("t_in_firstname"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_firstname"),
					"IN_id"=>$this->lang->line("in_firstname"),
					"IN_PH"=>'',
					"IN_value"=>$current_data["firstname"],
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
					"IN_value"=>$current_data["lastname"],
					"IN_attr"=>'maxlength="40"',
					"help_text"=>$this->lang->line("THENchar")
			);
			/*select occupation*/
			$in_occupation=array(
					"LB_text"=>$this->lang->line("t_in_occupation"),
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
			$se_occupation=array(
					"LB_text"=>$this->lang->line("t_se_occupation"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_occupation"),
					"S_id"=>$this->lang->line("se_occupation"),
					"S_old_value"=>$current_data["tb_occupation_id"],
					"S_data"=>$this->emm->select_occupation(),
					"S_id_field"=>"occupation_id",
					"S_name_field"=>"occupation_name",
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
					"IN_value"=>$current_data["id_card_number"],
					"IN_attr"=>'maxlength="13" readonly',
					"help_text"=>'ตัวเลข 13 หลัก'
			);
			if($current_data["checked"]==0)
			{
				$in_occupation["IN_value"]=$current_data["occupation_name"];
				$se_occupation["S_old_value"]=00;
			}
			/*-*initial attr for create element with element_lib*/

			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("แก้ไขข้อมูลส่วนตัว"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"profile_tab"=>$this->profile_tab(),
						
					"se_titlename"=>$this->eml->form_select($se_titlename),
					"in_firstname"=>$this->eml->form_input($in_firstname),
					"in_lastname"=>$this->eml->form_input($in_lastname),
					"in_occupation"=>$this->eml->form_input($in_occupation),
					"se_occupation"=>$this->eml->form_select($se_occupation),
					"in_id_card_number"=>$this->eml->form_input($in_id_card_number)
			);
			$this->load->view("edit_profile2",$data);
		}
		else
		{
			$set=array(
					"tb_titlename_id"=>$this->input->post($this->lang->line("se_titlename")),
					"firstname"=>$this->input->post($this->lang->line("in_firstname")),
					"lastname"=>$this->input->post($this->lang->line("in_lastname")),
					"tb_occupation_id"=>$this->input->post($this->lang->line("se_occupation"))
			);
			if($this->input->post($this->lang->line("se_occupation"))=="00")
			{
				$occ_name = trim($this->input->post($this->lang->line("in_occupation")));
				//ถ้ามีอาชีพซ้ำ ให้ใช้ไอดีอาชีพที่มีอยู่
				if($this->upm->new_occupation($occ_name))
					$set["tb_occupation_id"] = $this->upm->new_occupation($occ_name);
				else 
				{
					//เพิ่มอาชีพใหม่ return occupation_id 
					if($this->upm->new_occupation($occ_name))
						$set["tb_occupation_id"] = $this->upm->new_occupation($occ_name);
					/*
					unset($set["tb_occupation_id"]);
					$set_occupation=array(
							"occupation_name"=>$this->input->post($this->lang->line("in_occupation"))
					);
					$this->upm->update_occupation($set_occupation,$this->session->userdata("update_profile2_occupation_id"));
					*/
				}
			}
			$this->upm->update_edit_profile2($set,$this->session->userdata("rs_username"));	
		}
	}
	function edit_profile3()
	{
		$this->fl->check_loggedin();
		/*
		 * check session rs_username
		 * */
		$config=array(
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
				)
		);
		
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$get_edit_profile3=$this->upm->get_edit_profile3($this->session->userdata("rs_username"));
			$current_data=$get_edit_profile3[0];
			//set session for occupation_id
			//$this->session->set_userdata("update_profile2_occupation_id",$current_data["tb_occupation_id"]);
			/*initial  create element with element_lib*/
			$in_house_no=array(
					"LB_text"=>$this->lang->line("t_in_house_no"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_house_no"),
					"IN_id"=>$this->lang->line("in_house_no"),
					"IN_PH"=>'',
					"IN_value"=>$current_data["house_no"],
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
					"IN_value"=>$current_data["village_no"],
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
					"IN_value"=>$current_data["alley"],
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
					"IN_value"=>$current_data["road"],
					"IN_attr"=>'maxlength="25"',
					"help_text"=>''
			);
			$se_province=array(
					"LB_text"=>$this->lang->line("t_se_province"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_province"),
					"S_id"=>$this->lang->line("se_province"),
					"S_old_value"=>$current_data["tb_province_id"],
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
					"S_old_value"=>"",
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
					"S_old_value"=>"",
					"S_data"=>"",
					"S_id_field"=>"subdistrict_id",
					"S_name_field"=>"subdistrict_name",
					"help_text"=>''
			);
			/*-*initial attr for create element with element_lib*/
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("แก้ไขข้อมูลส่วนตัว"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"profile_tab"=>$this->profile_tab(),
		
					"in_house_no"=>$this->eml->form_input($in_house_no),
					"in_village_no"=>$this->eml->form_input($in_village_no),
					"in_alley"=>$this->eml->form_input($in_alley),
					"in_road"=>$this->eml->form_input($in_road),
					"se_province"=>$this->eml->form_select($se_province),
					"se_district"=>$this->eml->form_select($se_district),
					"se_subdistrict"=>$this->eml->form_select($se_subdistrict),
					
					"current_district_id"=>$current_data["tb_district_id"],
					"current_subdistrict_id"=>$current_data["tb_subdistrict_id"]
			);
			$this->load->view("edit_profile3",$data);
		}
		else
		{
			$set=array(
					"house_no"=>$this->input->post($this->lang->line("in_house_no")),
					"village_no"=>$this->input->post($this->lang->line("in_village_no")),
					"alley"=>$this->input->post($this->lang->line("in_alley")),
					"road"=>$this->input->post($this->lang->line("in_road")),
					"tb_province_id"=>$this->input->post($this->lang->line("se_province")),
					"tb_district_id"=>$this->input->post($this->lang->line("se_district")),
					"tb_subdistrict_id"=>$this->input->post($this->lang->line("se_subdistrict"))
			);
			$this->upm->update_edit_profile3($set,$this->session->userdata("rs_username"));	
		}
	}
	function profile_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="profiletab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="view_profile">ข้อมูลส่วนตัว</a></li>';
			
			if($this->session->userdata("rs_username"))
			{  
		$html.='<li><a href="#" data-toggle="pill" id="edit_profile1">แก้ไขข้อมูลการเข้าใช้ระบบ</a></li>
			<li><a href="#"  id="edit_profile2">แก้ไขข้อมูลส่วนตัว</a></li>
			<li><a href="#"  id="edit_profile3">แก้ไขข้อมูลที่อยู่</a></li>
			';
			}
		$html.='</ul>';
		return $html;
	}
	function check_current_password($data)
	{
		$this->form_validation->set_message("check_current_password","%s - รหัสผ่านเดิมไม่ถูกต้อง");
		return $this->upm->check_current_password($data);
	}

	function selected_other($data)
	{
		/*#################################################
			If seleced otherOccupation from <select>
		###################################################*/
		$this->form_validation->set_message("selected_other","%s - กรุณาระบุอาชีพอื่นๆ");
		if($data=="00") 
		{
			if(strlen(trim($this->input->post($this->lang->line("in_occupation"))))<1)return false;
			else return true;
		}
		else if($data!="00")
		{
			return true;
		}
		else return false;
	}
	function call_lib($data,$param)
	{
		/*#################################################
		 * $param = library_name , method_in_library , error_message
		* $param_value=array(library_name , method_in_library , error_message);
		###################################################*/
		$param_value=explode(',',$param);
		$this->form_validation->set_message("call_lib",$param_value[2]);
		$this->load->library($param_value[0]);
		//send $data to method in library
		return $this->$param_value[0]->$param_value[1]($data);
	}
}