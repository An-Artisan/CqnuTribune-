$("#submit").click(function(){
layui.use('layer', function(){
layer.config({extend:'../../../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../../../styles/moon/style.css'

});
});
// 引用表情
if(editor.$txt.html()=='<p><br></p>'){
    // 不为空
layui.use('layer', function(){
layer.config({extend:'../../../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../../../styles/moon/style.css'

});
layer.alert('留言不能为空！');
});
// 引用表情
}
else{
$(function(){
    var setting = {
        type: 'POST',
        // POST提交
        dataType:'json',
        // 接受返回值类型
        url:'../publishSecondGoods/backStage/message.php',
        // PHP接收地址
        data:{content: editor.$txt.html(),item_number: $('#item_number').text()},
        // 传过去的数据 当前留言内容，当前商品编号
        success:function(data){         
         if(data.state!=0){
            layer.confirm('留言成功~', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            location.reload(true);
            // 刷新页面，默认是flase，true代表刷新页面的同时也刷新浏览器的缓存
            });
            }
            else {
            layer.confirm('留言失败，请稍后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            location.reload(true);
            });
            }
        }
    };
$.ajax(setting);
// 调用第一次ajax程序
});
}
});
function login(){
layer.msg('请先登录后再试~');
var s = document.getElementById('example');
s.click();
}
function user(){
layui.use('layer', function(){
layer.config({extend:'../../../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../../../styles/moon/style.css'

});
layer.alert('不能自己私信自己~');
});
// 引用表情
}
