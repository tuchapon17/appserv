<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Room_has_article extends MY_Controller
{
	private $table_name	="tb_room_has_article";
	private $field_name	=array();
	var  $load_rha_model;
	private $sess_orderby_room_has_article;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("02"));
		$this->load->model("manage/room_has_article_model");
			$this->load_rha_model=$this->room_has_article_model;
		$this->lang->load("room_has_article/room_has_article","thailand");
		$this->sess_orderby_room_has_article=$this->session->userdata("orderby_room_has_article");
		$this->get_all_field();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all field in $table_name and push to array ($field_name)
	 *
	 * @return 	void
	 */
	function get_all_field()
	{
		$fields = $this->load_rha_model->get_all_field($this->table_name);
		foreach($fields as $field)
		{
			$this->field_name[$field]=$field;
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * - Receive data from view(add_room_has_article)
	 * - form validation
	 * - Add data to $table_name
	 *
	 * @return 	void
	 */
	function add()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("se_article"),
						"label"=>$this->lang->line("t_se_article"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_room"),
						"label"=>$this->lang->line("t_se_room"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_fee_type"),
						"label"=>$this->lang->line("t_se_fee_type"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("in_article_num"),
						"label"=>$this->lang->line("t_in_article_num"),
						"rules"=>"required|numeric"
				),
				array(
						"field"=>$this->lang->line("in_lump_sum_base_unit"),
						"label"=>$this->lang->line("t_in_lump_sum_base_unit"),
						"rules"=>"numeric"
				)
		);
		$this->frm->set_rules($config);
		if($this->frm->run() == false)
		{
			$se_article_type=array(
					"LB_text"=>$this->lang->line("t_se_article_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_article_type"),
					"S_id"=>$this->lang->line("se_article_type"),
					"S_old_value"=>$this->input->post($this->lang->line("se_article_type")),
					"S_data"=>$this->emm->select_article_type(),
					"S_id_field"=>"article_type_id",
					"S_name_field"=>"article_type_name",
					"help_text"=>''
			);
			$se_article=array(
					"LB_text"=>$this->lang->line("t_se_article"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_article"),
					"S_id"=>$this->lang->line("se_article"),
					"S_old_value"=>$this->input->post($this->lang->line("se_article")),
					"S_data"=>'',
					"S_id_field"=>"article_id",
					"S_name_field"=>"article_name",
					"help_text"=>''
			);
			$se_room=array(
					"LB_text"=>$this->lang->line("t_se_room"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_room"),
					"S_id"=>$this->lang->line("se_room"),
					"S_old_value"=>$this->input->post($this->lang->line("se_room")),
					"S_data"=>'',
					"S_id_field"=>"room_id",
					"S_name_field"=>"room_name",
					"help_text"=>''
			);
			$se_fee_type=array(
					"LB_text"=>$this->lang->line("t_se_fee_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_fee_type"),
					"S_id"=>$this->lang->line("se_fee_type"),
					"S_old_value"=>$this->input->post($this->lang->line("se_fee_type")),
					"S_data"=>$this->emm->get_select("tb_fee_type","fee_type_name"),
					"S_id_field"=>"fee_type_id",
					"S_name_field"=>"fee_type_name",
					"help_text"=>''
			);
			$in_article_num=array(
					"LB_text"=>$this->lang->line("t_in_article_num"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_article_num"),
					"IN_id"=>$this->lang->line("in_article_num"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_article_num")),
					"IN_attr"=>'maxlength="4"',
					"help_text"=>""
			);
			$in_lump_sum_base_unit=array(
					"LB_text"=>$this->lang->line("t_in_lump_sum_base_unit"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_lump_sum_base_unit"),
					"IN_id"=>$this->lang->line("in_lump_sum_base_unit"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_lump_sum_base_unit")),
					"IN_attr"=>'maxlength="4"',
					"help_text"=>""
			);
			
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_add_room_has_article")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"room_has_article_tab"=>$this->room_has_article_tab(),
					"se_article"=>$this->eml->form_select($se_article),
					"se_room"=>$this->eml->form_select($se_room),
					"se_fee_type"=>$this->eml->form_select($se_fee_type),
					"in_article_num"=>$this->eml->form_input($in_article_num),
					"in_lump_sum_base_unit"=>$this->eml->form_input($in_lump_sum_base_unit),
					"se_article_type"=>$this->eml->form_select($se_article_type)
			);
			$this->load->view("manage/room_has_article/add_room_has_article",$data);
		}
		else
		{
			$data=array(
					"tb_room_id"=>$this->input->post($this->lang->line("se_room")),
					"tb_article_id"=>$this->input->post($this->lang->line("se_article")),
					"article_num"=>$this->input->post($this->lang->line("in_article_num")),
					"tb_fee_type_id"=>$this->input->post($this->lang->line("se_fee_type")),
					"lump_sum_base_unit"=>$this->input->post($this->lang->line("in_lump_sum_base_unit"))
			);
			$redirect_link="?d=manage&c=room_has_article&m=add";
			//add event
			$this->add_event($this->lang->line("ti_add_room_has_article"));
			$this->load_rha_model->manage_add($data,
					$this->table_name,
					$redirect_link,
					$redirect_link,
					"room_has_article",
					"เพิ่ม".$this->lang->line("text_article")."สำหรับห้องสำเร็จ",
					"เพิ่ม".$this->lang->line("text_article")."สำหรับห้องไม่สำเร็จ"
					);
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * - Receive data from view(edit_article)
	 * - form validation
	 * - Update data in $table_name
	 *
	 * @return 	void
	 */
	function edit()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("in_article"),
						"label"=>$this->lang->line("t_in_article"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("in_room"),
						"label"=>$this->lang->line("t_in_room"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_fee_type"),
						"label"=>$this->lang->line("t_se_fee_type"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("in_article_num"),
						"label"=>$this->lang->line("t_in_article_num"),
						"rules"=>"required|numeric"
				),
				array(
						"field"=>$this->lang->line("in_lump_sum_base_unit"),
						"label"=>$this->lang->line("t_in_lump_sum_base_unit"),
						"rules"=>"numeric"
				)
		);
		$this->frm->set_rules($config);
		//$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("room_has_article", array("field"=>"tb_room_id","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=room_has_article&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
	
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
	
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_room_has_article", "tb_room_id");
			$search_text=null;
			$search_text=$this->session->userdata("search_room_has_article");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->load_rha_model->get_all_numrows_rha($this->table_name,$liketext,$searchfield);
				$get_room_has_article_list=$this->load_rha_model->get_room_has_article_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->load_rha_model->get_all_numrows_rha($this->table_name,'',$searchfield);
				$get_room_has_article_list=$this->load_rha_model->get_room_has_article_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
	
			//..pagination
			$se_article=array(
					"LB_text"=>$this->lang->line("t_se_article"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_article"),
					"S_id"=>$this->lang->line("se_article"),
					"S_old_value"=>$this->input->post($this->lang->line("se_article")),
					"S_data"=>$this->emm->get_select("tb_article","article_name"),
					"S_id_field"=>"article_id",
					"S_name_field"=>"article_name",
					"help_text"=>''
			);
			$se_room=array(
					"LB_text"=>$this->lang->line("t_se_room"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_room"),
					"S_id"=>$this->lang->line("se_room"),
					"S_old_value"=>$this->input->post($this->lang->line("se_room")),
					"S_data"=>'',
					"S_id_field"=>"room_id",
					"S_name_field"=>"room_name",
					"help_text"=>''
			);
			$se_fee_type=array(
					"LB_text"=>$this->lang->line("t_se_fee_type"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'',
					"S_name"=>$this->lang->line("se_fee_type"),
					"S_id"=>$this->lang->line("se_fee_type"),
					"S_old_value"=>$this->input->post($this->lang->line("se_fee_type")),
					"S_data"=>$this->emm->get_select("tb_fee_type","fee_type_name"),
					"S_id_field"=>"fee_type_id",
					"S_name_field"=>"fee_type_name",
					"help_text"=>''
			);
			$in_article_num=array(
					"LB_text"=>$this->lang->line("t_in_article_num"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_article_num"),
					"IN_id"=>$this->lang->line("in_article_num"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_article_num")),
					"IN_attr"=>'maxlength="4"',
					"help_text"=>""
			);
			$in_lump_sum_base_unit=array(
					"LB_text"=>$this->lang->line("t_in_lump_sum_base_unit"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_lump_sum_base_unit"),
					"IN_id"=>$this->lang->line("in_lump_sum_base_unit"),
					"IN_PH"=>'',
					"IN_value"=>set_value($this->lang->line("in_lump_sum_base_unit")),
					"IN_attr"=>'maxlength="4"',
					"help_text"=>""
			);
			
			$in_room=array(
					"LB_text"=>$this->lang->line("t_in_room"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_room"),
					"IN_id"=>$this->lang->line("in_room"),
					"IN_PH"=>'',
					"IN_value"=>'',
					"IN_attr"=>'readonly',
					"help_text"=>""
			);
			$in_article=array(
					"LB_text"=>$this->lang->line("t_in_article"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_type"=>'text',
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("in_article"),
					"IN_id"=>$this->lang->line("in_article"),
					"IN_PH"=>'',
					"IN_value"=>'',
					"IN_attr"=>'readonly',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_room_has_article")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"room_has_article_tab"=>$this->room_has_article_tab(),
						//"se_article"=>$this->eml->form_select($se_article),
						//"se_room"=>$this->eml->form_select($se_room),
					"se_fee_type"=>$this->eml->form_select($se_fee_type),
					"in_article_num"=>$this->eml->form_input($in_article_num),
					"in_lump_sum_base_unit"=>$this->eml->form_input($in_lump_sum_base_unit),
					"in_room"=>$this->eml->form_input($in_room),
					"in_article"=>$this->eml->form_input($in_article),
					"table_edit"=>$this->table_edit($get_room_has_article_list),
					"session_search_room_has_article"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/room_has_article/edit_room_has_article",$data);
		}
		else
		{
			$prev_url=$_SERVER['HTTP_REFERER'];
			$session_edit_id="edit_room_has_article_id";
			$set=array(
					//"tb_room_id"=>$this->input->post($this->lang->line("se_room")),
					//"tb_article_id"=>$this->input->post($this->lang->line("se_article")),
					"article_num"=>$this->input->post($this->lang->line("in_article_num")),
					"tb_fee_type_id"=>$this->input->post($this->lang->line("se_fee_type")),
					"lump_sum_base_unit"=>$this->input->post($this->lang->line("in_lump_sum_base_unit"))
			);
			$arr_sess_edit=explode(",",$this->session->userdata($session_edit_id));
			$where=array(
					"tb_room_id"=>$arr_sess_edit["0"],
					"tb_article_id"=>$arr_sess_edit["1"]
			);
			//add event
			$this->add_event("แก้ไข".$this->lang->line("text_room_has_article"));
			$this->load_rha_model->manage_edit(
					$set,
					$where,
					$this->table_name,
					$session_edit_id,
					"edit_room_has_article",
					"แก้ไข".$this->lang->line("text_article")."สำหรับห้องสำเร็จ",
					"แก้ไข".$this->lang->line("text_article")."สำหรับห้องไม่สำเร็จ",
					"?d=manage&c=room_has_article&m=edit",
					$prev_url
					);
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * Call function mange_delete
	 * - manage_delete($arr_id, $table, $field_PK, $select_field, $message_type='', $main_url='')
	 *
	 * @return 	void
	 */
	function delete()
	{
		//add event
		$this->add_event("ลบ".$this->lang->line("text_room_has_article"));
		$this->load_rha_model->delete_rha($this->input->post("del_room_has_article"), $this->table_name, "tb_room_id,tb_article_id", "room_name,article_name", "edit_room_has_article", "?d=manage&c=room_has_article&m=edit");
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Create tab
	 *
	 * @return 	string
	 */
	function room_has_article_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="add">เพิ่ม'.$this->lang->line("text_article").'สำหรับห้อง</a></li>';
		$html.='
			<li><a href="#"  id="edit">แก้ไข/ลบ'.$this->lang->line("text_article").'สำหรับห้อง</a></li>
			';
		$html.='</ul>';
		return $html;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Set order by session
	 *
	 * @return 	void
	 */
	function set_orderby()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_room_has_article",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	// --------------------------------------------------------------------
	
	/**
	 * Set search session and redirect
	 *
	 * @return 	void
	 */
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_room_has_article',$this->input->post("input_search_box"));
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_room_has_article");
		}
		redirect(base_url()."?d=manage&c=room_has_article&m=edit");
	}

	// --------------------------------------------------------------------
	
	/**
	 * Create table and pagination for manage data
	 *
	 * @param 	array
	 * @return 	string
	 */
	function table_edit($data)
	{
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>'.$this->lang->line("t_se_room").'</th>
				<th>'.$this->lang->line("t_se_article").'</th>
				<th>'.$this->lang->line("t_se_fee_type").'</th>
				<th>'.$this->lang->line("t_in_article_num").'</th>
				<th>'.$this->lang->line("t_in_lump_sum_base_unit").'</th>
				<th class="same_first_td">แก้ไข</th>
				<th><input type="checkbox" id="del_all_room_has_article"></th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=room_has_article&m=delete" id="form_del_room_has_article" autocomplete="off">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			if($this->load_rha_model->is_article_id_exist($dt['tb_article_id'],$dt["tb_room_id"]))
			{
				$del_checkbox = '<input type="checkbox" value="'.$dt["tb_room_id"].",".$dt["tb_article_id"].'" name="del_room_has_article[]" class="del_room_has_article">';
			}
			else $del_checkbox='';
			$html.='<tr>
					<td id="room'.$dt["tb_room_id"].'">'.$dt["room_name"].'</td>
					<td id="article'.$dt["tb_article_id"].'">'.$dt["article_name"].'</td>
					<td id="fee_type'.$dt["tb_fee_type_id"].'">'.$dt["fee_type_name"].'</td>
					<td>'.$dt["article_num"].'</td>
					<td>'.$dt["lump_sum_base_unit"].'</td>
					<td class="same_first_td">'.$this->eml->btn('edit','onclick=load_room_has_article("'.$dt["tb_room_id"].",".$dt["tb_article_id"].'")').'</td>
					<td>'.$del_checkbox.'</td>
			';
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
				
				<td>'.$this->eml->btn('delete','onclick="show_del_list();return false;"').'</td>
				</tr>
				</table>
				</form>';
		$html.=$this->pagination->create_links();
		return $html;
	}

	// --------------------------------------------------------------------
	
	/**
	 *
	 * @return 	void
	 * echo Json
	 */
	function select_room_list()
	{
		if($this->input->post("article_id")!=''):
		$query=$this->emm->select_room_rha($this->input->post("article_id"));
		$data='';
		//echo $this->db->last_query();break;
		if($query>0):
		foreach($query AS $ar):
		$data.="<option value='".$ar['room_id']."'>".$ar['room_name']."</option>";
		endforeach;
		endif;
		echo json_encode(array("room_list"=>$data));
		else: echo "";
		endif;
	}

	// --------------------------------------------------------------------
	
	/**
	 *
	 * @return 	void
	 * echo Json
	 */
	function select_article_list()
	{
		if($this->input->post("article_type_id")!=''):
		$query=$this->emm->select_article_by_article_type($this->input->post("article_type_id"));
		$data='';
		if($query>0):
			foreach($query AS $ar):
				$data.="<option value='".$ar['article_id']."'>".$ar['article_name']."</option>";
			endforeach;
		endif;
		echo json_encode(array("article_list"=>$data));
		else: echo "";
		endif;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get data reference by ID and return array with json
	 *
	 * @return 	array
	 */
	function load_room_has_article()
	{
		$load=$this->load_rha_model->load_room_has_article($this->input->post("room_id"),$this->input->post("article_id"));
		echo json_encode($load[0]);
	}

	// --------------------------------------------------------------------
	
	/**
	 * Set search_field session
	 *
	 * @return 	void
	 */
	function set_searchfield()
	{
		if($this->input->post("searchfield"))
		{
			$this->session->set_userdata("searchfield_room_has_article",$this->input->post("searchfield"));
		}
	}
}