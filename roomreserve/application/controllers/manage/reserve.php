<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reserve extends MY_Controller
{
	private $table_name	="tb_reserve";
	private $field_name	=array();

	var  $load_reserve_model;
	private $sess_orderby_reserve;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("01","02","04","07"),false,"OR");
		$this->load->model("manage/reserve_model");
			$this->load_reserve_model=$this->reserve_model;
		$this->lang->load("reserve/reserve","thailand");
	}

	// --------------------------------------------------------------------
	
	/**
	 * Get all field in $table_name and push to array ($field_name)
	 *
	 * @return 	void
	 */
	function get_all_field()
	{
		$fields = $this->load_reserve_model->get_all_field($this->table_name);
		foreach($fields as $field)
		{
			$this->field_name[$field]=$field;
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * - Receive data from view(add_reserve)
	 * - form validation
	 * - Add data to $table_name
	 *
	 * @return 	void
	 */
	function add()
	{
		$this->fl->check_group_privilege(array("07"));
		$config=array(
				array(
						"field"=>$this->lang->line("input_std_id"),
						"label"=>$this->lang->line("label_input_std_id"),
						"rules"=>""
				)
		);
		$this->frm->set_rules($config);
		if($this->frm->run() == false)
		{
			$in_std_id=array(
					"LB_text"=>$this->lang->line("label_input_std_id"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("input_std_id"),
					"IN_id"=>$this->lang->line("input_std_id"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("input_std_id")),
					"IN_attr"=>'maxlength="11"',
					"help_text"=>""
			);
			$in_phone=array(
					"LB_text"=>$this->lang->line("label_input_phone"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("input_phone"),
					"IN_id"=>$this->lang->line("input_phone"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("input_phone")),
					"IN_attr"=>'maxlength="10" phone',
					"help_text"=>""
			);
			$in_num_of_people=array(
					"LB_text"=>$this->lang->line("label_input_num_of_people"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("input_num_of_people"),
					"IN_id"=>$this->lang->line("input_num_of_people"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("input_num_of_people")),
					"IN_attr"=>'maxlength="3"',
					"help_text"=>""
			);
			$in_project_name=array(
					"LB_text"=>$this->lang->line("label_input_project_name"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("input_project_name"),
					"IN_id"=>$this->lang->line("input_project_name"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("input_project_name")),
					"IN_attr"=>'maxlength="100"',
					"help_text"=>""
			);
			$te_for_use=array(
					"LB_text"=>$this->lang->line("label_textarea_for_use"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("textarea_for_use"),
					"IN_id"=>$this->lang->line("textarea_for_use"),
					"IN_attr"=>'',
					"help_text"=>""
			);
			$se_faculty=array(
					"LB_text"=>$this->lang->line("label_select_faculty"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("select_faculty"),
					"S_id"=>$this->lang->line("select_faculty"),
					"S_old_value"=>$this->input->post($this->lang->line("select_faculty")),
					"S_data"=>$this->emm->select_faculty(),
					"S_id_field"=>"faculty_id",
					"S_name_field"=>"faculty_name",
					"help_text"=>''
			);
			$se_department=array(
					"LB_text"=>$this->lang->line("label_select_department"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("select_department"),
					"S_id"=>$this->lang->line("select_department"),
					"S_old_value"=>$this->input->post($this->lang->line("select_department")),
					"S_data"=>$this->emm->get_select("tb_department","department_name",array("checked"=>1)),
					"S_id_field"=>"department_id",
					"S_name_field"=>"department_name",
					"help_text"=>''
			);
			$se_job_position=array(
					"LB_text"=>$this->lang->line("label_select_job_position"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("select_job_position"),
					"S_id"=>$this->lang->line("select_job_position"),
					"S_old_value"=>$this->input->post($this->lang->line("select_job_position")),
					"S_data"=>$this->emm->get_select("tb_job_position","job_position_name",array("checked"=>1)),
					"S_id_field"=>"job_position_id",
					"S_name_field"=>"job_position_name",
					"help_text"=>''
			);
			$se_room_type=array(
					"LB_text"=>$this->lang->line("label_select_room_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("select_room_type"),
					"S_id"=>$this->lang->line("select_room_type"),
					"S_old_value"=>$this->input->post($this->lang->line("select_room_type")),
					"S_data"=>$this->emm->get_select("tb_room_type","room_type_name"),
					"S_id_field"=>"room_type_id",
					"S_name_field"=>"room_type_name",
					"help_text"=>''
			);
			$se_room=array(
					"LB_text"=>$this->lang->line("label_select_room"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("select_room"),
					"S_id"=>$this->lang->line("select_room"),
					"S_old_value"=>$this->input->post($this->lang->line("select_room")),
					"S_data"=>'',
					"S_id_field"=>"room_id",
					"S_name_field"=>"room_name",
					"help_text"=>''
			);
			$se_office=array(
					"LB_text"=>$this->lang->line("label_select_office"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("select_office"),
					"S_id"=>$this->lang->line("select_office"),
					"S_old_value"=>$this->input->post($this->lang->line("select_office")),
					"S_data"=>$this->emm->get_select("tb_office","office_name",array("checked"=>1)),
					"S_id_field"=>"office_id",
					"S_name_field"=>"office_name",
					"help_text"=>''
			);
			$se_person_type=array(
					"LB_text"=>$this->lang->line("label_select_person_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("select_person_type"),
					"S_id"=>$this->lang->line("select_person_type"),
					"S_old_value"=>$this->input->post($this->lang->line("select_person_type")),
					"S_data"=>$this->emm->get_select("tb_person_type","person_type"),
					"S_id_field"=>"person_type_id",
					"S_name_field"=>"person_type",
					"help_text"=>''
			);
			$se_person=array(
					"LB_text"=>$this->lang->line("label_select_person"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("select_person"),
					"S_id"=>$this->lang->line("select_person"),
					"S_old_value"=>$this->input->post($this->lang->line("select_person")),
					"S_data"=>'',
					"S_id_field"=>"person_type_id",
					"S_name_field"=>"person_type",
					"help_text"=>''
			);
			//add other
			$in_faculty=array(
					"LB_text"=>$this->lang->line("label_input_faculty"),
					"LB_attr"=>"",
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("input_faculty"),
					"IN_id"=>$this->lang->line("input_faculty"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("input_faculty")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$in_department=array(
					"LB_text"=>$this->lang->line("label_input_department"),
					"LB_attr"=>"",
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("input_department"),
					"IN_id"=>$this->lang->line("input_department"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("input_department")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$in_job_position=array(
					"LB_text"=>$this->lang->line("label_input_job_position"),
					"LB_attr"=>"",
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("input_job_position"),
					"IN_id"=>$this->lang->line("input_job_position"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("input_job_position")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$in_office=array(
					"LB_text"=>$this->lang->line("label_input_office"),
					"LB_attr"=>"",
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("input_office"),
					"IN_id"=>$this->lang->line("input_office"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("input_office")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("จองห้อง"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"se_faculty"=>$this->eml->form_select($se_faculty),
					"se_department"=>$this->eml->form_select($se_department),
					"se_job_position"=>$this->eml->form_select($se_job_position),
					"se_room_type"=>$this->eml->form_select($se_room_type),
					"se_room"=>$this->eml->form_select($se_room),
					"se_office"=>$this->eml->form_select($se_office),
					"se_person_type"=>$this->eml->form_select($se_person_type),
					"se_person"=>$this->eml->form_select($se_person),
					"in_std_id"=>$this->eml->form_input($in_std_id),
					"in_phone"=>$this->eml->form_input($in_phone),
					"in_num_of_people"=>$this->eml->form_input($in_num_of_people),
					"in_project_name"=>$this->eml->form_input($in_project_name),
					"te_for_use"=>$this->eml->form_textarea($te_for_use),
					"in_faculty"=>$this->eml->form_input($in_faculty),
					"in_department"=>$this->eml->form_input($in_department),
					"in_job_position"=>$this->eml->form_input($in_job_position),
					"in_office"=>$this->eml->form_input($in_office)
			);
			$data["reserve_tab"]=(!$this->fl->check_group_privilege(array("07"),true)) ? $this->reserve_tab() : '';
			$this->load->view("manage/reserve/add_reserve",$data);
		}
		else
		{
			$this->db->trans_begin();
			
			//insert tb_reserve
			$reserve_id=$this->load_reserve_model->get_maxid(5,"reserve_id","tb_reserve");
			$data=array(
					"reserve_id"=>$reserve_id,
					"tb_user_username"=>$this->session->userdata("rs_username"),
					"tb_room_id"=>$this->input->post("select_room"),
					"for_use"=>$this->input->post("textarea_for_use"),
					"project_name"=>$this->input->post("input_project_name"),
					"other_article"=>$this->input->post("other_article"),
					"num_of_people"=>$this->input->post("input_num_of_people"),
					"reserve_on"=>date('Y-m-d H:i:s')
					//""=>"",
			);
			$redirect_link="?d=manage&c=reserve&m=add";
			$this->load_reserve_model->manage_add2($data,"tb_reserve");
			
			$post_article_num=$this->input->post("article_num");
			//insert tb_reserve_has_article
			if($this->input->post("article"))
			{
				foreach ($this->input->post("article") as $index=>$val)
				{
					$data2=array(
							"tb_reserve_id"=>$reserve_id,
							"tb_article_id"=>$val,
							"unit_num"=>$post_article_num[$index]
					);
					$this->load_reserve_model->manage_add2($data2,"tb_reserve_has_article");
				}
			}
			
			//insert tb_reserve_has_datetime
			if($this->input->post("reserve_time")=="reserve_time1")
			{ 
				//แบบวันที่ รายวัน
				if($this->input->post("reserve_time-sub1")=="reserve_time1-1")
				{
					$date11 = $this->input->post("input-time1-1-date1");
					$time11b = $this->input->post("input-begin-time1-1");
					$time11e = $this->input->post("input-end-time1-1");
					foreach ($date11 as $key=>$val)
					{
						$c_time11b = $this->convert_datetime($time11b[$key]);
						$c_time11b = $c_time11b["time"];
						$c_time11e = $this->convert_datetime($time11e[$key]);
						$c_time11e = $c_time11e["time"];
						$c_date11 = $val;
						$beginDT = new DateTime($c_date11." ".$c_time11b);
						$endDT = new DateTime($c_date11." ".$c_time11e);
						$data11 = array(
								"datetime_id"=>$this->load_reserve_model->get_maxid(6,"datetime_id","tb_reserve_has_datetime"),
								"tb_reserve_id"=>$reserve_id,
								"reserve_datetime_begin"=>$beginDT->format('Y-m-d H:i:s'),
								"reserve_datetime_end"=>$endDT->format('Y-m-d H:i:s')
						);
						$this->load_reserve_model->manage_add2($data11,"tb_reserve_has_datetime");
					}
				}
				//แบบคาบเรียน รายวัน
				else if($this->input->post("reserve_time-sub1")=="reserve_time1-2")
				{
					$date12 = $this->input->post("input-period-date1");
					$time12b = $this->input->post("time1-period-begin");
					$time12e = $this->input->post("time1-period-end");
					foreach ($date12 as $key=>$val)
					{
						$c_time12b = $this->convert_datetime($time12b[$key]);
						$c_time12b = $c_time12b["time"];
						$c_time12e = $this->convert_datetime($time12e[$key]);
						$c_time12e = $c_time12e["time"];
						$c_date12 = $val;
						$beginDT = new DateTime($c_date12." ".$c_time12b);
						$endDT = new DateTime($c_date12." ".$c_time12e);
						$data12 = array(
								"datetime_id"=>$this->load_reserve_model->get_maxid(6,"datetime_id","tb_reserve_has_datetime"),
								"tb_reserve_id"=>$reserve_id,
								"reserve_datetime_begin"=>$beginDT->format('Y-m-d H:i:s'),
								"reserve_datetime_end"=>$endDT->format('Y-m-d H:i:s')
						);
						$this->load_reserve_model->manage_add2($data12,"tb_reserve_has_datetime");
					}
				}
			}
			//ระยะยาว
			else if($this->input->post("reserve_time")=="reserve_time2")
			{
				//แบบวันที่
				if($this->input->post("reserve_time-sub2")=="reserve_time2-1")
				{
					$post_begin_time2=$this->convert_datetime($this->input->post("input-begin-time2"));
					$post_end_time2=$this->convert_datetime($this->input->post("input-end-time2"));
					$c_begin_date2 = $this->convert_datetime($this->input->post("input-time2-1-date1Begin"));
					$c_end_date2 = $this->convert_datetime($this->input->post("input-time2-1-date1End"));
				}
				//แบบคาบเรียน
				else if($this->input->post("reserve_time-sub2")=="reserve_time2-2")
				{
					$post_begin_time2=$this->convert_datetime($this->input->post("time2-period-begin"));
					$post_end_time2=$this->convert_datetime($this->input->post("time2-period-end"));
					$c_begin_date2 = $this->convert_datetime($this->input->post("input-time2-2-date1Begin"));
					$c_end_date2 = $this->convert_datetime($this->input->post("input-time2-2-date1End"));
				}
				$yearBegin=substr($c_begin_date2["date"],0,4);
					$monthBegin=substr($c_begin_date2["date"],5,2);
						$dateBegin=substr($c_begin_date2["date"],8,2);
				$yearEnd=substr($c_end_date2["date"],0,4);
					$monthEnd=substr($c_end_date2["date"],5,2);
						$dateEnd=substr($c_end_date2["date"],8,2);
				$timeBegin=$post_begin_time2["time"];
				$timeEnd=$post_end_time2["time"];
				
				$arrDateTimeBegin=array();
				$arrDateTimeEnd=array();
				$arr_dayofweek=$this->input->post("day-time2");
				for($y=$yearBegin; $y<=$yearEnd; $y++)
				{
					//ถ้าลบกันแล้วมากกว่า 0 แสดงว่า วดปเริ่ม-วดปสิ้นสุด จองข้ามปี
					if($yearEnd-$y>0)
					{
						//ถ้าปีเริ่มที่เลือกมาก ให้เริ่มลูปเดือนที่เลือกมา
						if($y==$yearBegin) $minmonth=$monthBegin;
						//ถ้าไม่ใช่ปีเริ่มที่เลือกมาก ให้ลูปเดือนตั้งแต่เดือนแรก ของแต่ละปี
						else $minmonth=1;
						//ลูปเดือน
						for($m=$minmonth; $m<=12; $m++)
						{
							//d1 เก็บวันที่เริ่มต้นในการลูป วัน
							$d1;
							if($y==$yearBegin)//ถ้าเป็นปีแรก
							{
							//ถ้าเป็นเดือนแรกให้เริ่มloopตั้งแต่วันเริ่มที่เลือกไว้
								if($m==$monthBegin) $d1=$dateBegin;
								else $d1=1;
							}
							else $d1=1;
							for($d1; $d1<=cal_days_in_month(CAL_GREGORIAN, $m, $y); $d1++)
							{
								foreach($arr_dayofweek as $key=>$val)
								{
									//ตรวจสอบว่า วดป ที่ลูปได้มา เป็นวันอะไร (อา.-ส.)
									if(date('w',strtotime($y."-".$m."-".$d1))==$val)
									{
										array_push($arrDateTimeBegin, $y."-".$m."-".$d1." ".$timeBegin);
										array_push($arrDateTimeEnd, $y."-".$m."-".$d1." ".$timeEnd);
									}
								}
							}
						}
					}
					//ถ้าลบกันแล้วเท่ากับ 0 แสดงว่า วดปเริ่ม-วดปสิ้นสุด จองภายในปีเดียวกัน
					else if($yearEnd-$y==0)
					{
						//ถ้าปีเริ่มที่เลือกมาก ให้เริ่มลูปเดือนที่เลือกมา
						if($y==$yearBegin) $minmonth=$monthBegin;
						//ถ้าไม่ใช่ปีเริ่มที่เลือกมาก ให้ลูปเดือนตั้งแต่เดือนแรก ของแต่ละปี
						else $minmonth=1;
						for($m=$minmonth; $m<=$monthEnd; $m++)
						{
							//ถ้าเป็นเดือนเริ่ม ที่เลือกมา
							if($m==$monthBegin)
							{
								//ถ้าเดือนเริ่ม-สิ้นสุดเป็นเดือนเดียวกัน
								if($monthBegin==$monthEnd)	$dE=$dateEnd;
								else $dE=cal_days_in_month(CAL_GREGORIAN, $m ,$y);
								
								for($d1=$dateBegin; $d1<=$dE; $d1++)
								{
									foreach($arr_dayofweek as $key=>$val)
									{
										//ตรวจสอบว่า วดป ที่ลูปได้มา เป็นวันอะไร (อา.-ส.)
										if(date('w',strtotime($y."-".$m."-".$d1))==$val)
										{
											array_push($arrDateTimeBegin, $y."-".$m."-".$d1." ".$timeBegin);
											array_push($arrDateTimeEnd, $y."-".$m."-".$d1." ".$timeEnd);
										}
									}
								}
							}
							//ถ้าไม่เป็นเดือนเริ่ม ที่เลือกมา
							else if($m!=$monthBegin)
							{
								//ถ้าไม่เป็นเดือนสุดท้ายที่เลือกมา
								if($m!=$monthEnd)
								{
									for($d1=1; $d1<=cal_days_in_month(CAL_GREGORIAN, $m ,$y); $d1++)
									{
										foreach($arr_dayofweek as $key=>$val)
										{
											//ตรวจสอบว่า วดป ที่ลูปได้มา เป็นวันอะไร (อา.-ส.)
											if(date('w',strtotime($y."-".$m."-".$d1))==$val)
											{
													array_push($arrDateTimeBegin, $y."-".$m."-".$d1." ".$timeBegin);
													array_push($arrDateTimeEnd, $y."-".$m."-".$d1." ".$timeEnd);
											}
										}
									}
								}
								//ถ้าเป็นเดือนสุดท้ายที่เลือกมา
								else 
								{
									for($d1=1; $d1<=$dateEnd; $d1++)
									{
										foreach($arr_dayofweek as $key=>$val)
										{
											//ตรวจสอบว่า วดป ที่ลูปได้มา เป็นวันอะไร (อา.-ส.)
											if(date('w',strtotime($y."-".$m."-".$d1))==$val)
											{
												array_push($arrDateTimeBegin, $y."-".$m."-".$d1." ".$timeBegin);
												array_push($arrDateTimeEnd, $y."-".$m."-".$d1." ".$timeEnd);
											}
										}
									}
								}
							}//else if($m!=$monthBegin)
						}//for($m=$minmonth; $m<=$monthEnd; $m++)
					}//else if($yearEnd-$y==0)
				}
				foreach($arrDateTimeBegin as $index=>$val)
				{
					$data3=array(
							"datetime_id"=>$this->load_reserve_model->get_maxid(6,"datetime_id","tb_reserve_has_datetime"),
							"tb_reserve_id"=>$reserve_id,
							"reserve_datetime_begin"=>$val,
							"reserve_datetime_end"=>$arrDateTimeEnd[$index]
					);
					$this->load_reserve_model->manage_add2($data3,"tb_reserve_has_datetime");
				}
			}
					
			//insert tb_reserve_has_person
			if($this->input->post("select_person")=="03")//บุคคลทั่วไป
			{
				$job_position_id=$this->input->post("select_job_position");
				$office_id=$this->input->post("select_office");
				if($this->input->post("select_job_position")=="00")
				{
					if($this->load_reserve_model->find_one("tb_job_position",array("job_position_name"=>$this->input->post("input_job_position"))))
					{
						$exists_data=$this->load_reserve_model->find_one("tb_job_position",array("job_position_name"=>$this->input->post("input_job_position")));
						$exists_data=$exists_data[0];
						if($this->countdim($exists_data)==1)
							$job_position_id=$exists_data["job_position_id"];
					}
					else
					{
						$job_position_id=$this->load_reserve_model->get_maxid(2,"job_position_id","tb_job_position");
						$this->load_reserve_model->manage_add2(
								array(
										"job_position_id"=>$job_position_id,
										"job_position_name"=>$this->input->post("input_job_position")
								),
								"tb_job_position");
					}
				}
				if($this->input->post("select_office")=="00")
				{
					if($this->load_reserve_model->find_one("tb_office",array("office_name"=>$this->input->post("input_office"))))
					{
						$exists_data=$this->load_reserve_model->find_one("tb_office",array("office_name"=>$this->input->post("input_office")));
						$exists_data=$exists_data[0];
						if($this->countdim($exists_data)==1)
							$office_id=$exists_data["office_id"];
					}
					else
					{
						$office_id=$this->load_reserve_model->get_maxid(2,"office_id","tb_office");
						$this->load_reserve_model->manage_add2(
								array(
										"office_id"=>$office_id,
										"office_name"=>$this->input->post("input_office")
								),
								"tb_office");
					}
				}
				$data4=array(
						"tb_reserve_id"=>$reserve_id,
						"tb_person_id"=>$this->input->post("select_person"),
						"phone"=>$this->input->post("input_phone"),
						"tb_job_position_id"=>$job_position_id,
						"tb_office_id"=>$office_id
				);
			}
			else if($this->input->post("select_person")=="02" || $this->input->post("select_person")=="01")//02std || 01teacher
			{
				$faculty_id=$this->input->post("select_faculty");
				$department_id=$this->input->post("select_department");
				$job_position_id=$this->input->post("select_job_position");
				if($this->input->post("select_faculty")=="00")
				{
					//ถ้ามี ชื่อที่ซ้ำกันอยู่แล้วให้เลือกคีย์ของชื่อนั้นมาใช้อ้างอิง เพราะ ฟิลด์ชื่อเป็น unique
					if($this->load_reserve_model->find_one("tb_faculty",array("faculty_name"=>$this->input->post("input_faculty"))))
					{
						$exists_data=$this->load_reserve_model->find_one("tb_faculty",array("faculty_name"=>$this->input->post("input_faculty")));
						$exists_data=$exists_data[0];
						if($this->countdim($exists_data)==1)
							$faculty_id=$exists_data["faculty_id"];
					}
					else
					{
						$faculty_id=$this->load_reserve_model->get_maxid(2,"faculty_id","tb_faculty");
						$this->load_reserve_model->manage_add2(
							array(
									"faculty_id"=>$faculty_id,
									"faculty_name"=>$this->input->post("input_faculty")
							),
							"tb_faculty");
					}
				}
				if($this->input->post("select_department")=="00")
				{
					//ถ้ามี ชื่อที่ซ้ำกันอยู่แล้วให้เลือกคีย์ของชื่อนั้นมาใช้อ้างอิง เพราะ ฟิลด์ชื่อเป็น unique
					if($this->load_reserve_model->find_one("tb_department",array("department_name"=>$this->input->post("input_department"))))
					{
						$exists_data=$this->load_reserve_model->find_one("tb_department",array("department_name"=>$this->input->post("input_department")));
						$exists_data=$exists_data[0];
						if($this->countdim($exists_data)==1)
							$department_id=$exists_data["department_id"];
					}
					else
					{
						$department_id=$this->load_reserve_model->get_maxid(2,"department_id","tb_department");
						$this->load_reserve_model->manage_add2(
							array(
									"department_id"=>$department_id,
									"department_name"=>$this->input->post("input_department")
							),
							"tb_department");
					}
				}
				if($this->input->post("select_person")=="01")//01=อาจารย์/เจ้าหน้าที่
				{
					if($this->input->post("select_job_position")=="00")
					{
						if($this->load_reserve_model->find_one("tb_job_position",array("job_position_name"=>$this->input->post("input_job_position"))))
						{
							$exists_data=$this->load_reserve_model->find_one("tb_job_position",array("job_position_name"=>$this->input->post("input_job_position")));
							$exists_data=$exists_data[0];
							if($this->countdim($exists_data)==1)
								$job_position_id=$exists_data["job_position_id"];
						}
						else
						{
							$job_position_id=$this->load_reserve_model->get_maxid(2,"job_position_id","tb_job_position");
							$this->load_reserve_model->manage_add2(
									array(
											"job_position_id"=>$job_position_id,
											"job_position_name"=>$this->input->post("input_job_position")
									),
									"tb_job_position");
						}
					}
					//data 01teacher
					$data4=array(
							"tb_reserve_id"=>$reserve_id,
							"tb_person_id"=>$this->input->post("select_person"),
							"phone"=>$this->input->post("input_phone"),
							"tb_faculty_id"=>$faculty_id,
							"tb_department_id"=>$department_id,
							"tb_job_position_id"=>$job_position_id
					);
				}
				else
				{
					//data 02std
					$data4=array(
							"tb_reserve_id"=>$reserve_id,
							"tb_person_id"=>$this->input->post("select_person"),
							"phone"=>$this->input->post("input_phone"),
							"tb_faculty_id"=>$faculty_id,
							"tb_department_id"=>$department_id,
							"std_id"=>$this->input->post("input_std_id")
					);
				}
			}
			//data4 ใช้กับรหัส person 01 02 03
			$this->load_reserve_model->manage_add2($data4,"tb_reserve_has_person");
			
			
			//upload file
			if($this->input->post("select_person_type")!=02)
			{
				$this->load->library('upload'); // Load Library
				$files = $_FILES;
				$cpt = count($_FILES['project_file']['name']);
				$config = array();
				$config['upload_path'] = './upload/docs/';
				$config['allowed_types'] = 'doc|docx|pdf';
				$config['max_size']      = '0';
				$config['overwrite']     = FALSE;
				$this->upload->initialize($config); // These are just my options. Also keep in mind with PDF's YOU MUST TURN OFF xss_clean
				
				for($i=0; $i<$cpt; $i++)
				{
					$name = $_FILES["project_file"]["name"][$i];
					$ext = end(explode(".", $name));
					$file_detail=array(
							//1388212969.8946 to 1388212969_8946
							"new_name"=>str_replace(".", "_",microtime(true)).rand(100,999).".".end(explode(".", $files["project_file"]["name"][$i])),
							"old_name"=>$files["project_file"]["name"][$i],
							"ext"=>end(explode(".", $files["project_file"]["name"][$i])),
							"type"=>$files["project_file"]["type"][$i],
							"error"=>$files["project_file"]["error"][$i],
							"size"=>$files["project_file"]["size"][$i]
					);
					//print_r($file_detail);
					$_FILES['project_file']['name']= $file_detail["new_name"];
					$_FILES['project_file']['type']= $files['project_file']['type'][$i];
					$_FILES['project_file']['tmp_name']= $files['project_file']['tmp_name'][$i];
					$_FILES['project_file']['error']= $files['project_file']['error'][$i];
					$_FILES['project_file']['size']= $files['project_file']['size'][$i];
					//echo "<hr>";print_r($_FILES);
					if($this->upload->do_upload('project_file'))
					{
						//upload success
						$data5=array(
								"file_id"=>$this->load_reserve_model->get_maxid(5,"file_id","tb_reserve_has_file"),
								"tb_reserve_id"=>$reserve_id,
								"file_name"=>$file_detail["new_name"],
								"old_file_name"=>$file_detail["old_name"]
						);
						$this->load_reserve_model->manage_add2($data5,"tb_reserve_has_file");
					}
					else
					{
						echo $this->upload->display_errors('<p>', '</p>');
					}
				}
			}
			if($this->db->trans_status()===FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
				redirect(base_url()."?d=manage&c=reserve&m=view&id=".$reserve_id);
			}
			
			
			/* TEST SHOW DATA ZONE
			echo "<hr>";
			echo "tb_reserve";
			echo "<hr>";
			echo "<p>reserve_id : xxx</p>";
			echo "<p>tb_user_username : session_username</p>";
			echo "<p>tb_room_id : ".$this->input->post("select_room")."</p>";
			echo "<p>for_use : ".$this->input->post("textarea_for_use")."</p>";
			echo "<p>project_name : ".$this->input->post("input_project_name")."</p>";
			echo "<p>other_article : ".$this->input->post("other_article")."</p>";
			echo "<p>num_of_people : ".$this->input->post("input_num_of_people")."</p>";
			echo "<p>reserve_on : ".date("Y-m-d H:i:s")."</p>";
			echo "<p> : ".$this->input->post("")."</p>";
			//echo "<p> : ".$this->input->post("")."</p>";
			echo "<hr>";
			echo "tb_reserve_has_datetime";
			echo "<hr>";
			if($this->input->post("reserve_time")=="reserve_time1")
			{
				foreach($post_begin_time1 as $key=>$val)
				{
					echo "<p>begin-time1:".$key." : ".$post_begin_time1[$key]."</p>";
					echo "<p>end-time1:".$key." : ".$post_end_time1[$key]."</p>";
				}
			}
			else if($this->input->post("reserve_time")=="reserve_time2")
			{
				
				$yearBegin=substr($convert_begin_time2["date"],0,4);
				$monthBegin=substr($convert_begin_time2["date"],5,2);
				$dateBegin=substr($convert_begin_time2["date"],8,2);
				$yearEnd=substr($convert_end_time2["date"],0,4);
				$monthEnd=substr($convert_end_time2["date"],5,2);
				$dateEnd=substr($convert_end_time2["date"],8,2);
				$timeBegin=$convert_begin_time2["time"];
				$timeEnd=$convert_end_time2["time"];
				$arrDateTimeBegin=array();
				$arrDateTimeEnd=array();
				$arr_dayofweek=$this->input->post("day-time2");
				for($y=$yearBegin; $y<=$yearEnd; $y++)
				{
					if($yearEnd-$y>0)
					{
						if($y==$yearBegin) $minmonth=$monthBegin;
						else $minmonth=1;
						for($m=$minmonth; $m<=12; $m++)
						{
							$d1;
							if($y==$yearBegin)//ถ้าเป็นปีแรก
							{
								//ถ้าเป็นเดือนแรกให้เริ่มloopตั้งแต่วันเริ่มที่เลือกไว้
								if($m==$monthBegin) $d1=$dateBegin;
								else $d1=1;
							}
							else $d1=1;
							for($d1; $d1<=cal_days_in_month(CAL_GREGORIAN, $m, $y); $d1++)
							{
								foreach($arr_dayofweek as $key=>$val)
								{
									if(date('w',strtotime($y."-".$m."-".$d1))==$val)
									{
										array_push($arrDateTimeBegin, $y."-".$m."-".$d1." ".$timeBegin);
										array_push($arrDateTimeEnd, $y."-".$m."-".$d1." ".$timeEnd);
									}
								}
							}
						}
					}
					else if($yearEnd-$y==0)
					{
						for($m=1; $m<=$monthEnd; $m++)
						{
							if($m==$monthEnd)
							{
								for($d1=1; $d1<=$dateEnd; $d1++)
								{
									foreach($arr_dayofweek as $key=>$val)
									{
										if(date('w',strtotime($y."-".$m."-".$d1))==$val)
										{
											array_push($arrDateTimeBegin, $y."-".$m."-".$d1." ".$timeBegin);
											array_push($arrDateTimeEnd, $y."-".$m."-".$d1." ".$timeEnd);
										}
									}
								}
							}
						}
					}
				}
				print_r($arrDateTimeBegin);
				print_r($arrDateTimeEnd);
				//echo $convert_begin_time2["date"];
			}
			
			
			echo "<hr>";
			echo "ข้อมูลผู้จอง";
			echo "<hr>";
			echo "<p>person_type : ".$this->input->post("select_person_type")."</p>";
			echo "<p>person : ".$this->input->post("select_person")."</p>";
			if($this->input->post("select_person")=="03")//บุคคลทั่วไป
			{
				echo "<p>select_job_position : ".$this->input->post("select_job_position")."</p>";
				if($this->input->post("select_job_position")=="00")
					echo "<p>input_job_position : ".$this->input->post("input_job_position")."</p>";
				echo "<p>select_office : ".$this->input->post("select_office")."</p>";
				if($this->input->post("select_office")=="00")
					echo "<p>input_office : ".$this->input->post("input_office")."</p>";
			}
			else if($this->input->post("select_person")=="02")//std
			{
				//select_faculty
				//	input_faculty
				//select_department
				//	input_department
				//input_std_id
			}
			else if($this->input->post("select_person")=="01")//teacher
			{
				//select_faculty
				//	input_faculty
				//select_department
				//	input_department
				//select_job_position
				//	input_job_position
			}
			echo "<p>input_phone : ".$this->input->post("input_phone")."</p>";
			echo "<hr>";
			echo "มีความประสงค์ขอใช้";
			echo "<hr>";
			echo "<p>select_room_type : ".$this->input->post("select_room_type")."</p>";
			echo "<p>select_room : ".$this->input->post("select_room")."</p>";
			echo "<p>input_num_of_people : ".$this->input->post("input_num_of_people")."</p>";
			echo "<p>textarea_for_use : ".$this->input->post("textarea_for_use")."</p>";
			echo "<hr>";
			echo "ครุภัณฑ์/อุปกรณ์ที่ใช้";
			echo "<hr>";
			echo "<p>checkbox article[] : ".print_r($this->input->post("article"))."</p>";
			echo "<p>checkbox article_num[] : ".print_r($this->input->post("article_num"))."</p>";
			echo "<p>textarea other_article : ".$this->input->post("other_article")."</p>";
			echo "<hr>";
			echo "ข้อมูลโครงการ";
			echo "<hr>";
			echo "<p>input_project_name : ".$this->input->post("input_project_name")."</p>";
			echo "<hr>";
			echo "กำหนดเวลา";
			echo "<hr>";
			echo "<p>radio: ".$this->input->post("reserve_time")."</p>";
			echo "<p>input-begin-time1-1[] : ".print_r($post_begin_time1)."</p>";
			echo "<p>input-end-time1-1[] : ".print_r($post_end_time1)."</p>";
			echo "<p>input-begin-time2 : ".$post_begin_time2."</p>";
			echo "<p>input-end-time2 : ".$post_end_time2."</p>";
			echo "<p>day-time2[] : ".print_r($this->input->post("day-time2"))."</p>";
			//echo "<p> : ".$this->input->post("")."</p>";
			//echo $this->input->post("select_person_type");
			//echo $this->input->post("select_person_type");
			//print_r($this->input->post("article"));
			//print_r($this->input->post("article_num"));
			
			
			//print_r($post_begin_time1);
			//print_r($post_end_time1);
			foreach($post_begin_time1 as $key=>$bg)
			{
				//echo $this->convert_datetime($bg)["date"];
				//echo "<hr>";
				//echo $this->convert_datetime($bg)["time"];
				
			}
			//print_r($this->input->post("day-time2"));
			 
			*/
		}
		//redirect(base_url()."?d=manage&c=reserve&m=add_datetime");
	}

	function add_datetime()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("input_std_id"),
						"label"=>$this->lang->line("label_input_std_id"),
						"rules"=>""
				)
		);
		$this->frm->set_rules($config);
		if($this->frm->run() == false)
		{
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("จองห้อง"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose()
			);
			$this->load->view("manage/reserve/add_datetime_reserve",$data);
		}
		else
		{
			//add to reserve_has_datetime
		}
	}
	function convert_datetime($subject)
	{
		$datetime=array("date"=>'',"time"=>'');
		//find date
		$pattern = "/(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}/";
		preg_match($pattern,$subject, $matches);
		
		if(count($matches)>0)
		{
			$date_pos=array(
					"year"=>substr($matches[0],6,4),
					"month"=>substr($matches[0],3,2),
					"day"=>substr($matches[0],0,2)
			);
			$datetime["date"]=$date_pos["year"]."-".$date_pos["month"]."-".$date_pos["day"];
		}

		//find time
		$pattern = "/([0-9]|0[0-9]|1[0-9]|2[0-4]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0])/";
		preg_match($pattern,$subject, $matches);
		if(count($matches)>0)$datetime["time"]=$matches[0];
		return $datetime;
	}
	function select_room_list()
	{
		/*
		 * Return JSON
		 */
		if($this->input->post("room_type_id")!=''):
			$query=$this->emm->reserve_room_list($this->input->post("room_type_id"));
			$data='';
			if($query>0):
			foreach($query AS $ar):
			$data.="<option value='".$ar['room_id']."'>".$ar['room_name']."</option>";
			endforeach;
		endif;
		echo json_encode(array("room_list"=>$data));
		else: echo "";
		endif;
	}
	function select_person_list()
	{
		/*
		 * Return JSON
		*/
		if($this->input->post("person_type_id")!=''):
		$query=$this->emm->select_person_list($this->input->post("person_type_id"));
		$data='';
		if($query>0):
		foreach($query AS $ar):
		$data.="<option value='".$ar['person_id']."'>".$ar['person']."</option>";
		endforeach;
		endif;
		echo json_encode(array("person_list"=>$data));
		else: echo "";
		endif;
	}
	function get_room_has_article()
	{
		if($this->input->post("room_id")!='')
		{
			$query=$this->load_reserve_model->get_room_has_article($this->input->post("room_id"));
			$arr=array();
			foreach($query as $q)
			{
				$html='';
				$html.='<div class="checkbox del-checkbox">
				<label>
				<input type="checkbox" name="article[]" value="'.$q["tb_article_id"].'">'.$q["article_name"].' <span>(จำนวน <span class="has_article_num">'.$q["article_num"].'</span>)</span></label>
				</div>';
				array_push($arr,$html);
			}
			echo json_encode($arr);	
		}
	}
	// count dimension of array
	function countdim($array)
	{
		if (is_array(reset($array)))
		{
			$return = countdim(reset($array)) + 1;
		}
		else
		{
			$return = 1;
		}
		return $return;
	}
	function edit()
	{
		$this->fl->check_group_privilege(array("01"));
		$config=array(
				array(
						"field"=>"input_reserve_name",
						"label"=>"ชื่อห้อง",
						"rules"=>"required|max_length[50]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("reserve", array("field"=>"reserve_on","type"=>"DESC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=reserve&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
		
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
		
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_reserve", "reserve_id");
			$search_text=null;
			$search_text=$this->session->userdata("search_reserve");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->load_reserve_model->get_all_reserve_numrows("tb_reserve",$liketext,$searchfield);
		
				$get_reserve_list=$this->load_reserve_model->get_reserve_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->load_reserve_model->get_all_reserve_numrows("tb_reserve",'',$searchfield);
				$get_reserve_list=$this->load_reserve_model->get_reserve_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
		
			//..pagination
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("จัดการการจอง"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"reserve_tab"=>$this->reserve_tab(),
					"table_edit"=>$this->table_edit($get_reserve_list),
					"session_search_reserve"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/reserve/edit_reserve",$data);
		}
		else
		{

		}
	}
	function edit2()
	{
		$this->fl->check_group_privilege(array("01"));
		$config=array(
				array(
						"field"=>"aa",
						"label"=>"aa",
						"rules"=>""
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("reserve2", array("field"=>"reserve_on","type"=>"DESC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=reserve&m=edit2";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
		
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
		
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_reserve2", "reserve_id");
			$search_text=null;
			$search_text=$this->session->userdata("search_reserve2");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->load_reserve_model->get_all_reserve_numrows2("tb_reserve",$liketext,$searchfield);
		
				$get_reserve_list=$this->load_reserve_model->get_reserve_list2($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->load_reserve_model->get_all_reserve_numrows2("tb_reserve",'',$searchfield);
		
				$get_reserve_list=$this->load_reserve_model->get_reserve_list2($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
		
			//..pagination
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("จัดการการจอง"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"reserve_tab"=>$this->reserve_tab(),
					"table_edit"=>$this->table_edit2($get_reserve_list),
					"session_search_reserve"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/reserve/edit_reserve2",$data);
		}
		else
		{

		}
	}
	function edit3()
	{
		$this->fl->check_group_privilege(array("04"));
		$config=array(
				array(
						"field"=>"aa",
						"label"=>"aa",
						"rules"=>""
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("reserve3", array("field"=>"reserve_on","type"=>"DESC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=reserve&m=edit3";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
	
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
	
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_reserve3", "reserve_id");
			$search_text=null;
			$search_text=$this->session->userdata("search_reserve3");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->load_reserve_model->get_all_reserve_numrows3("tb_reserve",$liketext,$searchfield);
	
				$get_reserve_list=$this->load_reserve_model->get_reserve_list3($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->load_reserve_model->get_all_reserve_numrows3("tb_reserve",'',$searchfield);
	
				$get_reserve_list=$this->load_reserve_model->get_reserve_list3($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
	
			//..pagination
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("จัดการการจอง"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"reserve_tab"=>$this->reserve_tab(),
					"table_edit"=>$this->table_edit3($get_reserve_list),
					"session_search_reserve"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/reserve/edit_reserve3",$data);
		}
		else
		{
	
		}
	}
function edit4()
	{
		$this->fl->check_group_privilege(array("04"));
		$config=array(
				array(
						"field"=>"aa",
						"label"=>"aa",
						"rules"=>""
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("reserve4", array("field"=>"reserve_on","type"=>"DESC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=reserve&m=edit4";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
	
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
	
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_reserve4", "reserve_id");
			$search_text=null;
			$search_text=$this->session->userdata("search_reserve4");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->load_reserve_model->get_all_reserve_numrows4("tb_reserve",$liketext,$searchfield);
	
				$get_reserve_list=$this->load_reserve_model->get_reserve_list4($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->load_reserve_model->get_all_reserve_numrows4("tb_reserve",'',$searchfield);
	
				$get_reserve_list=$this->load_reserve_model->get_reserve_list4($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
	
			//..pagination
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("จัดการการจอง"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"reserve_tab"=>$this->reserve_tab(),
					"table_edit"=>$this->table_edit4($get_reserve_list),
					"session_search_reserve"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/reserve/edit_reserve4",$data);
		}
		else
		{
	
		}
	}
	function table_edit($data)
	{
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>ชื่อโครงการ</th>
				<th>ห้อง</th>
				<th>ประเภทบุคคล</th>
				<th>ส่วนลด(%)</th>
				<th>วันที่จอง</th>
				<th>สถานะการอนุมัติ</th>
				<th class="same_first_td">อนุมัติ</th>
				<th class="same_first_td">รายละเอียด</th>
				<th>ลบ<br/><input type="checkbox" id="del_all_reserve"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=reserve&m=delete" id="form_del_reserve" autocomplete="off">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			$approve_text=array(
					"<span class='text-warning'>รออนุมัติ</span>",
					"<span class='text-success'>อนุมัติแล้ว</span>",
					"<span class='text-primary'>ส่งให้ผู้บริหารอนุมัติ</span>",
					"<span class='text-danger'>ไม่อนุมัติ</span>"
			);
			if($dt['approve']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve0[]" class="allow_reserve0"/>
										  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve1[]" class="allow_reserve1" checked/>
						  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
					  		</span>';
			$html.='<tr>
					<td>'.$dt["reserve_id"].'</td>
					<td id="reserve'.$dt["reserve_id"].'">'.$dt["project_name"].'</td>
					<td>'.$dt["room_name"].'</td>
					<td>'.$dt["person_type"].'</td>
					<td>'.$dt["discount"].'</td>
					<td>'.date('Y/m/d H:i:s',strtotime($dt["reserve_on"])).'</td>
					<td>'.$approve_text[$dt['approve']].'</td>
							
					<td class="text-center">'.$this->eml->btn('approve','onclick=approve_alert("'.$dt['reserve_id'].'","'.base_url().'");').'</td>
					<td class="same_first_td">'.$this->eml->btn('view','onclick=window.open("'.base_url().'?d=manage&c=reserve&m=view&id='.$dt["reserve_id"].'","_blank")').'</td>
					<td><input type="checkbox" value="'.$dt["reserve_id"].'" name="del_reserve[]" class="del_reserve"></td>
			';
			//<td class="same_first_td">'.$this->eml->btn('view','onclick=show_all_data("'.$dt["reserve_id"].'")').'</td>
			$html.='</tr>';
			$num_row++;
			endforeach;
		}
		$html.='<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>'.$this->eml->btn('delete','onclick="show_del_list();return false;"').'</td>
				</tr>
				</table>
				</form>';
		$html.=$this->pagination->create_links();
		return $html;
	}
	function table_edit2($data)
	{
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>ชื่อโครงการ</th>
				<th>ห้อง</th>
				<th>ส่วนลด(%)</th>
				<th>วันที่จอง</th>
				<th>สถานะการอนุมัติ</th>
				<th>อนุมัติโดย</th>
				<th class="same_first_td">อนุมัติ</th>
				<th class="same_first_td">รายละเอียด</th>
				<th>ลบ<br/><input type="checkbox" id="del_all_reserve"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=reserve&m=delete" id="form_del_reserve" autocomplete="off">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			$approve_text=array(
					"<span class='text-warning'>รออนุมัติ</span>",
					"<span class='text-success'>อนุมัติแล้ว</span>",
					"<span class='text-primary'>ส่งให้ผู้บริหารอนุมัติ</span>",
					"<span class='text-danger'>ไม่อนุมัติ</span>"
			);
			if($dt['approve']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve0[]" class="allow_reserve0"/>
										  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve1[]" class="allow_reserve1" checked/>
						  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
					  		</span>';
			$html.='<tr>
					<td>'.$dt["reserve_id"].'</td>
					<td id="reserve'.$dt["reserve_id"].'">'.$dt["project_name"].'</td>
					<td>'.$dt["room_name"].'</td>
					<td>'.$dt["discount"].'</td>
							<td>'.date('Y/m/d H:i:s',strtotime($dt["reserve_on"])).'</td>
					<td>'.$approve_text[$dt['approve']].'</td>
					<td>'.$dt["tb_user_username"]." (".$dt['approve_on'].')</td>
					<td class="text-center">'.$this->eml->btn('approve','onclick=approve_alert("'.$dt['reserve_id'].'","'.base_url().'");').'</td>
					<td class="same_first_td">'.$this->eml->btn('view','onclick=window.open("'.base_url().'?d=manage&c=reserve&m=view&id='.$dt["reserve_id"].'","_blank")').'</td>
					<td><input type="checkbox" value="'.$dt["reserve_id"].'" name="del_reserve[]" class="del_reserve"></td>
			';
			//<td class="same_first_td">'.$this->eml->btn('view','onclick=show_all_data("'.$dt["reserve_id"].'")').'</td>
			$html.='</tr>';
			$num_row++;
			endforeach;
		}
		$html.='<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>'.$this->eml->btn('delete','onclick="show_del_list();return false;"').'</td>
				</tr>
				</table>
				</form>';
		$html.=$this->pagination->create_links();
		return $html;
	}
	function table_edit3($data)
	{
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>ชื่อโครงการ</th>
				<th>ห้อง</th>
				<th>ส่วนลด(%)</th>
				<th>สถานะการอนุมัติ</th>
				<th class="same_first_td">อนุมัติ</th>
				<th class="same_first_td">รายละเอียด</th>
				<th>ลบ<br/><input type="checkbox" id="del_all_reserve"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=reserve&m=delete" id="form_del_reserve" autocomplete="off">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			$approve_text=array(
					"<span class='text-warning'>รออนุมัติ</span>",
					"<span class='text-success'>อนุมัติแล้ว</span>",
					"<span class='text-primary'>ส่งให้ผู้บริหารอนุมัติ</span>",
					"<span class='text-danger'>ไม่อนุมัติ</span>"
			);
			if($dt['approve']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve0[]" class="allow_reserve0"/>
										  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve1[]" class="allow_reserve1" checked/>
						  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
					  		</span>';
			$html.='<tr>
					<td>'.$dt["reserve_id"].'</td>
					<td id="reserve'.$dt["reserve_id"].'">'.$dt["project_name"].'</td>
					<td>'.$dt["room_name"].'</td>
					<td>'.$dt["discount"].'</td>
							<td>'.$approve_text[$dt['approve']].'</td>
					<td class="text-center">'.$this->eml->btn('approve','onclick=approve_alert("'.$dt['reserve_id'].'","'.base_url().'");').'</td>
					<td class="same_first_td">'.$this->eml->btn('view','onclick=window.open("'.base_url().'?d=manage&c=reserve&m=view&id='.$dt["reserve_id"].'","_blank")').'</td>
					<td><input type="checkbox" value="'.$dt["reserve_id"].'" name="del_reserve[]" class="del_reserve"></td>
			';
			//<td class="same_first_td">'.$this->eml->btn('view','onclick=show_all_data("'.$dt["reserve_id"].'")').'</td>
			$html.='</tr>';
			$num_row++;
			endforeach;
		}
		$html.='<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>'.$this->eml->btn('delete','onclick="show_del_list();return false;"').'</td>
				</tr>
				</table>
				</form>';
		$html.=$this->pagination->create_links();
		return $html;
	}
	function table_edit4($data)
	{
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>ชื่อโครงการ</th>
				<th>ห้อง</th>
				<th>ประเภทบุคคล</th>
				<th>ส่วนลด(%)</th>
				<th>สถานะการอนุมัติ</th>
				<th class="same_first_td">รายละเอียด</th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=reserve&m=delete" id="form_del_reserve" autocomplete="off">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			$approve_text=array(
					"<span class='text-warning'>รออนุมัติ</span>",
					"<span class='text-success'>อนุมัติแล้ว</span>",
					"<span class='text-primary'>ส่งให้ผู้บริหารอนุมัติ</span>",
					"<span class='text-danger'>ไม่อนุมัติ</span>"
			);
			if($dt['approve']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve0[]" class="allow_reserve0"/>
										  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve1[]" class="allow_reserve1" checked/>
						  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
					  		</span>';
			$html.='<tr>
					<td>'.$dt["reserve_id"].'</td>
					<td id="reserve'.$dt["reserve_id"].'">'.$dt["project_name"].'</td>
					<td>'.$dt["room_name"].'</td>
					<td>'.$dt["person_type"].'</td>
					<td>'.$dt["discount"].'</td>
							<td>'.$approve_text[$dt['approve']].'</td>
					
					<td class="same_first_td">'.$this->eml->btn('view','onclick=window.open("'.base_url().'?d=manage&c=reserve&m=view&id='.$dt["reserve_id"].'","_blank")').'</td>
			';
			//<td class="same_first_td">'.$this->eml->btn('view','onclick=show_all_data("'.$dt["reserve_id"].'")').'</td>
			$html.='</tr>';
			$num_row++;
			endforeach;
		}
		$html.='
				</table>
				</form>';
		$html.=$this->pagination->create_links();
		return $html;
	}
	function reserve_tab()
	{
		//<li><a href="#"  id="add">จองห้อง</a></li>
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			';
		if($this->fl->check_group_privilege(array("02"),true))
		{
			$html.='<li><a href="#"  id="edit">จัดการการจอง</a></li>';
		}
		$html.='<li><a href="#"  id="edit2">จัดการการจองที่อนุมัติแล้ว</a></li>';
		if($this->fl->check_group_privilege(array("04"),true))
		{
			$html.='<li><a href="#"  id="edit3">จัดการการจองสำหรับผู้บริหาร</a></li>';
		}
		if($this->fl->check_group_privilege(array("02"),true))
		{
			$html.='<li><a href="#"  id="edit4">การจองทั้งหมด</a></li>';
		}
		$html.='</ul>';
		return $html;
	}
	function allow()
	{
		//$data = array
		$allow_list=$this->input->post("allow_list");
		$disallow_list=$this->input->post("disallow_list");
		$this->load_reserve_model->manage_allow($allow_list,$disallow_list, "tb_reserve", "reserve_id", "project_name", "edit_reserve", "?d=manage&c=reserve&m=edit");
	}
	function show_all_data()
	{
		if($this->input->post("get")=="article")
		{
			echo json_encode($this->load_reserve_model->get_article_data($this->input->post("reserve_id")));
		}
		else if($this->input->post("get")=="datetime")
		{
			echo json_encode($this->load_reserve_model->get_datetime_data($this->input->post("reserve_id")));
		}
		else if($this->input->post("get")=="file")
		{
			echo json_encode($this->load_reserve_model->get_file_data($this->input->post("reserve_id")));
		}
		else if($this->input->post("get")=="reserve")
		{
			$get_reserve_data=$this->load_reserve_model->get_reserve_data($this->input->post("reserve_id"));
			echo json_encode($get_reserve_data[0]);
		}
		
	}
	function view()
	{
		if(isset($_GET["id"]))
		{
			$get_reserve_data=$this->load_reserve_model->get_reserve_data($_GET["id"]);
			
			$article_data=$this->load_reserve_model->get_article_data($_GET["id"]);
			$datetime_data=$this->load_reserve_model->get_datetime_data($_GET["id"]);
			$file_data=$this->load_reserve_model->get_file_data($_GET["id"]);
			$reserve_data=$get_reserve_data[0];
			
			/*
			 * test
			*/

			$this->db->select("tb_person_type.*")->from("tb_reserve_has_person");
			$this->db->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id");
			$this->db->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id");
			$this->db->where("tb_reserve_has_person.tb_reserve_id",$_GET["id"])->limit(1);
			$person_type = $this->db->get()->result_array();
			
			$this->db->select()->from("tb_reserve_has_article");
			$this->db->join("tb_article","tb_article.article_id=tb_reserve_has_article.tb_article_id");
			$this->db->where("tb_reserve_id",$_GET["id"]);
			$used_article = $this->db->get()->result_array();
			
			//การจองนี้ใช้อุปกรณ์อะไรบ้าง
			$this->db->select("tb_article.article_id")->from("tb_reserve_has_article");
			$this->db->join("tb_article","tb_article.article_id=tb_reserve_has_article.tb_article_id");
			$this->db->where("tb_reserve_id",$_GET["id"]);
			$used_article_query = $this->db->get()->result_array();
			
			//list รายการอุปกรณ์ที่มีในการจอง
			$where_in=array();
			
			foreach($used_article_query as $u)
			{
				array_push($where_in,$u['article_id']);
			}
			
			$this->db->select("
					tb_room.*,tb_room.tb_fee_type_id AS room_fee_type,
					tb_room_has_article.*,tb_room_has_article.tb_fee_type_id AS rha_fee_type,
					tb_fee_type.*,
					tb_article.*,
					tb_reserve_has_article.*,
					tb_reserve.*,
					tb_reserve_has_datetime.*
					")->from("tb_room")
			->join("tb_room_has_article","tb_room_has_article.tb_room_id=tb_room.room_id")
			->join("tb_fee_type","tb_fee_type.fee_type_id=tb_room_has_article.tb_fee_type_id")
			->join("tb_article","tb_article.article_id=tb_room_has_article.tb_article_id")
			->join("tb_reserve_has_article","tb_reserve_has_article.tb_article_id=tb_article.article_id")
			->join("tb_reserve","tb_reserve.reserve_id=tb_reserve_has_article.tb_reserve_id")
			->join("tb_reserve_has_datetime","tb_reserve_has_datetime.tb_reserve_id=tb_reserve_has_article.tb_reserve_id")
			->where("tb_room.room_id",$reserve_data['tb_room_id'])
			->where("tb_reserve.reserve_id",$_GET['id']);
			
			//ถ้ามีรายการจองอุปกรณ์
			if(!empty($used_article_query))
				$this->db->where_in("tb_room_has_article.tb_article_id",$where_in);
			
			$used_room = $this->db->get()->result_array();
			$total_price=0;
			$reserve_fee=array();
			$article_price_sum=0;
			foreach($used_room as $u)
			{
				//ค่าบริการของ อุปกรณ์
				//หา fee_type_id $u['fee_type_id'];
				//fee_type อยู่ใน tb_room_has_article
				//fee_unit_lump_sum = ค่าบริการส่วนเกินต่อหน่วย
				//unit_num = จำนวนอุปกรณ์ที่ใช้ (tb_reserve_has_article)
				if($u['fee_type_id']=="01")//เหมา
				{
					$price01 = ($u['fee_unit_lump_sum']*$u['lump_sum_base_unit']);
					if($u['unit_num'] > $u['lump_sum_base_unit'])
					{
						$price01+=(($u['unit_num']-$u['lump_sum_base_unit'])*$u['fee_over_unit_lump_sum']);
					} 
					$total_price+=$price01;
					$article_price_sum+=$price01;
					$html='';
					$html.='<dl class="dl-horizontal">';
					$html.='<dt>วันเวลาที่คิดค่าบริการ</dt>';
					$html.='<dd>'.$u['reserve_datetime_begin']."-".$u['reserve_datetime_end'].'</dd>';
					$html.='<dt>อุปกรณ์</dt>';
					$html.='<dd>'.$u['article_name'].'</dd>';
					$html.='<dt>ประเภทค่าบริการ</dt>';
					$html.='<dd>'.$u['fee_type_name'].'</dd>';
					$html.='<dt>จำนวนอุปกรณ์เริ่มต้น</dt>';
					$html.='<dd>'.$u['lump_sum_base_unit'].'</dd>';
					$html.='<dt>ค่าบริการเหมา</dt>';
					$html.='<dd><strong><span class="text-danger">'.($u['fee_unit_lump_sum']*$u['lump_sum_base_unit']).' บาท</span></strong></dd>';
					$html.='<dt>จำนวนอุปกรณ์ที่จอง</dt>';
					$html.='<dd>'.$u['unit_num'].'</dd>';
					$html.='<dt>จำนวนอุปกรณ์ส่วนเกิน</dt>';
					$html.='<dd>'.($u['unit_num']-$u['lump_sum_base_unit']).'</dd>';
					$html.='<dt>อุปกรณ์ส่วนเกินหน่วยละ</dt>';
					$html.='<dd>'.$u['fee_over_unit_lump_sum'].' บาท</dd>';
					$html.='<dt>ค่าอุปกรณ์ส่วนเกิน</dt>';
					$html.='<dd><strong><span class="text-danger">'.(($u['unit_num']-$u['lump_sum_base_unit'])*$u['fee_over_unit_lump_sum']).' บาท</span></strong></dd>';
					$html.='<dt>คิดเป็นเงิน</dt>';
					$html.='<dd><strong><span class="text-danger">'.$price01.' บาท</span></strong></dd>';
					$html.='</dl>';
					//echo $html;
					array_push($reserve_fee, $html);
				}
				else if($u['fee_type_id']=="02")//ชม.
				{
					//หาความต่างของเวลา จาก วัน/เวลาเริ่มต้น  - วัน/เวลาสิ้นสุด
					$datetime_diff=$this->datetime_diff($u['reserve_datetime_begin'], $u['reserve_datetime_end']);
					//ถ้านาทีเกิน 30 นาที ให้ บวกชม.เพิ่ม 1 และให้นาทีรีเซตเป็น 0
					if($datetime_diff['minute'] > 10)
					{
						$datetime_diff['minute']=0;
						$datetime_diff['hour']++;
					}
					$price02 = ($u['fee_unit_hour']*$datetime_diff['hour'])*$u['unit_num'];
					$total_price+=$price02;
					$article_price_sum+=$price02;
					$html='';
					$html.='<dl class="dl-horizontal">';
					$html.='<dt>วันเวลาที่คิดค่าบริการ</dt>';
					$html.='<dd>'.$u['reserve_datetime_begin']."-".$u['reserve_datetime_end'].'</dd>';
					$html.='<dt>อุปกรณ์</dt>';
					$html.='<dd>'.$u['article_name'].'</dd>';
					$html.='<dt>ประเภทค่าบริการ</dt>';
					$html.='<dd>'.$u['fee_type_name'].'</dd>';
					$html.='<dt>จำนวนเวลาที่จอง</dt>';
					$html.='<dd>'.$datetime_diff['hour'].' ชั่วโมง</dd>';
					$html.='<dt>ค่าบริการ/ชั่วโมง</dt>';
					$html.='<dd>'.$u['fee_unit_hour'].'</dd>';
					$html.='<dt>จำนวนอุปกรณ์ที่จอง</dt>';
					$html.='<dd>'.$u['unit_num'].'</dd>';
					$html.='<dt>คิดเป็นเงิน</dt>';
					$html.='<dd><strong><span class="text-danger">'.$price02.' บาท</span></strong></dd>';
					$html.='</dl>';
					array_push($reserve_fee, $html);
				}
			}
			//ค่าบริการของห้อง
			$this->db->select("COUNT(tb_reserve_id) AS count_tb_reserve_id")->from("tb_reserve_has_datetime");
			$count_day = $this->db->where("tb_reserve_id",$_GET['id'])->get()->result_array();
			
			$this->db->select()->from("tb_reserve")
			->join("tb_reserve_has_datetime","tb_reserve_has_datetime.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->where("tb_reserve.reserve_id",$_GET["id"]);
			$room_data=$this->db->get()->result_array();
			//done = 0 ค่าบริการห้องแบบเหมา แสดงไปหรือยัง
			$done=0;
			$room_fee=array();
			$room_price_sum=0;
			foreach ($room_data as $r)
			{
				$datetime_diff_room=$this->datetime_diff($r['reserve_datetime_begin'], $r['reserve_datetime_end']);
				//แบบเหมา แสดงครั้งเดียวเพราะนับจำนวนวันมาคูณกับค่าห้อง
				if($r['tb_fee_type_id']=="01")//เหมา
				{
					if($done==0)
					{
						$room_price=($r['room_fee_lump_sum']*$count_day[0]['count_tb_reserve_id']);
						/*echo "<hr>";
						 echo "ค่าบริการห้อง ".$u['room_name']." : ".$u['room_fee_lump_sum']." บาท/วัน.";
						echo "คิดเป็นเงิน : ".$room_price." บาท";
						*/
						$total_price+=$room_price;
						$room_price_sum+=$room_price;
						$html='';
						$html.='<dl class="dl-horizontal">';
						$html.='<dt>ห้อง</dt>';
						$html.='<dd>'.$r['room_name'].'</dd>';
						$html.='<dt>ค่าบริการ</dt>';
						$html.='<dd>'.$r['room_fee_lump_sum'].' บาท/วัน</dd>';
						$html.='<dt>จำนวนวันที่จอง</dt>';
						$html.='<dd>'.$count_day[0]['count_tb_reserve_id'].' วัน</dd>';
						$html.='<dt>คิดเป็นเงิน</dt>';
						$html.='<dd><strong><span class="text-danger">'.$room_price.' บาท</span></strong></dd>';
						$html.='</dl>';
						array_push($room_fee, $html);
						$done++;
					}
				}
				//แบบ ชม. แสดงรายวัน
				else if($r['tb_fee_type_id']=="02")//ชม.
				{
					$room_price=($datetime_diff_room['hour']*$r['room_fee_hour']);
					$total_price+=$room_price;
					$room_price_sum+=$room_price;
					$html='';
					$html.='<dl class="dl-horizontal">';
					$html.='<dt>วันเวลาที่คิดค่าบริการ</dt>';
					$html.='<dd>'.$r['reserve_datetime_begin']."-".$r['reserve_datetime_end'].'</dd>';
					$html.='<dt>ห้อง</dt>';
					$html.='<dd>'.$r['room_name'].'</dd>';
					$html.='<dt>ค่าบริการ</dt>';
					$html.='<dd>'.$r['room_fee_hour'].' บาท/ชม.</dd>';
					$html.='<dt>จำนวนเวลาที่จอง</dt>';
					$html.='<dd>'.$datetime_diff['hour'].' ชม.</dd>';
					$html.='<dt>คิดเป็นเงิน</dt>';
					$html.='<dd><strong><span class="text-danger">'.$room_price.' บาท</span></strong></dd>';
					$html.='</dl>';
					array_push($room_fee, $html);
				}
			}
			
			//
			/*$this->db->select("
					tb_reserve.*,
					tb_reserve_has_article.*,
					tb_room.*,tb_room.tb_fee_type_id AS room_fee_type,
					tb_room_has_article.*,tb_room_has_article.tb_fee_type_id AS rha_fee_type,
					tb_article.*,
					tb_fee_type.*,
					tb_reserve_has_datetime.*	
			")->from("tb_reserve")
			->join("tb_reserve_has_article","tb_reserve_has_article.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->join("tb_room_has_article","tb_room_has_article.tb_room_id=tb_room.room_id")
			->join("tb_article","tb_article.article_id=tb_room_has_article.tb_article_id")
			->join("tb_fee_type","tb_fee_type.fee_type_id=tb_room.tb_fee_type_id")
			->join("tb_fee_type","tb_fee_type.fee_type_id=tb_room_has_article.tb_fee_type_id")
			->where("tb_reserve.reserve_id",$_GET["id"]);
			$reserve_price_data=$this->db->get();*/
			$this->db->select()->from("tb_reserve")
			->join("tb_reserve_has_person","tb_reserve_has_person.tb_reserve_id=tb_reserve.reserve_id")
			->join("tb_person","tb_person.person_id=tb_reserve_has_person.tb_person_id")
			->join("tb_person_type","tb_person_type.person_type_id=tb_person.tb_person_type_id")
			->join("tb_room","tb_room.room_id=tb_reserve.tb_room_id")
			->where("tb_reserve.reserve_id",$_GET["id"]);
			;
			$person_reserve_data=$this->db->get()->result_array();
			$discount_person01=0;
			if($person_reserve_data[0]['person_type_id']=="01")//ภายใน
			{
				//$discount_person01=$total_price;
				$room_discount_baht=$room_price_sum*($person_reserve_data[0]['discount_percent']/100);
				$room_price_total=$room_price_sum-$room_discount_baht;
				$all_price=$article_price_sum+$room_price_total;
				$reserve_discount_baht=$all_price*($person_reserve_data[0]['discount']/100);
				$reserve_price_total=$all_price-$reserve_discount_baht;
				$html='';
				$html.='<dl class="dl-horizontal">';
				$html.='<dt>ค่าบริการ</dt>';
				$html.='<dd>'.$total_price.' บาท</dd>';
				$html.='<dt>ค่าห้อง</dt>';
				$html.='<dd>'.$room_price_sum.' บาท</dd>';
				$html.='<dt>ค่าครุภัณฑ์/อุปกรณ์</dt>';
				$html.='<dd>'.$article_price_sum.' บาท</dd>';
				$html.='<dt>ส่วนลดค่าห้อง</dt>';
				$html.='<dd>'.$room_discount_baht.' บาท</dd>';
				$html.='<dt>ส่วนลดที่อนุมัติ'.$person_reserve_data[0]['reserve_id'].'</dt>';
				$html.='<dd>'.$reserve_discount_baht.' บาท</dd>';
				$html.='<dt>ค่าบริการทั้งสิ้น</dt>';
				$html.='<dd><strong><span class="text-danger">'.round($reserve_price_total).' บาท</span></strong></dd>';
				$html.='</dl>';
				$discount_text=$html;
			}
			else if($person_reserve_data[0]['person_type_id']=="02")//ภายนอก
			{
				$room_discount_baht=$room_price_sum*($person_reserve_data[0]['discount_percent']/100);
				$room_price_total=$room_price_sum-$room_discount_baht;
				$all_price=$article_price_sum+$room_price_total;
				$reserve_discount_baht=$all_price*($person_reserve_data[0]['discount']/100);
				$reserve_price_total=$all_price-$reserve_discount_baht;
				$html='';
				$html.='<dl class="dl-horizontal">';
				$html.='<dt>ค่าบริการ</dt>';
				$html.='<dd>'.$total_price.' บาท</dd>';
				$html.='<dt>ค่าห้อง</dt>';
				$html.='<dd>'.$room_price_sum.' บาท</dd>';
				$html.='<dt>ค่าครุภัณฑ์/อุปกรณ์</dt>';
				$html.='<dd>'.$article_price_sum.' บาท</dd>';
				$html.='<dt>ส่วนลดค่าห้อง</dt>';
				$html.='<dd>'.$room_discount_baht.' บาท</dd>';
				$html.='<dt>ส่วนลดที่อนุมัติ</dt>';
				$html.='<dd>'.$reserve_discount_baht.' บาท</dd>';
				$html.='<dt>ค่าบริการทั้งสิ้น</dt>';
				$html.='<dd><strong><span class="text-danger">'.round($reserve_price_total).' บาท</span></strong></dd>';
				$html.='</dl>';
				$discount_text=$html;
				//echo $html;
				/*echo "ส่วนลดค่าห้อง".$used_room[0]['discount_percent']."%";
				echo "ส่วนลดที่อนุมัติ".$used_room[0]['discount']."%";
				echo "<br>";
				$room_discount_baht=$room_price*($used_room[0]['discount_percent']/100);
				$room_price_total=$room_price-$room_discount_baht;
				echo "ส่วนลดค่าห้อง=".$room_discount_baht;
				echo "<br>";
				echo "ค่าห้อง-ส่วนลดค่าห้อง".$room_price."-".$room_discount_baht."=".($room_price-$room_discount_baht);
				echo "<br>";
				$reserve_discount_baht=$room_price*($used_room[0]['discount']/100);
				$reserve_price_total=$room_price_total-$reserve_discount_baht;
				echo "ค่าห้อง(หักส่วนลดห้องแล้ว)-ส่วนลดที่อนุมัติ".$room_price_total."-".$reserve_discount_baht."=".($room_price_total-$reserve_discount_baht);
				echo "<br>";
				echo "ค่าบริการทั้งสิ้น".$reserve_price_total;
				*/
			}
				
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("รายละเอียดการจอง"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"article_data"=>$article_data,
					"datetime_data"=>$datetime_data,
					"file_data"=>$file_data,
					"reserve_data"=>$reserve_data,
					"total_price"=>$total_price,
					"discount_person01"=>$discount_person01,
					"discount_text"=>$discount_text,
					"reserve_fee"=>$reserve_fee,
					"room_fee"=>$room_fee
			);
			$this->load->view("manage/reserve/view_reserve",$data);
		}
	}
	function set_orderby()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_reserve",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function set_orderby2()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_reserve2",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function set_orderby3()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_reserve3",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function set_orderby4()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_reserve4",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function set_orderby_list()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_reserve_list",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function datetime_diff($datetimebegin,$datetimeend)
	{
		$start_date = new DateTime($datetimebegin);
		$end_date = new DateTime($datetimeend);
		//$interval = $start_date->diff($end_date);
		//$interval = round($end_date->format('U') - $start_date->format('U'));
		/*return array(
				"year"=>$interval->y,
				"month"=>$interval->m,
				"day"=>$interval->d,
				"hour"=>$interval->h,
				"minute"=>$interval->i,
				"second"=>$interval->s
		);*/
		$arr=array(
				"year"=>round($end_date->format('Y') - $start_date->format('Y')),
				"month"=>round($end_date->format('m') - $start_date->format('m')),
				"day"=>round($end_date->format('d') - $start_date->format('d')),
				"hour"=>round($end_date->format('H') - $start_date->format('H')),
				"minute"=>round($end_date->format('i') - $start_date->format('i')),
				"second"=>round($end_date->format('s') - $start_date->format('s'))
		);
		return $arr;
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{	
			$this->session->set_userdata('search_reserve',(string)$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_reserve");
		}
		redirect(base_url()."?d=manage&c=reserve&m=edit");
	}
	function search2()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_reserve2',$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_reserve2");
		}
		redirect(base_url()."?d=manage&c=reserve&m=edit2");
	}
	function search3()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_reserve3',$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_reserve3");
		}
		redirect(base_url()."?d=manage&c=reserve&m=edit3");
	}
	function search4()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_reserve4',$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_reserve4");
		}
		redirect(base_url()."?d=manage&c=reserve&m=edit4");
	}
	function search_reserve_list()
	{
		if($this->input->post("input_search_box"))
		{
			$this->session->set_userdata('search_reserve_list',$this->input->post("input_search_box"));
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_reserve_list");
		}
		redirect(base_url()."?d=manage&c=reserve&m=reserve_list");
	}
	function reserve_approve()
	{
		$set=array("approve"=>$this->input->post("select_approve"));
		if($this->input->post("select_approve") == 1)
		{
			$set['approve_on']=date('Y-m-d H:i:s');
			$set['approve_by']=$this->session->userdata("rs_username");
		}
		$where=array("reserve_id"=>@$_GET['id']);
		$this->load_reserve_model->manage_edit2($set,$where,"tb_reserve","reserve_approve","สำเร็จ","ไม่สำเร็จ",$_SERVER['HTTP_REFERER']);
	}
	function reserve_list()
	{
		$config=array(
				array(
						"field"=>"aa",
						"label"=>"aa",
						"rules"=>""
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("reserve_list", array("field"=>"reserve_id","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=reserve&m=reserve_list";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
		
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
			
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_reserve_list", "reserve_id");
			$search_text=null;
			$search_text=$this->session->userdata("search_reserve_list");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->load_reserve_model->user_reserve_list_numrows("tb_reserve",$liketext,$searchfield);
				$get_reserve_list=$this->load_reserve_model->user_reserve_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->load_reserve_model->user_reserve_list_numrows("tb_reserve",'',$searchfield);
				$get_reserve_list=$this->load_reserve_model->user_reserve_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
		
			//..pagination
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("จัดการการจอง"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"table_edit"=>$this->table_reserve_list($get_reserve_list),
					"session_search_reserve"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/reserve/user_reserve_list",$data);
		}
		else
		{
		
		}
	}
	function table_reserve_list($data)
	{
		if($this->sess_orderby_reserve["type"]=="ASC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_212_down_arrow.png">';
		else if($this->sess_orderby_reserve["type"]=="DESC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_213_up_arrow.png">';
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>ชื่อโครงการ</th>
				<th>ห้อง</th>
				<th>วันที่จอง</th>
				<th>สถานะการจอง</th>
				<th>สถานะการยกเลิก</th>
				<th class="same_first_td">รายละเอียด</th>
				<th>ยกเลิก<br/><input type="checkbox" id="cancel_all_reserve"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=reserve&m=cancel_reserve" id="form_cancel_reserve" autocomplete="off">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			if($dt['canceled']==0)
			{
				$cancel_status='<span class="text-success"></span>';
				$cancel_checkbox='<input type="checkbox" 
						value="'.$dt["reserve_id"].'" name="cancel_reserve[]" 
						class="cancel_reserve">';
			}
			else 
			{
				$cancel_status='<span class="text-danger">ยกเลิกสำเร็จ</span>';
				$cancel_checkbox='';
			}
			if($dt['approve']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve0[]" class="allow_reserve0"/>
										  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["reserve_id"].'" id="checkboxFourInput'.$dt["reserve_id"].'" name="allow_reserve1[]" class="allow_reserve1" checked/>
						  	<label for="checkboxFourInput'.$dt["reserve_id"].'"></label>
					  		</span>';
			if($dt['approve']==0) $approve_text="<span class='text-warning'>รออนุมัติ</span>";
			else if($dt['approve']==1) $approve_text="<span class='text-success'>อนุมัติ</span>";
			else if($dt['approve']==3) $approve_text="<span class='text-danger'>ไม่อนุมัติ</span>";
			$html.='<tr>
					<td>'.$dt["reserve_id"].'</td>
					<td id="reserve'.$dt["reserve_id"].'">'.$dt["project_name"].'</td>
					<td>'.$dt["room_name"].'</td>
					<td>'.date('Y/m/d H:i:s',strtotime($dt["reserve_on"])).'</td>
					<td>'.$approve_text.'</td>
					<td>'.$cancel_status.'</td>
					<td class="same_first_td">'.$this->eml->btn('view','onclick=window.open("'.base_url().'?d=manage&c=reserve&m=view&id='.$dt["reserve_id"].'","_blank")').'</td>
					<td>'.$cancel_checkbox.'</td>
			';
			//<td class="same_first_td">'.$this->eml->btn('view','onclick=show_all_data("'.$dt["reserve_id"].'")').'</td>
			$html.='</tr>';
			$num_row++;
			endforeach;
		}
		$html.='<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>'.$this->eml->btn('cancel','onclick="show_cancel_list();return false;"').'</td>
				</tr>
				</table>
				</form>';
		$html.=$this->pagination->create_links();
		return $html;
	}
	
	/**
	 * Set search_field session
	 *
	 * @return 	void
	 */
	function set_searchfield()
	{
		if($this->input->post("searchfield"))
		{
			$this->session->set_userdata("searchfield_reserve",(string)$this->input->post("searchfield"));
		}
	}
	function set_searchfield2()
	{
		if($this->input->post("searchfield2"))
		{
			$this->session->set_userdata("searchfield_reserve2",(string)$this->input->post("searchfield"));
		}
	}
	function set_searchfield3()
	{
		if($this->input->post("searchfield3"))
		{
			$this->session->set_userdata("searchfield_reserve3",(string)$this->input->post("searchfield"));
		}
	}
	function set_searchfield4()
	{
		if($this->input->post("searchfield4"))
		{
			$this->session->set_userdata("searchfield_reserve4",(string)$this->input->post("searchfield"));
		}
	}
	function set_searchfield_list()
	{
		if($this->input->post("searchfield_list"))
		{
			$this->session->set_userdata("searchfield_reserve_list",(string)$this->input->post("searchfield"));
		}
	}
	function cancel_reserve()
	{
		$this->load_reserve_model->cancel_reserve($this->input->post("cancel_reserve"), "tb_reserve", "article_type_name", "edit_reserve", "?d=manage&c=reserve&m=reserve_list");
	}
	
	/**
	 * Call function mange_delete
	 * - manage_delete($arr_id, $table, $field_PK, $select_field, $message_type='', $main_url='')
	 *
	 * @return 	void
	 */
	function delete()
	{
		$referer_query_string = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
		$this->load_reserve_model->del_reserve($this->input->post("del_reserve"),$referer_query_string);
	}
	
	/**
	 * edit reserve detail such as reserve datetime, reserve info
	 */
	function edit_detail()
	{
		if(isset($_GET["id"]) && isset($_GET["t"]))
		{
			if($_GET["t"]=="room")
			{
				$q = $this->db->select()->from("tb_reserve")
				->where("reserve_id",$_GET["id"])->limit(1)->get();
				$nr = $q->num_rows();
				if($nr > 0)
				{
					$nr = $q->result_array();
					$config=array(
							array(
									"field"=>"input_reserve_name",
									"label"=>"ชื่อห้อง",
									"rules"=>""
							)
					);
					$this->frm->set_rules($config);
					$this->frm->set_message("rule","message");
					if($this->frm->run() == false)
					{
						$se_room_type=array(
								"LB_text"=>"ประเภทห้อง",
								"LB_attr"=>$this->eml->span_redstar(),
								"S_class"=>'',
								"S_name"=>"select_room_type",
								"S_id"=>"select_room_type",
								"S_old_value"=>"select_room_type",
								"S_data"=>$this->emm->get_select("tb_room_type","room_type_name"),
								"S_id_field"=>"room_type_id",
								"S_name_field"=>"room_type_name",
								"help_text"=>""
						);
						$se_room=array(
								"LB_text"=>"ห้อง",
								"LB_attr"=>$this->eml->span_redstar(),
								"S_class"=>'',
								"S_name"=>"select_room",
								"S_id"=>"select_room",
								"S_old_value"=>"select_room",
								"S_data"=>"",
								"S_id_field"=>"",
								"S_name_field"=>"",
								"help_text"=>""
						);
						$data=array(
								"htmlopen"=>$this->pel->htmlopen(),
								"head"=>$this->pel->head("แก้ไขห้อง"),
								"bodyopen"=>$this->pel->bodyopen(),
								"navbar"=>$this->pel->navbar(),
								"js"=>$this->pel->js(),
								"footer"=>$this->pel->footer(),
								"bodyclose"=>$this->pel->bodyclose(),
								"htmlclose"=>$this->pel->htmlclose(),
								"se_room_type"=>$this->eml->form_select($se_room_type),
								"se_room"=>$this->eml->form_select($se_room),
								"nr"=>$nr
						);
						$this->load->view("manage/reserve/edit_room",$data);
					}
					else 
					{
						
					}
				}
			}//if room
			else if($_GET["t"]=="datetime")
			{
				$q = $this->db->select()->from("tb_reserve_has_datetime")
				->where("tb_reserve_id",$_GET["id"])->get();
				$nr = $q->result_array();
				if($nr > 0)
				{
					$nr = $q->result_array();
					$config=array(
							array(
									"field"=>"input_reserve_name",
									"label"=>"ชื่อห้อง",
									"rules"=>""
							)
					);
					$this->frm->set_rules($config);
					$this->frm->set_message("rule","message");
					if($this->frm->run() == false)
					{
						$data=array(
								"htmlopen"=>$this->pel->htmlopen(),
								"head"=>$this->pel->head("แก้ไขห้อง"),
								"bodyopen"=>$this->pel->bodyopen(),
								"navbar"=>$this->pel->navbar(),
								"js"=>$this->pel->js(),
								"footer"=>$this->pel->footer(),
								"bodyclose"=>$this->pel->bodyclose(),
								"htmlclose"=>$this->pel->htmlclose(),
								"nr"=>$nr
						);
						$this->load->view("manage/reserve/edit_datetime",$data);
					}
					else 
					{
						
					}
				}
			}//if datetime
		}
		else
		{
			
		}
	}
}


























