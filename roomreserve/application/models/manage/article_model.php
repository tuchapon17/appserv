<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article_model extends MY_Model
{
	private $sess_orderby_article;
	public function __construct()
	{
		parent::__construct();
	}
	function set_session()
	{
		if($this->session->userdata("orderby_article"))
			$this->sess_orderby_article=$this->session->userdata("orderby_article");
	}
	function get_article_list($perpage,$getpage=0,$liketext='')
	{
		$this->set_session();
		$orderby_filed=$this->sess_orderby_article["field"];
		$orderby_type=$this->sess_orderby_article["type"];
		//field ที่ค้นหา
		$searchfield=$this->check_searchfield("searchfield_article", "article_name");
		
		$sql_select="at.*,att.article_type_name";
		$table_name="tb_article as at";
		if($liketext!='')
		{
			$query=$this->db->select($sql_select,false)->from($table_name)->join("tb_article_type as att","att.article_type_id=at.tb_article_type_id")->like($searchfield,$liketext,"both")->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)->limit($perpage,$getpage)->get();
		}
		else
		{
			$query=$this->db->select($sql_select,false)->from($table_name)->join("tb_article_type as att","att.article_type_id=at.tb_article_type_id")->order_by("CONVERT(".$orderby_filed." USING ".$this->mysql_charset.")",$orderby_type)->limit($perpage,$getpage)->get();
		}
		$num_rows=$query->num_rows();
		if($num_rows>0)
		{
			return $query->result_array();
		}
		else return false;
	}
	function load_article($id)
	{
		//for json
		//set session for update
		$this->session->set_userdata("edit_article_id",$id);
		$this->db->select()->from("tb_article")->where("article_id",$id)->limit(1);
		return $this->db->get()->result_array();
	}
}