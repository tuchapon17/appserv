<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Condition extends MY_Controller
{
	private $cdm;
	function __construct()
	{
		parent::__construct();
		$this->load->model("manage/condition_model");
		$this->cdm=$this->condition_model;
	}
	function view()
	{
		$get_data=$this->cdm->view_condition();
		$get_data=$get_data[0];
		$data=array(
				"htmlopen"=>$this->pel->htmlopen(),
				"head"=>$this->pel->head("ระเบียบการใช้งาน"),
				"bodyopen"=>$this->pel->bodyopen(),
				"navbar"=>$this->pel->navbar(),
				"js"=>$this->pel->js(),
				"footer"=>$this->pel->footer(),
				"bodyclose"=>$this->pel->bodyclose(),
				"htmlclose"=>$this->pel->htmlclose(),
				"condition_data"=>$get_data
		);
		$this->load->view("front/view_condition",$data);
	}
}