<?php defined('BASEPATH') OR exit('No direct script access allowed');

// 必须使用_model后缀，不然会与控制器冲突
class Article_model extends CI_model{
	/**
	 * 返回true or false
	 * 添加文章
	 */
	public function add($data){
		return $this->db->insert('article',$data);
	}
	/**
	 * 展示现有所有未删除的文章的信息
	 */
	public function check(){
		// $data=$this->db->get('article')->result_array();
		$data=$this->db->select('id,cname,title,abstract,pubdate')->from('article as a')->join('category as c','a.cid=c.cid')->order_by('id','desc')->where(array('is_delete'=>'0'))->get()->result_array();
		// p($data);die;
		return $data;
	}
	/**
	 * 展示现有所有已删除的文章的信息
	 */
	public function check_deleted(){
		// $data=$this->db->get('article')->result_array();
		$data=$this->db->select('id,cname,title,abstract,pubdate')->from('article as a')->join('category as c','a.cid=c.cid')->order_by('id','desc')->where(array('is_delete'=>'1'))->get()->result_array();
		// p($data);die;
		return $data;
	}
	/**
	 * 展示特定文章表单信息
	 */
	public function checkByID($id){
		$data=$this->db->select('a.id,a.cid,cname,title,abstract,content,thumb,type,pubdate')->where(array('id'=>$id))->from('article as a')->join('category as c','a.cid=c.cid')->order_by('id','desc')->get()->result_array();
		// p($data);die;
		return $data;
	}
	/**
	 * 修改文章信息
	 */
	public function update($id,$data){
		// p($data);die;
		$result=$this->db->update('article',$data,array('id'=>$id));
		// echo $this->db->last_query();die;
		return $result;
	}
	/**
	 * 恢复已删除的文章
	 */
	public function recovery_deleted($id){
		$result=$this->db->update('article',array('is_delete'=>'0'),array('id'=>$id));
		return $result;
	}
	/**
	 * 删除文章
	 */
	public function delete($id){
		$result=$this->db->update('article',array('is_delete'=>'1'),array('id'=>$id));
		return $result;
	}









}
