<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends BaseController
{
	private $rule;
	protected function _initialize()
	{
		parent::_initialize();
		$this->rule = D('authRule');
	}

	// 角色管理
	public function rolelist()
	{
		$this->display();
	}

	// 添加角色
	public function addrole()
	{
		if(IS_POST)
		{

		}
		else
		{
			$this->display();
		}
	}

	// 权限管理
	public function rulelist()
	{
		$this->display();
	}

	// 添加权限
	public function addrule()
	{
		if(IS_POST)
		{
			$map = array();
			$data = array();
			$data['title'] = trim(I('post.title',''));
			if(empty($data['title']))
			{
				$map['flag'] = false;
				$map['msg']  = '权限名称不能为空！';
				$this->ajaxReturn($map);
			}
			$data['name'] = trim(I('post.name',''));
			if(empty($data['name']))
			{
				$map['flag'] = false;
				$map['msg']  = '权限字段不能为空！';
				$this->ajaxReturn($map);
			}
			$data['pid'] = I('post.pid');
			$data['des'] = I('post.des');
			$res = $this->rule->ruleAdd($data);
			if($res['flag'])
			{
				$map['flag'] = $res['flag'];
				$map['msg']  = $res['msg'];
				$this->ajaxReturn($map);
			}
			else
			{
				$map['flag'] = $res['flag'];
				$map['msg']  = $res['msg'];
				$this->ajaxReturn($map);
			}
		}
		else
		{
			$this->display();
		}
	}

}