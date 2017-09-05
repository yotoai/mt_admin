<?php
namespace Admin\Model;
use Think\Model;
class LogModel extends Model
{
	// 增加日志
	public function addLog($data='')
	{
		if(empty($data))
		{
			return false;
		}else{
			$aff = $this->add($data);
			if($aff)
			{
				return true;
			}else{
				return false;
			}
		}
	}

	// 获取日志列表
	public function getLoglist()
	{
		$logList = $this->field('id,content,visitor,ip,logintime')->select();
		return $logList ? $logList : false;
	}

	public function deleteLog($data)
	{
		return $this->where($data)->delete();
	}
}