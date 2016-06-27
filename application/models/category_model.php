<?php defined('BASEPATH') OR exit('No direct script access allowed');

// 必须使用_model后缀，不然会与控制器冲突
class Category_model extends CI_model{
	/**
	 * 
	 */
	public function add($data){
		$this->db->insert('category',$data);		
	}
	/**
	 * 查询数据库的全部栏目 
	 * [check description]
	 * @return [array] [所有的栏目]
	 */
	public function check(){
		// $this->db->get('')连接数据库
		// result_aray（）以数组的方式返回结果集
		// result返回对象格式的数据，调用的样式不一样
		$data=$this->db->get('category')->result_array();
		return $data;
	}
	/**
	 * 查询数据库的cid对应的栏目 
	 * [check description]
	 * @return [array] [单个栏目信息]
	 */
	public function checkById($cid){
		// where要放在get之前
		// 不然会出现where函数未定义
		$data=$this->db->where(array('cid'=>$cid))->get('category')->result_array();
		return $data;
	}
	/**
	 * 查询数据库的cid对应的栏目 
	 * [check description]
	 * @return [array] [单个栏目信息]
	 */
	public function update($cid,$data){
		$this->db->update('category',$data,array('cid'=>$cid));
	}
	/**
	 * 删除栏目
	 */
	public function delete($cid){
		$this->db->delete('category',array('cid'=>$cid));
	}


}
