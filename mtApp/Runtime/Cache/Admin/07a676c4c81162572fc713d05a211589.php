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
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/mtadmin/Public/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]--><title>用户查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <img class="avatar size-XL l" src="<?php echo ($memberlist["wx_headimgurl"]); ?>">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18"><?php echo ($memberlist["wx_nickname"]); ?></span> <span class="pl-10 f-12">余额：0</span></dt>
    <dd class="pt-10 f-12" style="margin-left:0"><?php echo ($memberlist["res1"]); ?></dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">性别：</th>
        <td><?php echo ($memberlist["wx_sex"]); ?></td>
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td>13000000000</td>
      </tr>
      <tr>
        <th class="text-r">邮箱：</th>
        <td>admin@mail.com</td>
      </tr>
      <tr>
        <th class="text-r">所在城市：</th>
        <td><?php echo ($memberlist["wx_city"]); ?></td>
      </tr>
      <tr>
        <th class="text-r">关注时间：</th>
        <td><?php echo (date("Y-m-d H:i:s",$memberlist["subscribe_time"])); ?></td>
      </tr>
      <tr>
        <th class="text-r">积分：</th>
        <td>0</td>
      </tr>
    </tbody>
  </table>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script>
</body>
</html>