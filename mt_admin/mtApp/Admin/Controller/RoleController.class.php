<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends BaseController
{
	private $rule;
	private $role;
	protected function _initialize()
	{
		parent::_initialize();
		$this->rule = D('authRule');
		$this->role = D('authGroup');
	}

	// 角色管理
	public function rolelist()
	{
		if(IS_AJAX)
		{
			$rlist = $this->role->getRoleList(I('get.'));
			$this->ajaxReturn($rlist);
		}
		$this->display();
	}

	// 添加角色
	public function addrole()
	{
		if(IS_POST)
		{
			if($this->role->create())
			{
				if($this->role->add())
				{
					$map['flag'] = true;
					$map['msg']  = '添加成功！' ;
					$this->ajaxReturn($map);
				}
				else
				{
					$map['flag'] = false;
					$map['msg']  = '添加失败！' ;
					$this->ajaxReturn($map);
				}
			}
			else
			{
				$map['flag'] = false;
				$map['msg']  = $this->role->getError();
				$this->ajaxReturn($map);
			}
		}	
		else
		{
			$str = $this->makeData();
			$this->assign('rulestr',$str);
			$this->display();
		}
	}

	// 获取权限数据样式格式
	public function makeData()
	{
		$list = $this->rule->getRuleDataWithPid();
		foreach($list as $key=>$val)
		{
			$str .= '<dl class="permission-list"><dt><label style="font-size:16px;"><input type="checkbox" value="'.$val['id'].'" name="user-Character-0" id="user-Character-1"> ' . $val['title'] . '</label></dt><dd>';
			$str .= $this->returnSc($val['id']);
			$str .= '</dd></dl>';
		}
		return $str;
	}

	private function returnSc($pid)
	{
		$list = $this->rule->getRuleDataWithPid($pid);
		foreach($list as $key=>$val)
		{
			$str .= '<dl class="cl permission-list2"><dt><label class="" style="font-size:14px;color:black;font-weight:500;"><input type="checkbox" value="'.$val['id'].'" name="user-Character-1-0" id="user-Character-1-0"> '.$val['title'].'</label></dt><dd>';
			$str .= $this->returnTh($val['id']);	
			$str .= '</dd></dl>';
		}
		return $str;
	}

	private function returnTh($pid)
	{
		$list = $this->rule->getRuleDataWithPid($pid);
		foreach($list as $key=>$val)
		{
			$str .= '<label class="" style="font-size:12px;"><input type="checkbox" value="'.$val['id'].'" name="user-Character-1-0-0" id="user-Character-1-0-3"> '.$val['title'].'</label>';
		}
		return $str;
	}

	// 编辑角色
	public function editrole()
	{
		if(IS_POST)
		{
			if(!$this->role->create())
			{
				$map['flag'] = false;
				$map['msg']  = $this->role->getError();
				$this->ajaxReturn($map);
			}
			else
			{
				$where['id'] = I('post.id/d');
				if($this->role->where($where)->save() !== false)
				{
					$map['flag'] = true;
					$map['msg']  = '编辑成功！';
					$this->ajaxReturn($map);
				}
				else
				{
					$map['flag'] = false;
					$map['msg']  = '编辑失败！';
					$this->ajaxReturn($map);
				}
			}
		}
		$id = I('get.id');
		$list = $this->role->findRole($id);
		$str = $this->makeData();
		$this->assign('rulestr',$str);
		$this->assign('rlist',$list);
		$this->display();
	}

	// 删除角色
	public function delrole()
	{
		// dump(I('post.'));
		// return;
		if(!$this->role->create())
		{
			$map['flag'] = false;
			$map['msg']  = $this->role->getError();
			$this->ajaxReturn($map);
		}
		else
		{
			$where['id'] = I('post.id/d');
			if($this->role->where($where)->delete())
			{
				$map['flag'] = true;
				$map['msg']  = '删除成功！';
				$this->ajaxReturn($map);
			}
			else
			{
				$map['flag'] = false;
				$map['msg']  = '删除失败！';
				$this->ajaxReturn($map);
			}
		}
	}

	// 权限管理
	public function rulelist()
	{
		if(IS_AJAX)
		{
			$ruleList = $this->rule->getRuleList(I('get.'));
			$this->ajaxReturn($ruleList);
		}
		$this->display();
	}

	// 添加权限
	public function addrule()
	{
		if(IS_POST)
		{
			$map = array();
			if(!$this->rule->create())
			{
				$map['flag'] = false;
				$map['msg']  = $this->rule->getError();
				$this->ajaxReturn($map);
			}
			else
			{
				if($this->rule->add())
				{
					$map['flag'] = true;
					$map['msg']  = '添加成功！' ;
					$this->ajaxReturn($map);
				}
				else
				{
					$map['flag'] = false;
					$map['msg']  = '添加失败！' ;
					$this->ajaxReturn($map);
				}
			}
		}
		else
		{
			$rlist = $this->rule->getRules();
			$this->assign('rlist',$rlist);
			$this->display();
		}
	}

	// 获取zTree数据
	public function getRuleTree()
	{
		$this->ajaxReturn($this->rule->select());
	}

	// 编辑权限
	public function editrule()
	{
		if(IS_POST)
		{
			$map = array();
			if(!$this->rule->create())
			{
				$map['flag'] = false;
				$map['msg']  = $this->rule->getError();
				$this->ajaxReturn($map);
			}
			else
			{
				$where['id'] = I('post.id/d');
				if($this->rule->where($where)->save() !== false)
				{
					$map['flag'] = true;
					$map['msg']  = '编辑成功！';
					$this->ajaxReturn($map);
				}
				else
				{
					$map['flag'] = false;
					$map['msg']  = '编辑失败！';
					$this->ajaxReturn($map);
				}
			}
		}
		$id = I('get.id/d');
		$list = $this->rule->findRule($id);
		$rlist = $this->rule->getRules();
		$this->assign('rlist',$rlist);
		$this->assign('rulelist',$list);
		$this->display();
	}

	public function delrule()
	{
		$id = trim(I('post.id/d',''));
		if(empty($id))
		{
			$map['flag'] = false;
			$map['msg']  = '未知ID！';
			$this->ajaxReturn($map);
		}
		$where['id'] = $id;
		if($this->rule->where($where)->delete())
		{
			$map['flag'] = true;
			$map['msg']  = '删除成功！';
			$this->ajaxReturn($map);
		}
		else
		{
			$map['flag'] = false;
			$map['msg']  = '删除失败！';
			$this->ajaxReturn($map);
		}
	}

}