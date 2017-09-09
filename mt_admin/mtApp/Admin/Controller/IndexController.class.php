<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController 
{
    private $msg;
    private $rule;
    public function _initialize()
    {
        parent::_initialize();
        $this->rule = D('authRule');
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

            $this->assign('menu',$this->buildfMenu());
            $this->display();
    	}else{
    		$this->redirect('Login/index');
    	}
    }
    	

    public function buildfMenu()
    {
        $str = '';
        $list = $this->rule->getRuleDataWithPid();
        foreach($list as $key=>$val)
        {
            if($this->authCheck($val['name']) == true)
            {
                $str .= '<dl id="menu-article"><dt><i class="Hui-iconfont" style="font-size:18px;"> '.$val['iconfont'].' </i> '.$val['title'].'<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt><dd><ul>';
                $str .= $this->buildsMenu($val['id']);
                $str .= '</dd></dl>';
            }
        }
        return $str;
    }

    private function buildsMenu($pid)
    {
        $str = '';
        $list = $this->rule->getRuleDataWithPid($pid);
        foreach($list as $key=>$val)
        {
            if($this->authCheck($val['name']))
            {
                $str .= '<li><a _href="'. U($val['name']) .'" data-title="'.$val['title'].'" href="javascript:void(0)"><i class="Hui-iconfont"> '.$val['iconfont'].' </i>'.$val['title'].'</a></li>';
            }
        }
        return $str;
    }

    public function quit()
    {
        $userName = session("mt_username");
        $aff = D('user')->changeOnlineStatus($userName);
        if($aff){
            session('[destroy]');
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