layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
$(document).ready(function(){ 
$("#config_modify_submit").click(function(){
    $.ajax({  
         type : "post",  
          url : "../backStageBackStage/modifyConfig.php", 
          dataType:'json',
          data : {
              id: $('#id').val(),
          		phone: $('#phone').val(),
              qq: $('#qq').val(),
              wechat: $('#wechat').val(),
              weibo: $('#weibo').val(),
              baidu_statistics: $('#baidu_statistics').val(),
              copyright: $('#copyright').val()
                // 传修改的地址id名和名称
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('修改网站配置信息成功！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=config.php';
            // 跳转到所有分类界面
            });
            }
            else {
            layer.confirm('修改网站配置信息失败！', {
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