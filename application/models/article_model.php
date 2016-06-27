<?php defined('BASEPATH') OR exit('No direct script access allowed');

// 必须使用_model后缀，不然会与控制器冲突
class Article_model extends CI_model{
	/**
	 * 发表文章
	 */
	public function add($data){
		$this->db->insert('article',$data);
	}
	/**
	 * 展示现有的文章是数据
	 */
	public function check(){
		// $data=$this->db->get('article')->result_array();
		$data=$this->db->select('id,cname,title,abstract,pubdate')->from('article as a')->join('category as c','a.cid=c.cid')->order_by('id','desc')->get()->result_array();
		// p($data);die;
		return $data;
	}
	/**
	 * 修改文章信息
	 */
	public function update($id){
		$data=$this->db->where(array('id'=>$id))->get('article')->result_array();
		// p($data);die;
		return $data;
	}









}
