<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
class BaseController extends Controller
{
	protected $User;
	protected $uid;
	protected $username;
	protected $autoid;
	protected function _initialize()
	{
		$this->User = D("user");
		$this->username = session("mt_username");
		$this->isErrorLogin();
	}
	
	protected function authCheck()
	{
		$auth = new Auth();
		//需要验证的规则列表,支持逗号分隔的权限规则或索引数组
		$name = MODULE_NAME . '/' . ACTION_NAME;
		//分类  1为实时认证；2为登录认证
		$type = 1;
		//执行check的模式
		$mode = 'url';
		//'or' 表示满足任一条规则即通过验证;
		//'and'则表示需满足所有规则才能通过验证
		$relation = 'and';
		return $auth->check($name, $this->uid, $type, $mode, $relation);
	}

    // 错误登录方法
	protected function isErrorLogin()
	{
		if(empty($this->username))
		{
			$this->redirect("Login/index");
			exit();
		}else{
			$res = $this->User->CheckCurrentLoginID($this->username);
			if(!$res || $res['id'] == "")
			{
				$this->redirect("Login/index");
				exit();
			}
		}
	}
}