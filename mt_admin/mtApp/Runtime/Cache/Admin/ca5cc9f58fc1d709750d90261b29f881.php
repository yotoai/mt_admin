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
<style type="text/css">
</style>
<title>新增文章</title>
</head>
<body>
<div class="pd-20">
	<form action="<?php echo U('News/addNews');?>" method="post" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-1"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-8">
				<input type="text" class="input-text" value="" placeholder="" id="" name="title"  data-required="true" errmsg="标题不能为空！">
			</div>
			<div class="col-2"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-1"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-2"> <span class="select-box">
				<select name="firstcate" class="select" data-required="true" errmsg="分类不能为空！">
					<option value="-1">———请选择———</option>
					<?php if(is_array($cateList)): foreach($cateList as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["catename"]); ?></option><?php endforeach; endif; ?>
				</select>
				</span>
			 </div>
			<div class="formControls col-2"> <span class="select-box">
				<select name="secondcate" class="select">
					<option value="0" id="0">———请选择———</option>
				</select>
				</span>
			</div>
			<div class="formControls col-2"> <span class="select-box">
				<select name="thirdcate" class="select">
					<option value="0" id="1">———请选择———</option>
				</select>
				</span>
			 </div>
		</div>
		<div class="row cl">
			<label class="form-label col-1"><span class="c-red">*</span>作者：</label>
			<div class="formControls col-4">
				<input type="text" class="input-text" value="" placeholder="" id="" name="author" data-required="true" errmsg="作者不能为空！">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-1"><span class="c-red">*</span>文章摘要：</label>
			<div class="formControls col-8">
				<textarea name="abstract" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" data-required="true" errmsg="摘要不能为空！" onKeyUp="textarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
			<div class="col-2"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-1">关键词：</label>
			<div class="formControls col-8">
				<input type="text" class="input-text" value="" placeholder="建议3-5个关键字80个字内，用英文,隔开" id="" name="keywords">
			</div>
			<div class="col-2"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-1">页面描述：</label>
			<div class="formControls col-8">
				<textarea name="describe" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符200个字内" datatype="*10-200" dragonfly="true" nullmsg="描述不能为空！" onKeyUp="textarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
			<div class="col-2"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-1">缩略图名：</label>
			<div class="formControls col-4">
				<input type="text" class="input-text" value="" placeholder="" id="" name="iconname">
			</div>
			<label class="form-label col-1">缩略图：</label>
			<div class="formControls col-5">
				<span class="btn-upload form-group">
 					 <input class="input-text upload-url radius" type="text" name="uploadfile-1" id="uploadfile-1" readonly><a href="javascript:void();" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
  					<input type="file" multiple name="img" class="input-file">
				</span>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-1"><span class="c-red">*</span>文章内容：</label>
			<div class="formControls col-10"> 
				<script id="editor" type="text/plain" style="width:100%;height:400px;"></script>
			</div>
		</div>
		<div class="row cl">
			<div class="col-10 col-offset-1">
				<button onClick="article_save_submit(this);" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
				<button onClick="article_save(this);" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/jquery.form.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/mtadmin/Public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script>
<script type="text/javascript">
var ue;
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$list = $("#fileList"),
	$btn = $("#btn-star"),
	state = "pending",
	uploader;

	var uploader = WebUploader.create({
		auto: true,
		swf: 'lib/webuploader/0.1.5/Uploader.swf',
	
		// 文件接收服务端。
		server: 'http://lib.h-ui.net/webuploader/0.1.5/server/fileupload.php',
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		}
	});
	uploader.on( 'fileQueued', function( file ) {
		var $li = $(
			'<div id="' + file.id + '" class="item">' +
				'<div class="pic-box"><img></div>'+
				'<div class="info">' + file.name + '</div>' +
				'<p class="state">等待上传...</p>'+
			'</div>'
		),
		$img = $li.find('img');
		$list.append( $li );
	
		// 创建缩略图
		// 如果为非图片文件，可以不用调用此方法。
		// thumbnailWidth x thumbnailHeight 为 100 x 100
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>不能预览</span>');
				return;
			}
	
			$img.attr( 'src', src );
		}, thumbnailWidth, thumbnailHeight );
	});
	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
			$percent = $li.find('.progress-box .sr-only');
	
		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
		}
		$li.find(".state").text("上传中");
		$percent.css( 'width', percentage * 100 + '%' );
	});
	
	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	uploader.on( 'uploadSuccess', function( file ) {
		$( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
	});
	
	// 文件上传失败，显示上传出错。
	uploader.on( 'uploadError', function( file ) {
		$( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
	});
	
	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on( 'uploadComplete', function( file ) {
		$( '#'+file.id ).find('.progress-box').fadeOut();
	});
	uploader.on('all', function (type) {
        if (type === 'startUpload') {
            state = 'uploading';
        } else if (type === 'stopUpload') {
            state = 'paused';
        } else if (type === 'uploadFinished') {
            state = 'done';
        }

        if (state === 'uploading') {
            $btn.text('暂停上传');
        } else {
            $btn.text('开始上传');
        }
    });

    $btn.on('click', function () {
        if (state === 'uploading') {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });
    
    if($(":input[name='ref']").val()=='ref'){
        parent.layer.msg('保存成功！',{icon:1,time:2000});
        parent.$('.btn-refresh').click();
        parent.location.reload();
    }
	
	ue = UE.getEditor('editor');

	//
	$("select[name='firstcate']").change(function(){
	    $("select[name='secondcate'] option").not('#0').remove();
	    $("select[name='thirdcate'] option").not('#1').remove();
	    var cate_id = $("select[name='firstcate']").val();
	    $.ajax({
		    type:'post',
		    url:"<?php echo U('News/getCate');?>",
		    data:'id='+cate_id,
		    success:function(data){
		        var str = '';
		        for(var i = 0;i<data.length;i++){
		          str +="<option value='"+data[i].id+"'>"+data[i].catename+"</option>";
		        } 
		        $("select[name='secondcate']").append(str);
		    }
	    })
  	})

  	$("select[name='secondcate']").change(function(){
	    $("select[name='thirdcate'] option").not('#1').remove();
	    var cate_id = $("select[name='secondcate']").val();
	    $.ajax({
		    type:'post',
		    url:"<?php echo U('News/getCate');?>",
		    data:'id='+cate_id,
		    success:function(data){
		        var str = '';
		        for(var i = 0;i<data.length;i++){
		          str +="<option value='"+data[i].id+"'>"+data[i].catename+"</option>";
		        } 
		        $("select[name='thirdcate']").append(str);
		    }
	    })
  	})
});

// 保存草稿
function article_save(obj)
{
	$('#form-article-add').append('<input type="hidden" value="2" name="status">');
	$("form").ajaxSubmit({
        type:"post",
        url:"<?php echo U('News/addNews');?>",
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
// 保存提交
function article_save_submit(obj){
	var f = true;
    $("*[data-required]").each(function(){
        if($.trim($(this).val()) == "")
        {
            layer.msg($(this).attr("errmsg"),{icon:0,time:1500});
            $(this).focus();
            f = false;
			return false;
        }
    });
    if(f == false)
    {
        return false;
    }
    var html = ue.getContent();
	if(html == ""){
		layer.msg("请输入文章内容！",{icon:0,time:1500});
		return false; 
	}
	$('#form-article-add').append('<input type="hidden" value="0" name="status">');
	$("form").ajaxSubmit({
        type:"post",
        url:"<?php echo U('News/addNews');?>",
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