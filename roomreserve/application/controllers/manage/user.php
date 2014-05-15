<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller
{
	private $us_model;
	private $sess_orderby_user;
	private $sess_orderby_view_privilege;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("06"));
		$this->load->model("manage/user_model");
		$this->us_model=$this->user_model;
		$this->sess_orderby_user=$this->session->userdata("orderby_user");
		$this->sess_orderby_view_privilege=$this->session->userdata("orderby_view_privilege");
	}

	function edit()
	{
		$this->set_default_sess_orderby("user", array("field"=>"username","type"=>"ASC"));
		//pagination
		$this->load->library("pagination");
		$config['use_page_numbers'] = TRUE;
		$config['base_url']=base_url()."?d=manage&c=user&m=edit";
		//set per_page
		if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
		else $config['per_page']=$this->default_perpage;
		
		if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
		else $this->getpage=0;
		
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_user", "username");
		$search_text=null;
		$search_text=$this->session->userdata("search_user");
		if($search_text!=null)
		{
			$liketext=$search_text;
			$config['total_rows']=$this->us_model->get_all_numrows("tb_user",$liketext,$searchfield);
			$get_user_list=$this->us_model->get_user_list($config['per_page'],$this->getpage,$liketext);
		}
		else
		{
			$config['total_rows']=$this->us_model->get_all_numrows("tb_user",'',$searchfield);
			$get_user_list=$this->us_model->get_user_list($config['per_page'],$this->getpage);
		}
		$this->pagination->initialize($config);
		
		//..pagination
		$data=array(
				"htmlopen"=>$this->pel->htmlopen(),
				"head"=>$this->pel->head("จัดการผู้ใช้งาน"),
				"bodyopen"=>$this->pel->bodyopen(),
				"navbar"=>$this->pel->navbar(),
				"js"=>$this->pel->js(),
				"footer"=>$this->pel->footer(),
				"bodyclose"=>$this->pel->bodyclose(),
				"htmlclose"=>$this->pel->htmlclose(),
				"user_tab"=>$this->user_tab(),
				"table_edit"=>$this->table_edit($get_user_list),
				"session_search_user"=>$search_text,
				"pagination_num_rows"=>$config["total_rows"],
				"manage_search_box"=>$this->pel->manage_search_box($search_text)
		);
		$this->load->view("manage/user/edit_user",$data);
	}
	function delete()
	{
		$this->us_model->manage_delete($this->input->post("del_user"), "tb_user", "username", "username", "edit_user", "?d=manage&c=user&m=edit");
	}
	
	function user_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			';
		$html.='
			<li><a href="#"  id="edit">จัดการผู้ใช้</a></li>
			<li><a href="#"  id="add_privilege">เพิ่มสิทธิ์</a></li>
			<li><a href="#"  id="delete_privilege">ลบสิทธิ์</a></li>
			<li><a href="#"  id="view_privilege">รายการสิทธิ์ของผู้ใช้</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function allow()
	{
		//$data = array
		$allow_list=$this->input->post("allow_list");
		$disallow_list=$this->input->post("disallow_list");
		$this->us_model->manage_allow($allow_list,$disallow_list, "tb_user", "username", "username", "edit_user", "?d=manage&c=user&m=edit");
	}
	function search()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_user',$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_user");
		}
		redirect(base_url()."?d=manage&c=user&m=edit");
	}
	function search_view_privilege()
	{
		if(count($this->input->post("input_search_box"))>0)
		{
			$this->session->set_userdata('search_view_privilege',$this->input->post("input_search_box"));
	
		}
		else if($this->input->post("clear"))
		{
			$this->session->unset_userdata("search_view_privilege");
		}
		redirect(base_url()."?d=manage&c=user&m=view_privilege");
	}
	function table_edit($data)
	{
		if($this->sess_orderby_user["type"]=="ASC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_212_down_arrow.png">';
		else if($this->sess_orderby_user["type"]=="DESC") $img='<img width="9" src="'.base_url().'images/glyphicons_free/glyphicons/png/glyphicons_213_up_arrow.png">';
		$num_row=$this->getpage+1;
		$html='
				<table class="table table-striped table-bordered fixed-table" id="tabel_data_list">';
		$html.='<thead>
				<th>ลำดับ</th>
				<th>ชื่อผู้ใช้</th>
				<th>ชื่อ-นามสกุล</th>
				<th>กลุ่มผู้ใช้</th>
				<th>อีเมล</th>
				<th class="same_first_td">สถานะผู้ใช้<br/><button type="button" class="cbtn cbtn-green" id="allow-all"><button type="button" class="cbtn cbtn-red" id="disallow-all"></th>
				<th class="same_first_td">รายละเอียด</th>
		';
		$html.='</thead>';
		if(!empty($data))
		{
			foreach ($data AS $dt):
			//<td>'.$num_row.'</td>
			if($dt['user_status']==0)$checkbox='<span class="checkboxFour">
									  		<input type="checkbox" value="'.$dt["username"].'" id="checkboxFourInput'.$dt["username"].'" name="allow_user0[]" class="allow_user0"/>
										  	<label for="checkboxFourInput'.$dt["username"].'"></label>
									  		</span>';
			else $checkbox='<span class="checkboxFour">
					  		<input type="checkbox" value="'.$dt["username"].'" id="checkboxFourInput'.$dt["username"].'" name="allow_user1[]" class="allow_user1" checked/>
						  	<label for="checkboxFourInput'.$dt["username"].'"></label>
					  		</span>';
			$html.='<tr>
					<td>'.$num_row.'</td>
					<td id="user'.$dt["username"].'">'.$dt["username"].'</td>
					<td>'.$dt['titlename'].' '.$dt['firstname'].' '.$dt['lastname'].'</td>		
					<td>'.$dt["group_name"].'</td>
					<td>'.$dt["email"].'</td>
					<td class="same_first_td">'.$checkbox.'</td>
					<td class="same_first_td">'.$this->eml->btn('view','onclick=show_all_data("'.$dt["username"].'")').'</td>
					
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
				<td align="center">'.$this->eml->btn('submitcheck','onclick="show_allow_list();return false;"')." ".
									$this->eml->btn('refreshcheck','onclick="location.reload(true);"').'
				</td>
				<td></td>
				
				</tr>
				</table>';
		$html.=$this->pagination->create_links();
		return $html;
	}
	function set_orderby()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_user",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function set_orderby_view_privilege()
	{
		if($this->input->post("field") && $this->input->post("type"))
		{
			$this->session->set_userdata("orderby_view_privilege",array("field"=>$this->input->post("field"),"type"=>$this->input->post("type")));
		}
	}
	function show_all_data()
	{
		$load=$this->us_model->get_all_data($this->input->post("username"));
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
			$this->session->set_userdata("searchfield_user",$this->input->post("searchfield"));
		}
	}
	function set_searchfield_view_privilege()
	{
		if($this->input->post("searchfield"))
		{
			$this->session->set_userdata("searchfield_view_privilege",$this->input->post("searchfield"));
		}
	}
	function add_privilege()
	{
		$config=array(
	
				array(
						"field"=>$this->lang->line("se_privilege"),
						"label"=>$this->lang->line("t_se_privilege"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_user"),
						"label"=>$this->lang->line("t_se_user"),
						"rules"=>"required"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$se_privilege=array(
					"LB_text"=>$this->lang->line("t_se_privilege"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'cd',
					"S_name"=>$this->lang->line("se_privilege"),
					"S_id"=>$this->lang->line("se_privilege"),
					"S_old_value"=>$this->input->post($this->lang->line("se_privilege")),
					"S_data"=>$this->emm->get_select("tb_privilege","privilege_name"),
					"S_id_field"=>"privilege_id",
					"S_name_field"=>"privilege_name",
					"help_text"=>''
			);
			$se_user=array(
					"LB_text"=>$this->lang->line("t_se_user"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'cd',
					"S_name"=>$this->lang->line("se_user"),
					"S_id"=>$this->lang->line("se_user"),
					"S_old_value"=>$this->input->post($this->lang->line("se_user")),
					"S_data"=>"",
					"S_id_field"=>"",
					"S_name_field"=>"",
					"help_text"=>''
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("เพิ่มสิทธิ์"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"user_tab"=>$this->user_tab(),
					"se_privilege"=>$this->eml->form_select($se_privilege),
					"se_user"=>$this->eml->form_select($se_user)
			);
			$this->load->view("manage/user/add_privilege",$data);
		}
		else
		{
			$data=array(
					"tb_privilege_id"=>$this->input->post($this->lang->line("se_privilege")),
					"tb_user_username"=>$this->input->post($this->lang->line("se_user"))
			);
			$redirect_link="?d=manage&c=user&m=add_privilege";
			$this->us_model->manage_add($data,"tb_user_has_privilege",$redirect_link,$redirect_link,"privilege","เพิ่มสิทธิ์ให้ ".$this->input->post($this->lang->line("se_user"))." สำเร็จ","เพิ่มสิทธิ์ให้ ".$this->input->post($this->lang->line("se_user"))." ไม่สำเร็จ");
		}
	}
	/**
	 * Query user ที่ยังไม่มีสิทธิ์ที่ต้องการเพิ่มให้
	 */
	function add_privilege_get_user()
	{
		$result=$this->us_model->add_privilege_get_user($this->input->post("pid"));
		$data='';
		foreach($result AS $r):
			$data.="<option value='".$r['username']."'>".$r['username']." (".$r['firstname']." ".$r['lastname'].")</option>";
		endforeach;
		echo json_encode(array("user_list"=>$data));
	}
	function delete_privilege()
	{
		$config=array(
		
				array(
						"field"=>$this->lang->line("se_privilege"),
						"label"=>$this->lang->line("t_se_privilege"),
						"rules"=>"required"
				),
				array(
						"field"=>$this->lang->line("se_user"),
						"label"=>$this->lang->line("t_se_user"),
						"rules"=>"required"
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$se_privilege=array(
					"LB_text"=>$this->lang->line("t_se_privilege"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'cd',
					"S_name"=>$this->lang->line("se_privilege"),
					"S_id"=>$this->lang->line("se_privilege"),
					"S_old_value"=>$this->input->post($this->lang->line("se_privilege")),
					"S_data"=>"",
					"S_id_field"=>"",
					"S_name_field"=>"",
					"help_text"=>''
			);
			$se_user=array(
					"LB_text"=>$this->lang->line("t_se_user"),
					"LB_attr"=>$this->eml->span_redstar(),
					"S_class"=>'cd',
					"S_name"=>$this->lang->line("se_user"),
					"S_id"=>$this->lang->line("se_user"),
					"S_old_value"=>$this->input->post($this->lang->line("se_user")),
					"S_data"=>$this->us_model->delete_privilege_get_user(),
					"S_id_field"=>"username",
					"S_name_field"=>"username",
					"help_text"=>''
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head("ลบสิทธิ์"),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"user_tab"=>$this->user_tab(),
					"se_privilege"=>$this->eml->form_select($se_privilege),
					"se_user"=>$this->delete_privilege_user_select($se_user)
			);
			$this->load->view("manage/user/delete_privilege",$data);
		}
		else
		{
			$where=array(
				"tb_privilege_id"=>$this->input->post($this->lang->line("se_privilege")),
				"tb_user_username"=>$this->input->post($this->lang->line("se_user"))
			);
			$this->us_model->delete_privilege_process("tb_user_has_privilege",$where);
		}
	}
	function delete_privilege_get_privilege()
	{
		$result=$this->us_model->delete_privilege_get_privilege($this->input->post("u"));
		$data='';
		foreach($result AS $r):
		$data.="<option value='".$r['privilege_id']."'>".$r['privilege_name']."</option>";
		endforeach;
		echo json_encode(array("privilege_list"=>$data));
	}
	function delete_privilege_user_select($ar)
	{
		$html='
		<div class="form-group">
		<label for="'.$ar['S_name'].'">'.$ar['LB_text'].' '.$ar['LB_attr'].'</label>
		<select class="form-control '.$ar['S_class'].'" id="'.$ar['S_id'].'" name="'.$ar['S_name'].'">
		<option value="">เลือก</option>';
		if($ar['S_data']>0):
			foreach($ar['S_data'] as $ar2):
				if($ar['S_old_value']==$ar2[$ar['S_id_field']]) $selected="selected='selected'";
				else $selected='';
				$html.="<option value='".$ar2['username']."' ".$selected.">".$ar2['username']." (".$ar2['firstname']." ".$ar2['lastname'].")</option>";
			endforeach;
		endif;
		$html.='
		</select>
		<span class="help-block">'.$ar['help_text'].'</span>
		</div>';
		return $html;
	}
	function view_privilege()
	{
		$this->set_default_sess_orderby("view_privilege", array("field"=>"username","type"=>"ASC"));
		//pagination
		$this->load->library("pagination");
		$config['use_page_numbers'] = TRUE;
		$config['base_url']=base_url()."?d=manage&c=user&m=view_privilege";
		//set per_page
		if($this->session->userdata("set_per_page")) $config['per_page']=$this->session->userdata("set_per_page");
		else $config['per_page']=$this->default_perpage;
		
		if(isset($_GET['page']) && $this->check_page_num($_GET['page'])) $this->getpage=(($_GET['page']-1)*$config['per_page']);
		else $this->getpage=0;

		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_view_privilege", "username");
		$search_text=null;
		$search_text=$this->session->userdata("search_view_privilege");
		if($search_text!=null)
		{
			$liketext=$search_text;
			$config['total_rows']=$this->us_model->get_all_numrows("tb_user",$liketext,$searchfield);
			$get_user_list=$this->us_model->get_user_list_view_privilege($config['per_page'],$this->getpage,$liketext);
		}
		else
		{
			$config['total_rows']=$this->us_model->get_all_numrows("tb_user",'',$searchfield);
			$get_user_list=$this->us_model->get_user_list_view_privilege($config['per_page'],$this->getpage);
		}
		$this->pagination->initialize($config);
		
		$data=array(
				"htmlopen"=>$this->pel->htmlopen(),
				"head"=>$this->pel->head("รายการสิทธิ์ผู้ใช้"),
				"bodyopen"=>$this->pel->bodyopen(),
				"navbar"=>$this->pel->navbar(),
				"js"=>$this->pel->js(),
				"footer"=>$this->pel->footer(),
				"bodyclose"=>$this->pel->bodyclose(),
				"htmlclose"=>$this->pel->htmlclose(),
				"user_tab"=>$this->user_tab(),
				"user_table"=>$this->view_privilege_table($get_user_list),
				"manage_search_box"=>$this->pel->manage_search_box($search_text)
		);
		$this->load->view("manage/user/view_privilege",$data);
	}
	function view_privilege_table($user_list)
	{
		$privilege_list = $this->db->select()->from("tb_privilege")
		->order_by("privilege_id")
		->get()->result_array();
		$privilege_id_list = array();
		/*$user=$this->db->select("username,firstname,lastname,tb_titlename.*")->from("tb_user")
		->join("tb_titlename","tb_titlename.titlename_id=tb_user.tb_titlename_id")
		->limit($perpage,$this->getpage)
		->get()->result_array();*/
		/*$html='<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>ชื่อผู้เข้าใช้</th>
						<th>ชื่อ-นามสกุล</th>
						<th>กลุ่มผู้ใช้</th>
						<th>สิทธิ์</th>
					</tr>
				</thead>
				';
		*/
		$html='<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ชื่อผู้ใช้งาน</th>
				';
				foreach ($privilege_list as $p)
				{
					$html.= "<th>".$p["privilege_name"]."</th>";
					array_push($privilege_id_list, $p["privilege_id"]);
				}
		$html.='
						</tr>
					</thead>
				';
		if($user_list!=null)
		{
			foreach ($user_list as $u)
			{
				$privilege=$this->db->select()->from("tb_user_has_privilege")
				->join("tb_privilege","tb_privilege.privilege_id=tb_user_has_privilege.tb_privilege_id")
				->where("tb_user_username",$u['username'])
				->order_by("privilege_id")
				->get();
				$num_rows=$privilege->num_rows();
				$privilege=$privilege->result_array();
				/*$html.='
						<tbody>
						<tr>
							<td rowspan="'.($num_rows+1).'" class="text-center"><strong>'.$u['username'].'</strong></td>
							<td rowspan="'.($num_rows+1).'" class="text-center">'.$u['titlename'].' '.$u['firstname'].' '.$u['lastname'].'</td>
							<td rowspan="'.($num_rows+1).'" class="text-center">'.$u['group_name'].'</td>
						</tr>
						';
				foreach($privilege as $p)
				{
					$html.='
						<tr>
							<td class="text-left">'.$p['privilege_name'].'</td>
						</tr>
						';
				}*/
				$html.='<tbody>
						<tr>
							<td>'.$u["username"].'</td>
						';
						$old_key = -1;
						$count_privilege_id = count($privilege_id_list)-1;
						$count_privilege = count($privilege)-1;
						foreach ($privilege as $key=>$val)
						{
							//หาตำแหน่งของ $val["privilege_id"] ใน array $privilege_id_list
							//order_by privilege_id อยู่แล้ว 
							$find_key = array_search($val["privilege_id"], $privilege_id_list);
							//loop ปริ้นสิทธิ์ที่ไม่มี ก่อนจะปริ้นสิทธิ์ที่มี
							for ($i=1; $i<=$find_key-($old_key+1); $i++)
							{
								//สิทธิ์ที่ไม่มี
								$html .= "<td><i></i></td>";
							}
							//สิทธิ์ที่มี
							$html .= "<td class='text-center'><i class='fa fa-check'></i></td>";
							//บันทึกตำแหน่งล่าสุดของคีย์ที่ใช้
							$old_key = $find_key;
							//ถ้าเป็นตำแหน่งสุดท้ายของสิทธิ์ที่วน
							if($key == $count_privilege)
							{
								//ปริ้นช่องว่างที่เหลือ
								for($i=1; $i<=($count_privilege_id-$old_key); $i++)
								{
									$html.= "<td></td>";
								}
								//reset old_key to default
								$old_key = -1;
							}
						}
				$html.='</tr>';
			}
		}
		$html.='</tbody></table>';
		$html.=$this->pagination->create_links();
		return $html;
	}
}


























