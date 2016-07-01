<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * 登录管理
	 * @return [type] [description]
	 */
	public function __construct(){
		parent::__construct();
		$user = $this->session->userdata('user');
		$isLogin = $this->session->userdata('isLogin');
		// if(!$user||!$isLogin) {
		if(!$user) {
			// redirect  CI定义的URL辅助函数
			// 第二个参数可以使用auto,location,以及refresh
			redirect(base_url('admin.php/login/index'),'location');
		}
	}







	










}
 	