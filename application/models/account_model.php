<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_model{
	/**
	 * 用户注册
	 */
	public function add($data){
		$result=$this->db->insert('member',$data);
		return $result;

	}
	/**
		 * 用户注册,
		 * 检查手机号是否已注册
		 */
	public function check_phone($phone){
		$result=$this->db->where(array('phone'=>$phone))->get('member')->result_array();
		// p($result);
		return $result;

	}

	/**
	 * 登录检验
	 */
	public function check_login($data){
		return $this->db->where($data)->get('member')->result_array();
	}



}