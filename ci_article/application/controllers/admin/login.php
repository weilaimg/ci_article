<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	public function index () {
		//载入验证码辅助函数
		$this -> load -> helper('captcha');

		$speed = 'fdjsafhdskjafhlsda123213238978';
		$word = '';
		for ($i = 0 ; $i < 1; $i++)
		{
			$word .= $speed[mt_rand(0,strlen($speed)-1)];
		}
		// echo $word;die;
		//配置项
		$vals = array(
			'word' => $word,
			'img_path' => './captcha/',
			'img_url' => base_url() . '/captcha/',
			'img_width' => 80,
			'img_height' => 25,
			'expiration' =>60,
			); 
		//创建验证码
		$cap = create_captcha($vals);
		if(!isset($_SESSON)){
			session_start();
		}
		$_SESSION['code']=$cap['word'];

		
		$data['captcha'] = $cap ['image'];
		// print_const();die;
		$this -> load -> view ('admin/login.html',$data);
	}


	// /**
	//  * 验证码
	//  */
	// public function code (){
	// 	$config = array(
	// 		'width' => 80,

	// 		);
	// 	$this -> load -> library ('code',$config);
	// 	$this -> code -> show();
	// }


	/**
	 * 登陆
	 */
	public function login_in(){
		$code = $this -> input -> post('captcha');
		if(!isset($_SESSION)){
			session_start();
		}
		if ($code != $_SESSION['code']) error ('验证码错误');

		$username = $this -> input -> post('username');
		$this -> load -> model ('admin_model','admin');

		$passwd = $this -> input -> post ('passwd');
		$userData = $this -> admin -> check ($username);
		// p($userData);
		if(!$userData || $userData[0]['passwd'] != md5($passwd) )
		{
			error ('用户名或密码不正确');
		}

		$sessionData = array(
			'username' => $username,
			'uid' => $userData[0]['uid'],
			'logintime' => time()
			);
		$this -> session-> set_userdata($sessionData);

		success('admin/admin/index','登录成功！');
		// $data = $this -> session -> userdata('username');
		// p($data);
		// p($code);
		// echo '<hr />';
		// p($_SESSION['code']);
	}

	/**
	 * 退出登录
	 */
	public function login_out (){
		$this -> session -> sess_destroy();
		success('admin/login/index','退出成功');
	}



















}