<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_model{
	/**
	 * 展示最新添加的五篇文章
	 * @return [type] [description]
	 */
	public function check_recent(){
		return $this->db->select('id,title,thumb,abstract')->from('article')->limit(5)->get()->result_array();
	}
	/**
	 * 展示热门文章
	 * @return [type] [description]
	 */
	public function check_hot(){
		return $this->db->select('id,title,thumb,abstract')->from('article')->where(array('type'=>'2'))->limit(5)->get()->result_array();
	}
	/**
	 * 展示文章标题
	 * @return [type] [description]
	 */
	public function check_title(){
		$data=$this->db->select('id,title,hits')->order_by('hits','desc')->get_where('article',array(),10)->result_array();
		 // echo $this->db->last_query();die;
		return $data; 

	}




}