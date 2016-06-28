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
		if(!$user) {
			redirect('admin.php/login/index');
		}
	}







	










}
 	