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
<link href="/mtadmin/Public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>订单详情</title>
</head>
<body>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-1">订单号：</label>
			<div class="formControls col-4">
			<span class="select-box"><?php echo ($orderList["order_numbers"]); ?>
				</span> 
			</div>
			<label class="form-label col-1">买家昵称：</label>
			<div class="formControls col-4">
			<span class="select-box"><?php echo ($orderList["buyer_openid"]); ?>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-1">下单时间：</label>
			<div class="formControls col-4"> <span class="select-box"><?php echo (date("Y-m-d H:i:s",$orderList["order_createtime"])); ?>
				</span> 
			</div>
			<label class="form-label col-1">付款时间：</label>
			<div class="formControls col-4"> <span class="select-box"><?php echo (date("Y-m-d H:i:s",$orderList["order_paytime"])); ?>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-1">所购商品：</label>
			<div class="formControls col-9">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
			    <thead>
			      <tr class="text-c">
			        <th width="80">ID</th>
			        <th width="110">商品图片</th>
			        <th width="17%">商品名称</th>
			        <th width="110">购买数量</th>
			        <th width="120">商品单价</th>
			        <th>商品合计</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php if(is_array($orderList['goodsinfo'])): foreach($orderList['goodsinfo'] as $key=>$val): ?><tr class="text-c">
			          	<td></td>
			          	<td><img width="64" src="/mtadmin/Public/"/></td>
			          	<td><?php echo ($val["goods_name"]); ?></td>
			          	<td>× <?php echo ($val["buy_count"]); ?></td>
			          	<td><?php echo ($val["goods_price"]); ?> 元</td>
						<td><?php echo ($val['buy_count'] * $val['goods_price']); ?> 元</td>
			        </tr><?php endforeach; endif; ?>
						<td colspan="6" style="text-align:right;">订单总价格：<span style="color:#f60;font-size:17px;"><?php echo ($orderList["order_total"]); ?></span>元</td>
			    	</tr>
			    </tbody>
			</table>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-1">收件人：</label>
			<div class="formControls col-4">
				<span class="select-box"><?php echo ($orderList["address_id"]["receiver_name"]); ?></span>
				</div>
			<label class="form-label col-1">收件人号码：</label>
			<div class="formControls col-4">
				<span class="select-box"><?php echo ($orderList["address_id"]["receiver_phonenum"]); ?></span>
				</div>
		</div>
		<div class="row cl">
			<label class="form-label col-1">收货地址：</label>
			<div class="formControls col-9">
				<textarea name="" cols="" rows="" class="textarea"  placeholder="" readonly><?php echo ($orderList["address_id"]["receiver_address"]); ?></textarea>
				<p class="textarea-numberbar"></p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-1">买家留言：</label>
			<div class="formControls col-9">
				<textarea name="" cols="" rows="" class="textarea"  placeholder="买家没有留言..." readonly><?php echo ($orderList["buyer_msg"]); ?></textarea>
				<p class="textarea-numberbar"></p>
			</div>
		</div>
		<div class="row cl">
			<div class="col-10 col-offset-1">
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;返回&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<script type="text/javascript">
</script>
</body>
</html>