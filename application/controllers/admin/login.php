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
 		// $user=$this->session->userdata('user');
 		// echo 1;die;
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
		 $_SESSION['captcha']=$captcha['word'];
		 $data['captcha']=base_url('application/captcha').'/'.$captcha['filename'];
		 // $data['captcha'].=$captcha['filename'];
		 echo json_encode($data);
		 // p($data);die;
		 // p($data);die;
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
		 if (strtolower($captcha)!==strtolower($_SESSION['captcha'])) {
		 	e('验证码错误');
		 }
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
		 	//删除作废的验证码图片
		 	$this->deleteCaptcha();
		 	// 用户信息持久化
		 	// $res['user']=$data['user'];
		 	// $res['ip']=$_SERVER['REMOTE_ADDR'];

		 	$version=$_SERVER['SERVER_SOFTWARE'];

		 	$PHP=substr($version, strpos($version,'PHP'));
			 // $this->load->library('session');		 
			$res=array(
		 		'user'=>$data['user'],
		 		'isLogin'=>TRUE,
		 		'PHP'=>$PHP,
		 		'uid'=>$id,
		 		);
		 	$this->session->set_userdata($res);
		 	redirect(base_url('admin.php/admin/index'));
		 }else{
		 	e('登录失败，请重试！');
		 }
	}
	/**
	 * [logout 退出登录]
	 * @return [type] [description]
	 */
	public function logout(){
		$this->session->sess_destroy();
		s('admin.php/login/index','退出成功');
	}
	/**
	 * 删除过期的验证码图片
	 */
	public function deleteCaptcha(){
		$directory='./application/captcha/';
		$mask = $directory."*.jpg";
		if (glob($mask)) {
			//glob()返回一个包含有匹配文件／目录的数组。如果出错返回 FALSE。 
			//array_map()每一个数组元素都经过回调函数处理
			array_map( "unlink", glob($mask));
		}
	}
	

	










}
 	