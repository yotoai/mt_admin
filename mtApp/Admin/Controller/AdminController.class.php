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
		$userList = $this->User->getUserlist();
		if($userList){
			foreach($userList as $key=>$val){
			    $grade = $this->User->getGrade($val['username']);
	            if(!$grade){
	                $map = "查询用户角色信息失败！";
	                $userList[$key]['grade'] = $map;
	            }else{
	                $userList[$key]['grade'] = $grade;
	            }
			}
			$this->assign('userList',$userList);
			$this->display();
			exit();
		}else{
			$this->assign('userList',$userList);
			$this->display();
			exit();
		}
	}

	public function addAdmin()
	{	
		if(IS_POST){
			$username = I('post.username','');
			$password = I('post.password','');
			$username = trim($username);
			$password = trim($password);
			if(empty($username)){
				$map['flag'] = false;
				$map['msg'] = '用户名不能为空！';
				$this->ajaxReturn($map);
				exit();
			}
			if(empty($password)){
				$map['flag'] = false;
				$map['msg'] = '密码不能为空！';
				$this->ajaxReturn($map);
				exit();
			}
			$res = $this->User->existUserName($username);
			if($res){
				$map['flag'] = false;
				$map['msg'] = '用户名已存在！';
				$this->ajaxReturn($map);
				exit();
			}else{
				$data['username'] = $username;
				$data['password'] = md5($password);
				$data['telephone'] = I('post.telephone');
				$data['email'] = I("post.email");
				$data['grade'] = I('post.grade');
				$data['des'] = I('post.des');
				$data['addtime'] = time();
				$aff = $this->User->addUser($data);
				if($aff){
					$map['flag'] = true;
					$map['msg'] = '保存成功！';
					$this->ajaxReturn($map);
					exit();
				}else{
					$map['flag'] = false;
					$map['msg'] = '保存失败！';
					$this->ajaxReturn($map);
					exit();
				}
			}	
		}else{
			$gradeList = $this->Grade->getGradelist();
			$this->assign("gradeList",$gradeList);
			$this->display();
		}
	}

	public function delAdmin()
	{
		$id = I('post.id','');
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = '找不到要删除的！';
			$this->ajaxReturn($map);
			exit();
		}
		$data['id'] = $id;
		$aff = $this->User->deleteUser($data);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = '删除成功！';
			$this->ajaxReturn($map);
			exit();
		}else{
			$map['flag'] = false;
			$map['msg'] = '删除失败！';
			$this->ajaxReturn($map);
			exit();
		}
	}

	public function editAdmin()
	{
		if(IS_POST){
			$id = I('post.id','');
			if(empty($id)){
				$map['flag'] = false;
				$map['msg'] = '这个用户出了问题！';
				$this->ajaxReturn($map);
				exit();
			}
			$data = I('post.');
			$aff = $this->User->checkPassword($id,I('post.password'));
			if($aff){
				$data['password'] = $aff;
			}else{
				$data['password'] = md5(I('post.password'));
			}
			$aff = $this->User->saveUser($id,$data);
			if($aff){
				$map['flag'] = true;
				$map['msg'] = '保存成功';
				$this->ajaxReturn($map);
				exit();
			}else{
				$map['flag'] = false;
				$map['msg'] = '保存失败';
				$map['data'] = $data;
				$this->ajaxReturn($map);
				exit();
			}
		}else{
			$id = I('get.id','');
			if(empty($id)){
				echo '<p style="color:red;text-align:ccenter;">这个用户不存在！</p>';
				exit();
			}else{
				$data['id'] = $id;
			}
			$adminList = $this->User->getOneuserinfo($data);
			//dump($adminList);
			$gradeList = $this->Grade->getGradelist();
			$this->assign("gradeList",$gradeList);
			$this->assign('adminList',$adminList);
			$this->display('edit');
		}
	}

	public function upStatus()
	{
		$id = I('post.id','');
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = '这个用户出了问题！';
			$this->ajaxReturn($map);
			exit();
		}
		$aff = $this->User->upStatus($id);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = '已禁用~！';
			$this->ajaxReturn($map);
			exit();
		}else{
			$map['flag'] = false;
			$map['msg'] = '禁用失败！';
			$this->ajaxReturn($map);
			exit();
		}
	}

	public function checkName()
	{
		$username = I('post.username');
		$res = $this->User->existUserName($username);
		if($res){
			$map['flag'] = false;
			$this->ajaxReturn($map);
			exit();
		}else{
			$map['flag'] = true;
			$this->ajaxReturn($map);
			exit();
		}
	}
}