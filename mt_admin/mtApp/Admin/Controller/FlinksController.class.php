<?php
namespace Admin\Controller;
use Think\Controller;
class FlinksController extends BaseController 
{
	protected $link;
	public function _initialize()
	{
		parent::_initialize();
		$this->Link = D('flink');
	}
	public function flinksList()
	{
		$linkList = $this->Link->getFlinkList();
		$this->assign('linkList',$linkList);
		$this->display();
	}

	//上传logo 
	public function upLogo()
	{
		$config = array(    
			'maxSize'    =>    3145728,
		    'rootPath'   =>    './Public/Uploads/logo/',
		    'saveName'   =>    array('uniqid',''),
		    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
		    'autoSub'    =>    true,    
		    'subName'    =>    array('date','Ymd'),
		    );

		$upload = new \Think\Upload($config);// 实例化上传类
		$info = $upload->uploadOne($_FILES['file']);
		if(!$info){
			$this->ajaxReturn($upload->getError());
		}
		$namePic = '/Uploads/logo/'.$info['savepath'].$info['savename'];
		//return $this->namePic;
		$this->ajaxReturn($namePic);
	}

	// 添加友链
	public function addFlink()
	{
		if(IS_POST){
			$data['comname'] = I('post.comname');
			$data['url'] = I('post.url');
			$data['logo'] = I('post.image');
			$data['addtime'] = time();
			$aff = $this->Link->addFlink($data);
			if($aff){
				$this->redirect("Flinks/addFlink","msg=ref");
			}
		}else{
			$this->display();
		}
	}

	public function upStatus()
	{
		$id = I('post.id');
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = "没有找到对象！";
			$this->ajaxReturn($map);
			return false;
		}
		$aff = $this->Link->upStatusFlink($id);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = "修改成功！";
			$this->ajaxReturn($map);
			return false;
		}else{
			$map['flag'] = false;
			$map['msg'] = "修改失败！";
			$this->ajaxReturn($map);
			return false;
		}
	}

	public function editFlink()
	{
		$id = I('get.id');
		if(IS_POST){
			$logo = I('post.image');
			if(!empty($logo)){
				$data['logo'] = $logo;
				$data['url'] = I('post.url');
				$data['comname'] = I('post.comname');
				
			}else{
				$data['url'] = I('post.url');
				$data['comname'] = I('post.comname');
			}
			$aff = $this->Link->saveFlink($id,$data);
			if($aff){
				$this->redirect("Flinks/editFlink?id=".$id,"msg=ref");
			}else{
				$this->redirect("Flinks/editFlink?id=".$id,"msg=ref");
			}	
		}else{
			$linkList = $this->Link->getOneFlink($id);
			$this->assign('flinkList',$linkList);
			$this->display();
		}
	}

	public function delFlinks()
	{
		$id = I('post.id');
		if(empty($id)){
			$map['flag'] = false;
			$map['msg'] = "没有找到对象！";
			$this->ajaxReturn($map);
			return false;
		}
		$aff = $this->Link->deleteFlink($id);
		if($aff){
			$map['flag'] = true;
			$map['msg'] = "删除成功！";
			$this->ajaxReturn($map);
			return false;
		}else{
			$map['flag'] = false;
			$map['msg'] = "删除失败！";
			$this->ajaxReturn($map);
			return false;
		}
	}
}