<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendar_Model extends CI_Model
{
	var $conf;
	var $month;
	var $year;
	function __construct()
	{
		parent::__construct();
		$this->conf=array(
				"start_day"=>'monday',
				"show_next_prev"=>true,
				"next_prev_url"=>"?c=calendar&m=main"
		);
		$this->month=(isset($_GET["month"]) ? $this->month=$_GET["month"] : $this->month="");
		$this->year=(isset($_GET["year"]) ? $this->year=$_GET["year"] : $this->year="");
		
		$this->conf["template"]='
		{table_open}<table class="table-calendar">{/table_open}

	   	{heading_row_start}<tr>{/heading_row_start}
	
	   	{heading_previous_cell}<th ><a href="{previous_url}"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></a></th>{/heading_previous_cell}
	   	{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
	   	{heading_next_cell}<th><a href="{next_url}"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></th>{/heading_next_cell}

	   	{heading_row_end}</tr>{/heading_row_end}

	   	{week_row_start}<tr>{/week_row_start}
	   	{week_day_cell}<td >{week_day}</td>{/week_day_cell}
	   	{week_row_end}</tr>{/week_row_end}

	   	{cal_row_start}<tr>{/cal_row_start}
	   	{cal_cell_start}<td>{/cal_cell_start}

	   	{cal_cell_content}
				{day}
				{content}
		{/cal_cell_content}
	   	{cal_cell_content_today}
				<span class="highlight date" id="'.$this->year.'-'.$this->month.'-{day}">{day}</span>
				{content}
		{/cal_cell_content_today}

	   	{cal_cell_no_content}
				<span class="date" id="'.$this->year.'-'.$this->month.'-{day}">{day}</span>
		{/cal_cell_no_content}
	   	{cal_cell_no_content_today}
				<span class="highlight date" id="'.$this->year.'-'.$this->month.'-{day}">{day}</span>
		{/cal_cell_no_content_today}

	   	{cal_cell_blank}&nbsp;{/cal_cell_blank}

	   	{cal_cell_end}</td>{/cal_cell_end}
	   	{cal_row_end}</tr>{/cal_row_end}

	   	{table_close}</table>{/table_close}
		';
	}
	function get_calendar($year,$month,$room_id)
	{
		$this->db->select()->from("tb_reserve_has_datetime")
		->join("tb_reserve","tb_reserve_has_datetime.tb_reserve_id=tb_reserve.reserve_id")
		->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id");
		$where=array(
				"tb_reserve.canceled"=>0
		);
		//if($reserve_id!=null)$where["tb_reserve.reserve_id"]=$reserve_id;
		if($room_id!=null && $room_id!='all')$where['tb_reserve.tb_room_id']=$room_id;
		$this->db->where($where);
		$this->db->like("reserve_datetime_begin","$year-$month","after");
		
		//เงื่อนไข รออนุมัติ หรือ อนุมัติแล้ว
		$this->db->where("(tb_reserve.approve = 1 OR tb_reserve.approve = 0)",NULL,FALSE);
		
		$query=$this->db->get()->result_array();
		$cal_data=array();
		$datetime_id=array();
		foreach ($query as $row)
		{
			$class_color="";
			if($row["approve"] == "0") $class_color="text-warning";
			else if($row["approve"] == "1") $class_color="text-success";
			if(!array_key_exists($row["datetime_id"],$datetime_id))
			{
				$atext=$row["room_name"]." (".substr($row["reserve_datetime_begin"],11,5)."-".substr($row["reserve_datetime_end"],11,5);
				//$cal_data[(int)substr($row["reserve_datetime_begin"],8,2)]="<i class='fa fa-info-circle'></i>";
				
				//ถ้าไม่พบคีย์ของอาเรย์ ให้ใส่ข้อมูลวันที่ลงไป
				if(!array_key_exists((int)substr($row["reserve_datetime_begin"],8,2), $cal_data))
				{
					//$cal_data[(int)substr($row["reserve_datetime_begin"],8,2)]="<div class='text-left' onclick='alert(\"$row[reserve_datetime_begin].$row[reserve_datetime_end]\");'>".$row["project_name"]."</div>";
					$cal_data[(int)substr($row["reserve_datetime_begin"],8,2)]="<div class='time-small'><small><a class='".$class_color."' href='".base_url()."?d=manage&c=reserve&m=view&id=".$row['tb_reserve_id']."' title='".$atext."'>".$atext.")</a></small></div>";
				}
				else
					//สำหรับแถวสองของวันที่ ต่างกันตรง = และ .=
					//$cal_data[(int)substr($row["reserve_datetime_begin"],8,2)].="<div class='text-left' onclick='alert(\"$row[reserve_datetime_begin].$row[reserve_datetime_end]\");'>".$row["project_name"]."</div>";
					$cal_data[(int)substr($row["reserve_datetime_begin"],8,2)].="<div class='time-small'><small><a class='".$class_color."' href='".base_url()."?d=manage&c=reserve&m=view&id=".$row['tb_reserve_id']."' title='".$atext."'>".$atext.")</a></small></div>";
				$datetime_id[$row["datetime_id"]]=$row["datetime_id"];
				
			}
			
		}
		return $cal_data;
	}
	function generate($year,$month,$room_id)
	{
		$this->load->library("calendar",$this->conf);
		/*$cal_data=array(
				10=>'?c=test&m=calen&year=2013&month=10',
				11=>'bar'
		);*/
		$cal_data=$this->get_calendar($year, $month,$room_id);
		return $this->calendar->generate($year,$month,$cal_data);
	}
}