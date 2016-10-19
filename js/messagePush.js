$(function(){
    var setting = {
        type: 'POST',
        // POST提交
        url:'http://localhost/chatRoom/AjaxLongPolling/message_push.php',
        // PHP接收地址
        dataType:'json',
        // 返回json格式
        data:sender:$('#sender').text(),
        // 传过去的数据 当前登录昵称
        success:function(data){         
           
           $.ajax(setting);
           //  立马再次执行ajax长轮询
        }
    };
$.ajax(setting);
// 调用第一次ajax程序
});