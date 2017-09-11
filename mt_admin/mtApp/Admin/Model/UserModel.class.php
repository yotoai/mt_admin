<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends BaseModel
{
	// 获取用户列表
	public function getUserlist($data)
	{
		//获取Datatables发送的参数 必要
        $draw = $data['draw'];    //这个值直接返回给前台
        //获取时间区间
        $timeArr['mintime'] = $data['mintime'];
        $timeArr['maxtime'] = $data['maxtime'];
        $where = $this->dealTime($timeArr);
        //搜索框
        $search = trim($data['conditions']);    //获取前台传过来的过滤条件 
        if(strlen($search) > 0) {
            $where['id|username|telephone|email|rolename|status|addtime'] = array('like','%'.$search.'%');
        }
		//定义查询数据总记录数sql
    	$recordsTotal    = $this->count();

		//定义过滤条件查询过滤后的记录数sql
        $recordsFiltered =  $this->where($where)->count();
        //排序条件
        $orderArr = [
        				1=>'id', 
        				2=>'username', 
        				3=>'telephone', 
        				4=>'email', 
        				5=>'rolename',
        				6=>"status",
        				7=>"addtime"
        			];
        			        //获取要排序的字段
        $orderField = (empty($orderArr[$data['order']['0']['column']])) ? 'id' : $orderArr[$data['order']['0']['column']];
        //需要空格,防止字符串连接在一块
        $order = $orderField.' '.$data['order']['0']['dir'];
        //按条件过滤找出记录
        $result = [];
		$field = array(
					'id',
					'username',
					'telephone',
					'email',
					'rolename',
					'status',
					'addtime'
				);
		$result = $this
					->field($field)
					->where($where)
					->order('id desc')
					->limit(intval($data['start']).','.intval($data['length']))
					->select();
					//echo $this->getLastSql();
		foreach($result as $key=>$val)
        {
			$result[$key]['addtime'] = date("Y-m-d H:i:s",$val['addtime']);
        }
        //拼接要返回的数据
        $list = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $result
        );
		return $list;
	}

	//其中,dealTime方法主要用于处理时间段
    public function dealTime($data)
    {
        //处理最小时间
        if($data['mintime'] == '') $data['mintime'] = 0; else $data['mintime'] = strtotime($data['mintime']);
        //处理最大时间(当前时间)
        if ($data['maxtime'] == '') $data['maxtime'] = time(); else $data['maxtime'] = strtotime($data['maxtime'])+3600*24;
        $data['addtime'] = array('between', array($data['mintime'], $data['maxtime']));
        //清除没用的东西(防止条件报错)
        unset($data['mintime']);
        unset($data['maxtime']);
        return $data;
    }

	// 单独获取一个用户的信息
	public function findUserInfo($data)
	{
		$arr = array('id','username','telephone','email','role','rolename','des');
		$adminList = $this->field($arr)->where($data)->find();
		return $adminList;
	}

	// 检查当前登录用户id
	public function CheckCurrentLoginID($username)
	{
		$res = $this->field("id")->where("username='".$username."'")->find();
		return $res;
	}

	// 删除用户
	public function deleteUser($data)
	{
		$aff = $this->where($data)->delete();
		return $aff;
	}

	// 修改用户状态
	public function upStatus($id)
	{
		$where['id'] = $id;
		$res = $this->field('status')->where($where)->find();
		$data['status'] = $res['status'] == 1 ? -99 : 1;
		$aff = $this->where('id='.$id)->save($data);
		return $aff;
	}

	// 登录验证用户名是否存在
	public function existUserName($username)
	{
		$data['username'] = $username;
		$count = $this->where($data)->count("id");
		return $count == 1 ? true : false;
	}

	// 登录验证用户密码是否正确
	public function isTruePassword($username,$userpassword)
	{
		$data['username'] = $username;
		$password = $this->field("password")->where($data)->find();
		$data['password'] = md5(crypt($userpassword, C('SALT')));
		$userid = $this->where($data)->getField("id");
		if($data['password'] == $password['password'] && $userid)
		{
			return $userid;
		}else{
			return false;
		}
	}

	// 登录验证用户的状态
	public function userStatus($username,$userpassword)
	{
		$data['username'] = $username;
		$data['password'] = md5(crypt($userpassword, C('SALT')));
		$status = $this->field("status")->where($data)->find();
		return $status['status'] == 1 ? true : false;
	}

	// 登录验证用户是否在线
	public function isOnline($username,$userpassword)
	{
		$data['username'] = $username;
		$data['password'] = md5($userpassword);
		$status = $this->field("online")->where($data)->find();
		if($status['online'] == -1)
		{
			return true;
		}else{
			return false;
		}
	}

	// 获取用户角色
	public function getUserbaseinfo($username,$userpassword)
	{
		$data['username'] = $username;
		$data['password'] = md5($userpassword);
		$grade = $this->field("grade")->where($data)->find();
		return $grade;
	}

	// 改变用户在线状态
	public function changeOnlineStatus($username)
	{
		$data['username'] = $username;
		$onlineStatus = $this->field("online")->where($data)->find();
		if($onlineStatus['online'] == -1){
			$map['online'] = 1;
			$aff = $this->where($data)->save($map);
			return $aff;
		}else{
			$map['online'] = -1;
			$aff = $this->where($data)->save($map);
			return $aff;
		}
	}

	// 获取登录用户等级
	public function getGrade($username)
	{
		$data['username'] = $username;
		$gradeID = $this->field("grade")->where($data)->find();
		if(!$gradeID['grade'])
		{
			return false;
		}
		$grade = M("grade")->field("grade")->where("id=".$gradeID['grade'])->find();
		return $grade['grade'] ? $grade['grade'] : false;
	}

	// 获取用户登录次数
	public function updateOrgetLoginNum($username,$ac)
	{
		$where['username'] = $username;
		$num = $this->field("loginnum")->where($where)->find();
		if($num['loginnum'] && $ac == 'up')
		{
			$num['loginnum'] += 1;
		}elseif($num['loginnum'] && $ac == 'get'){
			return $num['loginnum'];
		}else{
			return false;
		}
		$res = $this->where($where)->save($num);
		return $res;
	}

	// 修改登录时间
	public function updateOrgetLoginTime($username,$ac)
	{
		$where['username'] = $username;
		$time = $this->field('recentlylogintime,lastlogintime')->where($where)->find();
		if($time && $ac == 'up')
		{
			$data['lastlogintime']     = $time['recentlylogintime'];
			$data['recentlylogintime'] = time();
			$res = $this->where($where)->save($data);
			if($res)
			{
				return true;
			}else{
				return false;
			}
		}elseif($time && $ac == 'get'){
			return $time['lastlogintime'];
		}else{
			return false;
		}
	}

	// 修改登录ip地址
	public function updateOrgetLoginIpAddr($username,$ac)
	{
		$where['username'] = $username;
		$ip = $this->field('recentlyipaddr,lastipaddr')->where($where)->find();
		//var_dump(boolval( $time ));
		if($ip && $ac == 'up')
		{
			if($ip['recentlyipaddr'] == get_client_ip() && $ip['lastipaddr'] == $ip['recentlyipaddr'])
			{
				return true;
			}
			
			$data['lastipaddr']     = $ip['recentlyipaddr'];
			$data['recentlyipaddr'] = get_client_ip();
			$res = $this->where($where)->save($data);
			if($res)
			{
				return true;
			}else{
				return false;
			}
		}elseif($ip && $ac == 'get'){
			return $ip['lastipaddr'];
		}else{
			return false;
		}

	} 
}