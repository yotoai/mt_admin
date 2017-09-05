<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model
{
	// 获取用户列表
	public function getUserlist()
	{
		$arr = array('id','username','telephone','email','grade','status','addtime');
		$userList = $this->field($arr)->select();
		return $userList;
	}

	// 单独获取一个用户的信息
	public function getOneuserinfo($data)
	{
		$arr = array('id','username','password','telephone','email','grade','des');
		$adminList = $this->field($arr)->where($data)->find();
		$adminList['password'] = substr($adminList['password'],0,8);
		return $adminList;
	}

	public function CheckCurrentLoginID($username)
	{
		$res = $this->field("id")->where("username='".$username."'")->find();
		return $res;
	}

	// 添加用户
	public function addUser($data)
	{
		return $this->add($data) ? true : false;
	}

	// 删除用户
	public function deleteUser($data)
	{
		$aff = $this->where($data)->delete();
		return $aff;
	}

	// 修改用户
	public function saveUser($id,$data)
	{
		$aff = $this->where('id='.$id)->save($data);
		return $aff;
	}

	// 修改用户状态
	public function upStatus($id)
	{
		$res = $this->field('status')->where('id='.$id)->find();
		if($res['status'] == 1){
			$data['status'] = -99;
		}else{
			$data['status'] = 1;
		}
		$aff = $this->where('id='.$id)->save($data);
		return $aff;
	}
	// 验证密码是否改动
	public function checkPassword($id,$password)
	{
		$pass = $this->field("password")->where("id=".$id)->find();
		$pass1 = substr($pass['password'],0,8);
		return $pass1 == $password ? $pass['password'] : false;
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
		$data['password'] = md5($userpassword);
		$count = $this->where($data)->count("id");
		if($data['password'] == $password['password'] && $count ==1)
		{
			return true;
		}else{
			return false;
		}
	}

	// 登录验证用户的状态
	public function userStatus($username,$userpassword)
	{
		$data['username'] = $username;
		$data['password'] = md5($userpassword);
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

	// 获取用户基本信息
	public function getUserbaseinfo($username,$userpassword)
	{
		$data['username'] = $username;
		$data['password'] = md5($userpassword);
		$userinfo = $this->field("grade")->where($data)->find();
		return $userinfo;
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
		//var_dump(boolval( $time ));
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