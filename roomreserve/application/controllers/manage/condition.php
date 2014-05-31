<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Condition extends MY_Controller
{
	private $cdm;
	function __construct()
	{
		parent::__construct();
		$this->fl->check_group_privilege(array("02"));
		$this->load->model("manage/condition_model");
		$this->cdm=$this->condition_model;
	}
	function edit()
	{
		$config=array(
				array(
						"field"=>$this->lang->line("te_condition"),
						"label"=>$this->lang->line("t_te_condition"),
						"rules"=>""
				)
		);
		$this->frm->set_rules($config);
		$this->frm->set_message("rule","message");
		if($this->frm->run() == false)
		{
			$te_condition=array(
					"LB_text"=>$this->lang->line("t_te_condition"),
					"LB_attr"=>$this->eml->span_redstar(),
					"IN_class"=>'',
					"IN_name"=>$this->lang->line("te_condition"),
					"IN_id"=>$this->lang->line("te_condition"),
					"IN_attr"=>'rows="20"',
					"help_text"=>""
			);
			$data=array(
					"htmlopen"=>$this->pel->htmlopen(),
					"head"=>$this->pel->head($this->lang->line("ti_edit_condition")),
					"bodyopen"=>$this->pel->bodyopen(),
					"navbar"=>$this->pel->navbar(),
					"js"=>$this->pel->js(),
					"footer"=>$this->pel->footer(),
					"bodyclose"=>$this->pel->bodyclose(),
					"htmlclose"=>$this->pel->htmlclose(),
					"condition_tab"=>$this->condition_tab(),
					"te_condition"=>$this->eml->form_textarea($te_condition)
			);
			$this->load->view("manage/condition/edit_condition",$data);
		}
		else
		{
			$prev_url=$_SERVER['HTTP_REFERER'];
			$session_edit_id="edit_condition_id";
			$set=array(
					"condition"=>$this->input->post("textarea_condition"),
					"last_modified_by"=>$this->session->userdata("rs_username")
			);
			$where=array(
					"condition_id"=>$this->session->userdata($session_edit_id)
			);
			//add event
			$this->add_event("แก้ไข".$this->lang->line("text_condition"));
			$this->cdm->manage_edit(
					$set,
					$where,
					"tb_condition",
					$session_edit_id,
					"edit_condition",
					"แก้ไข".$this->lang->line("text_condition")."สำเร็จ",
					"แก้ไข".$this->lang->line("text_condition")."ไม่สำเร็จ",
					"?d=manage&c=condition&m=edit",
					$prev_url
					);
		}
	}
	function condition_tab()
	{
		$html='
		<ul class="nav nav-tabs" id="manage_tab">
			<!-- data-toggle มี pill/tab -->
			';
		$html.='
			<li><a href="#"  id="edit">แก้ไข'.$this->lang->line("text_condition").'</a></li>
			';
		$html.='</ul>';
		return $html;
	}
	function load_condition()
	{
		$load=$this->cdm->load_condition($this->input->post("tid"));
		echo json_encode($load[0]);
	}
	
}