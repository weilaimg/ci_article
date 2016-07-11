<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 文章管理模型
 */
class Article_model extends CI_model{
	/**
	 * 发表文章
	 */ 
	public function add($data){
		$this -> db -> insert ('article',$data);
	}

	/**
	 * 查看文章 
	 */
	public function article_category()
	{
		$data = $this -> db -> select ('aid,title,cname,time')-> from ('article')->join('category','article.cid=category.cid')->order_by('aid','asc')->get()->result_array();
		return $data;
	}

	/**
	 * 首页查询文章 
	 */
	public function check(){
		$data['art'] = $this -> db ->limit(3)-> select ('aid,thumb,title,info')->order_by('time','desc')->get_where('article',array('type'=>0))->result_array();
		$data['hot'] = $this -> db -> select ('aid,thumb,title,info')->order_by('time','desc')->get_where('article',array('type'=>1))->result_array();
		return $data;
	}


	/**
	 * 查询文章标题
	 */

	public function title(){
		$data = $this -> db -> limit(6)->select ('title,aid')->order_by('time','desc')->get('article')->result_array();
		return $data;
	}














	
}