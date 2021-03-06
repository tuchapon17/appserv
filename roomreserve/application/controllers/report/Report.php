<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends MY_Controller {
	
	private $rpm;

	function __construct()
	{
		parent::__construct();
		$this->load->model("report/report_model");
		$this->rpm=$this->report_model;
	}
	
	function report_type()
	{
		$data=array(
				"htmlopen"=>$this->pel->htmlopen(),
				"head"=>$this->pel->head("รายงาน"),
				"bodyopen"=>$this->pel->bodyopen(),
				"navbar"=>$this->pel->navbar(),
				"js"=>$this->pel->js(),
				"footer"=>$this->pel->footer(),
				"bodyclose"=>$this->pel->bodyclose(),
				"htmlclose"=>$this->pel->htmlclose()
		);
		$this->load->view("report/report_type",$data);
	}
	function report_type_process()
	{
		//if (ob_get_contents()) ob_end_clean();
		//$year สำหรับออกรายงานรายปี และใช้กำหนดปีสำหรับออกรายงาน
		$year=$this->input->post("se_year");
		$month=$this->input->post("se_month");
		$post_time_length=$this->input->post("se_time_length");
		
		//กำหนดเวลาเริ่ม-สิ้นสุด สำหรับรายปี
		$year_time=array("begin"=>$year."-01-01 00:00:00","end"=>$year."-12-31 23:59:59");
		
		//กำหนดเวลาเริ่ม-สิ้นสุด สำหรับรายเทอม
		if($this->input->post("se_term")=="term1")		
			$term_time=array("begin"=>$year."-05-31 00:00:00","end"=>$year."-10-31 23:59:59");
		else if($this->input->post("se_term")=="term2")	
			$term_time=array("begin"=>$year."-11-01 00:00:00","end"=>($year+1)."-03-01 23:59:59");
		else if($this->input->post("se_term")=="term3")	
			$term_time=array("begin"=>($year+1)."-03-02 00:00:00","end"=>($year+1)."-05-30 23:59:59");
		
		//กำหนดเวลาเริ่ม-สิ้นสุด สำหรับรายไตรมาส
		if($this->input->post("se_quarter")=="quarter1")
		{
			//หาวันที่สุดท้ายของเดือนกุมภาพันธ์ find last date of Feb
			$timestamp = strtotime('February '.$year);
			//$first_second = date('m-01-Y 00:00:00', $timestamp);
			$last_feb  = date('Y-m-t', $timestamp);
			$quarter_time = array("begin"=>($year-1)."-12-01 00:00:00","end"=>$last_feb." 23:59:59");
		}
		else if($this->input->post("se_quarter")=="quarter2")
		{
			$quarter_time=array("begin"=>$year."-03-01 00:00:00","end"=>$year."-05-31 23:59:59");
		}
		else if($this->input->post("se_quarter")=="quarter3")
		{
			$quarter_time=array("begin"=>$year."-06-01 00:00:00","end"=>$year."-08-31 23:59:59");
		}
		else if($this->input->post("se_quarter")=="quarter4")
		{
			$quarter_time=array("begin"=>$year."-09-01 00:00:00","end"=>$year."-11-30 23:59:59");
		}
		
		//กำหนดเวลาเริ่ม-สิ้นสุด สำหรับรายเดือน (รูปแบบ : y-m-01 - y-m-วันสุดท้ายของเดือน)
		$month_name=array("January","February","March","April","May","June","July","August","September","October","November","December");
		$month_name_th=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$month_last_date=date('Y-'.$month.'-t',strtotime($month_name[((int)$month-1)].' '.$year));
		$month_time=array("begin"=>$year."-".$month."-01 00:00:00","end"=>$month_last_date." 23:59:59");
		
		//เลือกประเภทรายงาน
		if($this->input->post("se_report_type")=="report_reserve")
		{
			$this->db->select()->from("tb_reserve_has_datetime")
			->join("tb_reserve","tb_reserve.reserve_id=tb_reserve_has_datetime.tb_reserve_id")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			;
			if($post_time_length=="tl_month")
			{
				$select_time_length="รายเดือน";
				$on_time_text="ประจำเดือน ".$month_name_th[((int)$month-1)]." ปี ".($year+543);
				$this->db->where("reserve_datetime_begin >=",$month_time['begin']);
				$this->db->where("reserve_datetime_end <=",$month_time['end']);
			}
			else if($post_time_length=="tl_quarter")
			{
				$select_time_length="รายไตรมาส";
				$on_time_text="ประจำไตรมาสที่ ".str_replace("quarter", "", $this->input->post("se_quarter"))." ปี ".($year+543);
				$this->db->where("reserve_datetime_begin >=",$quarter_time['begin']);
				$this->db->where("reserve_datetime_end <=",$quarter_time['end']);
			}
			else if($post_time_length=="tl_term")
			{
				$on_time_text="ประจำเทอมที่ ".str_replace("term", "", $this->input->post("se_term"))." ปี ".($year+543);
				$select_time_length="รายภาคการศึกษา";
				$this->db->where("reserve_datetime_begin >=",$term_time['begin']);
				$this->db->where("reserve_datetime_end <=",$term_time['end']);
			}
			else if($post_time_length=="tl_year")
			{
				$select_time_length="รายปี";
				$on_time_text="ประจำปี ".($year+543);
				$this->db->where("reserve_datetime_begin >=",$year_time['begin']);
				$this->db->where("reserve_datetime_end <=",$year_time['end']);
			}
			$report_type_query=$this->db->get()->result_array();
			//print_r($report_type_query);
			
			$this->report_reserve_output($report_type_query, $select_time_length, $on_time_text);
		}
		else if($this->input->post("se_report_type")=="report_room_use")
		{
			$room_id=$this->input->post("se_room");
			$this->db->select()->from("tb_room")
			->join("tb_room_type","tb_room_type.room_type_id=tb_room.tb_room_type_id")
			->join("tb_reserve","tb_reserve.tb_room_id=tb_room.room_id")
			->join("tb_reserve_has_datetime","tb_reserve_has_datetime.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->where("tb_room.room_id",$room_id);
			
			if($post_time_length=="tl_month")
			{
				$select_time_length="รายเดือน";
				$on_time_text="ประจำเดือน ".$month_name_th[((int)$month-1)]." ปี ".($year+543);
				$this->db->where("reserve_datetime_begin >=",$month_time['begin']);
				$this->db->where("reserve_datetime_end <=",$month_time['end']);
			}
			else if($post_time_length=="tl_quarter")
			{
				$select_time_length="รายไตรมาส";
				$on_time_text="ประจำไตรมาสที่ ".str_replace("quarter", "", $this->input->post("se_quarter"))." ปี ".($year+543);
				$this->db->where("reserve_datetime_begin >=",$quarter_time['begin']);
				$this->db->where("reserve_datetime_end <=",$quarter_time['end']);
			}
			else if($post_time_length=="tl_term")
			{
				$on_time_text="ประจำเทอมที่ ".str_replace("term", "", $this->input->post("se_term"))." ปี ".($year+543);
				$select_time_length="รายภาคการศึกษา";
				$this->db->where("reserve_datetime_begin >=",$term_time['begin']);
				$this->db->where("reserve_datetime_end <=",$term_time['end']);
			}
			else if($post_time_length=="tl_year")
			{
				$select_time_length="รายปี";
				$on_time_text="ประจำปี ".($year+543);
				$this->db->where("reserve_datetime_begin >=",$year_time['begin']);
				$this->db->where("reserve_datetime_end <=",$year_time['end']);
			}
			else if($post_time_length=="tl_custom")
			{
				if($this->input->post("input_c_begin") && $this->input->post("input_c_end"))
				{
					$c_begin=$this->input->post("input_c_begin");
					$c_end=$this->input->post("input_c_end");
					preg_match('/(\d\d\-\d\d\-\d\d\d\d)/', $c_begin, $match_begin);
					preg_match('/(\d\d\-\d\d\-\d\d\d\d)/', $c_end, $match_end);
					if(sizeof($match_begin)>0)
						$c_begin=$match_begin[0];
					if(sizeof($match_end)>0)
						$c_end=$match_end[0];
					$reverse_begin=date('Y-m-d',strtotime($c_begin))." 00:00:00";
					$reverse_end=date('Y-m-d',strtotime($c_end))." 23:59:59";
					
					$select_time_length="";
					$on_time_text="ระหว่างวันที่ ".$this->en2th_date($c_begin)." - ".$this->en2th_date($c_end);
					$this->db->where("reserve_datetime_begin >=",$reverse_begin);
					$this->db->where("reserve_datetime_end <=",$reverse_end);
				}
			}
			$report_room_data=$this->db->get()->result_array();
				//echo $this->db->last_query();
			$this->report_room_output($report_room_data, $select_time_length, $on_time_text);
		}
		
		/*
		 * 
    ไตรมาสที่ 1 หมายถึงช่วงเดือน ธันวาคม ถึง กุมภาพันธ์
    ไตรมาสที่ 2 หมายถึงช่วงเดือน มีนาคม ถึง พฤษภาคม
    ไตรมาสที่ 3 หมายถึงช่วงเดือน มิถุนายน ถึง สิงหาคม
    ไตรมาสที่ 4 หมายถึงช่วงเดือน กันยายน ถึง พฤศจิกายน

		 */
	}
	
	/**
	 * รายงานการจองห้อง
	 * @param array $report
	 * @param string $select_time_length
	 * @param string $on_time_text
	 */
	function report_reserve_output($report, $select_time_length, $on_time_text)
	{
		//http://www.tcpdf.org/examples/example_048.phps
		//http://www.tcpdf.org/examples/example_048.pdf
		//www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc

		if (ob_get_contents()) ob_end_clean();
		$this->load->library("pdf");
		$pdf=$this->pdf;
		
		/*
		 * public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false) {
		*/
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		//$fontname = $pdf->addTTFfont($_SERVER['DOCUMENT_ROOT'].'/roomreserve/plugins/fonts/THSarabunNewI.ttf', 'TrueTypeUnicode', '', 32);
		$pdf->SetTitle('My Title');
		$margin=array(
				"top"=>23.5,
				"right"=>23.5,
				"left"=>23.5
		);
		$pdf->SetMargins($margin["left"], $margin["top"],$margin["right"],true);
		//$pdf->SetHeaderMargin(30);
		//$pdf->SetTopMargin(20);
		//$pdf->setFooterMargin(90);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->setFontSubsetting(false);
		$pdf->SetFont('thsarabunnewb', '', 18);

		$pdf->AddPage();
		$pdf->Cell(0, 15, 'รายงานการจองห้อง'.$select_time_length, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->Ln(7.5);
		$pdf->Cell(0, 15, $on_time_text, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->SetFont('thsarabunnew', '', 16);
		$width=array(6,30,20,25,19);
		//table
		$tbl =<<<EOT
		<style>
			.text-center{
				text-align:center;
			}
			table{
				width:100%;
				display:block;
			}
		</style>
		<div><hr></div>
		<table cellspacing="0" cellpadding="1" border="0.2">
		<tr>
				<th class="text-center" width="{$width[0]}%">ลำดับ</th>
				<th class="text-center" width="{$width[1]}%">โครงการ</th>
				<th class="text-center" width="{$width[2]}%">ห้อง</th>
				<th class="text-center" width="{$width[3]}%">วันเวลาจอง</th>
				<th class="text-center" width="{$width[4]}%"></th>
		</tr>
		</table>
EOT;
		$pdf->writeHTML($tbl, false, false, false, false, '');
		$count=0;
		
		foreach($report as $r)
		{
				//กำหนดความยาวของหน้า(สำหรับเนื้อหา) เพื่อขึ้นหน้าใหม่
				if($pdf->getY()<$pdf->getPageHeight()-23.5)
				{
					$count++;
			$tbl=<<<EOT
			<style>
			.text-center{
				text-align:center;
			}
			table{
				width:100%;
				display:block;
			}
		</style>
			<table cellspacing="0" cellpadding="1" border="0.2">
EOT;
			$tbl.=<<<EOT
		    <tr>
		        <td class="text-center" width="{$width[0]}%">{$count}</td>
		        <td width="{$width[1]}%">{$r['project_name']}</td>
		        <td width="{$width[2]}%">{$r['room_name']}</td>
		        <td width="{$width[3]}%">{$this->compress_two_datetime($r['reserve_datetime_begin'],$r['reserve_datetime_end'])}</td>
		        <td width="{$width[4]}%"></td>
		    </tr>
			
EOT;
			$tbl.=<<<EOT
		</table>
EOT;
				$pdf->writeHTML($tbl, false, false, false, false, '');
				}
				else
				{
					$pdf->AddPage();
				}
		}
		//ob_clean();
		$pdf->Output('My-File-Name.pdf', 'I');
	}
	
	/**
	 * รายงานการใช้ห้อง
	 * @param array $report
	 * @param string $select_time_length
	 * @param string $on_time_text
	 */
	function report_room_output($report, $select_time_length, $on_time_text)
	{
		//http://www.tcpdf.org/examples/example_048.phps
		//http://www.tcpdf.org/examples/example_048.pdf
		//www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
		$report = $report;
		if (ob_get_contents()) ob_end_clean();
		$this->load->library("pdf");
		$pdf=$this->pdf;
	
		/*
		 * public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false) {
		*/
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		//$fontname = $pdf->addTTFfont($_SERVER['DOCUMENT_ROOT'].'/roomreserve/plugins/fonts/THSarabunNewI.ttf', 'TrueTypeUnicode', '', 32);
		$pdf->SetTitle('My Title');
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);
		$margin=array(
				"top"=>23.5,
				"right"=>23.5,
				"left"=>23.5
		);
		$pdf->SetMargins($margin["left"], $margin["top"],$margin["right"],true);
//$pdf->SetMargins(15, $pdf->top_margin, 15); 
		//$pdf->SetAutoPageBreak(TRUE, 23.5);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->setFontSubsetting(false);
		$pdf->SetFont('thsarabunnewb', '', 18);
	
		$pdf->AddPage();
		$pdf->Cell(0, 15, 'รายงานการใช้ห้อง'.$select_time_length, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->Ln(7.5);
		$pdf->Cell(0, 15, $on_time_text, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->SetFont('thsarabunnew', '', 16);
		$width=array(6,30,20,20,9,16);
		//table
		$tbl=<<<EOT
		<style>
			.text-center{
				text-align:center;
			}
			table.tbl_report{
				width:100%;
				display:block;
			}
		</style>
		<div><hr></div>
		<table class="tbl_report" cellspacing="0" cellpadding="1" border="0.2">
		<tr>
				<th class="text-center" width="{$width[0]}%">ลำดับ</th>
				<th class="text-center" width="{$width[2]}%">ห้อง</th>
				<th class="text-center" width="{$width[1]}%">โครงการ</th>
				<th class="text-center" width="{$width[5]}%">บุคคล</th>
				<th class="text-center" width="{$width[3]}%">วันเวลาจอง</th>
				<th class="text-center" width="{$width[4]}%">จำนวนผู้เข้าร่วม</th>
				
		</tr>
		</table>
EOT;
		$pdf->writeHTML($tbl, false, false, false, false, '');
		$array_room_name=array();
		$array_project_name=array();
		foreach($report as $r)
		{
			array_push($array_room_name,$r['room_name']);
			array_push($array_project_name,$r['project_name']);
		}
		$prev_room_name='';
		$prev_project_name='';
		$tbl=<<<EOT
				<style>
					.text-center{
						text-align:center;
					}
					table.tbl_report{
						width:100%;
						display:block;
					}
				</style>
			
			<table class="tbl_report" cellspacing="0" cellpadding="1" border="0.2">
EOT;
		//for($i=1;$i<=10;$i++)
		//{
		$count=1;
		foreach($report as $r)
		{
			if($pdf->getY() < ($pdf->getPageHeight()-23.5) )
			{
				$room_name_num=0;
				if(sizeof($array_room_name)>0)
				{
					//นับ string ที่เหมือนกัน แล้วจัดกลุ่ม string นั้นเป็น key(string) => จำนวนที่นับได้
					$room_name_num=array_count_values($array_room_name);
				}
				$project_name_num=0;
				if(sizeof($array_project_name)>0)
				{
					//นับ string ที่เหมือนกัน แล้วจัดกลุ่ม string นั้นเป็น key(string) => จำนวนที่นับได้
					$project_name_num=array_count_values($array_project_name);
				}
				if($count > 1)
				{
					$tbl.=<<<EOT
		        	<tr nobr="true">
EOT;
					$tbl.=<<<EOT
		        	<td class="text-center" width="{$width[0]}%">{$count}</td>
EOT;
					//room_name
					if($prev_room_name==$r['room_name'])
					{
						$tbl.=<<<EOT
						<td width="{$width[2]}%">{$r['room_name']}</td>
EOT;
					}
					else 
					{
						$tbl.=<<<EOT
						<td width="{$width[2]}%">{$r['room_name']}</td>
EOT;
					}
					//project_name
					if($prev_project_name==$r['project_name'])
					{
						/*$tbl.=<<<EOT
						<td width="{$width[1]}%"></td>
EOT;*/
						$tbl.=<<<EOT
						<td width="{$width[1]}%">{$r['project_name']}</td>
EOT;
					}
					else
					{
						$tbl.=<<<EOT
						<td width="{$width[1]}%">{$r['project_name']}</td>
EOT;
					}
					$tbl.=<<<EOT
					<td width="{$width[5]}%">{$r['person']}</td>
			        <td width="{$width[3]}%">{$this->compress_two_datetime($r['reserve_datetime_begin'],$r['reserve_datetime_end'])}</td>
EOT;
					$tbl.=<<<EOT
			        <td class="text-center"width="{$width[4]}%">{$r['num_of_people']}</td>
EOT;
					$tbl.=<<<EOT
			       </tr>
EOT;
				}//count>1
				else if($count <= 1)
				{
					//rowspan="{$room_name_num[$r['room_name']]}"
					//rowspan="{$project_name_num[$r['project_name']]}"
					$tbl.=<<<EOT
					<tr nobr="true">
					<td class="text-center" width="{$width[0]}%">{$count}</td>
					<td width="{$width[2]}%">{$r['room_name']}</td>
					<td width="{$width[1]}%">{$r['project_name']}</td>
					<td width="{$width[5]}%">{$r['person']}</td>
					<td width="{$width[3]}%">{$this->compress_two_datetime($r['reserve_datetime_begin'],$r['reserve_datetime_end'])}</td>
					<td class="text-center" width="{$width[4]}%">{$r['num_of_people']}</td>
					
					</tr>
EOT;
				}
				$prev_room_name=$r['room_name'];
				$prev_project_name=$r['project_name'];
			}
			else
			{
				$pdf->AddPage();
			}
			$count++;
			
		}//foreach
	//}//for
		$tbl.=<<<EOT
			</table>
EOT;
		$pdf->writeHTML($tbl, false, false, false, false, '');
		//ob_clean();
		$pdf->Output('My-File-Name.pdf', 'I');
	}
	
	
	function getTime($datetime)
	{
		return substr($datetime,11,19);
	}
	
	/**
	 * แสดง วดป เวลา ให้สั้นลง 
	 * @param unknown $dateB
	 * @param unknown $dateE
	 * @return string
	 */
	function compress_two_datetime($dateB, $dateE)
	{
		$dateBegin=substr($dateB,0,10);
		$dateEnd=substr($dateE,0,10);
		$timeBegin=substr($dateB,11,8);
		$timeEnd=substr($dateE,11,8);
		//ถ้าวันเหมือนกัน แสดงวันเพียงครั้งเดียว
		if($dateBegin==$dateEnd)
		{
			return $timeBegin." - ".$timeEnd." (".$dateBegin.")";
		}
		else
		{
			return $timeBegin." (".$dateBegin.") - ".$timeEnd." (".$dateEnd.")";
		}
	}
	
	function test()
	{
		if (ob_get_contents()) ob_end_clean();
		$this->load->library("pdf");
		$pdf=$this->pdf;
		
		/*
		 * public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false) {
		*/
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		//$fontname = $pdf->addTTFfont($_SERVER['DOCUMENT_ROOT'].'/roomreserve/plugins/fonts/THSarabunNewI.ttf', 'TrueTypeUnicode', '', 32);
		$pdf->SetTitle('My Title');
		$margin=array(
				"top"=>23.5,
				"right"=>23.5,
				"left"=>23.5
		);
		$pdf->SetMargins($margin["left"], $margin["top"],$margin["right"],true);
		//$pdf->SetHeaderMargin(30);
		//$pdf->SetTopMargin(20);
		//$pdf->setFooterMargin(90);
		$pdf->SetAutoPageBreak(TRUE, 23.5);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->setFontSubsetting(false);
		$pdf->SetFont('thsarabunnewb', '', 18);
		
		$pdf->AddPage();
		$pdf->Cell(0, 15, 'รายงานการใช้ห้อง', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->Ln(7.5);
		$pdf->Cell(0, 15, "*-*-", 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->SetFont('thsarabunnew', '', 16);
		$width=array(6,30,20,25,19);
		
		
		$dimensions = $pdf->getPageDimensions();
		$hasBorder = false; //flag for fringe case
		for($i=1;$i<=10;$i++)
		{
			$rowcount = 0;
 
	//work out the number of lines required
	$rowcount = max($pdf->getNumLines("aaaaaaaaaaaaaaaaaaaaaaaaaaaaa", 80),$pdf->getNumLines("aaaaaaaaaaaaaaaaaaaaaaaaaaaaa", 80),$pdf->getNumLines("aaaaaaaaaaaaaaaaaaaaaaaaaaaaa", 80));
 
	$startY = $pdf->GetY();
 
	if (($startY + $rowcount * 6) + $dimensions['bm'] > ($dimensions['hk'])) {
		//this row will cause a page break, draw the bottom border on previous row and give this a top border
		//we could force a page break and rewrite grid headings here
		if ($hasborder) {
			$hasborder = false;
		} else {
			$pdf->Cell(240,0,'','T'); //draw bottom border on previous row
			$pdf->Ln();
		}
		$borders = 'LTR';
	} elseif ((ceil($startY) + $rowcount * 6) + $dimensions['bm'] == floor($dimensions['hk'])) {
		//fringe case where this cell will just reach the page break
		//draw the cell with a bottom border as we cannot draw it otherwise
		$borders = 'LRB';	
		$hasborder = true; //stops the attempt to draw the bottom border on the next row
	} else {
		//normal cell
		$borders = 'LR';
	}
 
	//now draw it
	$pdf->MultiCell(80,$rowcount * 6,"aaaaaaaaaaaaaaaaaaaaaaaaaaaaa",$borders,'L',0,0);
	$pdf->MultiCell(80,$rowcount * 6,"aaaaaaaaaaaaaaaaaaaaaaaaaaaaa",$borders,'L',0,0);
	$pdf->MultiCell(80,$rowcount * 6,"aaaaaaaaaaaaaaaaaaaaaaaaaaaaa",$borders,'L',0,0);
 
	$pdf->Ln();
		}
		$pdf->Output('My-File-Name.pdf', 'I');
	}
	/**
	 * $input_date format dd-mm-yyyy to dd ม.ค. 2556
	 * @param string $input_date
	 */
	function en2th_date($input_date)
	{
		$short_month_th=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		list($d, $m, $y)=split("[-]", $input_date);
		return (int)$d."/".(int)$m."/".(int)$y;
	}
	
	
	
	
}