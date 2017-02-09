layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
function friendly_link_modify_check(not_null){
	if(not_null.value == ''){
     layer.confirm('修改的友情链接不能为空，请重新输入~', {
      btn: ['确定','取消'] //按钮
    }, function(){
      location.reload(true);
    });
  }
}
// 检查修改的友情链接不能为空
$(document).ready(function(){ 
$("#friendly_link_submit").click(function(){
    $.ajax({  
         type : "post",  
          url : "../backStageBackStage/modifyFriendlyLink.php", 
          dataType:'json',
          data : {
          		friendly_link_id:$('#friendly_link_id').val(),
                friendly_link_name: $('#friendly_link_name').val(),
                friendly_link_url: $('#friendly_link_url').val()
                // 传修改的友情链接信息
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('修改友情链接成功！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=links.php';
            // 跳转到所有分类界面
            });
            }
            else {
            layer.confirm('修改友情链接失败！', {
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