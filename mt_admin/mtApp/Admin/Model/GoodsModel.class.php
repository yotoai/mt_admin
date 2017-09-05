<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model
{
	public function getGoodsList($data)
	{
		//获取Datatables发送的参数 必要
        $draw = $data['draw'];    //这个值直接返回给前台
        //获取时间区间
        $timeArr['mintime'] = $data['mintime'];
        $timeArr['maxtime'] = $data['maxtime'];
        $where = $this->dealTime($timeArr);
        if($data['cateid'] != "")
        {
        	$l = $this->getCateIDList($data['cateid']);
        	$where['goodscateid'] = array("in",trim($l,","));
        	
        }
        //搜索框
        $search = trim($data['conditions']);    //获取前台传过来的过滤条件 
        if(strlen($search) > 0) {
            $where['id|goodsname|goodscateid|goodscatename|goodsprice|addtime|refreshtime'] = array('like','%'.$search.'%');
        }
        $where['goodsstatus'] = array("neq",-99);
        //定义查询数据总记录数sql
        $recordsTotal = $this->where("goodsstatus != -99")->count();
		//定义过滤条件查询过滤后的记录数sql
        $recordsFiltered = $this->where($where)->count();
        //排序条件
        $orderArr = [
        				1=>'id', 
        				2=>'goodsname', 
        				3=>'goodscateid', 
        				4=>'goodsprice', 
        				5=>'addtime',
        				6=>"refreshtime",
        				7=>"goodsstatus",
        				8=>"goodscatename"
        			];
        //获取要排序的字段
        $orderField = (empty($orderArr[$data['order']['0']['column']])) ? 'id' : $orderArr[$data['order']['0']['column']];
        //需要空格,防止字符串连接在一块
        $order = $orderField.' '.$data['order']['0']['dir'];
        //按条件过滤找出记录
        $result = [];

		$field = array(
					"id",
					"goodsname",
					"goodsimg",
					"goodscateid",
					"goodscatename",
					"goodsprice",
					"goodsstatus",
					"addtime",
					"refreshtime"
				);
		$result = $this
					->field($field)
					->where($where)
					->order($order)
					->limit(intval($data['start']).','.intval($data['length']))
					->select();
		if(!empty($result))
		{
			foreach($result as $key=>$val){
				$result[$key]['addtime'] = date("Y-m-d H:i:s",$val['addtime']);
				$result[$key]['refreshtime'] = date("Y-m-d H:i:s",$val['refreshtime']);
        	}
		}
        //拼接要返回的数据
        $list = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $result,
        );        
        return $list;
	}
	
	//其中,dealTime方法主要用于处理时间段
    public function dealTime($data)
    {
        //处理最小时间
        if($data['mintime'] == ''){
        	$data['mintime'] = 0; 
        }else{
         	$data['mintime'] = strtotime($data['mintime']);
    	}
        //处理最大时间(当前时间)
        if($data['maxtime'] == ''){
        	$data['maxtime'] = time();
       	}else{
       		$data['maxtime'] = strtotime($data['maxtime'])+3600*24;
       	}
        $data['addtime'] = array('between', array($data['mintime'], $data['maxtime']));
        //清除没用的东西(防止条件报错)
        unset($data['mintime']);
        unset($data['maxtime']);
        return $data;
    }

    // 获取相应的商品类型ID
    static public $str = ""; 
    public static function getCateIDList($pid)
    {
    	$where['pid'] = $pid;
    	$list = M("goodscate")->field("id,pid")->where($where)->select();
    	if(!empty($list))
    	{
	    	foreach($list as $key=> $val)
			{
				if($val['id'] != "")
				{
					self::getCateIDList($val['id']);
				}
			}
    	}else{
    		self::$str .= $pid.",";
    	}
		return self::$str;
    }

	// 添加商品
	public function addGoods($data)
	{
		$aff = $this->add($data);
		return $aff;
	}

	// 修改商品状态(下架)
	public function changeGoodsStatusOff($id)
	{
		$where['id'] = array("in",$id);
		$list = $this->field("id,goodsstatus")->where($where)->select();
		$temp = "No";
		foreach($list as $key=>$val)
		{
			if($val['goodsstatus'] == 1)
			{
				$temp = "Yes";
				$gid .= $val['id'].",";
			}
		}
		if($temp == "No")
		{
			return $temp;
		}
	    $data['goodsstatus'] = -1;
	    $data['refreshtime'] = time();
	    $where1['id'] = array("in",trim(trim($gid,",")));
        $aff = $this->where($where1)->save($data);
        return $aff;
	}
	// 修改商品状态(上架)
	public function changeGoodsStatusUp($id)
	{
		$where['id'] = array("in",$id);
		$list = $this->field("id,goodsstatus")->where($where)->select();
		$temp = "No";
		foreach($list as $key=>$val)
		{
			if($val['goodsstatus'] == -1)
			{
				$temp = "Yes";
				$gid .= $val['id'].",";
			}
		}
		if($temp == "No")
		{
			return $temp;
		}
	    $data['goodsstatus'] = 1;
	    $data['refreshtime'] = time();
	    $where1['id'] = array("in",trim(trim($gid,",")));
        $aff = $this->where($where1)->save($data);
        return $aff;
	}

	// 保存商品信息
	public function saveGoods($id,$data)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	// 获取一条商品信息
	public function getOneGoodsInfo($id)
	{
		$where['id'] = $id;
		$list = $this->field("*")->where($where)->find();
		$list['goodscontent'] = stripcslashes(htmlspecialchars_decode($list['goodscontent']));
		return $list;
	}

	public function deleteGoods($id)
	{
		$l = count(explode(",",$id));
        if($l == 1)
        {
        	$errormsg = "删除失败！原因：该商品已上架，不能删除！";
        }elseif($l < 1){
        	$map['flag'] = false;
			$map['msg']  = "删除失败！原因：未知商品！";
			return $map;
        }elseif($l > 1){
        	$errormsg = "删除失败！原因：有商品已上架，不能删除！";
        }
		$where['id'] = array("in",$id);
		$list = $this->field("goodsstatus")->where($where)->select();
		foreach($list as $key => $val)
		{
			if($val['goodsstatus'] == 1)
			{
				$map['flag'] = false;
				$map['msg']  = $errormsg;
				return $map;
				break;
			}
		}
		$data['goodsstatus'] = -99;
		$data['refreshtime'] = time();
		$aff = $this->where($where)->save($data);
		if($aff){
			$map['flag'] = true;
			return $map;
		}else{
			return $aff;
		}
	}

}	