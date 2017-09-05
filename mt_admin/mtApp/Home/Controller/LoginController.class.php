<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller
{
	public function index()
	{
		$this->display('login');
	}

	public function doLogin()
	{
		$pass = I('post.pass');
		Vendor('Phpass.PasswordHash');
		$passHash = new \PasswordHash(8,false);
		
		//参数1：用户输入的，参数2：数据库存储的
		$res = $passHash->CheckPassword($pass,$hashPass);
	}
}