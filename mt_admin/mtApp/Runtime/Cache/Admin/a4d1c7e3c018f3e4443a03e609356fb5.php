<?php if (!defined('THINK_PATH')) exit();?>﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
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
<!--/meta 作为公共模版分离出去-->

<title>基本设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 联系方式设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form method="post" class="form form-horizontal" id="form-article-add">
		<div id="tab-system" class="HuiTab">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>用户名：</label>
					<div class="formControls col-xs-8 col-sm-9 callnum">
						<input type="text" placeholder="" value="<?php echo ($username); ?>" class="input-text" name="username" readonly>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>密&nbsp;&nbsp;&nbsp;码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="password" placeholder="" value="" class="input-text" name="pwd">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>新密码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="password" placeholder="" value="" class="input-text" name="newpwd">
					</div>
				</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
			</div>
		</div>
	</form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
function article_save_submit()
{
         var pwd =  $("input[name='pwd']").val();
         var newpwd = $("input[name='newpwd']").val();
        if(pwd == '' || pwd == null)
        {
                    layer.msg("请输入密码！",{icon:0,time:1200});
                    return false;
        }else if(newpwd == '' || newpwd == null){
                    layer.msg("请输入新密码！",{icon:0,time:1200});
                    return false;
        }else{
                    $.ajax({
                            type:"post",
                            url:"<?php echo U('System/changepwd');?>",
                            data:"pwd="+pwd+"&newpwd="+newpwd,
                            success:function(data){
                                    if(data.flag == true){
                                                layer.msg(data.msg,{icon:1,time:1200});
                                                return false;
                                    }else if(data.flag == false){
                                               layer.msg(data.msg,{icon:5,time:1200});
                                               return false; 
                                    }else{
                                                layer.msg("未知错误！",{icon:0,time:1200});
                                                return false;
                                    }
                            }
                    });
        }
}
//function addbtn($obj){
    //    $("."+$obj).append("<input style='margin-top:5px;' type='text' placeholder='' value='' class='input-text' name='callnum[]'> ");
//}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>