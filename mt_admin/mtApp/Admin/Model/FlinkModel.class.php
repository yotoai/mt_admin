<?php
namespace Admin\Model;
use Think\Model;
class FlinkModel extends Model
{
	public function getFlinkList()
	{
		$field = array("id","comname","url","logo","addtime","status");
		$list = $this->field($field)->select();
		return $list;
	}

	public function addFlink($data)
	{
		$aff = $this->add($adta);
		return $aff;
	}

	public function upStatusFlink($id)
	{
		$where['id'] = $id;
		$status = $this->field('status')->where($where)->find();
		if($status['status']==1){
			$data['status'] = 0; 
		}else{
			$data['status'] = 1; 
		}
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	public function saveFlink($id,$data)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	public function getOneFlink($id)
	{
		$field = array("comname","url","logo");
		$where['id'] = $id;
		$list = $this->field($field)->where($where)->find();
		return $list;
	}

	public function deleteFlink($id)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->delete();
		return $aff;
	}
}