<?php
namespace Admin\Model;
use Think\Model;
class AuthRuleModel extends Model
{
	// 验证数据
	protected $_validate = array(
		array('id','require','未知权限！',1,'',2),
		array('id','integer','权限ID错误！',1,'',2),
		array('title','require','请输入权限名称！',1,'',3),
		array('name','require','权限字段不能为空！',1,'',3),
		array('name','','权限字段已存在！',1,'unique',3)
	);

	// 自动完成
	protected $_auto = array(
		array('addtime','time',1,'function'),
		array('des','setdes',1,'callback'),
		array('iconfont','transString',1,'callback'),
		array('iconfont','transString',2,'callback')
	);
	// 自动完成回调函数
	public function setdes()
	{
		$des = trim(I('post.des'));
		return empty($des) ? '无' : $des;
	}

	// 把图标编码转换成字符串
	public function transString()
	{
		return preg_replace('/&amp;/', '&' ,I('post.iconfont'));
	}

	// 获取 datatables格式 权限数据
	public function getRuleList($data)
	{
		$draw = $data['draw'];

		$timeArr['mintime'] = $data['mintime'];
		$timeArr['maxtime'] = $data['maxtime'];
		$where = $this->dealTime($timeArr);
		$search = trim($data['conditions']);
		if(strlen($search) > 0)
		{
			$where['id|title|name|des|addtime'] = array('like','%'.$search.'%');
		}
		$where['status'] = array('neq',-1);
		$recordsTotal = $this->where('status != -1')->count();
		$recordsFiltered = $this->where($where)->count();
		$orderArr = [
						1 => 'id',
						2 => 'title',
						3 => 'name',
						4 => 'des',
						5 => 'addtime'
					];
		$orderField = (empty($orderArr[$data['order']['0']['column']])) ? 'id' : $orderArr[$data['order']['0']['column']];
		$order = $orderField.' '.$data['order']['0']['dir'];
		$result = [];
		$field = array(
					'id',
					'title',
					'name',
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

    public function findRule($id)
    {
    	$field = array('id','title','name','pid','des','iconfont');
    	$res = $this->field($field)->where('id='.$id)->find();
    	$res['iconfont'] = preg_replace('/&/', '&amp;' ,$res['iconfont']);
    	return $res;
    }
  	
  	private static $arrs = array();
	public static function getRules($pid=0,$count=1)
	{
		$where['pid'] = $pid;
		$field = array(
					'id',
					'pid',
					'title'
				);	
		
		$list = M('auth_rule')->field($field)->where($where)->select();
		foreach($list as $key => $val)
		{
			if($val['pid'] == $pid)
			{
				
				$val['title'] = str_repeat('— ', $count-1).$val['title'];
				self::$arrs[] = $val;
				unset($list[$key]);
				self::getRules($val['id'],$count+1);
			}
		}
		return self::$arrs;
	}

	// 获取权限 根据pid
	public function getRuleDataWithPid($pid=0)
	{
		$where['pid'] = $pid;
		$field = array('id','title','name','iconfont');
		$list = $this->field($field)->where($where)->select();
		return $list;
	}
}