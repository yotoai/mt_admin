<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
<title>草稿箱</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 草稿箱 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="text-c pt-20 pl-20 pr-20 pb-5"> 日期范围：
        <input type="text" onfocus="WdatePicker({maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}', onpicked:function(){table.fnFilter();}})"  name="mintime" id="logmin" class="input-text Wdate" style="width:186px;">
        -
        <input type="text" onfocus="WdatePicker({minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'%y-%M-%d', onpicked:function(){table.fnFilter();}})"  name="maxtime" id="logmax" class="input-text Wdate" style="width:186px;">&nbsp;&nbsp;
        <input type="search" class="input-text" style="width:250px" placeholder="文章标题等..." id="conditions" name="conditions"  aria-controls="DataTables_Table_0"><button type="button" class="btn btn-success radius ml-5" id="button" name="" onclick="javascript:table.fnFilter();"><i class="Hui-iconfont">&#xe665;</i> 搜文章</button>
	</div>
<div class="pt-10 pl-20 pr-20">
	<div class="cl pd-5 bg-1 bk-gray mt-0"> <span class="l"> <a class="btn btn-primary radius" data-title="添加资讯" onclick="news_add('添加资讯','<?php echo U('News/addNews');?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span> </div>
	<div class="mt-10">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>标题</th>
					<th width="80">分类</th>
					<th width="80">作者</th>
					<th width="120">添加时间</th>
					<th width="120">更新时间</th>
					<th width="60">文章状态</th>
					<th width="220">操作</th>
				</tr>
			</thead>
			<tbody>
				<!-- <?php if(is_array($newsList)): foreach($newsList as $key=>$val): ?><tr class="text-c">
					<td><input type="checkbox" value="" name=""></td>
					<td><?php echo ($val["id"]); ?></td>
					<td><?php echo ($val["title"]); ?></td>
					<td><?php echo ($val["type"]); ?></td>
					<td><?php echo ($val["author"]); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$val["addtime"])); ?></td>
					<?php if($val["status"] == 2): ?><td class="td-status">
						<span class="label label-defaunt radius">草稿</span></td>
						<td class="f-14 td-manage"><?php endif; ?>
					<a style="text-decoration:none" class="ml-5 btn" onClick="article_edit('资讯编辑','<?php echo U('News/editNews');?>?id=<?php echo ($val["id"]); ?>',<?php echo ($val["id"]); ?>)" href="javascript:;" title="编辑" class="btn"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="news_del(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
				</tr><?php endforeach; endif; ?> -->
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/js/commonfunctions.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
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
            "url":"<?php echo U('News/draftList');?>",
            "data":function(d){    //额外传递的参数
                d.mintime = $('#logmin').val();
                d.maxtime = $('#logmax').val();
                d.conditions = $("#conditions").val();
                d.actions = "draft";
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
            $(row).addClass('text-c')
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
            {
            	"sClass":"text-center",
            	"data": "status",
            	"render":function(data, type, full, meta){
            		var str = "";
            		if(data == 2){
            			str = "<span class='label label-default radius' data-state='"+data+"'>草稿</span>";
            		}
            		return str;
            	}
        	},
            {
                "sClass": "text-center",
                "data": "status",
                "render": function (data, type, full, meta) {
                	var html = "";
                    html += '<a style="text-decoration:none" class="ml-5 btn" onClick="article_edit(`文章编辑`,this)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="news_del(this);" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a>';
                    return html;
                },
                "bSortable": false
            }
        ]
});
$(function(){
	$("#layui-layer1").hide();
})
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
function article_edit(title,url,id){
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
function news_del(obj,id){
	AjaxPost(obj,"确认要移入回收站吗？","<?php echo U('News/delNews');?>");
}
</script> 
</body>
</html>