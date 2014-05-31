<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article_type extends MY_Controller
{
	private $actm;
	private $sess_orderby_article_type;
	function __construct()
	{
		parent::__construct();
		
		$this->fl->check_group_privilege(array("02"));
		$this->load->model("manage/article_type_model");
		$this->actm=$this->article_type_model;
		//echo "test";break;
		$this->set_default_sess_orderby("article_type", array("field"=>"article_type_name","type"=>"ASC"));
		if($this->session->userdata("orderby_article_type"))
			$this->sess_orderby_article_type=$this->session->userdata("orderby_article_type");
		
	}
	function add()
	{
		$config=array(
		
				array(
						"field"=>$this->lang->line("in_article_type"),
						"label"=>$this->lang->line("t_in_article_type"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		
		$this->db->select()->from("tb_article_type")
		->order_by("CONVERT(article_type_name USING ".$this->mysql_charset.")","ASC");
		$current_article_type = $this->db->get()->result_array();
		if($this->frm->run() == false)
		{
			$in_article_type=array(
					"LB_text"=>$this->lang->line("t_in_article_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_article_type"),
					"IN_id"=>$this->lang->line("in_article_type"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_article_type")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_add_article_type")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"article_type_tab"=>$this->article_type_tab(),
					"in_article_type"=>$this->eml->form_input($in_article_type),
					"current_article_type"=>$this->eml->multiple_select($current_article_type,"article_type_name")
			);
				
			$this->load->view("manage/article_type/add_article_type",$data);
		}
		else
		{
			//$data[] to insert new article_type
			$data=array(
					"article_type_id"=>$this->actm->get_maxid(2, "article_type_id", "tb_article_type"),
					"article_type_name"=>$this->input->post($this->lang->line("in_article_type"))
			);
			$redirect_link="?d=manage&c=article_type&m=add";
			//add event
			$this->add_event($this->lang->line("ti_add_article_type"));
			$this->actm->manage_add(
					$data,
					"tb_article_type",
					$redirect_link,
					$redirect_link,
					"article_type",
					"เพิ่มข้อมูล".$this->lang->line("text_article_type")."สำเร็จ",
					"เพิ่มข้อมูล".$this->lang->line("text_article_type")."ไม่สำเร็จ"
					);
		}
	}
	function edit()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_article_type"),
						"label"=>$this->lang->line("t_in_article_type"),
						"rules"=>"required|max_length[30]|callback_call_lib[regex_lib,regex_charTHEN,%s - กรอกได้เฉพาะอักษรไทย/อังกฤษ]"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			echo $this->set_default_sess_orderby("article_type", array("field"=>"article_type_name","type"=>"ASC"));
			$this->set_default_sess_orderby("article_type", array("field"=>"article_type_name","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=article_type&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
				
			if(isset($_GET['page']) && $this->check_page_num($_GET['page']))
				$this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
			
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_article_type", "article_type_name");
			$search_text=null;
			$search_text=$this->session->userdata("search_article_type");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->actm->get_all_numrows("tb_article_type",$liketext,$searchfield);
				$get_article_type_list=$this->actm->get_article_type_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->actm->get_all_numrows("tb_article_type",'',$searchfield);
				$get_article_type_list=$this->actm->get_article_type_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
				
			//..pagination
				
			$in_article_type=array(
					"LB_text"=>$this->lang->line("t_in_article_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_article_type"),
					"IN_id"=>$this->lang->line("in_article_type"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_article_type")),
					"IN_attr"=>'maxlength="30"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_article_type")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"article_type_tab"=>$this->article_type_tab(),
					"in_article_type"=>$this->eml->form_input($in_article_type),
					"table_edit"=>$this->table_edit($get_article_type_list),
					"session_search_article_type"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/article_type/edit_article_type",$data);
		}
		else
		{
			$prev_url=$_SERVER['HTTP_REFERER'];
			$session_edit_id="edit_article_type_id";
			$set=array(
					"article_type_name"=>$this->input->post($this->lang->line("in_article_type"))
			);
			$where=array(
					"article_type_id"=>$this->session->userdata($session_edit_id)
			);
			//add event
			$this->add_event("แก้ไข".$this->lang->line("text_article_type"));
			$this->actm->manage_edit(
					$set,
					$where,
					"tb_article_type",
					$session_edit_id,
					"edit_article_type",
					"แก้ไข".$this->lang->line("text_article_type")."สำเร็จ",
					"แก้ไข".$this->lang->line("text_article_type")."ไม่สำเร็จ",
					"?d=manage&c=article_type&m=edit",
					$prev_url);
		}
	}
	function delete()
	{
		//add event
		$this->add_event("ลบ".$this->lang->line("text_article_type"));
		$this->actm->manage_delete($this->input->post("del_article_type"), "tb_article_type", "article_type_id", "article_type_name", "edit_article_type", "?d=manage&c=article_type&m=edit");
	}
	
	function article_type_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="add">เพิ่ม'.$this->lang->line("text_article_type").'</a></li>';
		$html.='
			<li><a href="#"  id="edit">แก้ไข/ลบ'.$this->lang->line("text_article_type").'</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_article_type',$this->input->post("input_search_box"));
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_article_type");
		}
		redirect(base_url()."?d=manage&c=article_type&m=edit");
	}
	function table_edit($data)
	{
		if($this->sess_orderby_article_type["type"]=="ASC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_212_down_arrow.png"';
		else if($this->sess_orderby_article_type["type"]=="DESC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_213_up_arrow.png"';
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>รหัส</th>
				<th>'.$this->lang->line("text_article_type").'</th>
				<th class="same_first_td">แก้ไข</th>
				<th><input type="checkbox" id="del_all_article_type"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=article_type&m=delete" id="form_del_article_type">';
		if(!empty($data))
		{	//<td>'.$num_row.'</td>
			foreach ($data AS $dt):
			$html.='<tr>
					<td>'.$dt["article_type_id"].'</td>
					<td id="article_type'.$dt["article_type_id"].'">'.$dt["article_type_name"].'</td>
					<td class="same_first_td">'.$this->eml->btn('edit','onclick=load_article_type("'.$dt["article_type_id"].'")').'</td>
					<td><input type="checkbox" value="'.$dt["article_type_id"].'" name="del_article_type[]" class="del_article_type"></td>
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
			$this->session->set_userdata("orderby_article_type",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function load_article_type()
	{
		$load=$this->actm->load_article_type($this->input->post("tid"));
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
			$this->session->set_userdata("searchfield_article_type",$this->input->post("searchfield"));
		}
	}
	
	/**
	 * Check article_type already exist with ajax
	 */
	function already_exist_ajax()
	{
		$this->db->select()->from("tb_article_type")
		->where("article_type_name",trim( $this->input->post( $this->lang->line("in_article_type") ) ));
		$q = $this->db->get();
		if($q->num_rows() > 0 )
			echo json_encode(false);
		else echo json_encode(true);
	}
}