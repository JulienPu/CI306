<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_model{
	/**
	 * 检查账号密码
	 * @return [type] [description]
	 */
	public function checkLogin($data){
		// $result=$this->db->where($data)->get('user')->result_array();
		$result=$this->db->select('id')->from('user')->where($data)->get()->result_array();
		return $result;
		// var_dump($result);die;
	}
	/**
	 * 更新登录信息
	 */
	public function updateLogin($id,$data){
		$result=$this->db->update('user',$data,array('id'=>$id));
		return $result;

	}





}