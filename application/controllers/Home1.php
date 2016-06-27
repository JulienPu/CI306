<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
    // var $base;
    // var $css;

 //    function Start(){
	//     parent::Controller();
	//     $this->base = $this->config->item('base_url');
	//     $this->css = $this->config->item('css');
	// }

	// function hello($name){
	//     $data['css'] = $this->css;
	//     $data['base'] = $this->base;
	//     $data['mytitle'] = 'Welcome to this site';
	//     $data['mytext'] = "Hello, $name, now we're getting dynamic!";
	//     $this->load->view('testView', $data);
	// }
	/**
	*由于视图文件也是以.php为后缀，所以极易与控制器文件混淆，或者放错位置。当出现
	*cannot load this required file 时，检查。
	 */
	public function index(){
		$data = array(
			'head' => 'tete', 
			'index' => 'age', 
			'foot' => 'pied', 
			);
		$this->load->view('home/head');
		$this->load->view('home/index');
		$this->load->view('home/foot');
	}
	// public function 
}