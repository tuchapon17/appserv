<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Department extends MY_Controller
{
	private $dpm_model;
	private $sess_orderby_department;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("02"));
		$this->load->model("manage/department_model");
		$this->dpm_model=$this->department_model;
		$this->sess_orderby_department=$this->session->userdata("orderby_department");
	}
	function add()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_department"),
						"label"=>$this->lang->line("t_in_department"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		
		$this->db->select()->from("tb_department")
		->order_by("CONVERT(department_name USING ".$this->mysql_charset.")","ASC");
		$current_department = $this->db->get()->result_array();
		
		if($this->frm->run() == false)
		{
			$in_department=array(
					"LB_text"=>$this->lang->line("t_in_department"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_department"),
					"IN_id"=>$this->lang->line("in_department"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_department")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_add_department")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"department_tab"=>$this->department_tab(),
					"in_department"=>$this->eml->form_input($in_department),
					"current_department"=>$this->eml->multiple_select($current_department,"department_name")
			);
		
			$this->load->view("manage/department/add_department",$data);
		}
		else
		{
			$data=array(
					"department_id"=>$this->dpm_model->get_maxid(2, "department_id", "tb_department"),
					"department_name"=>$this->input->post($this->lang->line("in_department")),
					"checked"=>"1"
			);
			$redirect_link="?d=manage&c=department&m=add";
			$this->dpm_model->manage_add(
					$data,
					"tb_department",
					$redirect_link,
					$redirect_link,
					"department",
					"เพิ่ม".$this->lang->line("text_department")."สำเร็จ",
					"เพิ่ม".$this->lang->line("text_department")."ไม่สำเร็จ"
					);
		}
	}
	function edit()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_department"),
						"label"=>$this->lang->line("t_in_department"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("department", array("field"=>"department_name","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=department&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
		
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
		
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_department", "department_name");
			$search_text=null;
			$search_text=$this->session->userdata("search_department");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->dpm_model->get_all_numrows("tb_department",$liketext,$searchfield);
				
				$get_department_list=$this->dpm_model->get_department_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->dpm_model->get_all_numrows("tb_department",'',$searchfield);
				
				$get_department_list=$this->dpm_model->get_department_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
		
			//..pagination
			$in_department=array(
					"LB_text"=>$this->lang->line("t_in_department"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_department"),
					"IN_id"=>$this->lang->line("in_department"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_department")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_department")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"department_tab"=>$this->department_tab(),
					"in_department"=>$this->eml->form_input($in_department),
					"table_edit"=>$this->table_edit($get_department_list),
					"session_search_department"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/department/edit_department",$data);
		}
		else
		{
			$prev_url=$_SERVER['HTTP_REFERER'];
			$session_edit_id="edit_department_id";
			$set=array(
					"department_name"=>$this->input->post($this->lang->line("in_department"))
			);
			$where=array(
					"department_id"=>$this->session->userdata($session_edit_id)
			);
			$this->dpm_model->manage_edit(
					$set,
					$where,
					"tb_department",
					$session_edit_id,
					"edit_department",
					"แก้ไข".$this->lang->line("text_department")."สำเร็จ",
					"แก้ไข".$this->lang->line("text_department")."ไม่สำเร็จ",
					"?d=manage&c=department&m=edit",
					$prev_url
					);
		}
	}
	function delete()
	{
		$this->dpm_model->manage_delete(
				$this->input->post("del_department"),
				"tb_department", "department_id",
				"department_name", "edit_department",
				"?d=manage&c=department&m=edit"
				);
	}
	function allow()
	{
		//$data = array
		$allow_list=$this->input->post("allow_list");
		$disallow_list=$this->input->post("disallow_list");
		$this->dpm_model->manage_allow(
				$allow_list,
				$disallow_list,
				"tb_department",
				"department_id",
				"department_name",
				"edit_department",
				"?d=manage&c=department&m=edit"
				);
	}
	
	function department_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="add">เพิ่ม'.$this->lang->line("text_department").'</a></li>';
		$html.='
			<li><a href="#"  id="edit">แก้ไข/ลบ'.$this->lang->line("text_department").'</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_department',$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_department");
		}
		redirect(base_url()."?d=manage&c=department&m=edit");
	}
	function table_edit($data)
	{
		if($this->sess_orderby_department["type"]=="ASC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_212_down_arrow.png">';
		else if($this->sess_orderby_department["type"]=="DESC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_213_up_arrow.png">';
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>'.$this->lang->line("text_department").'</th>
				<th class="same_first_td">อนุมัติ<br/><button type="button" class="cbtn cbtn-green" id="allow-all"><button type="button" class="cbtn cbtn-red" id="disallow-all"></th>
				<th class="same_first_td">แก้ไข</th>
				<th>ลบ<br/><input type="checkbox" id="del_all_department"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=department&m=delete" id="form_del_department">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			//<td>'.$num_row.'</td>
			//if     $checkbox='<input type="checkbox" value="'.$dt["department_id"].'" name="allow_department0[]" class="allow_department0">';
			//else   $checkbox='<input type="checkbox" value="'.$dt["department_id"].'" name="allow_department1[]" class="allow_department1" checked>';
			if($dt['checked']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["department_id"].'" id="checkboxFourInput'.$dt["department_id"].'" name="allow_department0[]" class="allow_department0"/>
										  	<label for="checkboxFourInput'.$dt["department_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["department_id"].'" id="checkboxFourInput'.$dt["department_id"].'" name="allow_department1[]" class="allow_department1" checked/>
						  	<label for="checkboxFourInput'.$dt["department_id"].'"></label>
					  		</span>';
			$html.='<tr>
					<td>'.$dt["department_id"].'</td>
					<td id="department'.$dt["department_id"].'">'.$dt["department_name"].'</td>
					<td class="same_first_td">'.$checkbox.'</td>
					<td class="same_first_td">'.$this->eml->btn('edit','onclick=load_department("'.$dt["department_id"].'")').'</td>
					<td><input type="checkbox" value="'.$dt["department_id"].'" name="del_department[]" class="del_department"></td>
			';
			$html.='</tr>';
			$num_row++;
			endforeach;
		}
		$html.='<tr>
				<td></td>
				<td></td>
				<td align="center">'.$this->eml->btn('submitcheck','onclick="show_allow_list();return false;"')." ".
									$this->eml->btn('refreshcheck','onclick="location.reload(true);"').'
						</td>
				<td></td>
				<td>'.$this->eml->btn('delete','onclick="show_del_list();return false;"').'</td>
				</tr>
				</table>
				</form>';
		$html.=$this->pagination->create_links();
		return $html;
	}
	function set_orderby()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_department",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function load_department()
	{
		$load=$this->dpm_model->load_department($this->input->post("tid"));
		echo json_encode($load[0]);
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
			$this->session->set_userdata("searchfield_department",$this->input->post("searchfield"));
		}
	}
	
	/**
	 * Check department already exist with ajax
	 */
	function already_exist_ajax()
	{
		$this->db->select()->from("tb_department")
		->where("department_name",trim( $this->input->post( $this->lang->line("in_department") ) ));
		$q = $this->db->get();
		if($q->num_rows() > 0 )
			echo json_encode(false);
		else echo json_encode(true);
	}
}