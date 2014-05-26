<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Office extends MY_Controller
{
	private $off_model;
	private $sess_orderby_office;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("02"));
		$this->load->model("manage/office_model");
		$this->off_model=$this->office_model;
		$this->sess_orderby_office=$this->session->userdata("orderby_office");
	}
	
	/**
	 * Add office
	 */
	function add()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_office"),
						"label"=>$this->lang->line("t_in_office"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		
		$this->db->select()->from("tb_office")
		->order_by("CONVERT(office_name USING ".$this->mysql_charset.")","ASC");
		$current_office = $this->db->get()->result_array();
		if($this->frm->run() == false)
		{
			$in_office=array(
					"LB_text"=>$this->lang->line("t_in_office"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_office"),
					"IN_id"=>$this->lang->line("in_office"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_office")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_add_office")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"office_tab"=>$this->office_tab(),
					"in_office"=>$this->eml->form_input($in_office),
					"current_office"=>$this->eml->multiple_select($current_office,"office_name")
			);
		
			$this->load->view("manage/office/add_office",$data);
		}
		else
		{
			$data=array(
					"office_id"=>$this->off_model->get_maxid(2, "office_id", "tb_office"),
					"office_name"=>$this->input->post($this->lang->line("in_office")),
					"checked"=>"1"
			);
			$redirect_link="?d=manage&c=office&m=add";
			$this->off_model->manage_add(
					$data,
					"tb_office",
					$redirect_link,
					$redirect_link,
					"office",
					"เพิ่ม".$this->lang->line("text_office")."สำเร็จ",
					"เพิ่ม".$this->lang->line("text_office")."ไม่สำเร็จ"
					);
		}
	}
	function edit()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_office"),
						"label"=>$this->lang->line("t_in_office"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("office", array("field"=>"office_name","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=office&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
		
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
		
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_office", "office_name");
			$search_text=null;
			$search_text=$this->session->userdata("search_office");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->off_model->get_all_numrows("tb_office",$liketext,$searchfield);
				
				$get_office_list=$this->off_model->get_office_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->off_model->get_all_numrows("tb_office",'',$searchfield);
				
				$get_office_list=$this->off_model->get_office_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
		
			//..pagination
			$in_office=array(
					"LB_text"=>$this->lang->line("t_in_office"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_office"),
					"IN_id"=>$this->lang->line("in_office"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_office")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_office")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"office_tab"=>$this->office_tab(),
					"in_office"=>$this->eml->form_input($in_office),
					"table_edit"=>$this->table_edit($get_office_list),
					"session_search_office"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/office/edit_office",$data);
		}
		else
		{
			$prev_url=$_SERVER['HTTP_REFERER'];
			$session_edit_id="edit_office_id";
			$set=array(
					"office_name"=>$this->input->post($this->lang->line("in_office"))
			);
			$where=array(
					"office_id"=>$this->session->userdata($session_edit_id)
			);
			$this->off_model->manage_edit(
					$set,
					$where,
					"tb_office",
					$session_edit_id,
					"edit_office",
					"แก้ไข".$this->lang->line("text_office")."สำเร็จ",
					"แก้ไข".$this->lang->line("text_office")."ไม่สำเร็จ",
					"?d=manage&c=office&m=edit",
					$prev_url);
		}
	}
	function delete()
	{
		$this->off_model->manage_delete($this->input->post("del_office"), "tb_office", "office_id", "office_name", "edit_office", "?d=manage&c=office&m=edit");
	}
	function allow()
	{
		//$data = array
		$allow_list=$this->input->post("allow_list");
		$disallow_list=$this->input->post("disallow_list");
		$this->off_model->manage_allow($allow_list,$disallow_list, "tb_office", "office_id", "office_name", "edit_office", "?d=manage&c=office&m=edit");
	}
	
	
	
	
	function office_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="add">เพิ่ม'.$this->lang->line("text_office").'</a></li>';
		$html.='
			<li><a href="#"  id="edit">แก้ไข/ลบ'.$this->lang->line("text_office").'</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_office',$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_office");
		}
		redirect(base_url()."?d=manage&c=office&m=edit");
	}
	function table_edit($data)
	{
		if($this->sess_orderby_office["type"]=="ASC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_212_down_arrow.png">';
		else if($this->sess_orderby_office["type"]=="DESC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_213_up_arrow.png">';
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>'.$this->lang->line("text_office").'</th>
				<th class="same_first_td">อนุมัติ<br/><button type="button" class="cbtn cbtn-green" id="allow-all"><button type="button" class="cbtn cbtn-red" id="disallow-all"></th>
				<th class="same_first_td">แก้ไข</th>
				<th>ลบ<br/><input type="checkbox" id="del_all_office"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=office&m=delete" id="form_del_office">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			//<td>'.$num_row.'</td>
			//if     $checkbox='<input type="checkbox" value="'.$dt["office_id"].'" name="allow_office0[]" class="allow_office0">';
			//else   $checkbox='<input type="checkbox" value="'.$dt["office_id"].'" name="allow_office1[]" class="allow_office1" checked>';
			if($dt['checked']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["office_id"].'" id="checkboxFourInput'.$dt["office_id"].'" name="allow_office0[]" class="allow_office0"/>
										  	<label for="checkboxFourInput'.$dt["office_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["office_id"].'" id="checkboxFourInput'.$dt["office_id"].'" name="allow_office1[]" class="allow_office1" checked/>
						  	<label for="checkboxFourInput'.$dt["office_id"].'"></label>
					  		</span>';
			$html.='<tr>
					<td>'.$dt["office_id"].'</td>
					<td id="office'.$dt["office_id"].'">'.$dt["office_name"].'</td>
					<td class="same_first_td">'.$checkbox.'</td>
					<td class="same_first_td">'.$this->eml->btn('edit','onclick=load_office("'.$dt["office_id"].'")').'</td>
					<td><input type="checkbox" value="'.$dt["office_id"].'" name="del_office[]" class="del_office"></td>
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
			$this->session->set_userdata("orderby_office",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function load_office()
	{
		$load=$this->off_model->load_office($this->input->post("tid"));
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
			$this->session->set_userdata("searchfield_office",$this->input->post("searchfield"));
		}
	}
	
	/**
	 * Check office already exist with ajax
	 */
	function already_exist_ajax()
	{
		$this->db->select()->from("tb_office")
		->where("office_name",trim( $this->input->post( $this->lang->line("in_office") ) ));
		$q = $this->db->get();
		if($q->num_rows() > 0 )
			echo json_encode(false);
		else echo json_encode(true);
	}
}