<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 
class Home extends CI_Controller {

	public function index(){
		$this -> output ->enable_profiler(TRUE);
		//echo base_url().'style/index';
		//echo site_url() . '/index/home/category';

		$this -> load -> model ('article_model','art');
		$data = $this -> art -> check();

		$this -> load -> model('category_model','cate');
		$data['category'] = $this -> cate -> limit_category(4);

		$data['title'] = $this -> art -> title();


		$this -> load -> view('index/home.html',$data);
	}


	public function category(){

		$this -> load -> view ('index/category.html');

	}

	public function article(){
		$this -> load -> view ('index/article.html');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */