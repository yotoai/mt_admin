<?php
namespace Admin\Model;
use Think\Model;
class MsgModel extends Model
{
	// 获取客户留言列表
	public function getMsglist()
	{
		$list = $this->field('id,name,company,tel,email,require,addtime')->select();
		return $list;
	}

	// 修改留言状态
	public function saveMsgstatus()
	{
		$data['status'] = 1;
		$where['status'] = 0;
		return $this->where($where)->save($data);
	}

	// 获取最新留言数量 
	public function getMsgcount()
	{
		$data['status'] = 0;
		return $this->where($data)->count('id');
	}

	// 删除留言
	public function deleteMsg($data)
	{
		return $this->where($data)->delete();
	}
}