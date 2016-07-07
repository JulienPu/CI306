<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('account_model','account');
	}
	/**
	 * Index Page for this controller.
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function login(){
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$data['phone']=$this->input->post('mobile');
			$data['pwd']=md5($this->input->post('passwd'));
			$captcha=$this->input->post('validCode');
			 if (strtolower($captcha)!==strtolower($_SESSION['member'])) {
			 	e('验证码错误');
			 }else{
				$result=$this->account->check_login($data);
			 	if ($result) {
			 		s('index.php/home/index','恭喜，登录成功');
			 	}else{
			 		e('登录失败，请重试！');
			 	}
			 }
		}else{
			$this->load->view('index/login.html');
		}
	}
	/**
	 * [login description]
	 * @return [type] [description]
	 */
	public function register(){
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$data['phone']=$this->input->post('mobile');
			$data['pwd']=md5($this->input->post('passwd'));
			// $data['pwd']=$this->input->post('passwd');
			$captcha=$this->input->post('validCode');
			 if (strtolower($captcha)!==strtolower($_SESSION['member'])) {
			 	e('验证码错误');
			 }else{



				$phone_result=$this->account->check_phone($data['phone']);
			 	if ($phone_result) {
			 		e('手机号已注册请直接登录');
			 	}
			 	$result=$this->account->add($data);
			 	if ($result) {
			 		s('account/login','恭喜，注册成功');
			 	}else{
			 		e('注册失败，请重试！');
			 	}
			 }
		}else{
			$this->load->view('index/register.html');
		}
			
	}
	/**
	 * 生成验证码
	 * @return [string] [图片信息]
	 */
	public function captcha(){
		// 加载辅助函数
		$this->load->helper('captcha');
		// 配置验证码参数
		$path='./application/captcha/';
		$config=array(
		    'img_path'  => $path,
		    'img_url'   => base_url('/application/captcha/'),
		    'img_width' => 80,
		    'img_height'    => 30,
		    'word_length'   => 4,
		    'font_size' => 22,
		    'pool'      => '0123456789ab',
		 );

		 $captcha=create_captcha($config);

		 $_SESSION['member']=$captcha['word'];
		 $data['captcha']=base_url('application/captcha').'/'.$captcha['filename'];
		 // $data['captcha'].=$captcha['filename'];
		 echo json_encode($data);
		 // p($data);die;
	}

}
 	