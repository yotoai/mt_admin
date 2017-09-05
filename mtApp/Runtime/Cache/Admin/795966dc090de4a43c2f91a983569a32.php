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
<title>图片列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-0"> <span class="l"> <a class="btn btn-primary radius" onclick="picture_add('添加图片','<?php echo U('Picture/addPic');?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加图片</a></span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="40"><input name="" type="checkbox" value=""></th>
					<th width="80">ID</th>
					<th width="100">图片分类</th>
					<th width="100">图片缩略图</th>
					<th>图片标题</th>

					<th width="150">更新时间</th>
					<th width="60">发布状态</th>
					<th width="20%">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($picList)): foreach($picList as $key=>$val): ?><tr class="text-c">
					<td><input name="" type="checkbox" value=""></td>
					<td><?php echo ($val["id"]); ?></td>
					<td><?php echo ($val["type"]); ?></td>
					<td><img width="100" class="picture-thumb" src="/mtadmin/Public/<?php echo ($val["picpath"]); ?>"></td>
					<td><?php echo ($val["picname"]); ?></td>

					<td><?php echo (date("Y-m-d H:i:s",$val["addtime"])); ?></td>
					<?php if($val["status"] == 1): ?><td class="td-status"><span class="label label-success radius">已发布</span></td>
						<td class="td-manage"><a class="btn" style="text-decoration:none" onClick="picture_stop(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i>下架</a> 
					<?php else: ?>
						<td class="td-status"><span class="label label-defaunt radius">未发布</span></td>
						<td class="td-manage"><a class="btn" style="text-decoration:none" onClick="picture_start(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i>发布</a><?php endif; ?>
					<a style="text-decoration:none" class="ml-5 btn" onClick="picture_edit('图库编辑','<?php echo U('Picture/editPic');?>?id=<?php echo ($val["id"]); ?>',<?php echo ($val["id"]); ?>)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a style="text-decoration:none" class="ml-5 btn" onClick="picture_del(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script> 
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
	  {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
	]
});
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-查看*/
function picture_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-审核*/
function picture_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过'], 
		shade: false
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*图片-下架*/
function picture_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$.ajax({ 
			type:"post",
			url:"<?php echo U('Picture/upStatus');?>",
			data:"id="+id,
			success:function(data){
				//console.log(data);
				if(data.flag == true){			
					$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_start(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="发布" class="btn"><i class="Hui-iconfont">&#xe603;</i>发布</a>');
					$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">未发布</span>');
					$(obj).remove();
					layer.msg(data.msg,{icon: 1,time:1000});
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg,{icon: 5,time:1000});
					return false;
				}else{
					layer.msg("未知错误！", {icon: 0,time:1000});
					return false;
				}
			}
		});
		
	});
}

/*图片-发布*/
function picture_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$.ajax({ 
			type:"post",
			url:"<?php echo U('Picture/upStatus');?>",
			data:"id="+id,
			success:function(data){
				//console.log(data);
				if(data.flag == true){
					$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_stop(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a>');
						$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
						$(obj).remove();
						layer.msg(data.msg,{icon: 1,time:1000});
						return false;
				}else if(data.flag == false){
					layer.msg(data.msg, {icon: 5,time:1000});
					return false;
				}else{
					layer.msg("未知错误！", {icon: 0,time:1000});
					return false;
				}
			},
			dataType:"json"
		});
		
	});
}
/*图片-申请上线*/
function picture_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}
/*图片-编辑*/
function picture_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-删除*/
function picture_del(obj,id){

	layer.confirm('确认要删除吗？',function(index){
		$.ajax({ 
			type:"post",
			url:"<?php echo U('Picture/delPic');?>",
			data:"id="+id,
			success:function(data){
				if(data.flag == true){
					$(obj).parents("tr").remove();
					layer.msg(data.msg,{icon:1,time:1000});
					
				}else if(data.flag == false){
					layer.msg(data.msg, {icon: 5,time:1000});
				}else{
					layer.msg('未知错误！', {icon: 0,time:1000});
				}
			},
			dataType:"json"
		});
		
	});
}
</script>
</body>
</html>