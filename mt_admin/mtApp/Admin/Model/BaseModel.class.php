<?php
namespace Admin\Model;
use Think\Model;
/**
*  
*/
class BaseModel extends Model
{
	// 新增用户时的规则
	public function insertUserRules()
	{
		return $rules = [
				['username','require','用户名不能为空！',1],
				['username','/^[a-zA-Z\d_]{3,16}$/','用户名不能有中文且长度为3到16位！',1],
				['username','3,16','用户名长度需在3-16位！',1,'length'],
				['password','require','密码不能为空！',1],
				['password','6,32','密码最短为6位！',1,'length'],
				['password','/^[a-zA-Z\d_]{6,32}$/','密码不能有中文且长度为6到32位！',1,'regex'],
				['password','repassword','请输入相同密码！',1,'confirm'],
				['telephone','require','请输入手机！',1],
				['telephone','11','手机位数错误！',1,'length'],
				['telephone','/^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/','手机格式错误！',1,'regex'],
				['email','require','请输入email！',1],
				['email','email','请输入正确的email！',1],
				['role','require','用户角色不能为空！',1],
				['role','verifyRole','用户角色不存在！',1,'function']
		];
	}

	// 更新用户时的规则
	public function updateUserRules()
	{
		return $rules = [
			['id','require','未知用户！'],
			['telephone','require','请输入手机！',1],
			['telephone','11','手机位数错误！',1,'length'],
			['telephone','/^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/','手机格式错误！',1,'regex'],
			['email','require','请输入email！',1],
			['email','email','请输入正确的email！',1],
			['role','require','用户角色不能为空！',1],
			['role','verifyRole','用户角色不存在！',1,'function']
		];
	}

	// 判断 角色id 是否存在
	public function verifyRole()
	{
		$arr = array_values( M('auth_group')->field('id')->select() );
		return in_array(I('post.role'),$arr) ? true : false;
	}

	// 重置密码时的规则
	public function resetPwdRules()
	{
		return $rules = [
			['id','require','未知用户！'],
			['password','require','密码不能为空！',1],
			['password','6,32','密码最短为6位！',1,'length'],
			['password','/^[a-zA-Z\d_]{6,32}$/','密码不能有中文且长度为6到32位！',1,'regex'],
			['password','isChangePwd','修改的密码不能和原密码相同！',1,'callback']
		];
	}

	// 验证密码是否改动
	public function isChangePwd()
	{
		$where['id'] = empty(I('post.id/d')) ? session('mt_userid') : I('post.id/d');
		// return $where;
		$res = M('user')->field("password")->where($where)->find();
		//return $res;
		return $res['password'] == md5(crypt(I('post.password/s'), C('SALT'))) ? false : true;
	}

	// 修改个人信息
	public function changePersonInfoRules()
	{
		return $rules = [
			['telephone','require','请输入手机！',1],
			['telephone','11','手机位数错误！',1,'length'],
			['telephone','/^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/','手机格式错误！',1,'regex'],
			['email','require','请输入email！',1],
			['email','email','请输入正确的email！',1],
		];
	}

	// 修改密码
	public function changePwdRules()
	{	
		return $rules = [
			['oldpassword','require','原密码不能为空！'],
			['password','require','密码不能为空！'],
			['repassword','require','确认密码不能为空！'],
			['password','6,32','新密码最短为6位！',1,'length'],
			['password','/^[a-zA-Z\d_]{6,32}$/','密码不能有中文且长度为6到32位！',1,'regex'],
			['password','repassword','请输入相同密码！',1,'confirm'],
			['oldpassword','isTruePwd','原密码不正确！',1,'callback'],
			['password','isChangePwd','修改的密码不能和原密码相同！',1,'callback']
		];
	}

	// 验证密码是否正确
	public function isTruePwd()
	{
		$where['id'] = empty(I('post.id/d')) ? session('mt_userid') : I('post.id/d');
		$res = M('user')->field("password")->where($where)->find();
		return $res['password'] == md5(crypt(I('post.oldpassword/s'), C('SALT'))) ? true : false;
	}

	public function insertUserAuto()
	{
		return $auto = [
			['addtime','time',1,'function'],
			['password','encrypt',1,'callback'],
			['des','setDes',1,'callback'],
			['rolename','setRoleName',1,'callback']
		];
	}
	/* 给密码加密 */
	public function encrypt()
	{
		if(empty(I('post.password'))) return false;
		return md5(crypt(I('post.password/s'), C('SALT')));
	}

	// 更新用户时
	public function updateUserAuto()
	{
		return $auto = [
			['des','setDes',2,'callback'],
			['rolename','setRoleName',2,'callback']
		];
	}

	// 修改个人信息时
	public function changePersonInfoAuto()
	{
		return $auto = [
			['des','setDes',2,'callback']
		];
	}

	public function changePwdAuto()
	{
		return $auto = [
			['password','encrypt',2,'function']
		];
	}

	// 设置备注
	public function setDes()
	{
		return empty(trim(I('post.des/s'))) ? '无' : I('post.des/s');
	}

	// 设置 角色名称 
	public function setRoleName()
	{
		return array_values(M('auth_group')->field('title')->where('id='.I('post.role'))->find())[0];
	}
}