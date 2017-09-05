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
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>新增商品</title>
</head>
<body>
<div class="pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-goods-add" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-1"><span class="c-red">*</span>商品名称：</label>
			<div class="formControls col-10">
				<input type="text" class="input-text" value="" placeholder="" id="" name="goodsname" data-required errmsg="请输入商品名称！" />
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-1"><span class="c-red">*</span>商品分类：</label>
			<div class="formControls col-2">
                <span class="select-box">
    				<select name="goodscatepid" class="select" data-required errmsg="请选择商品分类！">
                        <!-- <option value="">——请选择——</option>
    					<?php if(is_array($cateList)): foreach($cateList as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["classify"]); ?></option><?php endforeach; endif; ?> -->
    				</select>
				</span> 
            </div>
            <div class="formControls col-2">
                <span class="select-box">
                    <select name="goodscatecid" class="select" data-required errmsg="请选择商品分类！">
                        <option value="">——请选择——</option>
                    </select>
                </span> 
            </div>
            <div class="formControls col-2">
                <span class="select-box">
                    <select name="goodscateid" class="select" data-required errmsg="请选择商品分类！">
                        <option value="">——请选择——</option>
                    </select>
                </span> 
            </div>
		</div>
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>展示价格：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="" placeholder="" id="" name="goodsprice" data-required  errmsg="请输入商品展示价格！" >
            </div>
            <label class="form-label col-1"><span class="c-red">*</span>展示原价：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="" placeholder="" id="" name="goodsorig" data-required errmsg="请输入商品展示原价格！">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>是否包邮：</label>
            <div class="formControls col-2">
                <div class="skin-minimal">
                    <div class="radio-box">
                        <input type="radio" id="radio-1" name="ismail" value="1" checked />
                        <label for="radio-1">是</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="radio-2" name="ismail" value="0" />
                        <label for="radio-2">否</label>
                    </div>
                </div>
            </div>
            <div id="mailprice" style="display:none">
                <label class="form-label col-1"><span class="c-red">*</span>快递费：</label>
                <div class="formControls col-2">
                    <input type="text" class="input-text" value="0.00" onclick="javascript:this.value=''" placeholder="" id="" name="mailprice" data-required errmsg="请输入快递费用！" />
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>赠送积分：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="" placeholder="" id="" name="sendpoints" data-required errmsg="请输入赠送的积分！" />
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>产地：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="" placeholder="" id="" name="madein" data-required errmsg="请输入商品产地！" />
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-1">商品简介：</label>
            <div class="formControls col-10">
                <textarea name="goodsabstract" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" data-required errmsg="请选择商品简介"></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-1">缩略图：</label>
            <div class="formControls col-3">
                <span class="btn-upload form-group">
                <input class="input-text upload-url radius" type="text" name="img" id="uploadfile-1" readonly data-required errmsg="请选择商品缩略图" /><a href="javascript:void();" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
                <input type="file" multiple name="img" class="input-file" data-required errmsg="请选择商品缩略图" />
                </span>
            </div>
            <label class="form-label col-1">图片名称：</label>
            <div class="formControls col-2">
                <input type="text" class="input-text" value="" placeholder="" id="" name="madein" data-required errmsg="请输入图片名称！" />
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-1">详细内容：</label>
			<div class="formControls col-10"> 
				<script id="editor" type="text/plain" style="width:100%;height:400px;"  ></script> 
			</div>
		</div>
		<div class="row cl">
			<div class="col-10 col-offset-1">
				<button onClick="goods_save_submit(this);" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/jquery.form.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/mtadmin/Public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 

<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

    var ue = UE.getEditor('editor');

    $("#radio-2").click(function(){
        $("#mailprice").css("display","block");
    });
    $("#radio-1").click(function(){
        $("#mailprice").css("display","none");
    });
    
    // 商品分类
    $.ajax({
        type:"post",
        url:"<?php echo U('Goods/getCateList');?>",
        data:"id=p",
        success:function(data){
            console.log(data);
            var str = '<option value="">——请选择——</option>';
            for(var i = 0;i < data.length; i++)
            {
                str += '<option value="'+data[i].id+'">'+data[i].classify+'</option>';
            }
            $("select[name='goodscatepid']").empty();
            $("select[name='goodscatepid']").append(str);
        }
    });

    $("select[name='goodscatepid']").change(function(){
        console.log($(this).val());
        $.ajax({
            type:"post",
            url:"<?php echo U('Goods/getCateList');?>",
            data:"id="+$(this).val(),
            success:function(data){
                var str = '<option value="">——请选择——</option>';
                for(var i = 0;i < data.length; i++)
                {
                    str += '<option value="'+data[i].id+'">'+data[i].classify+'</option>';
                }
                $("select[name='goodscatecid']").empty();
                $("select[name='goodscateid']").empty();
                $("select[name='goodscateid']").append('<option>——请选择——</option>');
                $("select[name='goodscatecid']").append(str);
            }
        });
    });

    $("select[name='goodscatecid']").change(function(){
        $.ajax({
            type:"post",
            url:"<?php echo U('Goods/getCateList');?>",
            data:"id="+$(this).val(),
            success:function(data){
                var str = '<option value="">——请选择——</option>';
                for(var i = 0;i < data.length; i++)
                {
                    str += '<option value="'+data[i].id+'">'+data[i].classify+'</option>';
                }
                $("select[name='goodscateid']").empty();
                $("select[name='goodscateid']").append(str);
            }
        });
    });

});
// 提交数据
function goods_save_submit(obj){
    var f = true;
    $("*[data-required]").each(function(){
        if($.trim($(this).val()) == "")
        {
            layer.msg($(this).attr("errmsg"),{icon:0,time:1500});
            $(this).focus();
            f = false
            return false;
        }
    });
    if(f == false)
    {
        return false;
    }
    $("form").ajaxSubmit({
        type:"post",
        url:"<?php echo U('Goods/addGoods');?>",
        beforeSubmit:function(){
            $(obj).attr("disabled",true);
        },
        success:function(data){
            if(data.flag == true)
            {
                layer.msg(data.msg,{icon:1,time:1500});
                setTimeout(function(){
                    parent.location.reload();
                },1400);
                return false;
            }else if(data.flag == false){
                layer.msg(data.msg,{icon:0,time:1500});
                $(obj).attr("disabled",false);
                return false;
            }
        }
    });
}
</script>
</body>
</html>