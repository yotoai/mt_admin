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
<title>友情链接</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 页面管理 <span class="c-gray en">&gt;</span> 友情链接 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">

	<div class="cl pd-5 bg-1 bk-gray mt-0"><span class="l"><a href="javascript:;" onclick="Flink_add('添加友链','<?php echo U('Flinks/addFlink');?>')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加友链</a></span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="70">ID</th>
					<th width="200">LOGO</th>
					<th width="120">公司名称</th>
					<th>具体URL</th>
					<th>添加时间</th>
					<th>状态</th>
					<th width="15%">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($linkList)): foreach($linkList as $key=>$val): ?><tr class="text-c">
					<td><input name="" type="checkbox" value=""></td>
					<td><?php echo ($val["id"]); ?></td>
					<td><img width="64" src="/mtadmin/Public/<?php echo ((isset($val["logo"]) && ($val["logo"] !== ""))?($val["logo"]):'images/default.jpg'); ?>"></td>
					<td><?php echo ($val["comname"]); ?> </td>
					<td><?php echo ($val["url"]); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$val["addtime"])); ?></td>
				<?php if($val["status"] == 1): ?><td class="td-status"><span class="label label-success radius">已启用</span></td>
					<td class="td-manage"><a style="text-decoration:none" onClick="admin_stop(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="停用" class="btn"><i class="Hui-iconfont">&#xe631;</i>停用</a> 
				<?php else: ?>
					<td class="td-status"><span class="label label-default radius">已停用</span></td>
					<td class="td-manage"><a style="text-decoration:none" onClick="admin_start(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="启用" class="btn"><i class="Hui-iconfont">&#xe615;</i>启用</a><?php endif; ?>
					<a style="text-decoration:none" onClick="flink_edit('友链编辑','<?php echo U('Flinks/editFlink');?>?id=<?php echo ($val["id"]); ?>','')" href="javascript:;" title="编辑" class="btn"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="flink_del(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script><script type="text/javascript" src="/mtadmin/Public/lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
 
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,5]}// 制定列不参与排序
	]
});
/*友链-添加*/
function Flink_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
function flink_edit(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*友链-停用*/
function admin_stop(obj,id){

	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({ 
			type:"post",
			url:"<?php echo U('Flinks/upStatus');?>",
			data:"id="+id,
			success:function(data){
				//console.log(data);
				if(data.flag == true){			
					$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,'+id+')" href="javascript:;" title="启用" style="text-decoration:none" class="btn"><i class="Hui-iconfont">&#xe615;</i>启用</a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已停用</span>');
					$(obj).remove();
					layer.msg(data.msg,{icon: 1,time:1000});
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

/*友链-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({ 
			type:"post",
			url:"<?php echo U('Flinks/upStatus');?>",
			data:"id="+id,
			success:function(data){
				if(data.flag == true){
					$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none" class="btn"><i class="Hui-iconfont">&#xe631;</i>停用</a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
					$(obj).remove();
					layer.msg(data.msg, {icon: 6,time:1000});
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg, {icon: 5,time:1000});
					return false;
				}else{
					layer.msg("未知错误！",{icon: 0,time:1000});
					return false;
				}
			},
			dataType:"json"
		});
	});
}
/*友链-删除*/
function flink_del(obj,id){
  layer.confirm('确认要删除吗？',function(index){  
    $.ajax({
        type:"post",
        url:"<?php echo U('Flinks/delFlinks');?>",
        data:"id="+id,
        success:function(data){
          if(data.flag == true){ 
            $(obj).parents("tr").remove();
            layer.msg(data.msg,{icon:1,time:1000});
            return false;
          }else if(data.flag == false){ 
            layer.msg(data.msg,{icon:5,time:1000});
            return false;
          }else{
            layer.msg('未知错误！',{icon:0,time:1000});
            return false;
          }
        },
        dataType:"json"
      });
  });
}
</script>
</body>
</html>