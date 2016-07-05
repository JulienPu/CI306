<?php defined('BASEPATH') OR exit('No direct script access allowed');

// 
class Detail_model extends CI_model{
	/**
	 * 展示文章信息
	 */
	public function checkById($id){
		$data=$this->db->select()->from('article as a')->join('category as c','a.cid=c.cid')->where(array('a.id'=>$id))->get()->result_array();
		// 处理缩略图文件，以获得原图的文件名	
		$thumb=$data[0]['thumb'];
		$pos1=strpos($thumb,'.');
		$pos2=strpos($thumb,'_');
		$ext=substr($thumb,$pos1);
		$org=substr($thumb,0,$pos2);
		$thumb=$org.$ext;
		$data[0]['thumb']=$thumb;
		return $data;
		 
	}
	/**
	 * 更新点击量
	 */
	public function update_hit($id){
		 // $this->db->update('article',array('hits'=>'hits+1'),array('id'=>$id));
		 // echo $this->db->last_query();die;
		 $sql="UPDATE `hd_article` SET hits= hits+1 WHERE `id` = ".$id;
		 // echo $sql;die;
		 $this->db->query($sql);

		 
	}
	/**
	 * 显示最近五篇文章的标题
	 */
	public function recent_title(){
		 return $this->db->select('id,title')->order_by('id','desc')->get('article',5)->result_array();	
	}






}
