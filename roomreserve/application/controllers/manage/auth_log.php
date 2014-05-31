<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_log extends MY_Controller
{
	var $al_model;
	private $sess_orderby_auth_log;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("05"));
		$this->load->model("manage/auth_log_model");
		$this->al_model=$this->auth_log_model;
		$this->sess_orderby_auth_log=$this->session->userdata("orderby_auth_log");
	}
	function edit()
	{
		$config=array(
				array(
						"field"=>"",
						"label"=>$this->lang->line("text_auth_log"),
						"rules"=>""
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$this->set_default_sess_orderby("auth_log", array("field"=>"event_log_id","type"=>"ASC"));
			//pagination
			$this->load->library("pagination");
			$config['use_page_numbers'] = TRUE;
			$config['base_url']=base_url()."?d=manage&c=auth_log&m=edit";
			//set per_page
			if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
			else $config['per_page']=$this->default_perpage;
			//ตำแหน่งหน้าที่แสดงข้อมูล
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
			else $this->getpage=0;
			//field ที่ค้นหา
			$searchfield=$this->check_searchfield("searchfield_auth_log", "tb_user_username");
			$search_text=null;
			$search_text=$this->session->userdata("search_auth_log");
			if($search_text!=null)
			{
				$liketext=$search_text;
				$config['total_rows']=$this->al_model->get_all_numrows("tb_event_log",$liketext,$searchfield);
	
				$get_auth_log_list=$this->al_model->get_auth_log_list($config['per_page'],$this->getpage,$liketext);
			}
			else
			{
				$config['total_rows']=$this->al_model->get_all_numrows("tb_event_log",'',$searchfield);
	
				$get_auth_log_list=$this->al_model->get_auth_log_list($config['per_page'],$this->getpage);
			}
			$this->pagination->initialize($config);
	
			//..pagination
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_auth_log")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"auth_log_tab"=>$this->auth_log_tab(),
					"table_edit"=>$this->table_edit($get_auth_log_list),
					"session_search_auth_log"=>$search_text,
					"pagination_num_rows"=>$config["total_rows"],
					"manage_search_box"=>$this->pel->manage_search_box($search_text)
			);
			$this->load->view("manage/auth_log/edit_auth_log",$data);
		}
		else
		{
			
		}
	}
	
	
	
	function auth_log_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			';
		$html.='
			<li><a href="#"  id="edit">จัดการ'.$this->lang->line("text_auth_log").'</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_auth_log',$this->input->post("input_search_box"));
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_auth_log");
		}
		redirect(base_url()."?d=manage&c=auth_log&m=edit");
	}
	function table_edit($data)
	{
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th class="same_first_td">รหัส</th>
				<th>ชื่อผู้ใช้</th>
				<th>IP</th>
				<th>วัน/เวลา</th>
				<th>การกระทำ</th>
		';
		$html.='</thead>
		<form method="post" action="'.base_url().'?d=manage&c=auth_log&m=delete" id="form_del_auth_log">';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			//convert datetime
			$th_dt = $this->th_date($dt["event_on"],"");
			$html.='<tr>
					<td>'.$dt["event_log_id"].'</td>
					<td id="auth_log'.$dt["event_log_id"].'">'.$dt["tb_user_username"].'</td>
					<td>'.$dt["ip_address"].'</td>
					<td>'.$th_dt["date"]." ".$th_dt["time"].'</td>
					<td>'.$dt["event_text"].'</td>
			';
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
	function set_orderby()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_auth_log",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function set_searchfield()
	{
		if($this->input->post("searchfield"))
		{
			$this->session->set_userdata("searchfield_auth_log",$this->input->post("searchfield"));
		}
	}
}