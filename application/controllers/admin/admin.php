<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model','admin');
	}
	/**
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		// echo base_url() . 'admin.php/admin/copy';die;
		// echo base_url() . 'application/public/admin/';die;
		// echo STYLEPATH . 'index/css/index.css';die;
		// echo base_url() . 'application/public/index/';die;
		$this->load->view('admin/index.html');
	}
	/**
	 * 右侧的版权栏iframe
	 * @return [type] [description]
	 */
	public function copy(){
		// echo base_url() . 'application/public/admin/';die;
		// echo STYLEPATH . 'index/css/index.css';die;
		// echo base_url() . 'application/public/index/';die;
		// echo "string";die;
		$this->load->view('admin/copy.html');
	}
	/**
		 * 修改密码
		 * @return [type] [description]
		 */
	public function changePwd(){
		if ($_SERVER['REQUEST_METHOD']=='POST') {

			$this->load->library('form_validation');
			$status=$this->form_validation->run('changePwd');

			if ($status) {
				$pwd1=md5($this->input->post('passwd'));
				$pwd2=md5($this->input->post('passwdF'));
				$uid=$this->session->userdata('uid');
				$result0=$this->admin->check($uid,$pwd1);
				// p($result0);die;
				if (!$result0) {
					//原始密码有误
					// $this->load->view('admin/change_passwd.html');
					e('原始密码输入有误');
				}else{
					//更新密码
					//两次新旧密码一致
					if ($pwd1===$pwd2) {
						e('密码与原来一致，请重新设置');
					}else{
						$result1=$this->admin->update($uid,$pwd2);
						// 更新失败
						if (!$result1) {
							e('更新失败，请重试');
						}else{
							$this->load->view('admin/copy.html');
						}
					}
					
				}
			}else{
				$this->load->view('admin/change_passwd.html');
			}
			// echo $pwd;
			// echo $rePwd;
		}else{
			$this->load->view('admin/change_passwd.html');
				
		}
	}

	










}
 	