<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Room_type extends MY_Controller
{
	private $rt_model;
	private $sess_orderby_room_type;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("02"));
		$this->load->model("manage/room_type_model");
		$this->rt_model=$this->room_type_model;
		$this->sess_orderby_room_type=$this->session->userdata("orderby_room_type");
	}
	function add()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_room_type"),
						"label"=>$this->lang->line("t_in_room_type"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$in_room_type=array(
					"LB_text"=>$this->lang->line("t_in_room_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_room_type"),
					"IN_id"=>$this->lang->line("in_room_type"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_room_type")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_add_room_type")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"room_type_tab"=>$this->room_type_tab(),
					"in_room_type"=>$this->eml->form_input($in_room_type)
			);
				
			$this->load->view("manage/room_type/add_room_type",$data);
		}
		else
		{
			//$data[] to insert new room_type
			$data=array(
					"room_type_id"=>$this->rt_model->get_maxid(2, "room_type_id", "tb_room_type"),
					"room_type_name"=>$this->input->post($this->lang->line("in_room_type"))
			);
			$redirect_link="?d=manage&c=room_type&m=add";
			$this->rt_model->manage_add(
					$data,
					"tb_room_type",
					$redirect_link,
					$redirect_link,
					"room_type",
					"เพิ่มข้อมูล".$this->lang->line("text_room_type")."สำเร็จ",
					"เพิ่มข้อมูล".$this->lang->line("text_room_type")."ไม่สำเร็จ"
					);
		}
	}
	function edit()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_room_type"),
						"label"=>$this->lang->line("t_in_room_type"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("room_type", array("field"=>"room_type_name","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=room_type&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
				
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_room_type", "room_type_name");
			$search_text=null;
			$search_text=$this->session->userdata("search_room_type");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->rt_model->get_all_numrows("tb_room_type",$liketext,$searchfield);
				$get_room_type_list=$this->rt_model->get_room_type_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->rt_model->get_all_numrows("tb_room_type",'',$searchfield);
				$get_room_type_list=$this->rt_model->get_room_type_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
				
			//..pagination
			$in_room_type=array(
					"LB_text"=>$this->lang->line("t_in_room_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_room_type"),
					"IN_id"=>$this->lang->line("in_room_type"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_room_type")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);	
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_room_type")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"room_type_tab"=>$this->room_type_tab(),
					"in_room_type"=>$this->eml->form_input($in_room_type),
					"table_edit"=>$this->table_edit($get_room_type_list),
					"session_search_room_type"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/room_type/edit_room_type",$data);
		}
		else
		{
			$prev_url=$_SERVER['HTTP_REFERER'];
			$session_edit_id="edit_room_type_id";
			$set=array(
					"room_type_name"=>$this->input->post($this->lang->line("in_room_type"))
			);
			$where=array(
					"room_type_id"=>$this->session->userdata($session_edit_id)
			);
			$this->rt_model->manage_edit(
					$set,
					$where,
					"tb_room_type",
					$session_edit_id,
					"edit_room_type",
					"แก้ไข".$this->lang->line("text_room_type")."สำเร็จ",
					"แก้ไข".$this->lang->line("text_room_type")."ไม่สำเร็จ",
					"?d=manage&c=room_type&m=edit",
					$prev_url
					);
		}
	}
	function delete()
	{
		$this->rt_model->manage_delete($this->input->post("del_room_type"), "tb_room_type", "room_type_id", "room_type_name", "edit_room_type", "?d=manage&c=room_type&m=edit");
	}
	
	function room_type_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="add">เพิ่ม'.$this->lang->line("text_room_type").'</a></li>';
		$html.='
			<li><a href="#"  id="edit">แก้ไข/ลบ'.$this->lang->line("text_room_type").'</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_room_type',$this->input->post("input_search_box"));
				
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_room_type");
		}
		redirect(base_url()."?d=manage&c=room_type&m=edit");
	}
	function table_edit($data)
	{
		if($this->sess_orderby_room_type["type"]=="ASC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_212_down_arrow.png"';
		else if($this->sess_orderby_room_type["type"]=="DESC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_213_up_arrow.png"';
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>'.$this->lang->line("text_room_type").'</th>
				<th class="same_first_td">แก้ไข</th>
				<th><input type="checkbox" id="del_all_room_type"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=room_type&m=delete" id="form_del_room_type">';
		if(!empty($data))
		{	//<td>'.$num_row.'</td>
			foreach ($data AS $dt):
			$html.='<tr>
					<td>'.$dt["room_type_id"].'</td>
					<td id="room_type'.$dt["room_type_id"].'">'.$dt["room_type_name"].'</td>
					<td class="same_first_td">'.$this->eml->btn('edit','onclick=load_room_type("'.$dt["room_type_id"].'")').'</td>
					<td><input type="checkbox" value="'.$dt["room_type_id"].'" name="del_room_type[]" class="del_room_type"></td>
			';
			$html.='</tr>';
			$num_row++;
			endforeach;
		}
		$html.='<tr>
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
	function set_orderby()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_room_type",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function load_room_type()
	{
		$load=$this->rt_model->load_room_type($this->input->post("tid"));
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
			$this->session->set_userdata("searchfield_room_type",$this->input->post("searchfield"));
		}
	}
}