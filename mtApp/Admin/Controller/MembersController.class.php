<?php
namespace Admin\Controller;
use Think\Controller;
class MembersController extends BaseController
{
	protected $Members;
	public function _initialize()
	{
		parent::_initialize();
		$this->Members = D('members');
	}

	public function membersList()
	{
		if(IS_AJAX){
			$membersList = $this->Members->getMenbersList(I('get.'));
			$this->ajaxReturn($membersList);
		}
		$this->display();
	}

	public function memberShow()
	{
		$id = I("get.id",'');
		$list = $this->Members->getOneMemberInfo($id);
		$this->assign("memberlist",$list);
		$this->display();
	}

	public function membersAdd()
	{
		$this->display();
	}

	public function editMembers()
	{
		$id = I("get.id","");
		if(IS_POST){
			$data = I("post.");
			$aff = $this->Members->saveMember($id,$data);

		}else{
			$list = $this->Members->editMemberInfo($id);
			//dump($list);
			$this->assign("list",$list);
			$this->display();
		}
	}

	// 修改会员状态
	public function upMembersStatus()
	{
		$id = I("post.id","");
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = "未知用户！";
			$this->ajaxReturn($map);
		}
		$aff = $this->Members->changeMemberStatus($id);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = "操作成功！";
			$this->ajaxReturn($map);
		}else{
			$map['flag'] = false;
			$map['msg'] = "操作失败！";
			$this->ajaxReturn($map);
		}
	}

	public function delMember()
	{
		$id = I("post.id","");
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = "未知用户！";
			$this->ajaxReturn($map);
		}
		$aff = $this->Members->deleteMember($id);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = "删除成功！";
			$this->ajaxReturn($map);
		}else{
			$map['flag'] = false;
			$map['msg'] = "删除失败！";
			$this->ajaxReturn($map);
		}
	}

	// 被删除的会员列表
	public function deletedMembers()
	{
		$list = $this->Members->getDeletedMembers();
		//dump($list);
		$this->assign("deledlist",$list);
		$this->display();
	}

	// 还原被删除人员
	public function restoreMember()
	{
		$id = I("post.id","");
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = "未知用户！";
			$this->ajaxReturn($map);
		}
		$aff = $this->Members->changeMemberStatus($id);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = "还原成功！";
			$this->ajaxReturn($map);
		}else{
			$map['flag'] = false;
			$map['msg'] = "还原失败！";
			$this->ajaxReturn($map);
		}
	}

	// 搜索查询
	public function searchMembers()
	{
		$endtime = trim(I("post.endtime",""));
		$starttime = I("post.starttime","");
		$conditions = I("post.conditions","");
		if(!empty($endtime)){
			$data['_string'] = strtotime($endtime).' > delete_time';
		}
		if(!empty($starttime)){
			$data['_string'] = strtotime($starttime).' < delete_time';
		}
		if(!empty($starttime) && !empty($endtime)){
			$data['_string'] = strtotime($endtime).' > delete_time AND '.strtotime($starttime).' < delete_time';
		}
		if(!empty($conditions)){
			$data['_string'] = '((wx_nickname like "%'.$conditions.'%") OR (wx_city like "%'.$conditions.'%"))';
		}
		if(!empty($starttime) && !empty($endtime) && !empty($conditions)){
			$data['_string'] = '((wx_nickname like "%'.$conditions.'%") OR (wx_city like "%'.$conditions.'%")) AND '.strtotime($endtime).' > delete_time AND '.strtotime($starttime).' < delete_time';
		}
		$list = $this->Members->searchAllMembers($data);
		$this->ajaxReturn($list);
	}

	// 等级
	public function membersGrade()
	{
		$this->display();
	}

	// 积分管理
	public function membersPoint()
	{
		$this->display();
	}


	public function shareRecords()
	{
		$this->display();
	}
}