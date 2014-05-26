<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Occupation extends MY_Controller
{
	private $occ_model;
	private $sess_orderby_occupation;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("02"));
		$this->load->model("manage/occupation_model");
		$this->occ_model=$this->occupation_model;
		$this->sess_orderby_occupation=$this->session->userdata("orderby_occupation");
	}
	function add()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_occupation"),
						"label"=>$this->lang->line("t_in_occupation"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		
		$this->db->select()->from("tb_occupation")
		->order_by("CONVERT(occupation_name USING ".$this->mysql_charset.")","ASC");
		$current_occupation = $this->db->get()->result_array();
		if($this->frm->run() == false)
		{
			$in_occupation=array(
					"LB_text"=>$this->lang->line("t_in_occupation"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_occupation"),
					"IN_id"=>$this->lang->line("in_occupation"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_occupation")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_add_occupation")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"occupation_tab"=>$this->occupation_tab(),
					"in_occupation"=>$this->eml->form_input($in_occupation),
					"current_occupation"=>$this->eml->multiple_select($current_occupation,"occupation_name")
			);
		
			$this->load->view("manage/occupation/add_occupation",$data);
		}
		else
		{
		
			$data=array(
					"occupation_id"=>$this->occ_model->get_maxid(2, "occupation_id", "tb_occupation"),
					"occupation_name"=>$this->input->post($this->lang->line("in_occupation")),
					"checked"=>"1"
			);
			$redirect_link="?d=manage&c=occupation&m=add";
			$this->occ_model->manage_add(
					$data,
					"tb_occupation",
					$redirect_link,
					$redirect_link,
					"occupation",
					"เพิ่ม".$this->lang->line("text_occupation")."สำเร็จ",
					"เพิ่ม".$this->lang->line("text_occupation")."ไม่สำเร็จ"
					);
		}
	}
	function edit()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_occupation"),
						"label"=>$this->lang->line("t_in_occupation"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("occupation", array("field"=>"occupation_name","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=occupation&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
		
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
		
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_occupation", "occupation_name");
			$search_text=null;
			$search_text=$this->session->userdata("search_occupation");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->occ_model->get_all_numrows("tb_occupation",$liketext,$searchfield);
				
				$get_occupation_list=$this->occ_model->get_occupation_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->occ_model->get_all_numrows("tb_occupation",'',$searchfield);
				
				$get_occupation_list=$this->occ_model->get_occupation_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
		
			//..pagination
			$in_occupation=array(
					"LB_text"=>$this->lang->line("t_in_occupation"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_occupation"),
					"IN_id"=>$this->lang->line("in_occupation"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_occupation")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_occupation")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"occupation_tab"=>$this->occupation_tab(),
					"in_occupation"=>$this->eml->form_input($in_occupation),
					"table_edit"=>$this->table_edit($get_occupation_list),
					"session_search_occupation"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/occupation/edit_occupation",$data);
		}
		else
		{
			$prev_url=$_SERVER['HTTP_REFERER'];
			$session_edit_id="edit_occupation_id";
			$set=array(
					"occupation_name"=>$this->input->post($this->lang->line("in_occupation"))
			);
			$where=array(
					"occupation_id"=>$this->session->userdata($session_edit_id)
			);
			$this->occ_model->manage_edit(
					$set,
					$where,
					"tb_occupation",
					$session_edit_id,
					"edit_occupation",
					"แก้ไข".$this->lang->line("text_occupation")."สำเร็จ",
					"แก้ไข".$this->lang->line("text_occupation")."ไม่สำเร็จ",
					"?d=manage&c=occupation&m=edit",
					$prev_url
					);
		}
	}
	function delete()
	{
		$this->occ_model->manage_delete($this->input->post("del_occupation"), "tb_occupation", "occupation_id", "occupation_name", "edit_occupation", "?d=manage&c=occupation&m=edit");
	}
	function allow()
	{
		//$data = array
		$allow_list=$this->input->post("allow_list");
		$disallow_list=$this->input->post("disallow_list");
		$this->occ_model->manage_allow($allow_list,$disallow_list, "tb_occupation", "occupation_id", "occupation_name", "edit_occupation", "?d=manage&c=occupation&m=edit");
	}
	
	
	
	
	function occupation_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="add">เพิ่ม'.$this->lang->line("text_occupation").'</a></li>';
		$html.='
			<li><a href="#"  id="edit">แก้ไข/ลบ'.$this->lang->line("text_occupation").'</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_occupation',$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_occupation");
		}
		redirect(base_url()."?d=manage&c=occupation&m=edit");
	}
	function table_edit($data)
	{
		if($this->sess_orderby_occupation["type"]=="ASC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_212_down_arrow.png">';
		else if($this->sess_orderby_occupation["type"]=="DESC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_213_up_arrow.png">';
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>'.$this->lang->line("text_occupation").'</th>
				<th class="same_first_td">อนุมัติ<br/><button type="button" class="cbtn cbtn-green" id="allow-all"><button type="button" class="cbtn cbtn-red" id="disallow-all"></th>
				<th class="same_first_td">แก้ไข</th>
				<th>ลบ<br/><input type="checkbox" id="del_all_occupation"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=occupation&m=delete" id="form_del_occupation">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			//<td>'.$num_row.'</td>
			//if     $checkbox='<input type="checkbox" value="'.$dt["occupation_id"].'" name="allow_occupation0[]" class="allow_occupation0">';
			//else   $checkbox='<input type="checkbox" value="'.$dt["occupation_id"].'" name="allow_occupation1[]" class="allow_occupation1" checked>';
			if($dt['checked']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["occupation_id"].'" id="checkboxFourInput'.$dt["occupation_id"].'" name="allow_occupation0[]" class="allow_occupation0"/>
										  	<label for="checkboxFourInput'.$dt["occupation_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["occupation_id"].'" id="checkboxFourInput'.$dt["occupation_id"].'" name="allow_occupation1[]" class="allow_occupation1" checked/>
						  	<label for="checkboxFourInput'.$dt["occupation_id"].'"></label>
					  		</span>';
			$html.='<tr>
					<td>'.$dt["occupation_id"].'</td>
					<td id="occupation'.$dt["occupation_id"].'">'.$dt["occupation_name"].'</td>
					<td class="same_first_td">'.$checkbox.'</td>
					<td class="same_first_td">'.$this->eml->btn('edit','onclick=load_occupation("'.$dt["occupation_id"].'")').'</td>
					<td><input type="checkbox" value="'.$dt["occupation_id"].'" name="del_occupation[]" class="del_occupation"></td>
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
			$this->session->set_userdata("orderby_occupation",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function load_occupation()
	{
		$load=$this->occ_model->load_occupation($this->input->post("tid"));
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
			$this->session->set_userdata("searchfield_occupation",$this->input->post("searchfield"));
		}
	}
	
	/**
	 * Check occupation already exist with ajax
	 */
	function already_exist_ajax()
	{
		$this->db->select()->from("tb_occupation")
		->where("occupation_name",trim( $this->input->post( $this->lang->line("in_occupation") ) ));
		$q = $this->db->get();
		if($q->num_rows() > 0 )
			echo json_encode(false);
		else echo json_encode(true);
	}
}