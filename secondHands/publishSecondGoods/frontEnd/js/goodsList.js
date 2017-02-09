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
  // 这里的e就是传过来的当前this
    if(e.innerHTML=='交易成功'){
 layer.confirm('您确定交易成功并且下架该商品？PS:下架之后还会保留在您的发布页面中。', {
  btn: ['确定','取消'] //按钮
}, function(){
  ajax_success(e);
  // 调用ajax
});
// 如果点击的是交易成功，就询问用户，如果用户确定，就调用ajax去下架商品
}
else{
    layer.confirm('您确定要删除这条发布信息吗？PS:删除后将不会显示在网站以及您的发布页面中。', {
  btn: ['确定','取消'] //按钮
}, function(){
  ajax_delete(e);
  // 调用ajax
});
}
// 如果不是点的交易成功，那么就是删除商品的发布信息，弹出询问看，如果用户确定就执行ajax删除商品
}
function ajax_delete(e){
// 这里的e就是传过来的this
    $.ajax({  
         type : "post",  
          url : "../backStage/deleteGoods.php",  
          dataType:'json',
          data : {
                content: e.name,
                // 传后台的用户编号
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('删除成功！已经删除该商品！', {
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
function ajax_success(e){
    $.ajax({  
         type : "post",  
          url : "../backStage/successGoods.php",  
          dataType:'json',
          data : {
                content: e.name,
                // 传商品编号
            },
          async : true,  
          // 默认是异步
          success : function(data){  
            if(data.state){
            layer.confirm('交易成功，已经下架该商品！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            location.reload(true);
            // 刷新页面，默认是flase，true代表刷新页面的同时也刷新浏览器的缓存
            });
            }
            else {
            layer.confirm('交易失败，请稍后再试！', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            location.reload(true);
            // 刷新页面，默认是flase，true代表刷新页面的同时也刷新浏览器的缓存
            });
            }
          }  
            // 调用成功后调用回调函数
     }); 
}

