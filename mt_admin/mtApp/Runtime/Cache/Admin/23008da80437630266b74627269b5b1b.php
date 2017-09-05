<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
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
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-0 mb-10"> <a href="javascript:;" onclick="admin_add('添加管理员','<?php echo U('Admin/addAdmin');?>')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a></span> </div>
	<table class="table table-border table-bordered table-bg table-sort">
		<thead>
			<tr>
				<th scope="col" colspan="9">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">用户名</th>
				<th>角色</th>
				<th width="120">手机</th>
				<th>邮箱</th>
				<th width="160">加入时间</th>
				<th width="100">状态</th>
				<th width="250">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($userList)): foreach($userList as $key=>$val): ?><tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td><?php echo ($val["id"]); ?></td>
				<td><?php echo ($val["username"]); ?></td>
				<td><?php echo ($val["grade"]); ?></td>
				<td><?php echo ($val["telephone"]); ?></td>
				<td><?php echo ($val["email"]); ?></td>
				<td><?php echo (date( "Y-m-d H:i:s", $val["addtime"])); ?></td>
				<?php if($val["status"] == 1): ?><td class="td-status"><span class="label label-success radius">已启用</span></td>
					<td class="td-manage"><a style="text-decoration:none" onClick="admin_stop(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="停用" class="btn"><i class="Hui-iconfont">&#xe631;</i>停用</a> 
				<?php else: ?>
					<td class="td-status"><span class="label label-default radius">已停用</span></td>
					<td class="td-manage"><a style="text-decoration:none" onClick="admin_start(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="启用" class="btn"><i class="Hui-iconfont">&#xe615;</i>启用</a><?php endif; ?>
				<a title="编辑" onClick="admin_edit('用户编辑','<?php echo U('Admin/editAdmin');?>?id=<?php echo ($val["id"]); ?>',<?php echo ($val["id"]); ?>);" href="javascript:;" class="ml-5 btn" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <a title="删除" href="javascript:;" onclick="admin_del(this,<?php echo ($val["id"]); ?>)" class="ml-5 btn" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>  
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
	]
});
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*管理员-删除*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){	
		$.ajax({
				type:"post",
				url:"<?php echo U('Admin/delAdmin');?>",
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
						layer.msg('未知错误！',{icon:5,time:1000});
						return false;
					}
				},
				dataType:"json"
			});
	});
}
/*管理员-编辑*/
function admin_edit(title,url,id){
	if(id != ''){
		var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
		layer.full(index);
	}else{
		layer.msg('打开编辑页面失败！',{icon:5,time:1000});
	}

}

/*管理员-停用*/
function admin_stop(obj,id){

	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({ 
			type:"post",
			url:"<?php echo U('Admin/upStatus');?>",
			data:"id="+id,
			success:function(data){
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
					layer.msg('未知错误！',{icon: 5,time:1000});
					return false;
				}	
			},
			dataType:"json"
		});

	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({ 
			type:"post",
			url:"<?php echo U('Admin/upStatus');?>",
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
					layer.msg('未知错误！', {icon: 5,time:1000});
				}
			},
			dataType:"json"
		});
	});
}
function admin_rule(obj,id)
{
	$.ajax({
		type:'post',
		url:"<?php echo U('Admin/checkRule');?>",
		data:"id="+id,
		success:function(data){
			if(data==1){
				$(obj).removeAttr('onclick');
				layer.msg('编辑需谨慎！再次点击编辑...', {icon: 0,time:3000});
				$(obj).attr('href',"<?php echo U('Admin/editAdmin');?>?id="+sid);
				$(obj).click();
			}else{
				layer.msg(' 您没有权限编辑！', {icon: 5,time:1000});
			}
		}
	});
}
/*admin-list 批量删除方法*/
// function datadel()
// {
	
// 	if($('input:checked').length >0){
// 		var bool = window.confirm('确定要删除吗？'); 
// 		if(bool)
// 		{	
// 			var arrid = new Array();
// 			$("input:checked").not("#quan").each(function(){ 
// 				arrid.push($(this).val());
// 			});
// 			//console.log(arrid);
// 			$.ajax({ 
// 				type:'post',
// 				url:"<?php echo U('Admin/delAdmin');?>",
// 				data:"id="+arrid,
// 				success:function(data){ 
// 					if(data==1){
// 						$("input:checked").parent().parent().not("#aa").remove();
// 						layer.msg('删除成功！',{icon:1,time:1000});
// 					}else if(data = 2){ 
// 						layer.msg('删除失败! 您没有权限',{icon:5,time:1000});
// 					}else{
// 						layer.msg('删除失败! ',{icon:5,time:1000});
// 					}
// 				},
// 				dataType:"json"

// 			});
// 		}else{ 
// 			$("input:checked").attr("checked",false);
// 		}
// 	}else{}
// }
</script>
</body>
</html>