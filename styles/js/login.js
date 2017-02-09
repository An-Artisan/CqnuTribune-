layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
// 引用layer前段框架
var login_user = document.getElementById('loginbtn');
login_user.onclick = function(){
$(function(){
    var setting = {
        type: 'POST',
        // POST提交
        dataType:'json',
        // 接受返回值类型
        url:'../../login/login.php',
        // PHP接收地址
        data:{user: $('#txtName').val(),password: $('#txtPwd').val()},
        // 传过去的数据 当前留言内容，当前商品编号
        success:function(data){         
         if(data.state!=0){
            layer.confirm('登录成功~', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            location.reload(true);
            // 刷新页面，默认是flase，true代表刷新页面的同时也刷新浏览器的缓存
            });
            }
            else {
            layer.confirm('用户名密码错误,请重新登录~', {
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