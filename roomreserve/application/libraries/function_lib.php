<?php
class Function_lib
{
	var $ci;
	function __construct()
	{
		$this->ci =& get_instance();
	}
	
	/**
	 * @param array $privilege
	 * @param string $is enable|disable enable for check privilege from DB
	 * @param string $operator AND|OR
	 * @return boolean
	 */
	function check_group_privilege($privilege,$is=false,$operator="AND")
	{
		$enable=true;
		if($enable)
		{
			$error_num=0;
			$this->ci->load->model("login_model");
			$lm=$this->ci->login_model;
			$privilege_array=array();
			if(!is_array($privilege))$privilege=array($privilege);
			if($this->ci->session->userdata("rs_username"))
			{
				//foreach($lm->get_group_privilege() as $gp)
				foreach($lm->get_user_privilege() as $gp)
				{
					array_push($privilege_array, $gp['tb_privilege_id']);
				}
				if(strtoupper($operator)=="AND")
				{
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
							<p><a href='".base_url()."'>หน้าแรก</a>".nbs(4)."<a href='".@$_SERVER['HTTP_REFERER']."'>ย้อนกลับ</a></p>
							");
						}
					}
					else
					{
						if($is) return true;
					}
				}
				else if(strtoupper($operator)=="OR")
				{
					foreach($privilege as $p)
					{
						if(in_array($p, $privilege_array))
						{
							$error_num++;
						}
					}
					if($error_num==0)
					{
						if($is) return false;
						else
						{
							show_error("
							<p>ขออภัย คุณไม่มีสิทธิ์เข้าใช้หน้านี้</p>
							<p><a href='".base_url()."'>หน้าแรก</a>".nbs(4)."<a href='".@$_SERVER['HTTP_REFERER']."'>ย้อนกลับ</a></p>
							");
						}
					}
					else
					{
						if($is) return true;
					}
				}
				
			}
			else
			{
				if($is) return false;
				else
				{
					$this->ci->session->set_flashdata("login_message","กรุณาเข้าสู่ระบบ");
					redirect(base_url()."?c=login&m=auth");
				}
				
			}
		}
	}
	function check_loggedin()
	{
		if(!$this->ci->session->userdata("rs_username"))
		{
			$this->ci->session->set_flashdata("login_message","กรุณาเข้าสู่ระบบ");
			redirect(base_url()."?c=login&m=auth");
		}
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
	
	/**
	 * 
	 * @param datetime $dtBegin
	 * @param datetime $dtEnd
	 * @return string (d-m-Y H:i:s-H:i:s)
	 */
	function date1_time2($dtBegin, $dtEnd)
	{
		$dt1 = $this->th_date($dtBegin);
		$dt2 = $this->th_date($dtEnd);
		if($dt1["date"] == $dt2["date"])
			return $dt1["date"]." ".$dt1["time"]."-".$dt2["time"];
		else return $dt1["date"]." ".$dt1["time"]."-".$dt2["date"]." ".$dt2["time"];
	}
}