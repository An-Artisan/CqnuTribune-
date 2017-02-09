layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
$(document).ready(function(){ 
$("#trash").click(function(){
    $.ajax({  
         type : "post",  
          url : "../backStageBackStage/cleanEmail.php", 
          dataType:'json',
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('清空email错误日志成功！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=emailLog.php';
            // 跳转到所有地址界面
            });
            }
            else {
            layer.confirm('清空email错误日志失败！', {
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