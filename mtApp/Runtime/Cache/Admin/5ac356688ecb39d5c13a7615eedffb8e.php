<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/H-ui.admin.css" />
<link href="/mtadmin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>角色管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
  <div class="text-c pt-10 pl-20 pr-20 pb-5"> 日期范围：
        <input type="text" onfocus="WdatePicker({maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}', onpicked:function(){table.fnFilter();}})"  name="mintime" id="logmin" class="input-text Wdate" style="width:186px;">
        -
        <input type="text" onfocus="WdatePicker({minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'%y-%M-%d', onpicked:function(){table.fnFilter();}})"  name="maxtime" id="logmax" class="input-text Wdate" style="width:186px;">&nbsp;&nbsp;
        <input type="search" class="input-text" style="width:250px" placeholder="角色名称等..." id="conditions" name="conditions"  aria-controls="DataTables_Table_0"><button type="button" class="btn btn-success radius ml-5" id="button" name="" onclick="javascript:table.fnFilter();"><i class="Hui-iconfont">&#xe665;</i> 搜角色</button>
  </div>
<div class="page-container pl-20 pr-20 pt-5">
	<div class="cl pt-5 pb-5 pl-5 pr-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色',`<?php echo U('Role/addrole');?>`,'800')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span> </div>
<div class="mt-10">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr>
				<th scope="col" colspan="6">角色管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<th width="40">ID</th>
				<th width="200">角色名</th>
				<th>用户列表</th>
				<th width="300">描述</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>1</td>
				<td>超级管理员</td>
				<td><a href="#">admin</a></td>
				<td>拥有至高无上的权利</td>
				<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','admin-role-add.html','1')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>2</td>
				<td>总编</td>
				<td><a href="#">张三</a></td>
				<td>具有添加、审核、发布、删除内容的权限</td>
				<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','admin-role-add.html','2')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>3</td>
				<td>栏目主辑</td>
				<td><a href="#">李四</a>，<a href="#">王五</a></td>
				<td>只对所在栏目具有添加、审核、发布、删除内容的权限</td>
				<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','admin-role-add.html','3')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>4</td>
				<td>栏目编辑</td>
				<td><a href="#">赵六</a>，<a href="#">钱七</a></td>
				<td>只对所在栏目具有添加、删除草稿等权利。</td>
				<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','admin-role-add.html','4')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
		</tbody>
	</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  var table = $('.table-sort').dataTable({
    "aaSorting": [[ 1, "desc" ]],
    "sDom": '<"top">t<"bottom"iflpr><"clear">',
        processing: true,
            serverSide: true,
            ajax: {
                "url":"<?php echo U('Role/rolelist');?>",
                "data":function(d){    //额外传递的参数
                    d.mintime = $('#logmin').val();
                    d.maxtime = $('#logmax').val();
                    d.conditions = $("#conditions").val();
                }
            },
            bStateSave: true,//状态保存
            aLengthMenu : [10, 20, 30, 50, 100, 150],
            bProcessing : true,
            bAutoWidth: false,
            bFilter : false, //是否启动过滤、搜索功能
            bInfo : true, //是否显示页脚信息，DataTables插件左下角显示记录数  
            createdRow: function ( row, data, index ) {
                $(row).addClass('text-c');
                $('#count').html(data.recordsFiltered);
            },
            aoColumns: [
                {
                    "sClass": "text-center",
                    "data": "auto_id",
                    "render": function (data, type, full, meta) {
                        return '<input type="checkbox"  name="select"  value="' + data + '" />';
                    },
                    "bSortable": false
                },
                { "mData": "auto_id" },
                { 
                	"sClass":"text-center",
                	"data":"wx_nickname",
                	"render":function(data,type,full,meta){
                		html = '<u style="cursor:pointer" class="text-primary" onclick="member_show(this,`'+data+'`,`360`,`400`)">'+data+'</u>';
                		return html;
                	}
                },
                { "mData": "wx_openid" },
                { "mData": "wx_city" },
                { "mData": "subscribe_time" },
                { "mData": "recent_time" },
                {
                	"sClass":"text-center",
                	"data":"members_status",
                	"render":function(data,type,full,meta) {
                		if(data == 1)
                		{
                			return '<span class="label label-success radius">正常</span>';
                		}else{
                			return '<span class="label label-default radius">已拉黑</span>';
                		}
                	}
                },
                {
                    "sClass": "text-center",
                    "data": "members_status",
                    "render": function (data, type, full, meta) {
                      	var html = "";
                      	if(data == -1){
                        	html = '<a style="text-decoration:none" class="btn" onClick="member_start(this)" href="javascript:;" title="还原"><i class="Hui-iconfont">&#xe6e1;</i> 还原</a>';
                      	}else if(data == 1){
							html = '<a style="text-decoration:none" class="btn" onClick="member_stop(this)" href="javascript:;" title="拉黑"><i class="Hui-iconfont">&#xe631;</i> 拉黑</a>';
                      	}
                      	html += '<a title="编辑" href="javascript:;" onclick="member_edit(this,`编辑`,``,`510`)" class="ml-5 btn" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i> 编辑</a> <a title="删除" href="javascript:;" onclick="member_del(this)" class="ml-5 btn" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i> 删除</a>'
                        return html;
                    },
                    "bSortable": false
                }
            ]
    });
</script>
<script type="text/javascript">
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script>
</body>
</html>