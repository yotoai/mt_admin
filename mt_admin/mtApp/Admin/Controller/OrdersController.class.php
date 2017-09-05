<?php
namespace Admin\Controller;
use Think\Controller;
class OrdersController extends BaseController 
{
	protected $Orders;
	public function _initialize()
	{
		parent::_initialize();
		$this->Orders = D('orders');
	}

	public function ordersList()
	{
		if(IS_AJAX){
			$ordersList = $this->Orders->getAllOrdersList(I("get."));
			$this->ajaxReturn($ordersList);
		}
		$this->display();
	}

	public function ordersDetail()
	{
		$id = I('get.id','');
		if(empty($id)){
			dump("订单ID为空！");
			exit();
		}
		$orderList = $this->Orders->getOrderDetail($id);
		$this->assign('orderList',$orderList);
		$this->display();
	}

	public function ordersSend()
	{
		$id = I("get.id");
		if(IS_POST){
			$id = I('post.id','');
			if(empty($id)){
				$map['flag'] = false;
				$map['msg'] = "订单ID不能为空！";
				$this->ajaxReturn($map);
			}
			$res = $this->Orders->confirmReceipt($id);
			if($res){
				$map['flag'] = true;
				$map['msg'] = "发货成功！";
				$this->ajaxReturn($map);
			}else{
				$map['flag'] = false;
				$map['msg'] = "发货失败！";
				$this->ajaxReturn($map);
			}
		}else{
			$this->assign("oid",$id);
			$this->display();
		}
	}
}