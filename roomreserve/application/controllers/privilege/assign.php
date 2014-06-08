<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assign extends MY_Controller
{
	private $am;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("01","02","03","04","05","06"),false,"OR");
		$this->load->model("privilege/assign_model");
		$this->am=$this->assign_model;
	}
	
	function add()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("se_privilege_list"),
						"label"=>$this->lang->line("t_se_privilege_list"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_user_list"),
						"label"=>$this->lang->line("t_se_user_list"),
						"rules"=>"required"
				)
		);
		$this->frm->set_rules($config);
		if($this->frm->run() == false)
		{
			$privilege_list=$this->am->get_privilege_list();
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("โอนสิทธิ์"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"privilege_list"=>$privilege_list,
					"assign_tab"=>$this->assign_tab()
			);
			$this->load->view("privilege/assign_add",$data);
		}
		else
		{
			$data=array(
					"privilege_assign_id"=>$this->am->get_maxid(4,"privilege_assign_id","tb_privilege_assign"),
					"assign_from"=>$this->session->userdata("rs_username"),
					"assign_to"=>$this->input->post($this->lang->line("se_user_list")),
					"assign_date"=>date("Y-m-d H:i:s"),
					"tb_privilege_id"=>$this->input->post($this->lang->line("se_privilege_list"))
			);
			//add event
			$this->add_event("โอนสิทธิ์ให้".$this->input->post($this->lang->line("se_user_list")));
			$this->am->manage_add($data,"tb_privilege_assign",
					"?d=privilege&c=assign&m=add",
					"?d=privilege&c=assign&m=add",
					"add_p_a",
					"โอนสิทธิ์ให้ ".$this->input->post($this->lang->line("se_user_list"))." สำเร็จ",
					"โอนสิทธิ์ให้ ".$this->input->post($this->lang->line("se_user_list"))." ไม่สำเร็จ"
					);
		}
	}
	
	function edit()
	{
		
		$config=array(
				array(
						"field"=>$this->lang->line("se_privilege_list"),
						"label"=>$this->lang->line("t_se_privilege_list"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_user_list"),
						"label"=>$this->lang->line("t_se_user_list"),
						"rules"=>"required"
				)
		);
		$this->frm->set_rules($config);
		if($this->frm->run() == false)
		{
			//pagination
			$this->load->library("pagination");
			$config_pg['use_page_numbers'] = TRUE;
			$config_pg['base_url']=base_url()."?d=privilege&c=assign&m=edit";
			//set per_page
			$config_pg['per_page']=$this->default_perpage;
			$getpage;
			if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $getpage=(($_GET['page']-1)*$config_pg['per_page']);
			else $getpage=0;
			$config_pg['total_rows']=$this->am->get_all_numrows("tb_privilege_assign",$this->session->userdata("rs_username"),"assign_from");
			$this->pagination->initialize($config_pg);
			//..pagination
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("จัดการการโอนสิทธิ์"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"assign_tab"=>$this->assign_tab(),
					"table_assign_list"=>$this->table_assign_list($this->am->get_privilege_assign_list($config_pg['per_page'],$getpage))
			);
			$this->load->view("privilege/assign_edit",$data);
		}
		else
		{
			
		}
	}
	
	function get_user_list()
	{
		$user_list = $this->am->get_user_list($this->input->post("privilege_id"));
		$user='';
		foreach($user_list as $u)
		{
			$user.="<option value='".$u['username']."'>".$u['username']."</option>";
		}
		echo json_encode(array("username"=>$user));
	}
	
	function assign_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			<li><a href="#"  id="add">โอนสิทธิ์</a></li>';
		$html.='
			<li><a href="#"  id="edit">จัดการการโอนสิทธิ์</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	
	function table_assign_list($data)
	{
		$html='
				<form autocomplete="off"><table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>ผู้รับสิทธิ์</th>
				<th>วันที่มอบสิทธิ์</th>
				<th>สิทธิ์</th>
				<th class="text-center">สถานะ</th>
		';
		$html.='</thead>';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			$th_dt = $this->th_date($dt["assign_date"],"");
			/*if($dt['canceled']==1)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["privilege_assign_id"].'" id="checkboxFourInput'.$dt["privilege_assign_id"].'" name="allow_assign" class="allow_assign1"/>
										  	<label class="label-assign" for="checkboxFourInput'.$dt["privilege_assign_id"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["privilege_assign_id"].'" id="checkboxFourInput'.$dt["privilege_assign_id"].'" name="allow_assign" class="allow_assign0" checked/>
						  	<label class="label-assign" for="checkboxFourInput'.$dt["privilege_assign_id"].'"></label>
					  		</span>';
			*/
			if($dt['canceled']==1)
				$checkbox = '<i class="fa fa-circle fa-danger" id="s1-'.$dt["privilege_assign_id"].'"></i>';
			else 
				$checkbox = '<i class="fa fa-circle fa-success pointer" id="s0-'.$dt["privilege_assign_id"].'"></i>';
			
			$html.='<tr>
					<td>'.$dt["assign_to"].'</td>
					<td>'.$th_dt["date"]." ".$th_dt["time"].'</td>
					<td>'.$dt["privilege_name"].'</td>
					<td>'.$checkbox.'</td>
			';
			$html.='</tr>';
			endforeach;
		}
		$html.='
				</form></table>
		';
		$html.=$this->pagination->create_links();
		return $html;
	}
	
	function allow_assign()
	{
		if($this->input->post("c") == "s0") //s0 =(canceled = 0) ยังไม่ได้ยกเลิก
			$c=1; //c=1 ตั้งสถานะเป็นยกเลิก

		$set=array("canceled"=>$c);
		$where=array("privilege_assign_id"=>$this->input->post("assign_id"));
		//add event
		$this->add_event("ยกเลิกการโอนสิทธิ์");
		
		$status = $this->am->allow_assign($set,$where);
		if($status==true && $c==1)			$m="ยกเลิกการโอนสิทธิ์ สำเร็จ";
		else if($status==false && $c==1)	$m="ยกเลิกการโอนสิทธิ์ ไม่สำเร็จ";
		echo json_encode(array("assign_status"=>$m));
	}
}