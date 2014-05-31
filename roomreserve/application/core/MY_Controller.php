<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	public $mysql_charset = "UTF8";
	
	//element_model
	public $emm;
	
	//element_lib
	public $eml;
	
	//page_element_lib
	public $pel;
	
	//form_validation
	public $frm;
	
	//function library
	public $fl;
	
	public $default_perpage=10;
	function __construct()
	{
		parent::__construct();
		$this->eml=$this->element_lib;
		$this->frm=$this->form_validation;
		$this->pel=$this->page_element_lib;
		$this->fl=$this->function_lib;
		$this->load->model("element_model");
		$this->emm=$this->element_model;
		//$this->lang->load("help_text","thailand");
		//$this->lang->load("label_name","thailand");
		$this->lang->load("form","thailand");
		$this->lang->load("name","thailand");
		//$this->session->unset_userdata("set_per_page");
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
	function call_lib_with_data($data,$param)
	{
		/*#################################################
		 * $param = library_name , method_in_library , error_message
		* $param_value=array(library_name , method_in_library , error_message , data1&data2);
		###################################################*/
		$param_value=explode(',',$param);
		$send_data=explode('&',$param_value[3]);
		$this->form_validation->set_message("call_lib_with_data",$param_value[2]);
		$this->load->library($param_value[0]);
		//send $data to method in library
		return $this->$param_value[0]->$param_value[1]($data,$send_data);
	}
	function check_searchfield($sess_name,$default_field)
	{
		if($this->session->userdata($sess_name)) return $this->session->userdata($sess_name);
		else
		{
			$this->session->set_userdata($sess_name,$default_field);
			return $default_field;
		}
	}
	function check_group_privilege($privilege,$is=false)
	{
		$enable=true;
		if($enable)
		{
			$error_num=0;
			$this->load->model("login_model");
			$lm=$this->login_model;
			$privilege_array=array();
			if($this->session->userdata("rs_username"))
			{
				foreach($lm->get_group_privilege() as $gp)
				{
					array_push($privilege_array, $gp['tb_privilege_id']);
				}
				foreach($privilege as $p)
				{
					if(!in_array($p, $privilege_array))
					{
						$error_num++;
					}
				}
				if($error_num>0)
				{
					if($is) return false;
					else 
					{
						show_error("
							<p>ขออภัย คุณไม่มีสิทธิ์เข้าใช้หน้านี้</p>
							<p><a href='".base_url()."'>หน้าแรก</a>".nbs(4)."<a href='".$_SERVER['HTTP_REFERER']."'>ย้อนกลับ</a></p>
							");
					}
				}
				else 
				{
					if($is) return true;
				}
			}
			else
			{
				if($is) return false;
				else redirect(base_url()."?c=login&m=auth");
			}
		}
	}
	function set_default_sess_orderby($sess_name,$data)
	{
		if(!$this->session->userdata("orderby_".$sess_name))
		{
			$this->session->set_userdata("orderby_".$sess_name,$data);
		}
	}
	function check_page_num($num)
	{
		return preg_match('/[\d]$/',$num);
	}
	function set_per_page()
	{
		if($this->input->post("num") && preg_match('/^[1-9]|[1-9][\d]+/',$this->input->post("num")))
		{
			$this->session->set_userdata("set_per_page",$this->input->post("num"));
		}
	}
	
	function add_event($text)
	{
		$this->emm->add_event_model($text);
	}
	
	/**
	 * 
	 * @param datetime $subject (Y-m-d H:i:s)
	 * @param string $type ("sm"=shor_month,"lm"=long_month)
	 * @return array (["date"],["time])
	 */
	function th_date($subject, $type='')
	{
		$datetime=array("date"=>'',"time"=>'');
		//find date
		$pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/";
		preg_match($pattern,$subject, $matches);
		
		if(count($matches)>0)
		{
			
			$date_pos=array(
					"year"=>substr($matches[0],0,4),
					"month"=>substr($matches[0],5,2),
					"day"=>substr($matches[0],8,2)
			);
			
			if($type=="sm")
			{
				$sm = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				$datetime["date"]=$date_pos["day"]." ".$sm[(int)$date_pos["month"]]." ".($date_pos["year"]+543);
			}
			else if($type=="lm")
			{
				$lm = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
				$datetime["date"]=$date_pos["day"]." ".$lm[(int)$date_pos["month"]]." ".($date_pos["year"]+543);
			}
			else $datetime["date"]=$date_pos["day"]."/".$date_pos["month"]."/".($date_pos["year"]+543);
		}
		
		//find time
		$pattern = "/([0-9]|0[0-9]|1[0-9]|2[0-4]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0])/";
		preg_match($pattern,$subject, $matches);
		if(count($matches)>0)$datetime["time"]=$matches[0];
		return $datetime;
	}
}
?>