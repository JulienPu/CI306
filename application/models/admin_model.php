<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_model{
	/**
	 * 检查密码输入
	 */
	public function check($id,$pwd){
		$data =$this->db->where(array('id'=>$id,'pwd'=>$pwd))->get('user')->result_array();
		// $sql=$this->db->last_query();
		// echo $sql;
		// p($data);die;
		 return $data;
	}
	/**
	 * 更新密码
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function update($id,$pwd){
		return $this->db->update('user',array('id'=>$id,'pwd'=>$pwd));
	}
	








}
