<?php
namespace Admin\Model;
use Think\Model;
class PictureModel extends Model
{
	public function getPicList()
	{
		$field = array("id","type","picname","picpath","addtime","status");
		$picList = $this->field($field)->select();
		foreach($picList as $key=>$val){
			$typename = M("picturetype")->field('typename')->where('id='.$val['type'])->find();
			$picList[$key]['type'] = $typename['typename'];
		}
		return $picList;
	}

	public function getPicCateList()
	{
		$field = array("id","typename");
		$list = M("picturetype")->field($field)->select();
		return $list;
	}

	public function isExiststype($type)
	{
		return M("picturetype")->where('id='.$type)->count("typename");
	}

	public function addPic($data)
	{
		$aff = $this->add($data);
		return $aff;
	}

	public function upPicStatus($id)
	{
		$where['id'] = $id;
		$status = $this->field('status')->where($where)->find();
		if($status['status']==-1){
			$data['status'] = 1;
		}else{
			$data['status'] = -1;
		}
		$aff = $this->where($where)->save($data);
		return $aff;
	}
	
	public function getPicStatus($id)
	{
		$where['id'] = $id;
		$res = $this->field('status')->where($where)->find();
		return $res['status'];
	}

	public function deletePic($id)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->delete();
		return $aff;
	}

	public function savePic($id,$data)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	public function getOnePic($id)
	{
		$where['id'] = $id;
		$field = array("picname","type","des","picpath");
		$list = $this->field($field)->where($where)->find();
		return $list;
	}
}