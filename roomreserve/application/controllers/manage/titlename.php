<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Titlename extends MY_Controller
{
	private $tn_model;
	private $sess_orderby_titlename;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("02"));
		$this->load->model("manage/titlename_model");
		$this->tn_model=$this->titlename_model;
		$this->sess_orderby_titlename=$this->session->userdata("orderby_titlename");
	}
	function add()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_titlename"),
						"label"=>$this->lang->line("t_in_titlename"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);	
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$in_titlename=array(
					"LB_text"=>$this->lang->line("t_in_titlename"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_titlename"),
					"IN_id"=>$this->lang->line("in_titlename"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_titlename")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_add_titlename")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"titlename_tab"=>$this->titlename_tab(),
					"in_titlename"=>$this->eml->form_input($in_titlename)
			);
			$this->load->view("manage/titlename/add_titlename",$data);
		}
		else
		{
			$data=array(
					"titlename_id"=>$this->tn_model->get_maxid(2, "titlename_id", "tb_titlename"),
					"titlename"=>$this->input->post($this->lang->line("in_titlename"))
			);
			$this->tn_model->add_titlename($data);
		}
	}
	var $getpage;
	function edit()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_titlename"),
						"label"=>$this->lang->line("t_in_titlename"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("titlename", array("field"=>"titlename","type"=>"ASC"));
			if(!$this->sess_orderby_titlename) 
				$this->session->set_userdata("orderby_titlename",array("field"=>"titlename","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=titlename&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
			
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_article_type", "article_type_name");
			$search_text=null;
			$search_text=$this->session->userdata("search_titlename");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->tn_model->get_all_numrows("tb_titlename",$liketext,$searchfield);
				$get_titlename_list=$this->tn_model->get_titlename_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->tn_model->get_all_numrows("tb_titlename",'',$searchfield);
				$get_titlename_list=$this->tn_model->get_titlename_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
			
			//..pagination
			
			$in_titlename=array(
					"LB_text"=>$this->lang->line("t_in_titlename"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_titlename"),
					"IN_id"=>$this->lang->line("in_titlename"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_titlename")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_titlename")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"titlename_tab"=>$this->titlename_tab(),
					"in_titlename"=>$this->eml->form_input($in_titlename),
					"table_edit"=>$this->table_edit($get_titlename_list),
					"session_search_titlename"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			//print_r($this->tn_model->get_titlename_list($config['per_page'],$this->getpage));break;
			$this->load->view("manage/titlename/edit_titlename",$data);
		}
		else
		{
			$prev_url=$_SERVER['HTTP_REFERER'];
			$set=array(
					"titlename"=>$this->input->post($this->lang->line("in_titlename"))
			);			
			$this->tn_model->edit_titlename($set,$prev_url);
		}
	}
	function delete()
	{
		$this->tn_model->delete_titlename($this->input->post("del_titlename"));
	}
	
	function titlename_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="titlename_tab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="add">เพิ่ม'.$this->lang->line("text_titlename").'</a></li>';
		$html.='
			<li><a href="#"  id="edit">แก้ไข/ลบ'.$this->lang->line("text_titlename").'</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function table_edit($data)
	{
		if($this->sess_orderby_titlename["type"]=="ASC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_212_down_arrow.png"';
		else if($this->sess_orderby_titlename["type"]=="DESC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_213_up_arrow.png"';
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>'.$this->lang->line("text_titlename").'</a></th>
				<th class="same_first_td">แก้ไข</th>
				<th><input type="checkbox" id="del_all_titlename"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=titlename&m=delete" id="form_del_titlename">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			$html.='<tr>
					<td>'.$dt["titlename_id"].'</td>
					<td id="titlename'.$dt["titlename_id"].'">'.$dt["titlename"].'</td>
					<td class="same_first_td">'.$this->eml->btn('edit','onclick=load_titlename("'.$dt["titlename_id"].'")').'</td>
					<td><input type="checkbox" value="'.$dt["titlename_id"].'" name="del_titlename[]" class="del_titlename"></td>
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
	function load_titlename()
	{
		$load=$this->tn_model->load_titlename($this->input->post("tid"));
		echo json_encode($load[0]);
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_titlename',$this->input->post("input_search_box"));
			
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_titlename");
		}
		redirect(base_url()."?d=manage&c=titlename&m=edit");
	}
	
	function set_orderby()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_titlename",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function search_box()
	{
		$html='
					
		';
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
			$this->session->set_userdata("searchfield_article_type",$this->input->post("searchfield"));
		}
	}
}
//preg_match('/^[1-9]|[1-9][\d]+/',$_GET['per_page']) ตัวเลขแต่ไม่ให้ 0 นำหน้า