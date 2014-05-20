<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		//$this->fl->check_group_privilege("03");
	}
	function main($year=null,$month=null)
	{
		if(isset($_GET['year']))
		{
			if($this->session->userdata("ct-year")!=$_GET["year"]) $year=$_GET['year'];
			else $year=$_GET['year'];
		}
		else redirect($_SERVER["QUERY_STRING"]."&year=".date("Y"));
		if(isset($_GET['month']))
		{
			if($this->session->userdata("ct-month")!=$_GET["month"]) $month=$_GET['month'];
			else $month=$_GET['month'];
		}
		else redirect($_SERVER["QUERY_STRING"]."&month=".date("m"));
		//if(isset($_GET['resid']))$reserve_id=$_GET['resid'];
		//else $reserve_id=null;
		//if(isset($_GET['rmid']))$room_id=$_GET['rmid'];
		//else $room_id=null;
		
		$room_id=($this->session->userdata("ct-room")) ? $this->session->userdata("ct-room") : null;
		
		$this->load->model('calendar_model');
		$data=array(
				"htmlopen"=>$this->pel->htmlopen(),
				"head"=>$this->pel->head("ปฏิทิน"),
				"bodyopen"=>$this->pel->bodyopen(),
				"navbar"=>$this->pel->navbar(),
				"js"=>$this->pel->js(),
				"footer"=>$this->pel->footer(),
				"bodyclose"=>$this->pel->bodyclose(),
				"htmlclose"=>$this->pel->htmlclose(),
				"calendar"=>$this->calendar_model->generate($year,$month,$room_id),
				"customviewbox"=>$this->customviewbox()
		);
		$this->load->view("calendar_main",$data);
	}
	function bydate()
	{
		$data=array(
				"htmlopen"=>$this->pel->htmlopen(),
				"head"=>$this->pel->head("วันที่"),
				"bodyopen"=>$this->pel->bodyopen(),
				"navbar"=>$this->pel->navbar(),
				"js"=>$this->pel->js(),
				"footer"=>$this->pel->footer(),
				"bodyclose"=>$this->pel->bodyclose(),
				"htmlclose"=>$this->pel->htmlclose()
		);
		$this->load->view("calendar_by_date",$data);
	}
	function get_date_detail()
	{
		$query=$this->db->select()->from("tb_reserve")
		->join("tb_reserve_has_datetime","tb_reserve.reserve_id=tb_reserve_has_datetime.tb_reserve_id")
		->join("tb_reserve_has_person","tb_reserve.reserve_id=tb_reserve_has_person.tb_reserve_id")
		->join("tb_room","tb_reserve.tb_room_id=tb_room.room_id")
		->where("tb_reserve.approve",1)
		->like("tb_reserve_has_datetime.reserve_datetime_begin",$this->input->post("ymd"),"after")->get();
		//$query=$this->db->select()->from("tb_reserve_has_datetime")->like("reserve_datetime_begin",$this->input->post("ymd"),"after")->get();
		if($query->num_rows()>0)
			echo json_encode($query->result_array());
		//else echo json_encode("");
	}
	function getdatetime()
	{
		$this->db->select()->from("tb_reserve_has_datetime")
		->join("tb_reserve","tb_reserve.reserve_id=tb_reserve_has_datetime.tb_reserve_id")
		->join("tb_room","tb_reserve.tb_room_id=tb_room.room_id");
		$this->db->where("tb_reserve.approve",1);
		$this->db->like("reserve_datetime_begin",$this->input->post("likedate"));
		echo json_encode($this->db->get()->result_array());
		
	}
	function get_datetime_detail()
	{
		$query=$this->db->select()->from("tb_reserve")
		->join("tb_reserve_has_datetime","tb_reserve.reserve_id=tb_reserve_has_datetime.tb_reserve_id")
		->join("tb_reserve_has_person","tb_reserve.reserve_id=tb_reserve_has_person.tb_reserve_id")
		->join("tb_room","tb_reserve.tb_room_id=tb_room.room_id")
		->where("tb_reserve_has_datetime.datetime_id",$this->input->post("datetime_id"))->get();
		//echo $this->db->last_query();
		if($query->num_rows()>0)
			$json=$query->result_array();
			echo json_encode($json[0]);
		//else echo json_encode("");
	}
	function customviewbox()
	{
		$html='<form class="form-horizontal" role="form" action="'.base_url().'?c=calendar&m=customview_process" method="post" autocomplete="off">';
		$html.='
      		 	<div class="form-group">
					<label class="col-lg-2 control-label" for="ct-room">ห้อง</label>
					<div class="col-lg-10">
				      	<select id="ct-room" name="ct-room" class="form-control">
						<option value="all">ทุกห้อง</option>';
		$room=$this->emm->get_select("tb_room","room_name");
		foreach ($room as $r)
		{
			$html.='<option value="'.$r['room_id'].'">'.$r['room_name'].'</option>';
		}
					  
			$html.='</select>
					</div><!-- col-lg-10 -->
				</div><!-- form-group -->
				<div class="form-group">
					<label class="col-lg-2 control-label" for="ct-year">ปี</label>
					<div class="col-lg-10">
						<select id="ct-year" name="ct-year" class="form-control">';
			$year=date('Y');
			$month=date('m');
			
				$query_year_reserve_on = $this->db->select("YEAR(reserve_on) AS year_reserve_on")
				->from("tb_reserve")
				->group_by("YEAR(reserve_on)")
				->get();
				$year_reserve_on = $query_year_reserve_on->result_array();
				if($query_year_reserve_on->num_rows() > 0)
				{
					foreach ($year_reserve_on[0] as $y)
					{
						if(($y+543) == $year)
							$html .= '<option value="'.$year.'" selected="selected">'.$year.'</option>';
						else $html .= '<option value="'.($y+543).'">'.($y+543).'</option>';
					}
				}
				else $html.='<option value="'.$year.'" selected="selected">'.$year.'</option>';
			
				/*$html.='<option value="'.($year-2).'">'.($year-2).'</option>';
				$html.='<option value="'.($year-1).'">'.($year-1).'</option>';
				$html.='<option value="'.$year.'" selected="selected">'.$year.'</option>';
				$html.='<option value="'.($year+1).'">'.($year+1).'</option>';
				$html.='<option value="'.($year+2).'">'.($year+2).'</option>';
				*/
				$html.='</select>
					</div><!-- col-lg-10 -->
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" for="ct-month">เดือน</label>
					<div class="col-lg-10">
						<select id="ct-month" name="ct-month" class="form-control">';
			for($i=1;$i<=12;$i++)
			{
				$month_th=array("ม.ค.","ก.พ.","มี.ค.","เม.ษ.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				$month_th_full=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
				$text=str_pad($i,2,0,STR_PAD_LEFT);
				$selected=($text==str_pad($month,2,0,STR_PAD_LEFT)) ? 'selected="selected"' : '';
				$html.='<option value="'.$text.'" '.$selected.'>'.$month_th_full[$i-1].'</option>';
			}
				$html.='</select>
					</div><!-- col-lg-10 -->
				</div>';
				$html.='
						<div class="form-group text-right">
							<div class="col-lg-12">
							'.$this->eml->btn("search","id='ct-btn'").nbs(4).$this->eml->btn("refreshcheck","onclick=window.location='".base_url()."?c=calendar&m=reset_customview'").'
							</div>
						</div>';
			$html.='</form>';
		return $html;
	}
	function customview_process()
	{
		$set=array(
				"ct-room"=>$this->input->post("ct-room"),
				"ct-year"=>$this->input->post("ct-year"),
				"ct-month"=>$this->input->post("ct-month")
		);
		$this->session->set_userdata($set);
		//redirect($_SERVER['HTTP_REFERER']);
		redirect(base_url()."?c=calendar&m=main&year=".($this->input->post("ct-year")-543)."&month=".$this->input->post("ct-month"));
	}
	function reset_customview()
	{
		$unset=array(
				"ct-room"=>null,
				"ct-year"=>null,
				"ct-month"=>null
		);
		$this->session->unset_userdata($unset);
		redirect(base_url()."?c=calendar&m=main");
	}
}