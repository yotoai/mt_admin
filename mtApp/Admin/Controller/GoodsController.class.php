<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends BaseController 
{
    protected $Goods;
    protected $GoodsCate;
    public function _initialize()
    {
        parent::_initialize();
        $this->Goods = D('goods');
        $this->GoodsCate = D('goodscate');
    } 

    public function index()
    {
        if(IS_AJAX){
            $goodsList = $this->Goods->getGoodsList(I("get."));
            $this->ajaxReturn($goodsList); 
        }
        $this->display();
    }

    public function addGoods()
    {
        $data = array();
    	if(IS_POST){
            $data = I("post.");
            $data['goodsimg'] = $this->uploadPic('goodsImg',$_FILES['img']);
            $data['goodscontent'] = I('post.editorValue');
            $data['addtime'] = time();
            $data['refreshtime'] = time();
            $data['goodscatename'] = $this->getCateName($data['goodscateid']);
            $aff = $this->Goods->addGoods($data);
            if($aff){
                $map['flag'] = true;
                $map['msg'] = "添加成功！";
                $this->ajaxReturn($map);
            }else{
                $map['flag'] = false;
                $map['msg'] = "添加失败！";
                $this->ajaxReturn($map);
            }
    	}else{
            $cateList = $this->GoodsCate->getGoodsCateNameList();
            $this->assign('cateList',$cateList);
    		$this->display();
    	}
    }

    private function getCateName($cid)
    {
        $name = $this->GoodsCate->getOneGoodsCate($cid);
        return $name['classify'];
    }

    // 删除商品
    public function delGoods()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg']  = "未知商品ID！";
            $this->ajaxReturn($map);
        }
        $id = trim(trim($id),",");
        $aff = $this->Goods->deleteGoods($id);
        if($aff['flag'] == true){
            $map['flag'] = true;
            $map['msg']  = "删除成功！";
            $this->ajaxReturn($map);
        }elseif($aff['flag'] == false){
            $map['flag'] = false;
            $map['msg']  = $aff['msg'];
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg']  = "删除失败！".$aff;
            $this->ajaxReturn($map);
        }
    }
    // 下架
    public function offGoodsStatus()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg']  = "未知商品ID！";
            $this->ajaxReturn($map);
        }
        $id = trim(trim($id),",");
        $aff = $this->Goods->changeGoodsStatusOff($id);
        if($aff == "No")
        {
            $map['flag'] = false;
            $map['msg']  = "没有需要下架的商品！";
            $this->ajaxReturn($map);
        }
        if($aff && $aff != "No"){
            $map['flag'] = true;
            $map['msg']  = "修改成功！";
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg']  = "修改失败！";
            $this->ajaxReturn($map);
        }
    }
    // 上架
    public function upGoodsStatus()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg']  = "未知商品ID！";
            $this->ajaxReturn($map);
        }
        $id = trim(trim($id),",");
        $aff = $this->Goods->changeGoodsStatusUp($id);
        if($aff == "No")
        {
            $map['flag'] = false;
            $map['msg']  = "没有需要上架的商品！";
            $this->ajaxReturn($map);
        }
        if($aff && $aff != "No"){
            $map['flag'] = true;
            $map['msg']  = "修改成功！";
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg']  = "修改失败！";
            $this->ajaxReturn($map);
        }
    }

    // 编辑商品
    public function editGoods()
    {
        $id = I('get.id');
        if(IS_POST){
            if($_FILES['imgs'] == ''){
                $data = I("post.");
                $data['goodsimg']     = I("post.img");
                $data['goodscontent'] = I('post.editorValue');
                $data['goodscatename'] = $this->getCateName($data['goodscateid']);
                $aff = $this->Goods->saveGoods($data['id'],$data);
                if($aff){
                    $map['flag'] = true;
                    $map['msg']  = "修改成功！";
                    $this->ajaxReturn($map);
                }else{
                    $map['flag'] = false;
                    $map['msg']  = "修改失败！";
                    $this->ajaxReturn($map);
                }
            }elseif($_FILES['imgs']['name'] != ''){
                $data    = I("post.");
                $namePic = $this->uploadPic('goodsImg',$_FILES['imgs']);
                $data['goodsimg']     = $namePic;
                $data['goodscontent'] = I('post.editorValue'); 
                $data['goodscatename'] = $this->getCateName($data['goodscateid']);
                $aff = $this->Goods->saveGoods($data['id'],$data);
                if($aff){
                    $map['flag'] = true;
                    $map['msg']  = "修改成功！";
                    $this->ajaxReturn($map);
                }else{
                    $map['flag'] = false;
                    $map['msg']  = "修改失败！";
                    $this->ajaxReturn($map);
                }
            }
        }else{
            $goodsList = $this->Goods->getOneGoodsInfo($id);
            $cateList  = $this->GoodsCate->getGoodsCateNameList();
            $this->assign("cateList",$cateList);
            $this->assign("goodsList",$goodsList);
            $this->assign("id",$id);
            $this->display();
        }
    }

    // 三级联动
    public function getCateList()
    {
        $id = I("post.id");
        $list = $this->GoodsCate->getGoodsCateNameList($id);
        $this->ajaxReturn($list);
    }

    public function category()
    {
        if(IS_AJAX){
            $cateList = $this->GoodsCate->getGoodsCatesList(I("get."));
            $this->ajaxReturn($cateList);
        }
        //$cateList = $this->GoodsCate->getGoodsCateList();
        //$this->assign("cateList",$cateList);
    	$this->display();
    }

    public function addCategory()
    {
    	if(IS_POST){
            $path = 'classifyImg';
            $img  = $_FILES['img'];
            if($img != "")
            {
                $namePic = $this->uploadPic($path,$img);
            }else{
                $namePic = '/img/default.jpg';
            }
            $data['classify'] = I('post.classify');
            $data['pid']      = I("post.pid");
            $data['cateimg']  = $namePic;
            $data['catedes']  = I('post.des');
            $data['cateaddtime'] = time();
            $aff = $this->GoodsCate->addGoodsCate($data);
            if($aff){
                $map['flag'] = true;
                $map['msg']  = "添加成功！";
                $map['id'] = $aff;
                $this->ajaxReturn($map);
            }else{
                $map['flag'] = false;
                $map['msg']  = "添加失败！";
                $this->ajaxReturn($map);
            }
    	}else{
            $typelist = $this->GoodsCate->getGoodsCateList();
            $this->assign("typeList",$typelist);
    		$this->display();
    	}
    }

    public function upGoodsCateStatus()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg']  = "未知分类ID！";
            $this->ajaxReturn($map);
        }
        $aff = $this->GoodsCate->changeGoodsCateStatus($id);
        if($aff){
            $map['flag'] = true;
            $map['msg']  = "修改成功！";
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg']  = "修改失败！";
            $this->ajaxReturn($map);
        }
    }

    public function delCate()
    {
        $id = I('post.id','');
        // var_dump($id);
        // exit();
        if(empty($id)){
            $map['flag'] = false;
            $map['msg']  = "未知分类ID！";
            $this->ajaxReturn($map);
        }
        $aff = $this->GoodsCate->deleteGoodsCate($id);
        if($aff){
            $map['flag'] = true;
            $map['msg']  = "删除成功！";
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg']  = "删除失败！";
            $this->ajaxReturn($map);
        }
    }

    // 编辑分类
    public function editCate()
    {
        $id = I('get.id');
        if(IS_POST){
            if(!empty($_FILES['img']['error'])){
                $data['classify'] = I('post.classify');
                $data['catedes'] = I('post.des');
                $this->GoodsCate->saveGoodsCate($id,$data);
                $this->redirect('Goods/editCate?id='.$id,array('msg'=>'ref'));
            }else{
                dump($_FILES['img']);
                $namePic = $this->uploadPic("classifyImg",$_FILES['img']);
                $data['cateimg'] = $namePic;
                $data['classify'] = I('post.classify');
                $data['catedes'] = I('post.des');
                $aff = $this->GoodsCate->saveGoodsCate($id,$data);
                $this->redirect('Goods/editCate?id='.$id,array('msg'=>'ref'));
            }
        }else{
            $cateList = $this->GoodsCate->getOneGoodsCate($id);
            $typelist = $this->GoodsCate->getGoodsCateList();
            $this->assign('cateList',$cateList);
            $this->assign('typeList',$typelist);
            $this->display();
        }
    }

    public function editCateName()
    {
        $id = I("post.id","");
        if(empty($id))
        {
            $map['flag'] = false;
            $map['msg']  = "未知分类ID！";
            $this->ajaxReturn($map);
        }
        $catename = I("post.catename","");
        // var_dump($catename);
        // exit();
        $res = $this->GoodsCate->SaveCateName($id,$catename);
        if($res || $res == 0){
            $map['flag'] = true;
            $map['msg']  = "修改成功！";
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg']  = "修改失败！";
            $this->ajaxReturn($map);
        }
    }

    // 获取树列表
    public function getTreeList()
    {
        $list = $this->GoodsCate->getTreeLists();
        $this->ajaxReturn($list);
    }

    public function uploadPic($path,$img)
    {
        $config = array(    
            'maxSize'    =>    3145728,
            'rootPath'   =>    './Public/Uploads/'.$path.'/',
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    true,    
            'subName'    =>    array('date','Ymd'),
        );

        $upload = new \Think\Upload($config);// 实例化上传类
        $info = $upload->uploadOne($img);
        $namePic = '/Uploads/'.$path.'/'.$info['savepath'].$info['savename'];
        return $namePic;
    }
}