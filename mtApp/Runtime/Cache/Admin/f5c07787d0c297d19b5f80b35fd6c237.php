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
<link href="/mtadmin/Public/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/mtadmin/Public/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/mtadmin/Public/css/style.css" rel="stylesheet" type="text/css" />

<link href="/mtadmin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]--><title>QQ咨询管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> QQ咨询管理<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mb-10"> <span class="l"> <a class="btn btn-primary radius" onClick="qq_add();" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加QQ</a></span> </div>
  <table class="table table-border table-bordered table-bg table-hover table-sort">
    <thead>
      <tr class="text-c">
        <th width="5%"><input type="checkbox" name="" value=""></th>
        <th width="25%">QQ号</th>
        <th width="25%">QQ身份标题</th>
        <th width="15%">状态</th>
        <th width="20%">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php if(is_array($qqList)): foreach($qqList as $key=>$val): ?><tr class="text-c">
        <td><input type="checkbox" value="" name=""><input type="hidden" name="id" value="<?php echo ((isset($val["id"]) && ($val["id"] !== ""))?($val["id"]):''); ?>"></td>
        <td><input type="text" name="qqnum" value="<?php echo ($val["qqnum"]); ?>" class="input-text"></td>
        <td><input type="text" name="qqtitle" value="<?php echo ($val["qqtitle"]); ?>" class="input-text"></td>
        <?php if($val["status"] == -1): ?><td class="td-status"><span class='label label-default radius'>未启用</span></td>
            <td class="td-manage">  <a style='text-decoration:none' onClick='qq_start(this,<?php echo ($val["id"]); ?>)' href='javascript:;' title='启用' class='btn'><i class='Hui-iconfont'>&#xe603;</i>启用</a>
        <?php else: ?>
            <td class="td-status"><span class='label label-success radius'>已启用</span></td>
            <td class="td-manage">  <a style='text-decoration:none' onClick='qq_stop(this,<?php echo ($val["id"]); ?>)' href='javascript:;' title='下架' class='btn'><i class='Hui-iconfont'>&#xe6de;</i>下架</a><?php endif; ?>
        <button title="保存" href="javascript:;" onclick="qq_sub(this,<?php echo ($val["id"]); ?>)" class="ml-5 btn" style="text-decoration:none" disabled="disabled"><i class="Hui-iconfont">&#xe632;</i>保存</button><a title="删除" href="javascript:;" onclick="qq_del(this,<?php echo ($val["id"]); ?>)" class="ml-5 btn" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
      </tr><?php endforeach; endif; ?>
    </tbody>
  </table>

</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script><script type="text/javascript" src="/mtadmin/Public/lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script>
 <script type="text/javascript">
$(function(){
        $("input").each(function(){
                $(this).change(function(){
                        $(this).parents("td").siblings().find("button").attr("disabled",false);
                });
        });
});
</script>
<script type="text/javascript">

$('.table-sort').dataTable({
	"lengthMenu":false,//显示数量选择 
	"bFilter": false,//过滤功能
	"bPaginate": false,//翻页信息
	"bInfo": false,//数量信息
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
	]
});
/* qq - 保存*/
function qq_sub(obj,id){
     var qqnum = $(obj).parents("td").siblings().find("input[name='qqnum']").val();
     var qqtitle = $(obj).parents("td").siblings().find("input[name='qqtitle']").val();
    if(qqnum == '' && qqnum == null){
            layer.msg("请输入QQ号！",{icon:0,time:1200});
            return false;
    }else if(!(/^[1-9][0-9]{4,11}$/.test(qqnum))){
           layer.msg("请输入正确的qq号！",{icon:0,time:1200});
           return false;
    }else if(qqtitle == '' || qqtitle == null){
            layer.msg("请输入QQ身份标题！",{icon:0,time:1200});
            return false;
    }else{
            $.ajax({
                    type:"post",
                    url:"<?php echo U('System/setqq');?>",
                    data:'qqnum='+qqnum+"&qqtitle="+qqtitle+"&id="+id,
                    success:function(data){
                            if(data.flag == true){
                                    layer.msg(data.msg,{icon:1,time:1300});
                                    setTimeout(function(){
                                            location.replace(location.href);
                                    },1200);
                                    return false;
                            }else if(data.flag == false){
                                    layer.msg(data.msg,{icon:5,time:1300});
                                     return false;
                            }else{
                                    layer.msg("未知错误！",{icon:0,time:1300});
                            }
                    }
            });
    }
}
/*qq-删除*/
function qq_del(obj,id){
  layer.confirm('确认要删除吗？',function(index){
        if(id == ''){
                $(obj).parents("tr").remove();
                layer.msg('删除成功！',{icon:1,time:1000});
                setTimeout(function(){
                         location.replace(location.href);
                },1000);
                return false;
        }
    $.ajax({
        type:"post",
        url:"<?php echo U('System/delqq');?>",
        data:"id="+id,
        success:function(data){
          if(data.flag == true){ 
                $(obj).parents("tr").remove();
                layer.msg(data.msg,{icon:1,time:1000});
                setTimeout(function(){
                         location.replace(location.href);
                },1000);
                return false;
          }else if(data.flag == false){ 
                layer.msg(data.msg,{icon:5,time:1000});
                return false;
          }else{
                layer.msg('未知错误!',{icon:5,time:1000});
                return false;
          }
        },
        dataType:"json"
      });
  });
}
/*qq-增加*/
function qq_add(){
        $("tbody").find(".dataTables_empty").parent().remove();
         $("tbody").append("<tr class='text-c'><td><input type='checkbox' value='' name=''><input type='hidden' name='id' value=''></td><td><input type='text' name='qqnum' value='' class='input-text'></td><td><input type='text' name='qqtitle' value='' class='input-text'></td><td><span class='label label-default radius'>未启用</span></td><td><a title='保存' href='javascript:;' onclick='qq_sub(this)' class='ml-5 btn' style='text-decoration:none'><i class='Hui-iconfont'>&#xe632;</i>保存</a><a title='删除' href='javascript:;' onclick='qq_del(this)' class='ml-5 btn' style='text-decoration:none'><i class='Hui-iconfont'>&#xe6e2;</i>删除</a></td></tr>");
}
</script>
<script>
/*QQ-下架*/
function qq_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$.ajax({ 
			type:"post",
			url:"<?php echo U('System/upQQStatus');?>",
			data:"id="+id,
			success:function(data){
				//console.log(data);
				if(data.flag == true){
                        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="qq_start(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="启用" class="btn"><i class="Hui-iconfont">&#xe603;</i>启用</a>');
                        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">未启用</span>');
                        $(obj).remove();
                        layer.msg("已下架！",{icon: 1,time:1000});
                        return false;
				}else if(data.flag == false){
                        layer.msg(data.msg,{icon: 5,time:1000});
                        return false;
				}else{
                        layer.msg("未知错误！",{icon: 0,time:1000});
                        return false;
               }
			}
		});
		
	});
}

/*QQ-启用*/
function qq_start(obj,id){
     if($(obj).parents("td").siblings().find("input[name='qqnum']").val() == ''){
            layer.msg("请输入QQ号！",{icon:0,time:1200});
            return false;
    }else if($(obj).parents("td").siblings().find("input[name='qqtitle']").val() == ''){
            layer.msg("请输入QQ身份标题！",{icon:0,time:1200});
            return false;
    }else if(id == ''){
            layer.msg("请先保存！",{icon:0,time:1200});
            return false;
    }else{
         var qqnum = $(obj).parents("td").siblings().find("input[name='qqnum']").val();
         if(qqnum != '' || qqnum != null){
                if(!(/^[1-9][0-9]{4,11}$/.test(qqnum))){
                         layer.msg("请输入正确的qq号！",{icon:0,time:1200});
                         return false;
                 }
         }
    }

	layer.confirm('确认要启用吗？',function(index){
		$.ajax({ 
			type:"post",
			url:"<?php echo U('System/upQQStatus');?>",
			data:"id="+id,
			success:function(data){
				//console.log(data);
				if(data.flag == true){
					$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="qq_stop(this,<?php echo ($val["id"]); ?>)" href="javascript:;" title="下架" class="btn"><i class="Hui-iconfont">&#xe6de;</i>下架</a>');
						$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
						$(obj).remove();
						layer.msg(data.msg,{icon: 6,time:1000});
                        return false;
				}else if(data.flag == false){
                        layer.msg(data.msg, {icon: 5,time:1000});
                        return false;
				}else{
                        layer.msg('未知错误!', {icon: 5,time:1000});
                        return false;
                }
			},
			dataType:"json"
		});
		
	});
}
</script>
</body>
</html>