<?php
namespace Admin\Controller;
use Think\Controller;
class JobsController extends BaseController 
{
	protected $Job;

	public function _initialize()
	{
        parent::_initialize();
		$this->Job = D('jobs');
	}
    
    public function index()
    {
   		$jobList = $this->Job->getJobsList();
   		$this->assign('jobList',$jobList);
        $this->display();
    }

    public function addJobs()
    {
    	if(IS_POST){
    		$data['addtime'] = time();
    		$data['des'] = I('post.editorValue');
    		$data['job'] = I('post.job');
    		$aff = $this->Job->addJobs($data);
    		if($aff){
                $this->redirect('Jobs/addJobs',array('msg'=>'ref'));
    		}
    	}else{
    		$this->display();
    	}
    }

    public function editJobs()
    {
        $id = I('get.id');

    	if(IS_POST){
    		$data['job'] = I('post.job');
            $data['des'] = I('post.editorValue');
            $this->Job->saveJobs($id,$data);
            $this->redirect('Jobs/editJobs?id='.$id,'msg=ref');
    	}else{
    		$jobList = $this->Job->getOneJobs($id);
    		$this->assign('jobList',$jobList);
    		$this->display();
    	}
    }

    public function delJobs()
    {
    	$id = I('post.id');
    	if(empty($id))
        {
            $map['flag'] = false;
            $map['msg'] = "没有找到对象！";
            $this->ajaxReturn($map);
            return false;
        }
        $aff = $this->Job->deleteJob($id);
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

    public function upStatus()
    {
    	$id = I('post.id');
        if(empty($id))
        {
            $map['flag'] = false;
            $map['msg'] = "没有找到对象！";
            $this->ajaxReturn($map);
            return false;
        }
    	
        $aff = $this->Job->upDataJob($id);
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
}