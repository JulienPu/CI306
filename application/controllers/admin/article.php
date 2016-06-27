<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
	/**
	 * 构造函数实例化模型
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('article_model','article');
		$this->load->model('category_model','cate');
	}
	/**
	 * Index Page for this controller.
	 *文章列表展示
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		// $this->load->library('pagination');

		// $totalRow=$this->db->count_all_results('article');
		// echo $totalRow;die;
		// $RowsPerPage=2;

		// $config['base_url'] = base_url('admin.php/article/index');
		// $config['total_rows'] =$totalRow;
		// $config['per_page'] = $RowsPerPage;

		// $this->pagination->initialize($config);

		// echo $this->pagination->create_links();
		$data['article']=$this->article->check();
		$this->load->view('admin/check_article.html',$data);
	}
	/**
	 * Index Page for this controller.
	*发表模板展示
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function show_tpl(){
		$this->load->helper('form');
		$data['category']=$this->cate->check();
		$this->load->view('admin/article.html',$data);
	}
	/**
	 * 提交文章
	 * @return [type] [description]
	 */
	public function issue(){
		// 配置上传类的参数
		$config['upload_path'] = './application/upload';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '2048';
		$config['file_name'] = time().mt_rand(1000,9999);
		// $config['max_width'] = '1920';
		// $config['max_height'] = '1080';
		// 加载上传类
		$this->load->library('upload',$config);
		// 设置表单上传文件的字段
		$status=$this->upload->do_upload('thumb');
		// 未选择文件，进行提示
		if (!$status) {
			e('请上传图片');
		}
		// 上传时发生错误，进行提示
		$error=$this->upload->display_errors();
		if ($error) {
			e($error);
		}
		// 上传成功，接收返回的文件信息
		$upload=$this->upload->data();
		// p($upload);die;
		
		// 处理缩略图
		$arr['image_library'] = 'gd2';
		$arr['source_image'] = $upload['full_path'];
		$arr['maintain_ratio'] = TRUE;
		$arr['width']     = 200;
		$arr['height']   = 150;
		// 在文件上传时使用了config数组，这里为了防止冲突，将数组取名修改一下
		$this->load->library('image_lib', $arr);
		// 成功时返回true
		// 缩略图的保存路径与上传后的原图路径一致
		$thumb=$this->image_lib->resize();
		// 生成缩略图时发生错误，进行提示
		$error_thumb=$this->image_lib->display_errors();
		if ($error_thumb) {
			e($error_thumb);
		}
		if (!$thumb) {
			e('生成缩略图失败');
		}
			// ①载入表单验证类
		$this->load->library('form_validation');
		// ②设置校验规则
		// 可以单个配置也可以创建单独的form_valaditon文件进行统一设置，便于多次使用
		// $this->form_validation->set_rules('title','文章标题','required|min_length[5]');
		// $this->form_validation->set_rules('type','类型','required|integer');
		// $this->form_validation->set_rules('cid','栏目','integer');
		// $this->form_validation->set_rules('abstract','摘要','required|max_length[110]');
		// $this->form_validation->set_rules('content','内容','required|max_length[2000]');
		// san验证
		// 展示错误信息，则需要在展示表单的时候加载辅助函数
		$status=$this->form_validation->run('article');
		if($status){
			// 接收数据
			$title    =$this->input->post('title');
			$type     =$this->input->post('type');
			$cid      =$this->input->post('cid');
			$abstract =$this->input->post('abstract');
			$content  =$this->input->post('content');
			$thumb    =$upload['file_name'];
			$pubdate  =time();

			$data=array(
				'title'=>$title,
				'type'=>$type,
				'cid'=>$cid,
				'abstract'=>$abstract,
				'content'=>$content,
				'pubdate'=>$pubdate,
				);
			// p($data);die;
			$this->article->add($data);
			s('admin.php/article/index','文章添加成功');
		}else{
			// 重新加载表单
			// 但是要进行处理，以保证用户之前输入的数据不丢失
			// 使用set_value（field）；
			// 使用form_error（field）；
			$this->load->helper('form');
			$this->load->view('admin/article.html');
		}
	}
	/**
	 * 编辑文章
	 */
	public function edit(){
		$id=$this->uri->segment(3);
		$data['article']=$this->article->update($id);
		// p($data);die;
		$this->load->helper('form');
		$this->load->view('admin/edit_article.html',$data);
	}
	/**
	 * 提交编辑文章
	 */
	public function submit(){
		$this->load->library('form_validation');
		$status=$this->form_validation->run('article');
		if($status){
			echo 'bingo!!';
		}else{
			$this->load->helper('form');
			$this->load->view('admin/edit_article.html');
		}
	}
	/**
	 * 删除文章
	 */
	public function delete(){

	}










}
 	