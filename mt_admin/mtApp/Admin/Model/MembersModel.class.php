<?php
namespace Admin\Model;
use Think\Model;
class MembersModel extends Model
{
	public function getMenbersList($data)
	{
				//获取Datatables发送的参数 必要
        $draw = $data['draw'];    //这个值直接返回给前台
        //获取时间区间
        $timeArr['mintime'] = $data['mintime'];
        $timeArr['maxtime'] = $data['maxtime'];
        $where = $this->dealTime($timeArr);

        //搜索框
        $search = trim($data['conditions']);    //获取前台传过来的过滤条件 
        if(strlen($search) > 0) {
            $where['auto_id|wx_nickname|wx_openid|wx_city|subscribe_time|recent_time|members_status'] = array('like','%'.$search.'%');
        }
        $where['members_status'] = array("neq",-99);
        //定义查询数据总记录数sql
        $recordsTotal = $this->where("members_status != -99")->count();
		//定义过滤条件查询过滤后的记录数sql
        $recordsFiltered = $this->where($where)->count();
        //排序条件
        $orderArr = [
        				1=>'auto_id',
        				2=>'wx_nickname',
        				3=>'wx_openid',
        				4=>'wx_city',
        				5=>'subscribe_time',
        				6=>"recent_time",
        				7=>"members_status"
        			];
        //获取要排序的字段
        $orderField = (empty($orderArr[$data['order']['0']['column']])) ? 'auto_id' : $orderArr[$data['order']['0']['column']];
        //需要空格,防止字符串连接在一块
        $order = $orderField.' '.$data['order']['0']['dir'];
        //按条件过滤找出记录
        $result = [];

		$field = array(
					"auto_id",
					"wx_nickname",
					"wx_openid",
					"wx_city",
					"subscribe_time",
					"recent_time",
					"members_status"
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
				$result[$key]['subscribe_time'] = date("Y-m-d H:i:s",$val['subscribe_time']);
				$result[$key]['recent_time'] = date("Y-m-d H:i:s",$val['recent_time']);
        	}
		}
        //拼接要返回的数据
        $list = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $result
        );        
        return $list;

		//$list = $this->field($field)->where("members_status != -99")->select();
		//return $list;
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

	public function getOneMemberInfo($id)
	{
		$field = array("wx_nickname","wx_headimgurl","wx_sex","wx_city","subscribe_time","res1");
		$where['auto_id'] = $id;
		$list = $this->field($field)->where($where)->find();
		$res = M("members_sex")->field("sex_name")->where("sex_code=".$list['wx_sex'])->find();
		$list['wx_sex'] = $res['sex_name'];
		return $list;
	}

	public function editMemberInfo($id)
	{
		$field = array("wx_nickname","wx_headimgurl","wx_sex","wx_city","subscribe_time","res1");
		$where['auto_id'] = $id;
		$list = $this->field($field)->where($where)->find();
		return $list;
	}

	// 编辑会员信息
	public function saveMember($id,$data)
	{
		$where['auto_id'] = $id;
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	// 删除会员
	public function deleteMember($id)
	{
		$where['auto_id'] = $id;
		$data['members_status'] = -99;
		$data['delete_time'] = time();
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	public function changeMemberStatus($id)
	{
		$where['auto_id'] = $id;
		$status = $this->field("members_status")->where($where)->find();
		if($status['members_status'] == 1){
			$data['members_status'] = -1;
		}elseif($status['members_status'] == -1){
			$data['members_status'] = 1;
		}elseif($status['members_status'] == -99){
			$data['members_status'] = -1;
			$data['restore_time'] = time();
		}
		$aff = $this->where($where)->save($data);
		return $aff;
	}

	// 获取被删除的会员列表
	public function getDeletedMembers()
	{
		$where['members_status'] = -99;
		$field = array("auto_id","wx_nickname","wx_openid","wx_city","subscribe_time","members_status");
		$list = $this->field($field)->where($where)->select();
		return $list;
	}

	public function searchAllMembers($data)
	{
		// $where['members_status'] = -99;
		$where = $data['_string'].' AND members_status = -99';
		$field = array("auto_id","wx_nickname","wx_openid","wx_city","subscribe_time","members_status");
		$list = $this->field($field)->where($where)->select();
		// dump($where);
		return $list;
	}
}