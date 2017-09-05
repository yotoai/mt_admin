<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController 
{
    protected $msg;
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index()
    {
    	if(session('mt_username')){
 			$userName = session('mt_username');
    		$this->assign('username',$userName);
           
            // 获取最新客户消息
            // $msg = M('msg');
            // $num = $msg->where('status=0')->count();
            // $this->assign('num',$num);
            $this->display();
    	}else{
    		$this->redirect('Login/index');
    	}
    }
    	


    public function quit()
    {
        $userName = session("mt_username");
        $aff = D('user')->changeOnlineStatus($userName);
        if($aff){
            session('mt_username',null);
            $this->redirect('Login/index');          
        }else{
            echo "<script> alert('failed quit'); history.back(); </script>";
        }

    } 

    public function getBaseInfo()
    {
        $userName = session("mt_username");
        $arr = array();
        $arr['loginnum'] = D('user')->updateOrgetLoginNum($userName,'get');
        $arr['loginip'] = D('user')->updateOrgetLoginIpAddr($userName,'get');
        $arr['logintime'] = date('Y-m-d H:i:s', D('user')->updateOrgetLoginTime($userName,'get'));
        $this->ajaxReturn($arr);
    }
}