<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends BaseController 
{
	protected $Log;
	protected $User;
    protected $Msg;
	public function _initialize()
	{
        parent::_initialize();
		$this->Log = D('log');
        $this->Msg = D('msg');
	}

	public function logList()
	{
        $logList = $this->Log->getLoglist();
        if($logList){
            foreach($logList as $key=>$val){
                $grade = $this->User->getGrade($val['visitor']);
                if(!$grade){
                    $map = "查询用户角色信息失败！";
                    $logList[$key]['grade'] = $map;
                }else{
                    $logList[$key]['grade'] = $grade;
                }
            }
            $this->assign('logList',$logList);
            $this->display();
            exit();
        }else{
            $this->assign('logList',$logList);
            $this->display();
            exit();
        }
	}

	public function delLog()
	{
        $id = I("post.id",'');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg'] = '找不到要删除的！';
            $this->ajaxReturn($map);
            exit();
        }else{
            $data['id'] = $id;
        }
        $aff = $this->Log->deleteLog($data);
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

	public function msg()
	{
		$msgList = $this->Msg->getMsglist();
        if($msgList){
            $aff = $this->msg->saveMsgstatus();
            if(!$aff){
                echo '<p style="color:red;text-align:center;font-family: "Microsoft YaHei";">修改留言状态失败！</p>';
                exit();
            }
            $this->assign('msgList',$msgList);
            $this->display();
        }else{
            $this->assign('msgList',$msgList);
            $this->display();
        }

	}

	public function delMsg()
	{
		$id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg'] = '找不到要删除的！';
            $this->ajaxReturn($map);
            exit(); 
        }else{
            $data['id'] = $id;
        }
		$aff = $this->Msg->deleteMsg($data);
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

    // 获取消息数量
	public function getNewMsgNum()
	{
		$count = $this->Msg->getMsgcount();
        if($count){
            $map['flag'] = true;
            $map['msg'] = $count;
            $this->ajaxReturn($map);
            exit();
        }
	}

    public function systembase()
    {
        $wb = M("webbase");
        if(IS_POST){
            $wb = M("webbase");
            $data = I("post.");
            $count = $wb->count("id");
            if($count <= 0){
                $aff = $wb->add($data);
                if($aff){
                    $this->redirect('System/systembase');
                }
            }else{
                $aff = $wb->where("id=1")->save($data);
                $this->redirect('System/systembase');
            }
        }else{
            $wblist = $wb->field("webtitle,keyword,description,contacthotline,contactemail,copyright,icp,countcode,hotline")->find();
            $this->assign("wb",$wblist);
            $this->display();
        }
    }

    public function setcontact()
    {
        if(IS_POST){
            $ct = M("contacttype");
            $data = I("post.");
            $count = $ct->count("id");
            if($count < 1 && $count == 0){
                $aff = $ct->add($data);
                if($aff){
                    $this->ajaxReturn(array("flag"=>true,"msg"=>"添加成功！"));
                }else{
                    $this->ajaxReturn(array("flag"=>false,"msg"=>"添加失败！"));
                }
            }else{
                $aff = $ct->where("id=1")->save($data);
                if($aff){
                    $this->ajaxReturn(array("flag"=>true,"msg"=>"修改成功！"));
                }else{
                    $this->ajaxReturn(array("flag"=>false,"msg"=>"修改失败！"));
                }
            }
        }else{
            $ct = M("contacttype");
            $ctlist = $ct->field("callnum,phonenum,email")->find();
            $this->assign("ct",$ctlist);
            $this->display();
        }
    }
    
    /* 联系QQ管理*/
    public function setqq()
    {
        if(IS_POST){
            $qqcontact = M("qqcontact");
            $data['qqnum'] = trim(I("post.qqnum",''));
            $data['qqtitle'] = trim(I("post.qqtitle",''));
            $id = I("post.id","");
            if(empty($id)){
                $aff = $qqcontact->add($data);
                if($aff){
                    $msg['flag'] = true;
                    $msg['msg'] = "保存成功！";
                    $this->ajaxReturn($msg);
                }else{
                    $msg['flag'] = false;
                    $msg['msg'] = "保存失败！";
                    $this->ajaxReturn($msg);
                }
            }else{
                $list = $qqcontact->field("qqnum,qqtitle")->where("id=".$id)->find();
                if($data['qqnum'] == $list['qqnum'] && $data['qqtitle'] == $list['qqtitle']){
                    $msg['flag'] = false;
                    $msg['msg'] = "您没有做出任何修改！";
                    $this->ajaxReturn($msg);
                }
                $aff = $qqcontact->where("id=".$id)->save($data);
                if($aff){
                    $msg['flag'] = true;
                    $msg['msg'] = "保存成功！";
                    $this->ajaxReturn($msg);
                }else{
                    $msg['flag'] = false;
                    $msg['msg'] = "修改失败！";
                    $this->ajaxReturn($msg);
                }
            }
        }else{
            $qqlist= M("qqcontact")->field("id,qqnum,qqtitle,status")->select();
            $this->assign("qqList",$qqlist);
            $this->display();
        }
    }
        
    /* QQ是否启用状态 */
    public function upQQStatus()
    {
        $id = I('post.id');
        $qq = M("qqcontact");
        $status = $qq->field('status')->where('id='.$id)->find();
        if($status['status']==-1){
            $data['status'] = 1;
        }else{
            $data['status'] = -1;
        }
        $aff = $qq->where('id='.$id)->save($data);
        if($aff){
            $map['flag'] = true;
            $map['msg'] = "已启用！";
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg'] = "启用失败！";
            $this->ajaxReturn($map);
        }
    }

    public function delqq()
    {
        $qq = M("qqcontact");
        $id = I("post.id",'');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg'] = "删除失败，没有找到要删除的！";
            $this->ajaxReturn($map);
        }else{
            $aff = $qq->where("id=".$id)->delete();
            if($aff){
                $map['flag'] = true;
                $map['msg'] = "删除成功！";
                $this->ajaxReturn($map);
                exit;
            }else{
                $map['flag'] = false;
                $map['msg'] = "删除失败！";
                $this->ajaxReturn($map);
            }
        }
    }
}