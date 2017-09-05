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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form method="post" class="form form-horizontal" id="form-article-add" >
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>网站名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" placeholder="控制在25个字、50个字节以内" value="<?php echo ($wb["webtitle"]); ?>" class="input-text" name="webtitle" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>关键词：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" placeholder="5个左右,8汉字以内,用英文,隔开" value="<?php echo ($wb["keyword"]); ?>" class="input-text" name="keyword" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>描述：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-description" placeholder="空制在80个汉字，160个字符以内" value="<?php echo ($wb["description"]); ?>" class="input-text" name="description" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系热线：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-hotline" placeholder="0757-28829110 18927743221" value="<?php echo ($wb["contacthotline"]); ?>" class="input-text" name="contacthotline" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>投诉热线：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-hotline" placeholder="0757-28829110" value="<?php echo ($wb["hotline"]); ?>" class="input-text" name="hotline" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>E-mail：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-email" placeholder="zhp3813@sina.com" value="<?php echo ($wb["contactemail"]); ?>" class="input-text" name="contactemail" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>公司地址：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-address" placeholder="广东佛山禅城区金澜南路107号 " value="<?php echo ($wb["address"]); ?>" class="input-text" name="address" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>底部版权信息：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-copyright" placeholder="Copyright &copy; 2006-2014 红色古都  All Rights Reserved" value="<?php echo ($wb["copyright"]); ?>" class="input-text" name="copyright" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">备案号：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-icp" placeholder="京ICP备00000000号" value="<?php echo ($wb["icp"]); ?>" class="input-text" name="icp" autocomplete="off">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">统计代码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea class="textarea" name="countcode"></textarea>
					</div>
				</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();"  class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
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
function article_save_submit(){
    layer.msg("保存成功！",{icon:1,time:1500});
    setTimeout(function(){
        $("#form-article-add").submit();
    },1300);
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>