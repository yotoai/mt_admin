<?php
namespace Admin\Model;
use Think\Model;
class AuthRuleModel extends Model
{
	public function ruleAdd($data)
	{
		if($this->issetRule($data['name']))
		{
			$map['flag'] = false;
			$map['msg']  = '权限字段已存在！' ;
			return $map;
		}
		$res = $this->add($data);
		if($res)
		{
			$map['flag'] = true;
			$map['msg']  = '添加成功！' ;
			return $map;
		}
		else
		{
			$map['flag'] = false;
			$map['msg']  = '添加失败！' ;
			return $map;
		}
	}

	private function issetRule($name)
	{
		$where['name'] = $name;
		$res = $this->where($where)->count('id');
		return $res > 0 ? true : false;
	}
}