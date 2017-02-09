layui.use('layer', function(){
layer.config({extend:'../../../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../../../styles/moon/style.css'

});
});
// 引用表情
function ask(e){
// 这里的e就是传过来的this
    $.ajax({  
         type : "post",  
          url : "../backStage/deleteStudyNote.php",  
          dataType:'json',
          data : {
                s_id: e.name,
                s_picture: e.id
                // 传后台的学霸笔记编号以及用户上传的图片
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('删除成功！已经删除该笔记！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            location.reload(true);
            // 刷新页面，默认是flase，true代表刷新页面的同时也刷新浏览器的缓存
            });
            }
            else {
            layer.confirm('删除失败，请稍后再试！', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            location.reload(true);
            });
            }
          }  
        // 调用成功或者失败后，给用户提醒然后刷新页面
     }); 
}