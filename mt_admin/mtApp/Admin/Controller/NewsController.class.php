<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends BaseController 
{
    protected $News;
    protected $Cate;
    public function _initialize()
    {
        parent::_initialize();
        $this->News = D('news');
        $this->Cate = D('category');
    }

    /* status = 1 ：已发布 ，2 ：草稿 ，0 ：未发布 ，-1 ：回收站 */  
    public function index()
    {
        if(IS_AJAX)
        {
            $newsList = $this->News->getNewsList(I("get."));
            $this->ajaxReturn($newsList);
        }    
        $this->display();
    }

    public function addNews()
    {
    	if(IS_POST){
            $namePic = uploadPic('news_icon',$_FILES['img']);
            // dump(I('post.'));
            $data = I('post.');
            $data['icon'] = $namePic;
            $data['addtime'] = time();
            $data['refreshtime'] = time();
            if(I('post.thirdcate') != 0){
                $data['type'] = I('post.thirdcate');
            }elseif(I('post.thirdcate') == 0 && I('post.secondcate') != 0){
                $data['type'] = I('post.secondcate');
            }else{
                $data['type'] = I('post.firstcate');
            }
            $map['keywords'] = I('post.keywords');
            $map['describe'] = I('post.describe');
            $map['content']  = I('post.editorValue');
            $aff = $this->News->addNews($data,$map);
            if($aff['flag'] == false){
                $map['flag'] = false;
                $map['msg']  = "添加失败！，原因：".$aff['msg'];
                $this->ajaxReturn($map);
            }elseif($aff){
                $map['flag'] = true;
                $map['msg']  = "添加成功！";
                $this->ajaxReturn($map);
            }else{
                $map['flag'] = false;
                $map['msg']  = "添加失败！";
                $this->ajaxReturn($map);
            }
    	}else{
    		$cateList = $this->Cate->getCatelist();
    		$this->assign('cateList',$cateList);
    		$this->display('News/addNews');
    	}
    }

    public function editNews()
    {
        $id = I('get.id');
        if(IS_POST){
            //var_dump($_FILES['img']);
            if(empty($_FILES['img'])){
                $data = I('post.');
                //dump($data);
                //exit();
                if(I('post.thirdcate') != 0){
                    $data['type'] = I('post.thirdcate');
                }elseif(I('post.thirdcate') == 0 && I('post.secondcate') != 0){
                    $data['type'] = I('post.secondcate');
                }else{
                    $data['type'] = I('post.firstcate');
                }
                $data['refreshtime'] = time();
                $map['keywords'] = I('post.keywords');
                $map['describe'] = I('post.describe');
                $aff = $this->News->saveNews($data['id'],$map,$data);
                if($aff)
                {
                    $maps['flag'] = true;
                    $maps['msg']  = "编辑成功！";
                    $this->ajaxReturn($maps);
                }else{
                    $maps['flag'] = false;
                    $maps['msg']  = "编辑失败！";
                    $this->ajaxReturn($maps);
                }
            }else{
                $data = I('post.');
                //dump($data);
                //exit();
                if(I('post.thirdcate') != 0){
                    $data['type'] = I('post.thirdcate');
                }elseif(I('post.thirdcate') == 0 && I('post.secondcate') != 0){
                    $data['type'] = I('post.secondcate');
                }else{
                    $data['type'] = I('post.firstcate');
                }
                $namePic = uploadPic('news_icon',$_FILES['img']);
                $data['icon'] = $namePic;
                $data['refreshtime'] = time();
                $map['content'] = I('post.editorValue');
                $map['keywords'] = I('post.keywords');
                $map['describe'] = I('post.describe');
                $aff = $this->News->saveNews($data['id'],$map,$data);
                if($aff)
                {
                    $maps['flag'] = true;
                    $maps['msg']  = "编辑成功！";
                    $this->ajaxReturn($maps);
                }else{
                    $maps['flag'] = false;
                    $maps['msg']  = "编辑失败！";
                    $this->ajaxReturn($maps);
                }
            }
        }else{
            $id = I('get.id');
            $newsList = $this->News->getOneNews($id);
            // 顶级分类
            $catelist = $this->Cate->getCatelist();
            // 获取当前类型的父类
            $cateid = $this->Cate->getPrevCate($newsList['type']);
            if($cateid){
                $secondcate = $this->Cate->getPrevCate($cateid);
                if($secondcate){
                    $firstcate = $secondcate;
                    $secondcate = $cateid;
                    $catelist1 = $this->Cate->getCatelist($firstcate);
                    $thirdcate = $newsList['type'];
                    $catelist2 = $this->Cate->getCatelist($secondcate);
                }else{
                    $firstcate = $cateid;
                    $secondcate = $newsList['type'];
                    $catelist1 = $this->Cate->getCatelist($secondcate);
                }
            }else{
                $firstcate = $newsList['type'];
            }
            $this->assign('catelist',$catelist);
            $this->assign('catelist1',$catelist1);
            $this->assign('catelist2',$catelist2);
            $this->assign('first',$firstcate);
            $this->assign('second',$secondcate);
            $this->assign('third',$thirdcate);
            $this->assign('newsList',$newsList);
            $this->assign('id',$id);
            $this->display();
        }
    }

    public function draftList()
    {
        if(IS_AJAX)
        {
            $newsList = $this->News->getNewsList(I("get."));
            $this->ajaxReturn($newsList);
        }    
        $this->display();
    }

    public function recycleBin()
    {
        if(IS_AJAX)
        {
            $newsList = $this->News->getNewsList(I("get."));
            $this->ajaxReturn($newsList);
        }    
        $this->display();
    }

    public function getAllNewsCount()
    {
        $arr['News']  = $this->News->getNewsCount();
        $arr['Draft'] = $this->News->getDraftCount();
        $arr['Bin']   = $this->News->getBinCount();
        $this->ajaxReturn($arr);
    }
    // 下架文章
    public function changeStatusOff()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg']  = "未知文章ID！";
            $this->ajaxReturn($map);
        }
        $id = trim(trim($id,","));
        $aff = $this->News->changeNewsStatusOff($id);
        if($aff == "No")
        {
            $map['flag'] = false;
            $map['msg']  = "没有需要下架的文章！";
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
    // 发布文章
    public function changeStatusUp()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg']  = "未知文章ID！";
            $this->ajaxReturn($map);
        }
        $id = trim(trim($id,","));
        $aff = $this->News->changeNewsStatusUp($id);
        if($aff == "No")
        {
            $map['flag'] = false;
            $map['msg']  = "没有需要发布的文章！";
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

    // 回收站还原
    public function restoreNews()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg'] = "这个文章不存在！";
            $this->ajaxReturn($map);
        }
        $id  = trim(trim($id),",");
        $aff = $this->News->restoreNewsStatus($id);
        if($aff){
            $map['flag'] = true;
            $map['msg'] = "还原成功！";
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg'] = "还原失败！";
            $this->ajaxReturn($map);
        }
    }

    public function cate()
    {
        // if(IS_AJAX){
        //     $cateList = $this->Cate->getNewsCateLists(I("get."));
        //     $this->ajaxReturn($cateList);
        // }
        $cateList = $this->Cate->getNewsCateList();
        $this->assign("cateList",$cateList);
        $this->display();
    }

    public function getCateTree()
    {
        $typeList = $this->Cate->getNewsCateList($tree="tree");
        $this->ajaxReturn($typeList);
    }

    public function addCate()
    {
        if(IS_POST){
            if(empty($_FILES['img'])){
                $data = I('post.');
                $data['addtime'] = time();
                $aff = $this->Cate->addNewCate($data);
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
                $data = I('post.');
                $namePic = uploadPic('cate_img',$_FILES['img']);
                $data['imgpath'] = $namePic;
                $data['addtime'] = time();
                $aff = $this->Cate->addNewCate($data);
                if($aff){
                    $map['flag'] = true;
                    $map['msg'] = "添加成功！";
                    $this->ajaxReturn($map);
                }else{
                    $map['flag'] = false;
                    $map['msg'] = "添加失败！";
                    $this->ajaxReturn($map);
                }
            }
        }else{
            $typeList = $this->Cate->getNewsCateList();
            $this->assign('typeList',$typeList);
            $this->display();
        }
    }

    public function editCate()
    {
        $id = I('get.id');
        if(IS_POST){
            if(empty($_FILES['img'])){
                $id = I("post.id","");
                $data = I('post.');
                if(empty($id))
                {
                    $map['flag'] = false;
                    $map['msg'] = "未知分类ID！";
                    $this->ajaxReturn($map);
                }
                $aff = $this->Cate->saveCate($id,$data);
                if($aff){
                    $map['flag'] = true;
                    $map['msg'] = "编辑成功！";
                    $this->ajaxReturn($map);
                }else{
                    $map['flag'] = false;
                    $map['msg'] = "编辑失败！";
                    $this->ajaxReturn($map);
                }
            }else{
                $id = I("post.id","");
                if(empty($id))
                {
                    $map['flag'] = false;
                    $map['msg'] = "未知分类ID！";
                    $this->ajaxReturn($map);
                }
                $data = I('post.');
                $namePic = uploadPic('cate_img',$_FILES['img']);
                $data['imgpath'] = $namePic;
                $aff = $this->Cate->saveCate($id,$data);
                if($aff){
                    $map['flag'] = true;
                    $map['msg'] = "编辑成功！";
                    $this->ajaxReturn($map);
                }else{
                    $map['flag'] = false;
                    $map['msg'] = "编辑失败！";
                    $this->ajaxReturn($map);
                }
            }
        }else{
            $cateList = $this->Cate->getOneCate($id);
            $typeList = $this->Cate->getNewsCateList();
            $this->assign('typeList',$typeList);
            $this->assign('cateList',$cateList);
            $this->display(); 
        }
    }

    public function delCate()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg'] = "找不到要删除的！";
            $this->ajaxReturn($map);
        }
        $count = $this->Cate->getNextCateCount($id);
        if($count > 0){
            $map['flag'] = false;
            $map['msg'] = "请先删除子类！";
            $this->ajaxReturn($map);
        }
        $aff = $this->Cate->deleteCate($id);
        if($aff){
            $map['flag'] = true;
            $map['msg'] = "删除成功！";
            $this->ajaxReturn($map);
        }else{
            $map['flag'] = false;
            $map['msg'] = "删除失败！";
            $this->ajaxReturn($map);
        }
    }

    // 修改分类状态
    public function upCateStatus()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg'] = "找不到要修改的！";
            $this->ajaxReturn($map);
            exit();
        }
        // $count = $this->Cate->getNextCateCount($id);
        // if($count > 0){
        //     $map['flag'] = false;
        //     $map['msg'] = "禁用后子类都将不可用！";
        //     $this->ajaxReturn($map);
        //     exit();
        // }
        $aff = $this->Cate->upCateStatus($id);
        if($aff){
            $map['flag'] = true;
            $map['msg'] = "修改成功！";
            $this->ajaxReturn($map);
            exit();
        }else{
            $map['flag'] = false;
            $map['msg'] = "修改失败！";
            $this->ajaxReturn($map);
            exit();
        }
    }
    // 删除文章
    public function delNews()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg']  = "未知文章ID！";
            $this->ajaxReturn($map);
        }
        $id = trim(trim($id),",");
        $aff = $this->News->deleteNews($id);
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

    public function getCate()
    {
        $id = I('post.id','');
        if(empty($id)){
            $map['flag'] = false;
            $map['msg'] = "找不到这个分类的！";
            $this->ajaxReturn($map);
        }
        $res = $this->Cate->getCatelist($id);
        if($res){
            $this->ajaxReturn($res);
        }else{
            $map['flag'] = false;
            $map['msg'] = "找不到要查询的！";
            $this->ajaxReturn($map);
        }
    }
}