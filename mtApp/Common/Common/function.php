<?php
	function getIP()
	{
	    global $ip;
	    if (getenv("HTTP_CLIENT_IP"))
	        $ip = getenv("HTTP_CLIENT_IP");
	    else if(getenv("HTTP_X_FORWARDED_FOR"))
	        $ip = getenv("HTTP_X_FORWARDED_FOR");
	    else if(getenv("REMOTE_ADDR"))
	        $ip = getenv("REMOTE_ADDR");
	    else $ip = "Unknow IP";
	    return $ip;
	}

	function uploadPic($path,$img)
    {
        $config = array(    
        'maxSize'    =>    3145728,
        'rootPath'   =>    './Public/Uploads/'.$path.'/',
        'saveName'   =>    array('uniqid',''),
        'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
        'autoSub'    =>    true,    
        'subName'    =>    array('date','Ymd'),
        );

        $upload = new \Think\Upload($config);// 实例化上传类
        $info = $upload->uploadOne($img);
        if(!$info){
            return array("flag"=>false,"msg"=>$upload->getError());
        }else{
            $namePic = '/Uploads/'.$path.'/'.$info['savepath'].$info['savename'];
            return array("flag"=>true,"filename"=>$namePic);
        }
    }


     // 上传文件
    function uploadExl($path,$exc)
    {
        $config = array(    
        'maxSize'    =>    10145728,
        'rootPath'   =>    './Public/Uploads/'.$path.'/',
        'saveName'   =>    array('uniqid',''),
        'exts'       =>    array('xls','xlsx','csv'),
        'autoSub'    =>    true,    
        'subName'    =>    array('date','Ymd'),
        );

        $upload = new \Think\Upload($config);// 实例化上传类
        $info = $upload->uploadOne($exc);
        if(!$info)
        {
            return array("flag"=>false,"msg"=>$upload->getError());
        }else{
            // windows下写  ./
            $namePic = './Public/Uploads/'.$path.'/'.$info['savepath'].$info['savename'];
            // Linux 下写   /
            // $namePic = '/Public/Uploads/'.$path.'/'.$info['savepath'].$info['savename'];
            return array("flag"=>true,"msg"=>$namePic);
        }
    }

    // 模板中调用auth验证的方法
    function checkAuth($ruleName,$uid,$relation='or',$t,$f='false')
    {   
        $auth = new \Think\Auth();
        //分类  1为实时认证；2为登录认证
        $type = 1;
        //执行check的模式
        $mode = 'url';
        if(empty($uid)){
            $uid = session("cb_uid");
        }
        //'or' 表示满足任一条规则即通过验证;
        //'and'则表示需满足所有规则才能通过验证
        $relation = 'and';
        return $auth->check($ruleName, $uid, $type, $mode, $relation) ? $t : $f;
        // 模板中调用：
        // {:checkAuth('Admin/add',$_SESSION['userid'],'or','<a href=”__URL__/add”>添加</a>','')}
    }

    // auth验证方法
    function authCheck()
    {
        $uid = session("cb_uid");
        $auth = new \Think\Auth();
        $ruleName = CONTROLLER_NAME . '/' . ACTION_NAME;  //需要验证的规则列表,支持逗号分隔的权限规则或索引数组
        $type = 1;        //分类  1为实时认证；2为登录认证
        $mode = 'url';    //执行check的模式
        $relation = 'and';//'or' 表示满足任一条规则即通过验证;'and'则表示需满足所有规则才能通过验证
        return $auth->check($ruleName, $uid, $type, $mode, $relation);
    }