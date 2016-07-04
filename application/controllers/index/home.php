<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	/**
	 * 
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model','home');
	}

	/**
	 * Index Page for this controller.
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$data['recent'] =$this->home->check_recent();
		$data['hot']    =$this->home->check_hot();
		$data['title']    =$this->home->check_title();
		$this->load->view('index/home.html',$data);
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
 	