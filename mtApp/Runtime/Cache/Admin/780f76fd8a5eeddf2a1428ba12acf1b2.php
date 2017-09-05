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
<![endif]--><title>订单管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
  <div class="text-c pt-20 pl-20 pr-20 pb-5"> 日期范围：
        <input type="text" onfocus="WdatePicker({maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}', onpicked:function(){table.fnFilter();}})"  name="mintime" id="logmin" class="input-text Wdate" style="width:186px;">
        -
        <input type="text" onfocus="WdatePicker({minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'%y-%M-%d', onpicked:function(){table.fnFilter();}})"  name="maxtime" id="logmax" class="input-text Wdate" style="width:186px;">&nbsp;&nbsp;
        <input type="search" class="input-text" style="width:250px" placeholder="商品名称等..." id="conditions" name="conditions"  aria-controls="DataTables_Table_0"><button type="button" class="btn btn-success radius ml-5" id="button" name="" onclick="javascript:table.fnFilter();"><i class="Hui-iconfont">&#xe665;</i> 搜订单</button>
  </div>
<div class="pd-20">
  <table class="table table-border table-bordered table-bg table-hover table-sort">
    <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="5%">ID</th>
        <th width="15%">订单号</th>
        <th width="10%">商品种类数量</th>
        <th width="10%">总价</th>
        <th width="15%">下单时间</th>
        <th width="15%">订单状态</th>
        <th width="30%">操作</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

</div>
<script type="text/javascript" src="/mtadmin/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/mtadmin/Public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/mtadmin/Public/js/H-ui.admin.js"></script> 
<script type="text/javascript">
  var table = $('.table-sort').dataTable({
    "aaSorting": [[ 1, "desc" ]],
    "sDom": '<"top">t<"bottom"iflpr><"clear">',
        processing: true,
            serverSide: true,
            ajax: {
                "url":"<?php echo U('Orders/ordersList');?>",
                "data":function(d){    //额外传递的参数
                    d.mintime = $('#logmin').val();
                    d.maxtime = $('#logmax').val();
                    d.conditions = $("#conditions").val();
                }
            },
            bStateSave: true,//状态保存
            aLengthMenu : [10, 20, 30, 50, 100, 150],
            bProcessing : true,
            bAutoWidth: false,
            bFilter : false, //是否启动过滤、搜索功能
            bInfo : true, //是否显示页脚信息，DataTables插件左下角显示记录数  
            createdRow: function ( row, data, index ) {
                $(row).addClass('text-c');
                $('#count').html(data.recordsFiltered);
            },
            aoColumns: [
                {
                    "sClass": "text-center",
                    "data": "auto_id",
                    "render": function (data, type, full, meta) {
                        return '<input type="checkbox"  name="select"  value="' + data + '" />';
                    },
                    "bSortable": false
                },
                { "mData": "auto_id" },
                { "mData": "order_numbers" },
                { "mData": "goods_quantity" },
                { "mData": "order_total" },
                { "mData": "order_createtime" },
                { "mData": "order_status_name" },
                {
                    "sClass": "text-center",
                    "data": "order_status",
                    "render": function (data, type, full, meta) {
                      var html = "";
                      if(data == 50){
                        html = '<a title="发货" href="javascript:;" onclick="order_send(`发货`,this)" class="ml-5 btn" style="text-decoration:none"><i class="Hui-iconfont">&#xe603;</i>发货</a>';
                      }
                        html += '<a title="详情" href="javascript:;" onclick="order_show(`订单详情`,this)" class="ml-5 btn" style="text-decoration:none"><i class="Hui-iconfont">&#xe665;</i>订单详情</a><a style="text-decoration:none" class="ml-5 btn" onClick="goods_del(this)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i>删除</a>';
                        return html;
                    },
                    "bSortable": false
                }
            ]
    });
</script>
<script type="text/javascript">
//  订单详情
function order_show(title,obj)
{
  var id = $(obj).parents("tr").find("input[name='select']").val();
  if($.trim(id) == '')
  {
      layer.msg("未知订单！",{icon:0,time:1500});
      return false;
  }
  var index = layer.open({
    type: 2,
    title: title,
    content: "<?php echo U('Orders/ordersDetail');?>?id="+id
  });
  layer.full(index);
}
// 发货
function order_send(title,obj)
{
    var id = $(obj).parents("tr").find("input[name='select']").val();
    if($.trim(id) == '')
    {
        layer.msg("未知订单！",{icon:0,time:1500});
        return false;
    }
    layer.open({
        type:2,
        title:title,
        area:['350px','250px'],
        content:"<?php echo U('Orders/ordersSend');?>?id="+id
    });
    //   $.ajax({
    //       type:'post',
    //       url:"<?php echo U('Orders/orderSend');?>",
    //       data:'id='+id,
    //       success:function(data){
    //           if(data.flag == true){
    //               $(obj).attr('title','已发货');
    //               $(obj).children().remove();
    //               $(obj).append('<i class="Hui-iconfont">&#xe676;</i>');
    //               $(obj).parent().prev().text("已发货");
    //               layer.msg(data.msg,{icon:1,time:1000});
    //               return false;
    //           }else if(data.flag == false){
    //               layer.msg(data.msg,{icon:5,time:1000});
    //               return false;
    //           }else{
    //               layer.msg("未知错误！",{icon:0,time:1000});
    //               return false;                 
    //           }
    //       },
    //       dataType:'json'
    //   });
    // });
}
/*订单-删除*/
function goods_del(obj){
  layer.confirm('确认要删除吗？',function(index){
    var id = $(obj).parents("tr").find("input[name='select']").val();
    $.ajax({ 
      type:"post",
      url:"<?php echo U('Goods/delGoods');?>",
      data:"id="+id,
      success:function(data){
        if(data.flag == true){
          $(obj).parents("tr").remove();
          $('.table-sort').dataTable().fnClearTable();
          layer.msg(data.msg,{icon:1,time:1000});
        }else if(data.flag == false){
          layer.msg(data.msg, {icon: 5,time:1000});
          return false;
        }else{
          layer.msg("未知错误！", {icon: 0,time:1000});
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