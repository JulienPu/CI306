<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		// echo STYLEPATH . 'index/css/index.css';die;
		// echo base_url() . 'application/public/index/';die;
		$this->load->view('index/home.html');
	}

	/**
	 * 头部分类
	 */
	public function category(){
		$this->load->view('index/category.html');
	}
	/**
	 * 点击更多阅读文章
	 */
	public function article(){
		$this->load->view('index/article.html');
	}
	

}
 	