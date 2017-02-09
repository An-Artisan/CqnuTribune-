layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
function delete_seo(e){
 
	    $.ajax({  
         type : "post",  
          url : "../backStageBackStage/deleteSeo.php", 
          dataType:'json',
          data : {
          		seo_id:e.name
              
                // 传修改的商品名
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('删除该模块SEO成功！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=seo.php';
            // 跳转到所有分类界面
            });
            }
            else {
            layer.confirm('删除该模块SEO失败！', {
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