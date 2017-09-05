<?php
namespace Admin\Controller;
use Think\Controller;
class PictureController extends BaseController 
{
	protected $Pic;
	public function _initialize()
	{
		parent::_initialize();
		$this->Pic = D('picture');
	}

	public function picList()
	{
		$picList = $this->Pic->getPicList();
		//dump($picList);
		$this->assign('picList',$picList);
		$this->display();
	}

	public function addPic()
	{
		if(IS_POST){
			$picpath = I("post.picpath","");
			if(empty($picpath)){
				$map['flag'] = false;
				$map['msg'] = "请上传图片！";
				$this->assign("map",$map);
				$this->display();
				exit();
			}else{
				$data['picpath'] = $picpath;
			}
			$picname = I("post.picname","");
			if(empty($picname)){
				$map['flag'] = false;
				$map['msg'] = "图片名不能为空！";
				$this->assign("map",$map);
				$this->display();
				exit();
			}else{
				$data['picname'] = $picname;
			}
			$type = I("post.type","");
			if(empty($type)){
				$map['flag'] = false;
				$map['msg'] = "类型不能为空！";
				$this->assign("map",$map);
				$this->display();
				exit();
			}
			$count = $this->Pic->isExiststype($type);
			if($count <= 0){
				$map['flag'] = false;
				$map['msg'] = "类型不存在！";
				$this->assign("map",$map);
				$this->display();
				exit();
			}else{
				$data['type'] = $type;
			}
			$data['des'] = I('post.des');
			$data['addtime'] = time();
			// dump($data);
			$aff = $this->Pic->addPic($data);
			if($aff){
				$this->redirect('Picture/addPic','msg=ref');
			}
		}else{
			$typenameList = $this->Pic->getPicCateList();
			$this->assign('typenameList',$typenameList);
			$this->display();
		}
	}

	public function upPic()
	{
		$config = array(    
			'maxSize'    =>    3145728,
		    'rootPath'   =>    './Public/Uploads/uploadPic/',
		    'saveName'   =>    array('uniqid',''),
		    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
		    'autoSub'    =>    true,    
		    'subName'    =>    array('date','Ymd'),
		    );

		$upload = new \Think\Upload($config);// 实例化上传类
		$info = $upload->uploadOne($_FILES['file']);
		if(!$info){
			$this->ajaxReturn($upload->getError());
			exit();
		}
		$namePic = '/Uploads/uploadPic/'.$info['savepath'].$info['savename'];
		//return $this->namePic;
		$this->ajaxReturn($namePic);
	}

	public function upStatus()
	{
		$id = I('post.id','');
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = "类型不存在！";
			$this->ajaxReturn($map);
			exit();
		}
		$aff = $this->Pic->upPicStatus($id);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = "修改成功！";
			$this->ajaxReturn($map);
			exit();
		}else{
			$map['flag'] = false;
			$map['msg'] = "修改失败！";
			$this->ajaxReturn($map);
			exit();
		}
	}

	public function delPic()
	{
		$id = I('post.id','');
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = "没有找到要删除的！";
			$this->ajaxReturn($map);
			exit();
		}
		$res = $this->Pic->getPicStatus($id);
		if(empty($res)){
			$map['flag'] = false;
			$map['msg'] = "获取图片状态失败！";
			$this->ajaxReturn($map);
			exit();
		}
		if($res == 1){
			$map['flag'] = false;
			$map['msg'] = "删除失败！图片已发布！";
			$this->ajaxReturn($map);
			exit();
		}else{
			$aff = $this->Pic->deletePic($id);
			if($aff){
				$map['flag'] = true;
				$map['msg'] = "删除成功！";
				$this->ajaxReturn($map);
				exit();
			}else{
				$map['flag'] = false;
				$map['msg'] = "删除失败！";
				$this->ajaxReturn($map);
				exit();
			}
		}
	}

	public function editPic()
	{
		$id = I('get.id');
		if(IS_POST){
			$picpath = I("post.picpath","");
			if(!empty($picpath)){
				$data['picpath'] = $picpath;
			}
			$picname = I("post.picname","");
			if(empty($picname)){
				$map['flag'] = false;
				$map['msg'] = "图片名不能为空！";
				$this->assign("map",$map);
				$this->display();
				exit();
			}else{
				$data['picname'] = $picname;
			}
			$type = I("post.type","");
			if(empty($type)){
				$map['flag'] = false;
				$map['msg'] = "类型不能为空！";
				$this->assign("map",$map);
				$this->display();
				exit();
			}
			$count = $this->Pic->isExiststype($type);
			if($count <= 0){
				$map['flag'] = false;
				$map['msg'] = "类型不存在！";
				$this->assign("map",$map);
				$this->display();
				exit();
			}else{
				$data['type'] = $type;
			}
			$aff = $this->Pic->savePic($id,$data);
			if($aff){
				$this->redirect('Picture/editPic?id='.$id,array('msg'=>'ref'));
			}else{
				$this->redirect('Picture/editPic?id='.$id,array('msg'=>'ref'));
			}
		}else{
			$picList = $this->Pic->getOnePic($id);
			$typenameList = $this->Pic->getPicCateList();
			$this->assign('typenameList',$typenameList);
			$this->assign('picList',$picList);
			$this->display();
		}
	}
}