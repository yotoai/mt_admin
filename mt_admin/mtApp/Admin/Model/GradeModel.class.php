<?php
namespace Admin\Model;
use Think\Model;
class GradeModel extends Model
{
	// 获取角色列表
	public function getGradelist()
	{
		$arr = array("id","grade");
		$list = $this->field($arr)->select();
		return $list;
	}
}