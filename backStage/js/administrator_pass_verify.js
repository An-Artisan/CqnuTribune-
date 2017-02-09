layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
// 引用layer弹窗表情
$(document).ready(function(){ 
$("#btn").click(function(){
    $.ajax({  
         type : "post",  
          url : "../backStageBackStage/administratorPassVerify.php", 
          dataType:'json',
          data : {
                administrator_name: $('#administrator_name').val(),
                administrator_pass: $('#administrator_pass').val(),
                administrator_verify: $('#administrator_verify').val()
                // 传给后台地址用户名密码以及验证码
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('登陆成功！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            window.location.href='../backStageFrontEnd/index.php';
            // 跳转到所有地址界面
            });
            }
            else {
            layer.confirm('登陆失败！', {
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