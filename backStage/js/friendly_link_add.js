layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
// 引用表情

function friendly_link_check(sorf){
    var reg = new RegExp("^[0-9]*$");
    if(!reg.test(sorf.value) || sorf.value == ''){
      layer.confirm('请输入数字排序，并且是整数且不能为空~', {
      btn: ['确定','取消'] //按钮
    }, function(){
      location.reload(true);
    });
    }
  
}
// 排序的输入限制
$(document).ready(function(){ 
$("#friendly_link_submit").click(function(){
    $.ajax({  
         type : "post",  
          url : "../backStageBackStage/addFriendlyLink.php", 
          dataType:'json',
          data : {
                friendly_link_name: $('#friendly_link_name').val(),friendly_link_url: $('#friendly_link_url').val(),friendly_link_sort: $('#friendly_link_sort').val()
                // 传给后台url名称 排序号以及url地址
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('添加友情链接成功！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=links.php';
            // 跳转到所有地址界面
            });
            }
            else {
            layer.confirm('添加友情链接失败！', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            location.reload(true);
            });
            }
          }  
        // 调用成功或者失败后，给用户提醒然后刷新页面
     }); 
});
});  