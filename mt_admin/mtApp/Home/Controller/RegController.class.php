<?php
namespace Home\Controller;
use Think\Controller;

class RegController extends Controller
{
	protected $code;
	public function _initialize()
	{

	}

	public function index()
	{
		$this->display('reg');
	}

	// 简单的产生4位随机数
	public function getRandomNum()
	{
		return mt_rand(1000,9999);
	}

	// 执行发送
	public function doSendSms()
	{
		$user = 'doufu';
		$num = I('post.num');
		$code = $this->getRandomNum();
		Vendor('AliSms.AliSms');
		$sms = new \AliSms($num,$user,$code);
		$sms->sendMsg();
		$this->AjaxReturn(sha1('"'.$code.'"'));
	}

	public function doReg()
	{
		$pass = I('post.pass');
		Vendor('Phpass.PasswordHash');
		$passHash = new \PasswordHash(8,false);
		$hashPass = $passHash->HashPassword($pass);
	}
}