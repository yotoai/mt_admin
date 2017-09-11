<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends BaseController 
{
	protected $Grade;
	public function _initialize()
	{
		parent::_initialize();
		$this->Grade = D("grade");
	}

	public function index()
	{
		$this->visitAuth();
		if(IS_AJAX){
			$userList = $this->User->getUserlist(I('get.'));
			$this->ajaxReturn($userList);
		}
		$this->display();
	}

	public function addAdmin()
	{
		if(IS_AJAX && !IS_POST){
			$this->isHaveAuth();
		}
		if(IS_POST && IS_AJAX)
		{
			if($this->User->validate($this->User->insertUserRules())->auto($this->User->insertUserAuto())->create())
			{
				$this->User->startTrans();
				$aff = $this->User->add();
				if($aff)
				{
					$data['uid'] = $aff;
					$data['group_id'] = I('post.role');
					$aff = M('auth_group_access')->add($data);
					if($aff)
					{
						$this->User->commit();
						$map['flag'] = true;
						$map['msg'] = '保存成功！';
						$this->ajaxReturn($map);
					}
					else
					{
						$this->rollback();
						$map['flag'] = false;
						$map['msg'] = '保存失败！';
						$this->ajaxReturn($map);
					}
				}
				else
				{
					$this->User->rollback();
					$map['flag'] = false;
					$map['msg'] = '保存失败！';
					$this->ajaxReturn($map);
				}
			}
			else
			{
				$map['flag'] = false;
				$map['msg'] = $this->User->getError();
				$this->ajaxReturn($map);
			}	
		}else{
			$this->assign("rolelist",M('auth_group')->field('id,title')->select());
			$this->display();
		}
	}

	public function delAdmin()
	{
		$this->isHavedAuth();
		$id = I('post.id','');
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = '找不到要删除的！';
			$this->ajaxReturn($map);
		}
		$data['id'] = $id;
		$aff = $this->User->deleteUser($data);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = '删除成功！';
			$this->ajaxReturn($map);
		}else{
			$map['flag'] = false;
			$map['msg'] = '删除失败！';
			$this->ajaxReturn($map);
		}
	}

	// 编辑用户基本信息
	public function editAdmin()
	{
		if(IS_AJAX && !IS_POST){
			$this->isHaveAuth();
		}
		if(IS_POST && IS_AJAX)
		{
			if(!$this->User->validate($this->User->updateUserRules())->auto($this->User->updateUserAuto())->create())
			{
				$map['flag'] = false;
				$map['msg']  = $this->User->getError();
				$this->ajaxReturn($map);
			}
			else
			{
				$this->User->startTrans();
				$where['id'] = I('post.id/d');
				if($this->User->where($where)->save() !== false)
				{
					$wheres['uid'] = I('post.id/d');
					$data['group_id'] =I('post.role');
					if(M('auth_group_access')->where($wheres)->save($data) !== false)
					{
						$this->User->commit();
						$map['flag'] = true;
						$map['msg'] = '编辑成功';
						$this->ajaxReturn($map);
					}
					else{
						$this->User->rollback();
						$map['flag'] = false;
						$map['msg'] = '编辑失败';
						$this->ajaxReturn($map);
					}
				}
				else{
					$this->User->rollback();
					$map['flag'] = false;
					$map['msg'] = '编辑失败';
					$this->ajaxReturn($map);
				}
			}
		}
		else
		{
			$data['id'] = I('get.id','');
			$aList = $this->User->findUserInfo($data);
			$this->assign("rolelist",M('auth_group')->field('id,title')->select());
			$this->assign('adminList',$aList);
			$this->display('edit');
		}
	}

	// 重置密码
	public function resetPassWord()
	{
		if(!$this->User->validate($this->User->resetPwdRules())->create())
		{
			$map['flag'] = false;
			$map['msg']  = $this->User->getError();
			$this->ajaxReturn($map);
		}
		else
		{
			$where['id'] = I('post.id/d');
			$data['password'] = $this->User->encrypt();
			if($this->User->where($where)->save($data) !== false)
			{
				$map['flag'] = true;
				$map['msg'] = '编辑成功';
				$this->ajaxReturn($map);
			}else{
				$map['flag'] = false;
				$map['msg'] = '编辑失败';
				$this->ajaxReturn($map);
			}
		}
	}

	// 生成随机密码
	public function randPassWord( $length = 8 )
	{
		// 密码字符集，可任意添加你需要的字符
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$password = '';
		for($i = 0; $i < $length; $i++ )
		{
			$password .= $chars[mt_rand(0,strlen($chars) - 1)];
		}
		$this->ajaxReturn($password);
	}

	public function upStatus()
	{
		$this->isHavedAuth();
		$id = I('post.id','');
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = '未知用户！';
			$this->ajaxReturn($map);
		}
		$aff = $this->User->upStatus($id);
		//dump($aff);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = '操作成功！';
			$this->ajaxReturn($map);
		}else{
			$map['flag'] = false;
			$map['msg'] = '操作失败！';
			$this->ajaxReturn($map);
		}
	}

	public function checkName()
	{
		$username = I('post.username');
		$res = $this->User->existUserName($username);
		if($res){
			$map['flag'] = false;
			$this->ajaxReturn($map);
		}else{
			$map['flag'] = true;
			$this->ajaxReturn($map);
		}
	}
}