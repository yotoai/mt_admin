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
<link href="/mtadmin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<link href="/mtadmin/Public/skin/default/skin.css" rel="stylesheet" type="text/css" id="skin" />
<link href="/mtadmin/Public/css/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>萌田网络科技后台管理系统</title>
<meta name="keywords" content="赣州网站建设,网站推广,微网建设,微信开发,萌田网络公司">
<meta name="description" content="萌田网络科技后台管理系统">
<script>
// 防止页面返回
history.pushState(null,null,document.URL);
window.addEventListener('popstate',function(){
history.pushState(null,null,document.URL);
});
</script>
</head>
<body>
<header class="Hui-header cl" style="zoom:1"> <a class="Hui-logo l" title="萌田网络科技后台管理系统" href="/" target="_blank">萌田网络科技后台管理系统</a> <a class="Hui-logo-m l" href="/" target="_blank" title="H-ui.admin">MT</a> <span class="Hui-subtitle l">V2.0</span>
<!-- 	<nav class="mainnav cl" id="Hui-nav">
		<ul>
			<li class="dropDown dropDown_click"><a href="javascript:;" aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
				<ul class="dropDown-menu radius box-shadow">
					<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
					<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
					<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
					<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
				</ul>
			</li>
		</ul>
	</nav> -->
	<ul class="Hui-userbar">
		<li>您好！</li>
		<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo ($username); ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				<li><a href="<?php echo U('Index/quit');?>">切换账户</a></li>
				<li><a href="<?php echo U('Index/quit');?>">退出</a></li>
			</ul>
		</li>
		<li id="Hui-msg"> <a id="msg" _href="<?php echo U('System/msg');?>" data-title="客户消息" onClick="Hui_admin_tab(this)" href="javascript:;" title="消息"><span class="badge badge-danger"><?php echo ($num); ?></span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
		<li id="Hui-skin" class="dropDown right dropDown_hover"><a href="javascript:;" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
				<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
				<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
				<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
				<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
				<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
			</ul>
		</li>
	</ul>
	<a href="javascript:;" class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a> </header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('News/index');?>" data-title="资讯管理" href="javascript:void(0)">资讯管理</a></li>
					<li><a _href="<?php echo U('News/cate');?>" data-title="资讯分类" href="javascript:void(0)">分类目录</a></li>
					<li><a _href="<?php echo U('News/draftList');?>" data-title="草稿箱" href="javascript:void(0)">草稿箱</a></li>
					<li><a _href="<?php echo U('News/recycleBin');?>" data-title="回收站" href="javascript:void(0)">回收站</a></li>
				</ul>
			</dd>
		</dl>
	<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Picture/picList');?>" data-title="图片管理" href="javascript:void(0)">图片管理</a></li>
				</ul>
			</dd>
		</dl> 
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Goods/category');?>" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
					<li><a _href="<?php echo U('Goods/index');?>" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-order">
			<dt><i class="Hui-iconfont">&#xe687;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Orders/ordersList');?>" data-title="订单管理" href="javascript:void(0)">订单管理</a></li>
					<!-- <li><a _href="<?php echo U('Goods/index');?>" data-title="产品管理" href="javascript:void(0)">产品管理</a></li> -->
				</ul>
			</dd>
		</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Members/membersList');?>" data-title="会员列表" href="javascript:;">会员列表</a></li>
					<li><a _href="<?php echo U('Members/deletedMembers');?>" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
					<li><a _href="<?php echo U('Members/membersGrade');?>" data-title="等级管理" href="javascript:;">等级管理</a></li>
					<li><a _href="<?php echo U('Members/membersPoint');?>" data-title="积分管理" href="javascript:;">积分管理</a></li>
					<li><a _href="<?php echo U('Members/shareRecords');?>" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-page">
			<dt><i class="Hui-iconfont">&#xe626;</i> 链接管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Flinks/flinksList');?>" data-title="友情链接" href="javascript:void(0)">友情链接</a></li>
				</ul>
			</dd>
		</dl>
    <?php if($username == 'admin'): ?><dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Admin/index');?>" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
					<li><a _href="<?php echo U('Role/rolelist');?>" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
					<li><a _href="<?php echo U('Role/rulelist');?>" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
				</ul>
			</dd>
		</dl><?php endif; ?>
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe637;</i> 招聘管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Jobs/index');?>" data-title="招聘信息" href="javascript:void(0)">招聘信息</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('System/systembase');?>" data-title="网站基本设置" href="javascript:void(0)">网站基本设置</a></li>
                    <li><a _href="<?php echo U('System/changepwd');?>" data-title="用户密码修改" href="javascript:void(0)">用户密码修改</a></li>
                    <li><a _href="<?php echo U('System/setcontact');?>" data-title="联系方式设置" href="javascript:void(0)">左侧联系栏设置</a></li>
                    <li><a _href="<?php echo U('System/setqq');?>" data-title="联系QQ管理" href="javascript:void(0)">联系QQ管理</a></li>
                    <li><a _href="<?php echo U('System/logList');?>" data-title="登录日志" href="javascript:void(0)">登录日志</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</aside>
<div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="我的桌面" _href="welcome.html">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="welcome.html"></iframe>
		</div>
	</div>
</section>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<script type="text/javascript">
/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
// function Hui_msg_tab(title,url)
// {
// 	var index = layer.open({
// 		type: 2,
// 		title: title,
// 		content: url
// 	});
// 	layer.full(index);
// }
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
</script> 
<script type="text/javascript">
$(function(){
	$("#msg").click(function(){
		$(".badge").text(0);
	});
	setInterval(function(){
		$.ajax({
			url:"<?php echo U('System/getNewMsgNum');?>",
			success:function(data){
				if(data.flag == true){
					$(".badge").text(data.msg);
				}
			}
		});
	},30000)
});
$(function(){

	// function aa()
	// {
	// 	return 'aaaaa';
	// }

	window.onbeforeunload = function(){
		return '';
	}
})


</script>
</body>
</html>