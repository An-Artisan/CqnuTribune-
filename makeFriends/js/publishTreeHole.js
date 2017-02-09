layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
// 引用表情

$(document).ready(function(){ 
$("#publishTreeHole").click(function(){
    if(!$("#user").length>0){
      layer.confirm('请先登录~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            location.reload(true);
            });
      }
    $.ajax({  
         type : "post",  
          url : "../backStage/publishTreeHole.php", 
          dataType:'json',
          data : {
                content: editor.$txt.html(),publishUser: $('#user').text()
                // 传内容和发布人
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('发布树洞成功~', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            location.reload(true);
            });
            }
            else {
            layer.confirm('发布树洞失败，如没登录，请先登录。', {
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