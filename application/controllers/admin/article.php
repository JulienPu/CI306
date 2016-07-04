<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {
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
		$data['article']=$this->article->check();
		$this->load->view('admin/check_article.html',$data);
	}
	/**
	 * Index Page for this controller.
	*发表模板展示
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function issue(){
		$data['category']=$this->cate->check();
		// 表单提交逻辑
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$info=$this->deal_submit($data);
			if ($info) {
				// p($info);die;
				$result=$this->article->add($info);
				if ($result) {
					s('admin.php/article/index','文章添加成功');
				}else{
					e('添加失败，请重试！');				
				}
			}
		}else{
			// 首次模板展示逻辑
			$this->load->helper('form');
			$this->load->view('admin/article.html',$data);
		}
	}		
	
	/**
	 * 编辑文章
	 */
	public function edit(){
		$data['category']=$this->cate->check();
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$info=$this->deal_submit($data);
			if ($info) {
				// 返回处理过的表单信息，进行数据库更新操作
				$id=$this->input->post('id');
								// p($info);die;

				$result=$this->article->update($id,$info);
				if ($result) {
					s('admin.php/article/index','文章修改成功');
				}else{
					e('修改失败，请重试！');				
				}
			}
		}else{
			$data['category']=$this->cate->check();
			$id=$this->uri->segment(3);
			$data['article']=$this->article->checkByID($id);
			$this->load->helper('form');
			$this->load->view('admin/edit_article.html',$data);
		}

	}
	/**
	 * 删除文章,删除后的文章在废纸篓中可以查看到
	 */
	public function delete(){
		$id=$this->uri->segment(3);
		$result=$this->article->delete($id);
		if ($result) {
			s('admin.php/article/index','文章修改成功');
		}else{
			e('删除失败，请重试！');				
		}
	}
	/**
	 * [recovery 展示数据表中已删除文章]
	 * @return [type] [description]
	 */
	public function recovery_tpl(){
		$data['article']=$this->article->check_deleted();
		$this->load->view('admin/recovery_article.html',$data);
	}
	/**
	 * [recovery 恢复数据表中已删除文章]
	 * @return [type] [description]
	 */
	public function recovery_edit(){
		$id=$this->uri->segment(3);
		$result=$this->article->recovery_deleted($id);
		if ($result) {
			s('admin.php/article/index','文章修改成功');
		}else{
			e('恢复失败，请重试！');				
		}
	}
	/**
	 * $data 数组 分类列表
	 * $info 为处理后的表单信息
	 * 验证未通过时返回空
	 * 处理提交的文章数据
	 */
	public function deal_submit($data){
		//上传文件以及处理原图生成缩略图
		$upload=$this->pic_upload();
		$orginal_path=$upload['full_path'];
		$this->deal_thumb($orginal_path);
			// ①载入表单验证类
		$this->load->library('form_validation');
		$status=$this->form_validation->run('article');

		if($status){
			
			// 接收数据
			$title    =$this->input->post('title');
			$type     =$this->input->post('type');
			$cid      =$this->input->post('cid');
			$abstract =$this->input->post('abstract');
			$content  =$this->input->post('content');
			// 保存上传原图的文件信息
			// 使用缩略图时直接拼接
			$thumb    =$upload['raw_name'].'_thumb'.$upload['file_ext'];
			$pubdate  =time();

			$info=array(
				'title'=>$title,
				'type'=>$type,
				'cid'=>$cid,
				'abstract'=>$abstract,
				'content'=>$content,
				'thumb'=>$thumb,
				'pubdate'=>$pubdate,
				);
			return $info;
		}else{
			// 禁用缓存，解决多次提交后页面过期的问题
			header("Cache-Control: no-cache, must-revalidate");
			$this->load->helper('form');
			$this->load->view('admin/article.html',$data);
			return ;
		}
	}
	/**
	 * 处理文件上传
	 * @return [数组] [description]
	 *    [file_name] => 14673412181204.jpg
	 *    [file_path] => D:/web/CI306/application/upload/
	 *    [full_path] => D:/web/CI306/application/upload/14673412181204.jpg
	 */
	public function pic_upload(){
		// 配置上传类的参数
		$config['upload_path'] = './application/upload';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '2048';
		$config['file_name'] = time().mt_rand(1000,9999);
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
		return $upload;
	}
	/**
	 * 处理缩略图
	 * @return [void] [description]
	 */
	public function deal_thumb($path){
		// echo $path;die;
		// 处理缩略图
		$arr['image_library']  = 'gd2';
		$arr['source_image']   = $path;
		$arr['maintain_ratio'] = TRUE;
		$arr['width']          = 100;
		$arr['height']         = 75;
		$arr['create_thumb'] = TRUE;

		$this->load->library('image_lib', $arr);
		// 成功时返回true
		// 缩略图的保存路径与上传后的原图路径一致
		$thumb=$this->image_lib->resize();
		// 生成缩略图时发生错误，进行提示
		$error=$this->image_lib->display_errors();
		if ($error) {
			e($error);
		}
		if (!$thumb) {
			e('生成缩略图失败');
		}
	}









}
 	