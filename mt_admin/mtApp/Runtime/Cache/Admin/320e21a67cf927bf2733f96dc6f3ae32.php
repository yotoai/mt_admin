<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/mtadmin/Public/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/mtadmin/Public/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/mtadmin/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="/mtadmin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/mtadmin/Public/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>文章分类</title>
<style type="text/css">
.dataTables_wrapper .dataTables_length {
    float: left;
    padding-top: -10px; */
    margin-left: 5px;
}
</style>
</head>
<body>
	<div class="pos-a" style="width:200px;left:0;top:0; bottom:0; height:100%; border-right:1px solid #e5e5e5; background-color:#f5f5f5;padding:5px;">
	<ul id="LeftTree" class="ztree">
	</ul>
</div>
<div style="margin-left:200px;">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 分类目录 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="pd-20">
		<div class="cl pd-5 bg-1 bk-gray mt-0"> <span class="l"> <a class="btn btn-primary radius" data-title="添加分类" onclick="cate_add('添加分类','<?php echo U('News/addCate');?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> 
		</div>
		<div class="page-container">
			<div class="mt-15">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="50">ID</th>
							<th width="120">名称</th>
							<!-- <th width="120">图片描述</th> -->
							<th width="100">添加时间</th>
							<th width="100">更新时间</th>
							<th width="60">发布状态</th>
							<th width="250">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($cateList)): foreach($cateList as $key=>$val): ?><tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td><?php echo ($val["id"]); ?></td>
							<td style="padding-left:60px;" class="text-l"><?php echo ($val["catename"]); ?></td>
							<!-- <td><img width="100" src="/mtadmin/Public/<?php echo ($val["img"]); ?>" /></td> -->
							<td><?php echo ($val["addtime"]); ?></td>
							<td><?php echo ($val["refreshtime"]); ?></td>
							<?php if($val["status"] == 1): ?><td class="td-status">
								<span class="label label-success radius">已发布</span></td>
								<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a>
							<?php elseif($val["status"] == -1): ?>
								<td class="td-status">
								<span class="label label-defaunt radius">未发布</span></td>
								<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_start(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="发布" class="btn"><i class="Hui-iconfont">&#xe603;</i>发布</a><?php endif; ?>
							<a style="text-decoration:none" class="ml-5 btn" onClick="article_edit('类目编辑','<?php echo U('News/editCate');?>?id=<?php echo ($val["id"]); ?>',<?php echo ($val["id"]); ?>)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="news_del(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="删除" class="btn"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
						</tr>
						<?php if(is_array($val["prev"])): $i = 0; $__LIST__ = $val["prev"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td><?php echo ($vo["id"]); ?></td>
							<td style="padding-left:60px;" class="text-l"><?php echo ($vo["catename"]); ?></td>
							<td><img width="100" src="/mtadmin/Public/<?php echo ($vo["img"]); ?>" /></td>
							<td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
							<?php if($vo["status"] == 1): ?><td class="td-status">
								<span class="label label-success radius">已发布</span></td>
								<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,<?php echo ($vo["id"]); ?>)" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a>
							<?php elseif($vo["status"] == -1): ?>
								<td class="td-status">
								<span class="label label-defaunt radius">未发布</span></td>
								<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_start(this,<?php echo ($vo["id"]); ?>)" href="javascript:;" title="发布" class="btn"><i class="Hui-iconfont">&#xe603;</i>发布</a><?php endif; ?>
							<a style="text-decoration:none" class="ml-5 btn" onClick="article_edit('类目编辑','<?php echo U('News/editCate');?>?id=<?php echo ($vo["id"]); ?>',<?php echo ($vo["id"]); ?>)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="news_del(this,<?php echo ($vo["id"]); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
						</tr>
						<?php if(is_array($vo["next"])): $i = 0; $__LIST__ = $vo["next"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td><?php echo ($vo["id"]); ?></td>
							<td style="padding-left:60px;" class="text-l"><?php echo ($vo["catename"]); ?></td>
							<td><img width="100" src="/mtadmin/Public/<?php echo ($vo["img"]); ?>" /></td>
							<td><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
							<?php if($vo["status"] == 1): ?><td class="td-status">
								<span class="label label-success radius">已发布</span></td>
								<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,<?php echo ($vo["id"]); ?>)" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a>
							<?php elseif($vo["status"] == -1): ?>
								<td class="td-status">
								<span class="label label-defaunt radius">未发布</span></td>
								<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_start(this,<?php echo ($vo["id"]); ?>)" href="javascript:;" title="发布" class="btn"><i class="Hui-iconfont">&#xe603;</i>发布</a><?php endif; ?>
							<a style="text-decoration:none" class="ml-5 btn" onClick="article_edit('类目编辑','<?php echo U('News/editCate');?>?id=<?php echo ($vo["id"]); ?>',<?php echo ($vo["id"]); ?>)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="news_del(this,<?php echo ($vo["id"]); ?>)" href="javascript:;" title="删除" class="btn"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<script type="text/javascript">
var zTree;
var table = $('.table-sort').dataTable({
	//"aaSorting": [[ 1, "asc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"sDom": '<"top"f>t<"bottom"ilp><"clear">',
    //bFilter : false, //是否启动过滤、搜索功能
	//bLengthChange:false,//去掉每页多少条框体
	//"paging": false,   //禁止分页
	bStateSave: false, // 不保留搜索条件
    "info": true,   //去掉底部文字
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,1,2,3,4,5,6]}// 制定列不参与排序
	]
});
var setting = {
	async: {
		enable: true,
		url: CreateTree,
		//autoParam: ["id"]
	},
	view: {
		dblClickExpand: true,
		showLine: true,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pid",
			rootPId: ""
		},
		key:{
			name:"catename"
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			zTree = $.fn.zTree.getZTreeObj("LeftTree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				demoIframe.attr("src",treeNode.file + ".html");
				return true;
			}
		}
	}
};

var zNodes =[
	{ id:1, pId:0, name:"一级分类", open:true},
	{ id:11, pId:1, name:"二级分类"},
	{ id:111, pId:11, name:"三级分类"},
	{ id:112, pId:11, name:"三级分类"},
	{ id:113, pId:11, name:"三级分类"},
	{ id:114, pId:11, name:"三级分类"},
	{ id:115, pId:11, name:"三级分类"},
	{ id:12, pId:1, name:"二级分类 1-2"},
	{ id:121, pId:12, name:"三级分类 1-2-1"},
	{ id:122, pId:12, name:"三级分类 1-2-2"},
];
		
var code;
		
function showCode(str) {
	if (!code) code = $("#code");
	code.empty();
	code.append("<li>"+str+"</li>");
}
$(document).ready(function(){
	CreateTree();
	//var zTree = $.fn.zTree.getZTreeObj("tree");
	//zTree.selectNode(zTree.getNodeByParam("id",'11'));
	//zTree.updateNode(treeNode);  // 刷新树
});
function CreateTree()
{
	var t = $("#LeftTree");
	$.ajax({
		type:"post",
		url:"<?php echo U('News/getCateTree');?>",
		success:function(data){
			t = $.fn.zTree.init(t, setting, data);
			zTree = $.fn.zTree.getZTreeObj("LeftTree");
			zTree.expandAll(true);
		}
	});
}

function cate_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$.ajax({
			type:'post',
			url:"<?php echo U('News/upCateStatus');?>",
			data:'id='+id,
			success:function(data){
				if(data.flag == true){
					$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,'+id+')" href="javascript:;" title="发布" class="btn"><i class="Hui-iconfont">&#xe603;</i>发布</a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">未发布</span>');
					$(obj).remove();
					layer.msg(data.msg,{icon: 5,time:1000});
					return false;
				}else if(data.msg == false){
					layer.msg(data.msg,{icon: 5,time:1000});
					return false;
				}
			}
		});
		
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$.ajax({
			type:'post',
			url:"<?php echo U('News/upCateStatus');?>",
			data:'id='+id,
			success:function(data){
				if(data.flag == true){
					$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,'+id+')" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
					$(obj).remove();
					layer.msg(data.msg,{icon: 6,time:1000});
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg,{icon: 5,time:1000});
					return false;
				}else{
					layer.msg("未知错误！",{icon: 0,time:1000});
					return false;
				}
			}
		})
		
	});
}
/*资讯-删除*/
function news_del(obj,id){
	layer.confirm('确认要删除该类目吗？此操作不可逆！',function(index){
		$.ajax({
			type:'post',
			url:"<?php echo U('News/delCate');?>",
			data:'id='+id,
			success:function(data){
				if(data.flag == true){
					$(obj).parents("tr").remove();
					layer.msg(data.msg,{icon: 5,time:1500});
					zTree.reAsyncChildNodes(null,"refresh"); // 刷新树
					if($("tbody").children().length == 0){
						setTimeout(function(){
							location.replace(location.href);
						},1000);
					}
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg,{icon: 5,time:1000});
					return false;
				}else{
					layer.msg("未知错误！",{icon: 0,time:1000});
					return false;
				}
			}
		});
	});
}
</script>
</body>
</html>