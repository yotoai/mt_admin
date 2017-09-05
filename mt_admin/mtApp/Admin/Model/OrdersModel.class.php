<?php
namespace Admin\Model;
use Think\Model;
class OrdersModel extends Model
{
	public function getAllOrdersList($data)
	{
		$draw = $data['draw'];

		$search = trim($data['search']['value']);
		if(strlen($search) > 0)
		{
			$where['auto_id|order_numbers|goods_quantity|order_status|order_createtime|order_total'] = array('like','%'.$search.'%');
		}

		$recordsTotal = $this->count();
		$recordsFiltered = $this->where($where)->count();
		$orderList = [
						1=>'auto_id',
						2=>'order_numbers',
						3=>'goods_quantity',
						4=>'order_status',
						5=>'order_createtime',
						6=>'order_total'
					 ];
		//获取要排序的字段
        $orderField = (empty($orderArr[$data['order']['0']['column']])) ? 'auto_id' : $orderArr[$data['order']['0']['column']];
        //需要空格,防止字符串连接在一块
        $order = $orderField.' '.$data['order']['0']['dir'];
        //按条件过滤找出记录
        $result = [];

        $field = array("auto_id","order_numbers","goods_quantity","order_createtime","order_status","order_total");
		$result = $this->field($field)->where($where)->order($order)->limit($data['start'].','.$data['length'])->select();
		if(!empty($result))
		{
			foreach($result as $key=>$val)
			{
				$result[$key]['order_createtime'] = date("Y-m-d H:i:s",$val['order_createtime']);
				$where1['status_code'] = $val['order_status'];
				$status = M("orderstatus")->field("status_name")->where($where1)->find();
				$result[$key]['order_status_name'] = $status['status_name'];
			}
		}

		//拼接要返回的数据
        $list = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered"=>intval($recordsFiltered),
            "data" => $result,
        );
		return $list;
	}

	public function getOrderDetail($id)
	{
		$where['auto_id'] = $id;
		$field = array("order_numbers","goods_quantity","order_createtime","order_paytime","order_status","order_total","buyer_openid","address_id","buyer_msg");
		$list = $this->field($field)->where($where)->find();
		// 获取商品信息
		$where1['order_numbers'] = $list['order_numbers'];
		$infofield = array("goods_name","goods_img","buy_count","goods_price");
		$res = M("orderinfo")->field($infofield)->where($where1)->find();
		$list["goodsinfo"][] = $res;
		// 获取买家信息
		$where2['wx_openid'] = $list['buyer_openid'];
		$nickname = M("members")->field("wx_nickname")->where($where2)->find();
		$list['buyer_openid'] = $nickname['wx_nickname'];
		// 获取订单状态信息
		$where3['status_code'] = $list['order_status'];
		$status = M("orderstatus")->field("status_name")->where($where3)->find();
		$list['order_status'] = $status['status_name'];
		// 获取地址信息
		$addressfield = array("receiver_name","receiver_phonenum","receiver_address");
		$adinfo = M("buyeraddress")->field($addressfield)->where("auto_id=".$list['address_id'])->find();
		$list["address_id"] = $adinfo;
		return $list;
	}

	public function confirmReceipt($id)
	{
		$where["auto_id"] = $id;
		$status = $this->field("order_status")->where($where)->find();
		if($status['order_status'] == 50)
		{
			$status['order_status'] = 100;
		}
		$aff = $this->where($where)->save($status);
		return $aff;
	}
}