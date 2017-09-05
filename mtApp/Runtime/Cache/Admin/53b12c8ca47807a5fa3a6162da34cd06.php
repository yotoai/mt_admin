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
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>删除的用户</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 删除的用户<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c pd-20"> 日期范围：
		<input type="text" name="start_time" id="countTimestart" onfocus="selecttime(1)" value="<?php echo ($start_time); ?>" size="17" class="date input-text" style="width:200px" readonly> - <input type="text" name="end_time" id="countTimeend" onfocus="selecttime(2)" value="<?php echo ($end_time); ?>" size="17"  class="date input-text" style="width:200px" readonly>
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="conditions" name="">
		<button type="submit" class="btn btn-success radius" id="subtime" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	<div class="cl pt-5 pb-5 pr-20 pl-20 bg-1 bk-gray"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong>88</strong> 条</span> </div>
	<div class="mt-10 pr-20 pl-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="90">用户OpenID</th>
				<th width="">地址</th>
				<th width="130">加入时间</th>
				<th width="70">状态</th>
				<th width="20%">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($deledlist)): foreach($deledlist as $key=>$val): ?><tr class="text-c">
					<td><input type="checkbox" value="1" name=""></td>
					<td><?php echo ($val["auto_id"]); ?></td>
					<td><u style="cursor:pointer" class="text-primary" onclick="member_show('<?php echo ($val["wx_nickname"]); ?>','<?php echo U('Members/memberShow');?>?id=<?php echo ($val["wx_openid"]); ?>','10001','360','400')"><?php echo ($val["wx_nickname"]); ?></u></td>
					<td><?php echo ($val["wx_openid"]); ?></td>
					<td><?php echo ($val["wx_city"]); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$val["subscribe_time"])); ?></td>
					<td class="td-status"><span class="label label-danger radius">已删除</span></td>
					<td class="td-manage"><a style="text-decoration:none" href="javascript:;" onClick="member_huanyuan(this,'<?php echo ($val["auto_id"]); ?>')" class="btn" title="还原"><i class="Hui-iconfont">&#xe66b;</i> 还原</a><a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($val["auto_id"]); ?>')" class="ml-5 btn" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i> 删除</a></td>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
		]
	});
	$('.table-sort tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});


	$("#subtime").click(function(){
		var endTime = $.trim($("#countTimeend").val());
		var startTime = $.trim($("#countTimestart").val());
		var condition = $.trim($("#conditions").val());
		if(isNUll(endTime) && isNUll(startTime) && isNUll(condition)){
			layer.msg("搜索条件不能为空！",{icon: 0,time:1000});
			return false;
		}
		var data = '';
		if(!isNUll(endTime)){
			data += 'endtime='+endTime;
		}
		if(!isNUll(startTime)){
			data += '&starttime='+startTime;
		}
		if(!isNUll(condition)){
			data += '&conditions='+condition;
		}
		$.ajax({
			type:"get",
			url:"<?php echo U('Members/searchMembers');?>",
			// data:"endtime="+endtime+"&starttime="+starttime+"&conditions="+conditions,
			data:data,
			success:function(data){
				console.log(data);
			}
		});
	});


});

function isNUll(str)
{
	if(str == "" || str == null || str == undefined){
		return true;
	}else{
		return false;
	}
}

function selecttime(flag){
    if(flag==1){
		var endTime = $("#countTimeend").val();
		if(endTime != ""){
			WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:endTime})}else{
			WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})}
    }else{
		var startTime = $("#countTimestart").val();
		if(startTime != ""){
		    WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:startTime})}else{
		    WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})}
    }
 }

/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*用户-还原*/
function member_huanyuan(obj,id){
	layer.confirm('确认要还原吗？',function(index){
		$.ajax({
			type:"post",
			url:"<?php echo U('Members/restoreMember');?>",
			data:"id="+id,
			success:function(data){
				if(data.flag == true){
					$(obj).parents("tr").remove();
					layer.msg(data.msg,{icon: 6,time:1000});
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg,{icon: 5,time:1000});
					return false;
				}else{
					layer.msg('未知错误！',{icon: 0,time:1000});
					return false;
				}
			}
		});

	});
}

/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
</script> 
</body>
</html>