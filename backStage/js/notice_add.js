layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
function category_check(sorf){
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
$("#category_submit").click(function(){
    $.ajax({  
         type : "post",  
          url : "../backStageBackStage/addNotie.php", 
          dataType:'json',
          data : {
               a_content: $('#category_name').val()
                // 传后台的用户编号
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('添加公告成功！', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=notice.php';
            // 跳转到所有分类界面
            });
            }
            else {
            layer.confirm('添加公告失败！', {
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