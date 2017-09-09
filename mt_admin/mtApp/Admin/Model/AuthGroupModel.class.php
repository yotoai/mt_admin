<?php
namespace Admin\Model;
use Think\Model;
class AuthGroupModel extends Model
{
	// 验证数据
	protected $_validate = array(
		array('id','require','未知权限！',1,'',2),
		array('id','integer','权限ID错误！',1,'',2),
		array('title','require','角色名称不能为空！',1,'',array(1,2)),
		array('title','','该角色已存在！',1,'unique',3),
		array('rules','require','角色权限不能为空！',1,'',array(1,2))
	);

	// 自动完成
	protected $_auto = array(
		array('addtime','time',1,'function'),
		array('des','setdes',1,'callback'),
	);

	// 自动完成回调函数
	public function setdes()
	{
		$des = trim(I('post.des'));
		if(empty($des))
		{
			return '无';
		}
		else
		{
			return $des;
		}
	}

	// 获取 datatables格式 权限数据
	public function getRoleList($data)
	{
		$draw = $data['draw'];

		$timeArr['mintime'] = $data['mintime'];
		$timeArr['maxtime'] = $data['maxtime'];
		$where = $this->dealTime($timeArr);
		$search = trim($data['conditions']);
		if(strlen($search) > 0)
		{
			$where['id|title|des|addtime'] = array('like','%'.$search.'%');
		}
		$where['status'] = array('neq',-1);
		$recordsTotal = $this->where('status != -1')->count();
		$recordsFiltered = $this->where($where)->count();
		$orderArr = [
						1 => 'id',
						2 => 'title',
						3 => 'des',
						4 => 'addtime'
					];
		$orderField = (empty($orderArr[$data['order']['0']['column']])) ? 'id' : $orderArr[$data['order']['0']['column']];
		$order = $orderField.' '.$data['order']['0']['dir'];
		$result = [];
		$field = array(
					'id',
					'title',
					'des',
					'addtime'
				);
		$result = $this
		            ->field($field)
		            ->where($where)
		            ->order($order)
		            ->limit(intval($data['start']).','.intval($data['length']))
		            ->select();
		if(!empty($result))
		{
			foreach($result as $key=>$val)
			{
				$result[$key]['addtime'] = date('Y-m-d H:i:s',$val['addtime']);
			}
		}
		$list = array(
				'draw'           => intval($draw),
				'recordsTotal'   => intval($recordsTotal),
				'recordsFiltered'=> intval($recordsFiltered),
				'data'           => $result
			);
		return $list;
	}

	//其中,dealTime方法主要用于处理时间段
    private function dealTime($data)
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

    // 查询一条数据
    public function findRole($id)
    {
    	$where['id'] = $id;
    	$field = array('id','title','rules','des');
    	$list = $this->field($field)->where($where)->find();
    	return $list;
    }
}
