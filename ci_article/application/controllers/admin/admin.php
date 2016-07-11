<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function index (){
		$this -> load -> view ('admin/index.html');
	}

	public function copy () {
		$this -> load -> view('admin/copy.html');
	}

	/**
	 * 修改密码
	 */
	public function change(){
		$this -> load -> view ('admin/change_passwd.html');
	}

	/**
	 * 修改动作
	 */
	public function change_passwd(){
		$this ->load -> model('admin_model','admin');

		$username = $this -> session -> userdata('username');
		$userData = $this ->admin-> check($username);
		
		$passwd = $this -> input -> post ('passwd');
		if(md5($passwd) != $userData[0]['passwd'])
			error('原始密码错误'); 

		$passwdF = $this -> input -> post('passwdF');
		$passwdS = $this -> input -> post('passwdS');
		if($passwdF != $passwdS)
			error ('两次输入不一致');

		$uid = $this -> session -> userdata('uid');
		$passwdF = $this -> input -> post('passwdF');
		$data = array(
			'passwd'=>md5($passwdF),
			);
		$this -> admin-> change($uid,$data);

		success ('admin/admin/copy','修改成功');
	}
















}