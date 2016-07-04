<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {
	/**
	 * 构造函数，自动载入QR模型
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('category_model','cate');
	}
	/**
	 * 查看栏目
	 */
	public function index(){
		// 保存数据时以数组的形式进行保存
		$data['category']=$this->cate->check();
		$this->load->view('admin/cate.html',$data);
	}
	/**
	 * 添加栏目
	 * @return [type] [description]
	 */
	public function add(){
		if ($_SERVER['REQUEST_METHOD']=='POST') {

			// 加载验证类库
			$this->load->library('form_validation');
			// 校验
			$status=$this->form_validation->run('category');
			if($status){
				$data=array(
					// 必须使用数据表字段
					'cname'=>$this->input->post('cname')
				);
				$this->cate->add($data);
				s('admin.php/category/index','添加成功');
			}else{
				$this->load->helper('form');
				$this->load->view('admin/add_cate.html');
			}
		}else{
			$this->load->helper('form');
			$this->load->view('admin/add_cate.html');
		}
	}
	/**
	 * 栏目编辑
	 * @return [type] [description]
	 */
	public function edit(){
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$this->load->library('form_validation');
			// 校验
			$status=$this->form_validation->run('category');
			if($status){
				// 将修改后的栏目信息用来更新数据库			

				$cid=$this->input->post('cid');
				$cname=$this->input->post('cname');
				$data=array(
					'cname'=>$cname
					);

				$this->cate->update($cid,$data);
				s('admin.php/category/index','编辑成功');
			}else{
				$this->load->helper('form');
				$this->load->view('admin/edit_cate.html');
			}

		}else{
			$cid = $this->uri->segment(3);
			$data['category']=$this->cate->checkById($cid);
			$this->load->helper('form');
			$this->load->view('admin/edit_cate.html',$data);
		}
		
	}
	/**
	 * 
	 */
	public function delete(){
		// 通过地址栏提交的参数
		// 使用sement函数进行解析
		$cid = $this->uri->segment(3);
		$this->cate->delete($cid);
		s('admin.php/category/index','删除成功');

	}
	










}
 	