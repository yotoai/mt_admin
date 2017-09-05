<?php if (!defined('THINK_PATH')) exit();?>﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
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
<!--/meta 作为公共模版分离出去-->

<title>添加权限-萌田网络</title>
<meta name="keywords" content="崇义建站,微信开发,网站优化,萌田网络">
<meta name="description" content="萌田网络科技后台管理系统，萌田网路科技是一件专注网络，网站开发的服务商">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
			<div class="formControls col-xs-5 col-sm-6">
				<input type="text" data-required='true' class="input-text" value="" placeholder="" id="roleName" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限字段：</label>
			<div class="formControls col-xs-5 col-sm-6">
				<input type="text" class="input-text" value="" placeholder="如：admin/index" id="role" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">父权节点：</label>
			<div class="formControls col-xs-5 col-sm-6"> <span class="select-box">
				<select name="pid" class="select">
					<option value="0">———请选择———</option>
					<?php if(is_array($cateList)): foreach($cateList as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["catename"]); ?></option><?php endforeach; endif; ?>
				</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-5 col-sm-6">
				<input type="text" class="input-text" value="" placeholder="" id="" name="des">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="button" class="btn btn-success radius" id="admin-role-save" name=""><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/checkform.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
$('#admin-role-save').click(function(){
	rolename = $.trim($('#roleName').val());
	if(rolename == '' || rolename == undefined || rolename == null)
	{
		layer.msg('请输入权限名称！',{icon:0,time:1500});
		$('#roleName').focus();
		return;
	}
	role = $.trim($('#role').val());
	if(role == '' || role == undefined || role == null)
	{
		layer.msg('请输入权限名称！',{icon:0,time:1500});
		$('#role').focus();
		return;
	}
	$.ajax({
		type:'post',
		url:"<?php echo U('Role/addrule');?>",
		data:$('#form-admin-role-add').serialize(),
		success:function(data){
			if(data.flag == true)
			{
				layer.msg(data.msg,{icon:1,time:1500});
				setTimeout(function(){
					parent.location.reload();
				},1200);
				return false;
			}
			else if(data.flag == false)
			{
				layer.msg(data.msg,{icon:0,time:1500});
				return false;
			}
			else
			{
				layer.msg('未知错误！',{icon:0,time:1500});
				return false;
			}
		}
	})

});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>