layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
function modify_check(not_null){
	if(not_null.value == ''){
     layer.confirm('修改的商品分类不能为空，请重新输入~', {
      btn: ['确定','取消'] //按钮
    }, function(){
      location.reload(true);
    });
  }
}
// 检查修改的商品分类不能为空
$(document).ready(function(){ 
$("#modify_submit").click(function(){
    $.ajax({  
         type : "post",  
          url : "../backStageBackStage/modifyGoodsType.php", 
          dataType:'json',
          data : {
          		top_category:$('#modify_id').val(),
                top_name: $('#modify_name').val()
                // 传修改的商品名
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('修改分类成功！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=goods.php';
            // 跳转到所有分类界面
            });
            }
            else {
            layer.confirm('修改分类失败！', {
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