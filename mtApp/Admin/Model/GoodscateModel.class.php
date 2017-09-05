<?php
namespace Admin\Model;
use Think\Model;
class GoodscateModel extends Model
{
	public function getGoodsCatesList($data)
	{
		//定义查询数据总记录数sql
        $recordsTotal = $this->where()->count();
		//定义过滤条件查询过滤后的记录数sql
        $recordsFiltered = $this->where()->count();
		$result = $this->getGoodsCateList();
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
	public static function getGoodsCateList($pid=0,$count=1)
	{
		$where['pid'] = $pid;
		$field = array(
					"id",
					"pid",
					"classify",
					"cateimg",
					"catedes",
					"cateaddtime",
					"catestatus"
				);
		$list = M("goodscate")
					->field($field)
					->where($where)
					->limit($start.','.$length)
					->select();
		//echo M("goodscate")->getLastSql();
		foreach($list as $key => $val)
		{
			if($val['pid'] == $pid)
			{
				$val['classify'] = str_repeat('— ', $count-1).$val['classify'];
				$val['cateaddtime'] = date("Y-m-d H:i:s",$val['cateaddtime']);
				self::$arrs[] = $val;
				unset($list[$key]);
				self::getGoodsCateList($val['id'],$count+1);
			}
		}
		return self::$arrs;
	}

	public function getGoodsCateNameList($id)
	{
		if(!empty($id))
		{
			if($id == 'p') $id = 0;
			$where['pid'] = $id;
		}
		$field = array("id","classify");
		$list = $this->field($field)->where($where)->select();
		return $list;
	}

	public function addGoodsCate($data)
	{
		$aff = $this->add($data);
		return $aff;
	}

	public function changeGoodsCateStatus($id)
	{
		$where['id'] = $id;
		$status = $this->field('catestatus')->where($where)->find();
        if($status['catestatus'] == 1){
            $data['catestatus'] = -1;
        }else{
            $data['catestatus'] = 1;
        }
        $aff = $this->where($where)->save($data);
        return $aff;
	}

	public function deleteGoodsCate($id)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->delete();
		return $aff;
	}

	public function saveGoodsCate($id,$data)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	public function SaveCateName($id,$catename)
	{
		$where['id'] = $id;
		$data['classify'] = $catename;
		$res = $this->where($where)->save($data);
		return $res;
	}

	public function getOneGoodsCate($id)
	{
		$where['id'] = $id; 
		$field = array("pid","classify","cateimg","catedes");
		$list = $this->field($field)->where($where)->find();
		return $list;
	}

	public function getTreeLists()
	{
		$field = array("id","pid","classify");
		$list = $this->field($field)->select();
		return $list;
	}
}