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
<title>商品分类</title>
<style type="text/css">
.ztree li span.button.add {
	margin-left:2px;
	margin-right: -1px;
	background-position:-144px 0;
	vertical-align:top;
	*vertical-align:middle;
}
</style>
</head>
<body class="pos-r">
<div class="pos-a" style="width:200px;left:0;top:0; bottom:0; height:100%; border-right:1px solid #e5e5e5; background-color:#f5f5f5;padding:5px;">
	<ul id="LeftTree" class="ztree">
	</ul>
</div>
<div style="margin-left:200px;">
	<nav class="breadcrumb">
		<i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 分类列表 <a class="btn btn-refresh btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="page-container">
		<div class="pd-20">
			<div class="cl pd-5 bg-1 bk-gray mt-0"> 
				<span class="l"> <a class="btn btn-primary radius" onclick="openDialog('添加分类','<?php echo U('Goods/addCategory');?>',this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> 
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="40"><input name="" type="checkbox" value=""></th>
							<th width="40">ID</th>
							<th width="100">缩略图</th>
							<th class="text-c" width="130">类名称</th>
							<th>简述</th>
							<th width="150">添加时间</th>
							<th width="60">状态</th>
							<th width="20%">操作</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php if(is_array($cateList)): foreach($cateList as $key=>$val): ?><tr class="text-c va-m">
							<td><input name="" type="checkbox" value=""></td>
							<td><?php echo ($val["id"]); ?></td>
							<td><img width="36" class="product-thumb" src="/mtadmin/Public/<?php echo ($val["cateimg"]); ?>"></a></td>
							<td class="text-l"><?php echo ($val["classify"]); ?></td>
							<td><?php echo ($val["catedes"]); ?></td>
							<td><?php echo (date("Y-m-d H:i:s",$val["cateaddtime"])); ?></td>
						<?php if($val["fcatestatus"] == 1): ?><td class="td-status"><span class="label label-success radius">已发布</span></td>
							<td class="td-manage"><a style="text-decoration:none" onClick="cate_stop(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a> 
						<?php else: ?>
							<td class="td-status"><span class="label label-defaunt radius">已下架</span></td>
							<td class="td-manage"><a style="text-decoration:none" onClick="cate_start(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="发布" class="btn"><i class="Hui-iconfont">&#xe603;</i>发布</a><?php endif; ?> 
							<a style="text-decoration:none" class="ml-5 btn" onClick="cate_edit('分类编辑','<?php echo U('Goods/editCate');?>?id=<?php echo ($val["id"]); ?>','')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="cate_del(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
						</tr><?php endforeach; endif; ?> -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/commonfunctions.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<script type="text/javascript">
var table = $('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],
	"sDom": '<"top"f>t<"bottom"ir><"clear">',
	bDeferRender:true,
    processing: true,
        serverSide: true,
        ajax: {
            "url":"<?php echo U('Goods/category');?>",
            "data":function(d){    //额外传递的参数
                d.mintime = $('#logmin').val();
                d.maxtime = $('#logmax').val();
                d.conditions = $("#conditions").val();
            }
        },
		bLengthChange:false,//去掉每页多少条框体
        bStateSave: true,//状态保存
        //aLengthMenu : [15, 20, 30, 50, 100, 150],
        bProcessing : true,
        bAutoWidth: false,
        bFilter : false, //是否启动过滤、搜索功能
        bInfo : false, //是否显示页脚信息，DataTables插件左下角显示记录数 
		bStateSave: false, // 不保留搜索条件
        createdRow: function ( row, data, index) {
            $(row).addClass('text-c');
        },
        aoColumns: [
            {
                "sClass": "text-c",
                "data": "id",
                "render": function (data, type, full, meta) {
                    return '<input type="checkbox"  name="select"  value="' + data + '" />';
                },
                "bSortable": false
            },
            { "mData": "id" },
            {
            	"sClass":"text-c",
            	"data"  :"cateimg",
            	"render":function(data,type,full,meta){
            		return str = "<img width='36' class='product-thumb'  src='/mtadmin/Public/"+data+"' />";
            	}
            },
            { 
            	"sClass":"text-l",
            	"data": "classify" 
            },
            { "mData": "catedes"},
            { "mData": "cateaddtime"},
            {
            	"sClass":"text-center",
            	"data": "catestatus",
            	"render":function(data, type, full, meta){
            		var str = "";
            		if(data == 1){
            			str = "<span class='label label-success radius' data-state='"+data+"'>已发布</span>";
            		}else{
            			str =  "<span class='label label-defaunt radius' data-state='"+data+"'>已下架</span>";
            		}
            		return str;
            	}
        	},
            {
                "sClass": "text-center",
                "data": "catestatus",
                "render": function (data, type, full, meta) {
                	var html = "";
                	if(data == 1){
                		html = '<a style="text-decoration:none" onClick="goods_off(this)" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a>';
                	}else{
                		html = '<a style="text-decoration:none" onClick="goods_up(this)" href="javascript:;" title="发布" class="btn"><i class="Hui-iconfont">&#xe603;</i>发布</a>';
                	}
                    html += '<a style="text-decoration:none" class="ml-5 btn" onClick="openDialog(`分类编辑`,`<?php echo U("goods/editCate");?>`,this)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="goods_delete(this);" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a>';
                    return html;
                },
                "bSortable": false
            }
        ]
});
var cateid;
var zTree;
var setting = {
	async: {
		enable: true,
		url: CreateTree,
		//autoParam: ["id"]
	},
	view: {
		dblClickExpand: true,
		showLine: true,
		selectedMulti: false,
		addHoverDom: addHoverDom,
		removeHoverDom: removeHoverDom
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pid",
			rootPId: ""
		},
		key:{
			name:"classify"
		}
	},
	edit: {
		enable: true,
		showRemoveBtn:function (treeId, treeNode) {
			return !treeNode.isParent;
		},
		showRenameBtn:true
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			if (treeNode.isParent){
				return false;
			} else {
				return true;
			}
		},
		onClick: function(event, treeId, treeNode){
    		//table.fnFilter();
		},
		beforeRemove: function(treeId, treeNode){
			layer.confirm("确定要删除该分类吗？",function(index){
				$.ajax({
					type:"post",
					url:"<?php echo U('Goods/delCate');?>",
					data:"id="+treeNode.id,
					success:function(data){
						if(data.flag == true)
						{
							layer.msg(data.msg,{icon:1,time:1500});
							zTree.reAsyncChildNodes(null,"refresh"); // 刷新树
							return false;
						}else if(data.flag == false){
							layer.msg(data.msg,{icon:0,time:1500});
							return false;
						}else{
							layer.msg("未知错误！",{icon:0,time:1500});
							return false;
						}
					}
				});
			});
			return false; // 阻止该方法默认行为
		},
		beforeRename:function(treeId,treeNode,newName){
			layer.confirm("确定要修改该节点名称吗？",function(index){
				$.ajax({
					type:"post",
					url :"<?php echo U('Goods/editCateName');?>",
					data:"id="+treeNode.id+"&catename="+newName,
					success:function(data){
						if(data.flag == true){
							layer.msg(data.msg,{icon:1,time:1500});
							//zTree.reAsyncChildNodes(null,"refresh"); // 刷新树
							refreshParentNode();
							table.dataTable().fnClearTable();
							return false;
						}else if(data.flag == false){
							layer.msg(data.msg,{icon:0,time:1500});
							return false;
						}else{
							layer.msg("未知错误！",{icon:0,time:1500});
							return false;
						}
					}
				});
			},function(){
				refreshParentNode();
				//zTree.reAsyncChildNodes(null,"refresh"); // 刷新树
			});
			return false; // 阻止该方法默认行为
		},
	}
};

function addHoverDom(treeId, treeNode) {
	var aObj = $("#" + treeNode.tId + "_span");
	if (treeNode.editNameFlag || $("#addBtn_"+treeNode.id).length>0) return;
	var addStr = "<span id='addBtn_" +treeNode.id+ "' treenode_add class='button add' title='addBtn' onfocus='this.blur();'> </span>";
	aObj.append(addStr);
	var btn = $("#addBtn_"+treeNode.id);
	//var nodename = {classify:"new node"}; // 取name的属性值作为键
	if (btn) btn.bind("click", function(){
		$.ajax({
			type:"post",
			url :"<?php echo U('Goods/addCategory');?>",
			data:"pid="+treeNode.id+"&classify=new node",
			success:function(data){
				if(data.flag == true)
				{
					zTree.addNodes(treeNode,{id:data.id,classify:"new node"});
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg,{icon:0,time:1500});
					return false;
				}else{
					layer.msg("未知错误！",{icon:0,time:1500});
					return false;
				}
			}
		});
		return false;
	});
};
function removeHoverDom(treeId, treeNode) {
	$("#addBtn_"+treeNode.id).unbind().remove();
};

/** 
 * 刷新当前选择节点的父节点 
 */  
function refreshParentNode(){
	type = "refresh";
	silent = false;
	nodes = zTree.getSelectedNodes();  
    /*根据 zTree 的唯一标识 tId 快速获取节点 JSON 数据对象*/  
    var parentNode = zTree.getNodeByTId(nodes[0].parentTId);  
    /*选中指定节点*/  
    zTree.selectNode(parentNode);  
    zTree.reAsyncChildNodes(parentNode, type, silent);  
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
		url:"<?php echo U('Goods/getTreeList');?>",
		success:function(data){
			t = $.fn.zTree.init(t, setting, data);
			zTree = $.fn.zTree.getZTreeObj("LeftTree");
			zTree.expandAll(true);
		}
	});
}

/*打开全屏窗口*/
function openDialog(title,url,obj)
{
	var id;
	if(!IsNullOrUndefined(obj))
	{
		id = $(obj).parents("tr").find("input[name='select']").val();
	}
	if(id == '')
	{
		layer.msg("未知商品！");
		return false;
	}
	openfullDialog(title,url,id);
}

//批量删除
function goods_up(obj)
{
	AjaxPost(obj,"确认要发布吗？","<?php echo U('Goods/upGoodsCateStatus');?>");
}
//批量删除
function goods_off(obj)
{
	AjaxPost(obj,"确认要下架吗？","<?php echo U('Goods/upGoodsCateStatus');?>");
}
/*删除*/
function goods_delete(obj){
	layer.confirm('确认要删除吗？',function(index){
		var id = $(obj).parents("tr").find("input[name=select]").val();
		$.ajax({
			type:'post',
			url:"<?php echo U('Goods/delCate');?>",
			data:'id='+id,
			success:function(data){
				if(data.flag == true){
					zTree.reAsyncChildNodes(null,"refresh"); // 刷新树
					$('.table-sort').dataTable().fnClearTable();
					layer.msg(data.msg,{icon: 1,time:1300});	
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg,{icon: 5,time:1000});
					return false;
				}else{
					layer.msg("未知错误！",{icon:0,time:1000});
					return false;
				}
			}
		});
	});
}

</script>
</body>
</html>