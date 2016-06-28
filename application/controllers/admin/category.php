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
	 * 添加栏目展示模板
	 * @return [type] [description]
	 */
	public function show_tpl(){
		// $this->output->enable_profiler(TRUE);
		// 必须先加载辅助函数
		// 不然会提示表单显示的辅助函数未定义
		// Message: Call to undefined function set_value()
		$this->load->helper('form');
		$this->load->view('admin/add_cate.html');
	}
	/**
	 * 提交已填写的栏目名称
	 * @return [type] [description]
	 */
	public function submit(){
		// 加载验证类库
		$this->load->library('form_validation');
		// 校验
		$status=$this->form_validation->run('category');
		if($status){
			// 输入类的使用
			// 已经进行数据的预处理
			// $a=$this->input->post('cname');
			// $a=$this->input->get('REMOTE_ADDR');
			// $a=$this->input->server('REMOTE_ADDR');
			// echo $a;die;
			// 接收数据
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

	}
	/**
	 * 展示栏目编辑模板
	 * @return [type] [description]
	 */
	public function show_tpl_edit(){
		// 接收对应的cid
		// 参数根据URL实际情况进行变化
		//index.php/category/index/1
		//此时参数应该为3
		//查询到的数据格式为
		//Array
		// (
		//     [0] => Array
		//         (
		//             [cid] => 6
		//             [cname] => 历史
		//         )

		// )
		$cid = $this->uri->segment(3);
		$data['category']=$this->cate->checkById($cid);
		$this->load->helper('form');
		$this->load->view('admin/edit_cate.html',$data);
	}
	/**
	 * 提交已填写的栏目名称
	 * @return [type] [description]
	 */
	public function submit_edit(){
		// 加载验证类库
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
 	