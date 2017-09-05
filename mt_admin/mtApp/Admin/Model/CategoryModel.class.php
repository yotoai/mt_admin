<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model
{
	// 根据ID获取分类列表
	public function getCatelist($cate=0){
		$field = array("id","catename");
		$where["pid"] = $cate;
		$where["status"] = '1';
		$typeList = $this->field($field)->where($where)->select();
		return $typeList;
	}

	// 获取当前类的父类
	public function getPrevCate($id)
	{
		$data['id'] = $id;
		$res = $this->field("pid")->where($data)->find();
		return $res["pid"];
	}

	//获取子类的个数
	public function getNextCateCount($id)
	{
		$where['pid'] = $id;
		$count = $this->where($where)->count('id');
		return $count;
	}

	// 获取一条类数据
	public function getOneCate($id)
	{
		$where['id'] = $id;
		$field = array("id","catename","imgpath","pid","des","imgname");
		$list = $this->field($field)->where($where)->find();
		return $list;
	}

	public function getNewsCateLists()
	{
		//定义查询数据总记录数sql
        $recordsTotal = $this->where()->count();
		//定义过滤条件查询过滤后的记录数sql
        $recordsFiltered = $this->where()->count();
		$result = $this->getNewsCateList($tree="");
		//拼接要返回的数据
        $list = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $result,
        );        
        return $list;
	}

	static public $arrs = array();
	public static function getNewsCateList($tree,$pid=0,$count=1)
	{
		$where['pid'] = $pid;
		$field = array(
					"id",
					"pid",
					"catename",
					"imgpath",
					"status",
					"addtime",
					"refreshtime"
				);	
		
		$list = M("category")->field($field)->where($where)->select();
		foreach($list as $key => $val)
		{
			if($val['pid'] == $pid)
			{
				if($tree != "tree"){
					$val['catename'] = str_repeat('— ', $count-1).$val['catename'];
				}
				$val['addtime'] = date("Y-m-d H:i:s",$val['addtime']);
				$val['refreshtime'] = date("Y-m-d H:i:s",$val['refreshtime']);
				self::$arrs[] = $val;
				unset($list[$key]);
				self::getNewsCateList($tree,$val['id'],$count+1);
			}
		}
		return self::$arrs;
	}




	// 增加新的分类
	public function addNewCate($data)
	{
		$aff = $this->add($data);
		return $aff;
	}

	// 保存修改的
	public function saveCate($id,$data)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	// 删除分类
	public function deleteCate($id)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->delete();
		return $aff;
	}

	// 修改分类状态
	public function upCateStatus($id)
	{
		$where['id'] = $id;
		$res = $this->field('status')->where($where)->find();
		if($res['status']==1){
            $data['status'] = -1;
        }else{
            $data['status'] = 1;
        }
        $aff = $this->where($where)->save($data);
        return $aff;
	}
}