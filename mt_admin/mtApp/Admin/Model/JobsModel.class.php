<?php
namespace Admin\Model;
use Think\Model;
class JobsModel extends Model
{
	public function getJobsList()
	{
		$field = array("id","job","addtime","status","views");
		$list = $this->field($field)->select();
		return $list;
	}

	public function addJobs($data)
	{
		$aff = $this->add($data);
		return $aff;
	}

	public function saveJobs($id,$data)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	public function getOneJobs($id)
	{
		$field = array("id","job","des");
		$where['id'] = $id;
		$list = $this->field($field)->where($where)->find();
		$list['des'] = htmlspecialchars_decode($jobList['des']);
		return $list;
	}

	public function deleteJobs($id)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->delete();
		return $aff;
	}

	public function upDataJob($id)
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

}