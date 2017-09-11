<?php
namespace Admin\Controller;
use Think\Controller;
class PersonController extends BaseController
{
	protected function _initialize()
	{
		parent::_initialize();
	}

    // 个人中心
    public function person()
    {
        $where['id'] = $this->uid;
        if(IS_POST)
        {
        	// dump(I('post.'));
        	// exit;
            $map = array();
            if(!$this->User->validate($this->User->changePersonInfoRules())->auto($this->User->changePersonInfoAuto())->create())
            {
                $map['flag'] = false;
                $map['msg']  = $this->User->getError();
                $this->ajaxReturn($map);
            }
            else
            {
                if($this->User->where($where)->save() !== false)
                {
                    $map['flag'] = true;
                    $map['msg']  = "修改成功！";
                    $this->ajaxReturn($map);
                }
                else
                {
                    $map['flag'] = false;
                    $map['msg'] = '修改失败！';
                    $this->ajaxReturn($map);
                }
            }
        }else{
            $aList = $this->User->findUserInfo($where);
            $this->assign('aList',$aList);
            $this->display();
        }
    }


    public function changepwd()
    {
    	if(IS_POST)
    	{
    		$map = array();
    		if(!$this->User->validate($this->User->changePwdRules())->create())
	    	{
				$map['flag'] = false;
                $map['msg']  = $this->User->getError();
                $this->ajaxReturn($map);
	    	}
	    	else
	    	{
	    		$where['id'] = $this->uid;
                $data['password'] = $this->User->encrypt();
	    		if($this->User->where($where)->save($data))
	    		{
                    $map['flag'] = true;
                    $map['msg']  = '修改成功！';
                    $this->ajaxReturn($map);
                }
                else
                {
                    $map['flag'] = false;
                    $map['msg'] = '修改失败！';
                    $this->ajaxReturn($map);
                }
	    	}
    	}
    }
}