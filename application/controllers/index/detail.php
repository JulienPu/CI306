<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
	/**
	 * 
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('detail_model','detail');
	}

	/**
	 * Index Page for this controller.
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$id=$this->uri->segment(3);

		$data['detail']=$this->detail->checkById($id);
		$data['recent_title']=$this->detail->recent_title();
		$this->detail->update_hit($id);
		// p($data);
		$this->load->view('index/details.html',$data);
	}
	

}
 	