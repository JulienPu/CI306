<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->library('session');
		$this->load->model('login_model','login');		
	}
	/**
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		 
		// $data['captcha']=$this->captcha();
		$this->load->view('admin/login.html');

	}
	/**
	 * 生成验证码
	 * @return [string] [图片信息]
	 */
	public function captcha(){
		// 加载辅助函数
		$this->load->helper('captcha');
		// 配置验证码参数
		$config=array(
		    'img_path'  => './application/captcha/',
		    'img_url'   => base_url('application/captcha/'),
		    'img_width' => 80,
		    'img_height'    => 30,
		    'word_length'   => 4,
		    'font_size' => 22,
		    'pool'      => '0123456789abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ',
		 );

		 $captcha=create_captcha($config);
		 $data['captcha']=$captcha['filename'];
		 $_SESSION['captcha']=$captcha['word'];
		 echo $data['captcha'];
	}
	/**
	 * [check 登录验证]
	 * @return [type] [description]
	 */
	public function check(){
		// p($_SERVER);die;
		// 接收表单数据
		 $data['user']=$this->input->post('username');
		 $data['pwd']=md5($this->input->post('passwd'));
		 // $data['pwd']=$this->input->post('passwd');
		 $captcha=$this->input->post('captcha');
		 // if (strtolower($captcha)!==strtolower($_SESSION['captcha'])) {
		 // 	e('验证码错误');
		 // }
		 // p($data);die;
		 $check=$this->login->checkLogin($data);
		 if (!$check) {
		 	e('用户名或者密码错误！');
		 }
		 // p($check);die;
		 $id=$check[0]['id'];
		 $update['loginTime']=time();
		 // $update['loginIp']=$_SERVER['REMOTE_ADDR'];
		 $IP=$_SERVER['REMOTE_ADDR'];
		 $update['loginIp']=ip2long($IP);
		 // p($update);die;
		 // 验证通过，更新登录IP以及登录时间
		 $result=$this->login->updateLogin($id,$update);
		 if ($result) {
		 	// 用户信息持久化
		 	// $res['user']=$data['user'];
		 	// $res['ip']=$_SERVER['REMOTE_ADDR'];

		 	$version=$_SERVER['SERVER_SOFTWARE'];

		 	$PHP=substr($version, strpos($version,'PHP'));
			 // $this->load->library('session');		 
			// $res=array(
		 // 		'user'=>$data['user'],
		 // 		'PHP'=>$PHP,
		 // 		);
		 // 	$this->session->set_userdata($res);
		 	$_SESSION['user']=$data['user'];
		 	$_SESSION['PHP']=$PHP;
		 	// p($_SESSION);die;
		 	// s('admin.php/admin/index','登录成功');
		 	$this->load->view('admin/index.html');
		 }else{
		 	e('登录失败，请重试！');
		 }
	}
	
	

	










}
 	