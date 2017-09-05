<?php
namespace Admin\Model;
use Think\Model;
class NewsModel extends Model
{
	public function _initialize()
	{

	}

	// 获取文章列表
	public function getNewsList($data)
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
            $where['id|title|type|status|views|addtime|refreshtime|author'] = array('like','%'.$search.'%');
        }
		//定义查询数据总记录数sql
        if($data['actions'] == "draft"){
			$where['status'] = array('not in',array('-1','1','0'));
        	$recordsTotal    = $this->where("status not in (-1,0,1)")->count();
        }elseif($data['actions'] == "index"){
			$where['status'] = array('not in',array('-1','2'));
        	$recordsTotal    = $this->where("status not in(-1,2)")->count();
        }elseif($data['actions'] == "bin"){
        	$where['status'] = array('not in',array('1','2','0'));
        	$recordsTotal    = $this->where("status not in (1,2,0)")->count();
        }
		//定义过滤条件查询过滤后的记录数sql
        $recordsFiltered =  $this->where($where)->count();
        //排序条件
        $orderArr = [
        				1=>'id', 
        				2=>'title', 
        				3=>'type', 
        				4=>'status', 
        				5=>'views',
        				6=>"addtime",
        				7=>"refreshtime",
        				7=>"author"
        			];
        			        //获取要排序的字段
        $orderField = (empty($orderArr[$data['order']['0']['column']])) ? 'id' : $orderArr[$data['order']['0']['column']];
        //需要空格,防止字符串连接在一块
        $order = $orderField.' '.$data['order']['0']['dir'];
        //按条件过滤找出记录
        $result = [];
		$field = array(
					'id',
					'title',
					'author',
					'type',
					'status',
					'views',
					'addtime',
					'refreshtime'
				);
		$result = $this
					->field($field)
					->where($where)
					->order('id desc')
					->limit(intval($data['start']).','.intval($data['length']))
					->select();
					//echo $this->getLastSql();
		foreach($result as $key=>$val)
        {
			$result[$key]['addtime'] = date("Y-m-d H:i:s",$val['addtime']);
			$result[$key]['refreshtime'] = date("Y-m-d H:i:s",$val['refreshtime']);
            $typename = M('category')
            				->field('catename')
            				->where('id='.$val['type'])
            				->find();
            $result[$key]['type'] = $typename['catename'];
        }
        //拼接要返回的数据
        $list = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $result
        );
		return $list;
	}

	//其中,dealTime方法主要用于处理时间段
    public function dealTime($data)
    {
        //处理最小时间
        if($data['mintime'] == '') $data['mintime'] = 0; else $data['mintime'] = strtotime($data['mintime']);
        //处理最大时间(当前时间)
        if ($data['maxtime'] == '') $data['maxtime'] = time(); else $data['maxtime'] = strtotime($data['maxtime'])+3600*24;
        $data['addtime'] = array('between', array($data['mintime'], $data['maxtime']));
        //清除没用的东西(防止条件报错)
        unset($data['mintime']);
        unset($data['maxtime']);
        return $data;
    }

	// 获取文章的详情
	public function getOneNews($id)
	{
		$field = array('id','title','abstract','author','icon','iconname','type','tags');
		$where['id'] = $id;
		$newsList = $this->field($field)->where($where)->find();
		$fields = array('content','keywords','describe');
		$wheres['newsid'] = $id;
        $content = M('newscontent')->field($fields)->where($wheres)->find();
        $newsList['content'] = stripcslashes(htmlspecialchars_decode($content['content']));
        $newsList['keywords'] = $content['keywords'];
        $newsList['describe'] = $content['describe'];
        return $newsList;
	}

	// 获取文章的总数
	public function getNewsCount()
	{
		$map['status'] = array('not in',array('-1','2'));
		$sum = $this->where($map)->count('id');
		return $sum;
	}

	// 获取回收站的总数
	public function getBinCount()
	{
		$sum = $this->where('status=-1')->count('id');
		return $sum;
	}

	// 获取草稿箱的总数
	public function getDraftCount()
	{
		$sum = $this->where('status=2')->count('id');
		return $sum;
	}

	// 增加文章
	public function addNews($data,$map)
	{	
		try {
			$aff = $this->add($data);
			if($aff){
				$map['newsid'] = $aff;
				$aff = M('newscontent')->add($map);
			}
			return $aff;
		} catch (Exception $e) {
			$map['flag'] = false;
			$map['msg'] = $e->message();
			return $map;
		}	
	}

	// 保存修改的文章
	public function saveNews($id,$map,$data)
	{
		$where['id'] = $id;
		$aff = $this->where($where)->save($data);
		if($aff){
			$where1['newsid'] = $id;
			$aff = M('newscontent')->where($where1)->save($map);	
		}
		if($aff == 0 || $aff)
		{
			$aff = true;
			return $aff;
		}else{
			return $aff;
		}
	}

	// 文章假删、真删
	public function deleteNews($id)
	{
		$flag = true;
		$l = count(explode(",",$id));
        if($l == 1)
        {
        	$errormsg = "删除失败！原因：该文章已发布，不能删除！";
        }elseif($l < 1){
        	$map['flag'] = false;
			$map['msg']  = "删除失败！原因：未知文章！";
			return $map;
        }elseif($l > 1){
        	$errormsg = "删除失败！原因：有文章已发布，不能删除！";
        }
		$w['id'] = array('in',$id);
		$field = array('id','status');
        $list = $this->field($field)->where($w)->select();
        foreach($list as $key=>$val)
        {
        	if($val['status'] == 1){
        		$map['flag'] = false;
				$map['msg']  = $errormsg;
				$flag = false;
				return $map;
				break;
            }
        }
        if($flag == false)
        {
        	return false;
        }
        foreach($list as $k => $v)
        {
        	if($v['status'] == -1){
            	$nid .= $v['id'].",";
            }elseif($v['status'] == 2){
                $cnid .= $v['id'].",";
            }else{
            	$onid .= $v['id'].",";
            }
        }
        if(count($nid) > 0)
        {
        	$where['id'] = array("in",trim($nid),",");
        	$res = $this->where($where)->delete();
            if($res){
            	$wheres['newsid'] = $where['id'];
            	$aff = M('newscontent')->where($wheres)->delete();
            }else{
            	return $aff;
            }
        }elseif(count($cnid) > 0){
        	$where['id'] = array("in",trim($cnid,","));
        	$data['status']      = -1;
			$data['refreshtime'] = time();
	    	$data['previousstatus'] = 2;
        	$aff = $this->where($where)->save($data);
        }elseif(count($onid) > 0){
        	$where['id'] = array("in",trim($onid,","));
        	$data['status']      = -1;
			$data['refreshtime'] = time();
	    	$data['previousstatus'] = 0;
        	$aff = $this->where($where)->save($data);
        }else{
        	return false;
        }
        if($aff)
        {
        	$map['flag'] = true;
        	return $map;
        }else{
        	return $aff;
        }
	}

	// 修改文章状态(下架)
	public function changeNewsStatusOff($id)
	{
		$where['id'] = array("in",$id);
		$list = $this->field("id,status")->where($where)->select();
		$temp = "No";
		foreach($list as $key=>$val)
		{
			if($val['status'] == 1)
			{
				$temp = "Yes";
				$nid .= $val['id'].",";
			}
		}
		if($temp == "No")
		{
			return $temp;
		}
	    $data['status']      = 0;
	    $data['refreshtime'] = time();
	    $data['previousstatus'] = 1;
	    $where1['id']        = array("in",trim($nid,","));
        $aff = $this->where($where1)->save($data);
        return $aff;
	}

	// 修改文章状态(发布)
	public function changeNewsStatusUp($id)
	{
		$where['id'] = array("in",$id);
		$list = $this->field("id,status")->where($where)->select();
		$temp = "No";
		foreach($list as $key=>$val)
		{
			if($val['status'] == 0)
			{
				$temp = "Yes";
				$nid .= $val['id'].",";
			}
		}
		if($temp == "No")
		{
			return $temp;
		}
	    $data['status']         = 1;
	    $data['refreshtime']    = time();
	    $data['previousstatus'] = 0;
	    $where1['id']           = array("in",trim($nid,","));
        $aff = $this->where($where1)->save($data);
        return $aff;
	}

	// 还原文章
	public function restoreNewsStatus($id)
	{
		$where['id'] = array("in",$id);
		$list = $this->field("id,previousstatus")->where($where)->select();
		foreach($list as $key => $val)
		{
			if($val['previousstatus'] == 0){
				$nid .= $val['id'].",";
			}elseif($val['previousstatus'] == 2){
				$cnid .= $val['id'].",";
			}
		}
		if(count($nid) > 0)
		{
			$data['status'] = 0;
			$wheres['id']   = array("in",trim($nid,","));
			$res = $this->where($wheres)->save($data);
			if($res){
				$map = true;
			}else{
				return false;
			}
		}else{
			$res = true;
		}
		if(count($cnid) > 0)
		{
			$data['status'] = 2;
			$wheress['id']   = array("in",trim($cnid,","));
			$ress = $this->where($wheress)->save($data);
			if($ress){
				$map = true;
			}else{
				return false;
			}
		}else{
			$ress = true;
		}
		if($map && $res && $ress)
		{
			return true;
		}else{
			return false;
		}
	}
}