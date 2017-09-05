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
<link href="/mtadmin/Public/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/mtadmin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>编辑管理员</title>
</head>
<body>
<div class="pd-20">
	<form class="form form-horizontal" id="form-admin-add">
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>管理员：</label>
			<div class="formControls col-5">
				<input type="hidden" name="id" value="<?php echo ($adminList["id"]); ?>">
				<input type="text" class="input-text" value="<?php echo ($adminList["username"]); ?>" placeholder="" id="user-name" name="name" disabled readonly>
			</div>
			<div class="col-4"> 用户名不可更改！</div>
		</div>
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>修改密码：</label>
			<div class="formControls col-5">
				<input type="password" placeholder="密码" autocomplete="off" value="<?php echo ($adminList["password"]); ?>" maxlength="18" class="input-text"  name="pass">
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>确认密码：</label>
			<div class="formControls col-5">
				<input type="password" placeholder="确认新密码" autocomplete="off" class="input-text" maxlength="18" name="pass1" value="<?php echo ($adminList["password"]); ?>">
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>手机：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php echo ($adminList["telephone"]); ?>" autocomplete="off" placeholder="" id="user-tel" name="telephone">
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>Email:</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php echo ($adminList["email"]); ?>" autocomplete="off" placeholder="" id="user-tel" name="email">
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-2">角色：</label>
			<div class="formControls col-5"> 
				<span class="select-box" style="width:150px;">
					<select class="select" name="grade" size="1" grade="<?php echo ($adminList["grade"]); ?>">
						<?php if(is_array($gradeList)): foreach($gradeList as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["grade"]); ?></option><?php endforeach; endif; ?>
					</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-2">备注：</label>
			<div class="formControls col-5">
				<textarea name="des" cols="" rows="" class="textarea" dragonfly="true" onKeyUp="textarealength(this,100)"><?php echo ($adminList["des"]); ?></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<div class="col-9 col-offset-2">
				<input id="sub" onClick="subform();" class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;保存&nbsp;&nbsp;" disabled>
				<button id="cancle" onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/1.9.3/layer.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/checkform.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	$("select option").each(function(){
		if($(this).val()==$("select").attr('grade')){ 
			$(this).attr("selected",true);
		}
	});
	
	$("input").each(function(){
		$(this).change(function(){
			$("#sub").attr("disabled",false);
		});
	});
	$("textarea[name='des']").change(function(){
			$("#sub").attr("disabled",false);
	});
});
</script>
<script type="text/javascript">
function subform()
{
	var pass = $.trim($("input[name='pass']").val());
	if(pass == ''){
		layer.msg("密码不能为空！",{icon:0,time:2000});
		$("input[name='pass']").focus();
		return false;
	}else if(!pass.isPwdEasy()){
		layer.msg('密码过于简单！',{icon:0,time:2000});
		$("input[name='pass']").focus();
		return false;
	}
	var pass1 = $.trim($("input[name='pass1']").val());
	if(pass1 == ''){
		layer.msg("请再次输入密码！",{icon:0,time:2000});
		$("input[name='pass1']").focus();
		return false;
	}else if(pass !== pass1){
		layer.msg("请输入相同的密码！",{icon:0,time:2000});
		$("input[name='pass1']").focus();
		return false;
	}
	var telephone = $.trim($("input[name='telephone']").val());
	if(telephone == ''){
		layer.msg("手机号码不能为空！",{icon:0,time:2000});
		$("input[name='telephone']").focus();
		return false;
	}else if(!telephone.isMobile()){
		layer.msg("请输入正确的手机号码！",{icon:0,time:2000});
		$("input[name='telephone']").focus();
		return false;
	}
	var email = $.trim($("input[name='email']").val());
	if(email == ''){
		layer.msg("email不能为空！",{icon:0,time:2000});
		$("input[name='email']").focus();
		return false;
	}else if(!email.isEmail()){
		layer.msg("请输入正确的Email！",{icon:0,time:2000});
		$("input[name='email']").focus();
		return false;
	}
	var grade = $.trim($("select").val());
	var des = $.trim($("textarea[name='des']").text());
	var id = $.trim($("input[name='id']").val());
	$.ajax({
		type:"post",
		url:"<?php echo U('Admin/editAdmin');?>",
		data:"id="+id+"&password="+pass+"&telephone="+telephone+"&email="+email+"&grade="+grade+"&des="+des,
		success:function(data){
			if(data.flag == true){
				layer.msg(data.msg,{icon:1,time:2000});
				setTimeout(function(){
			        parent.$('.btn-refresh').click();
			        parent.location.reload();
					location.replace(location.href);
				},1500);
		        return false;
			}else if(data.flag == false){
				layer.msg(data.msg,{icon:0,time:2000});
				return false;
			}else{
				layer.msg('未知错误！',{icon:0,time:2000});
				return false;
			}
		}
	});
}
</script>
</body>
</html>