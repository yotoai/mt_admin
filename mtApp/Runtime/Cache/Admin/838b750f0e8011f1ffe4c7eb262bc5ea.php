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
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>资讯列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="text-c pt-20 pl-20 pr-20 pb-5"> 日期范围：
        <input type="text" onfocus="WdatePicker({maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}', onpicked:function(){table.fnFilter();}})"  name="mintime" id="logmin" class="input-text Wdate" style="width:186px;">
        -
        <input type="text" onfocus="WdatePicker({minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'%y-%M-%d', onpicked:function(){table.fnFilter();}})"  name="maxtime" id="logmax" class="input-text Wdate" style="width:186px;">&nbsp;&nbsp;
        <input type="search" class="input-text" style="width:250px" placeholder="文章标题等..." id="conditions" name="conditions"  aria-controls="DataTables_Table_0"><button type="button" class="btn btn-success radius ml-5" id="button" name="" onclick="javascript:table.fnFilter();"><i class="Hui-iconfont">&#xe665;</i> 搜文章</button>
	</div>
<div class="pt-10 pr-20 pl-20">
	<div class="cl pd-5 bg-1 bk-gray mt-0"> <span class="l"> <a class="btn btn-primary radius" data-title="添加资讯" onclick="news_add('添加资讯','<?php echo U('News/addNews');?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span>
	<span class="l"> <a class="ml-5 btn btn-warning radius" onclick="news_off(this)" href="javascript:;"><i class="Hui-iconfont">&#xe6de;</i> 批量下架</a></span>
	<span class="l"> <a class="ml-5 btn btn-success radius" onclick="news_up(this)" href="javascript:;"><i class="Hui-iconfont">&#xe6dc;</i> 批量发布</a></span>
	<span class="l"> <a class="ml-5 btn btn-danger radius" onclick="news_delete(this)" href="javascript:;"><i class="Hui-iconfont">&#xe609;</i> 批量删除</a></span> </div>
	<div class="mt-10">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>标题</th>
					<th width="100">分类</th>
					<th width="100">作者</th>
					<th width="120">提交时间</th>
					<th width="120">更新时间</th>
					<th width="75">浏览次数</th>
					<th width="60">文章状态</th>
					<th width="280">操作</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/commonfunctions.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script>
<script type="text/javascript">
var table = $('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],
		"sDom": '<"top">t<"bottom"iflpr><"clear">',
		bDeferRender:true,
        processing: true,
            serverSide: true,
            ajax: {
                "url":"<?php echo U('News/index');?>",
                "data":function(d){    //额外传递的参数
                    d.mintime = $('#logmin').val();
                    d.maxtime = $('#logmax').val();
                    d.conditions = $("#conditions").val();
                    d.actions = "index";
                }
            },
            bStateSave: true,//状态保存
            aLengthMenu : [10, 20, 30, 50, 100, 150],
            bProcessing : true,
            bAutoWidth: false,
            bFilter : false, //是否启动过滤、搜索功能
            bInfo : true, //是否显示页脚信息，DataTables插件左下角显示记录数 
			bStateSave: false, // 不保留搜索条件
            createdRow: function ( row, data, index) {
                $(row).addClass('text-c');
            },
            aoColumns: [
                {
                    "sClass": "text-center",
                    "data": "id",
                    "render": function (data, type, full, meta) {
                        return '<input type="checkbox"  name="select"  value="' + data + '" />';
                    },
                    "bSortable": false
                },
                { "mData": "id" },
                { "mData": "title" },
                { "mData": "type" },
                { "mData": "author" },
                { "mData": "addtime"},
                { "mData": "refreshtime"},
                { "mData": "views"},
                {
                	"sClass":"text-center",
                	"data": "status",
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
                    "data": "status",
                    "render": function (data, type, full, meta) {
                    	var html = "";
                    	if(data == 1){
                    		html = '<a style="text-decoration:none" onClick="news_off(this)" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a>';
                    	}else{
                    		html = '<a style="text-decoration:none" onClick="news_up(this)" href="javascript:;" title="发布" class="btn"><i class="Hui-iconfont">&#xe603;</i>发布</a>';
                    	}
                        html += '<a style="text-decoration:none" class="ml-5 btn" onClick="article_edit(`文章编辑`,this)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="news_del(this);" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a>';
                        return html;
                    },
                    "bSortable": false
                }
            ]
    });

/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,obj){
	var id = $(obj).parents("tr").find("input[name=select]").val();
	var url = "<?php echo U('News/editNews');?>?id="+id;
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
function news_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/
function news_del(obj){
	layer.confirm('确认要移入回收站吗？',function(index){
		var id = $(obj).parents("tr").find("input[name=select]").val();
		console.log(id);
		$.ajax({
			type:'post',
			url:"<?php echo U('News/delNews');?>",
			data:'id='+id,
			success:function(data){
				if(data.flag == true){
					$(obj).parents("tr").remove();
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

/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		var id = $(obj).parents("tr").find("input[name=select]").val();
		$.ajax({
			type:'post',
			url:"<?php echo U('News/upStatus');?>",
			data:'id='+id,
			success:function(data){
				if(data.flag == true){
					$('.table-sort').dataTable().fnClearTable();
					layer.msg(data.msg,{icon: 1,time:1000});
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

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		var id = $(obj).parents("tr").find("input[name=select]").val();
		$.ajax({
			type:'post',
			url:"<?php echo U('News/upStatus');?>",
			data:'id='+id,
			success:function(data){
				if(data.flag == true){
					$('.table-sort').dataTable().fnClearTable();
					layer.msg(data.msg,{icon: 6,time:1000});
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg,{icon: 5,time:1000});
					return false;
				}else{
					layer.msg("未知错误！",{icon: 5,time:1000});
					return false;
				}
			}
		})
	});
}

// 批量下架
function news_off(obj)
{
	AjaxPost(obj,"确认要下架吗？","<?php echo U('News/changeStatusOff');?>");
}

// 批量上架
function news_up(obj)
{
	AjaxPost(obj,"确认要发布吗？","<?php echo U('News/changeStatusUp');?>");
}

//批量删除
function news_delete(obj)
{
	AjaxPost(obj,"确认要删除吗？","<?php echo U('News/delNews');?>");
}
</script>
</body>
</html>