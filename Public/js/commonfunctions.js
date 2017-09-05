//AJAXPost提交
function AjaxPost(obj,msg,url,type)
{
	var l = $(obj).parents("tr").length;
	var str = "";
	if(l <= 0)
	{
		var count = $(".table-sort tbody").find($("input[name='select']:checked")).length;
		if(count <= 0 && type != "bin")
		{
			$(".table-sort input[type='checkbox']").attr("checked",false);
			return false;
		}else if(count <= 0 && type == "bin"){
			$(".table-sort tbody").find($("input[name='select']")).each(function(){
				str += $(this).val() + ",";
			});
		}else if(count > 0){
			$(".table-sort tbody").find($("input[name='select']:checked")).each(function(){
				str += $(this).val() + ",";
			});
		}
	}else if(l == 1){
		str = $(obj).parents("tr").find("input[name='select']").val();
	}else{
		return false;
	}
	layer.confirm(msg,function(index){
		$.ajax({
			type:"post",
			url:url,
			data:{id:str},
			BeforeSend:function(){
				layer.load(0,{shade:false});
			},
			success:function(data){
				if(data.flag == true){
					//重新构建table
                    $(".table-sort").dataTable().fnClearTable();
                    $(".table-sort thead input[type='checkbox']").attr("checked",false);
					layer.msg(data.msg,{icon: 1,time:1500});
					return false;
				}else if(data.flag == false){
					layer.msg(data.msg,{icon: 5,time:1500});
					$(".table-sort input[type='checkbox']").attr("checked",false);
					return false;
				}else{
					layer.msg('未知错误！',{icon: 0,time:1500});
					$(".table-sort input[type='checkbox']").attr("checked",false);
					return false;
				}
			}
		});
	},function(index){ 
		$(".table-sort input[type='checkbox']").attr("checked",false);
	});
}

/*全屏打开窗口*/
function openfullDialog(title,url,id){
	var urls = "";
	if(id != "")
	{
		urls = url + "?id=" + id;
	}else{
		urls = url;
	}
	var index = layer.open({
		type: 2,
		title: title,
		content: urls
	});
	layer.full(index);
}

// 判断是否为空或者undefined
function IsNullOrUndefined(str)
{
	newstr = $.trim(str);
	if(newstr === "" || newstr === "undefined" || newstr === null || newstr === undefined || newstr === "null")
	{
		return true;
	}else{
		return false;
	}
}