//=====发送单条即时消息=====
/* * *********************************************
 * @思路：    
              1：当按下enter(回车键)时，清空编辑器的内容为空
              2：同时把输入的内容追加到聊天区域中
              3：同时发送ajax请求把内容交给后台存进数据库(这里是缓存服务器)
              
 * @功能:     实现单条即时消息的发送
 * @作者:     不敢为天下
 * @时间：    2016-10-10
*/
//=====发送消息开始=====
// document.onreadystatechange = subSomething;
// //当页面加载状态改变的时候执行这个方法. 
// function subSomething() 
// { 
// if(document.readyState == 'complete') //当页面加载状态 
// {
document.onkeydown = function (event) {
var e = event || window.event || arguments.callee.caller.arguments[0];
if (e && e.keyCode == 13 && e.ctrlKey) { // 按 enter  e.ctrlKey代表ctrl
    if (editor.$txt.html() != '<p><br></p>') {
        // wangEditor默认的内容是<p><br></p> 如果没有任何内容就按回车不执行下面的程序
        var  edit = editor.$txt.html();
        // 获取准备发送的内容
        editor.$txt.html('<p><br></p>');
        // 吧编辑器的内容清空
        // $("#content").append(edit+ '<br />' +  getNowFormatDate()  + '<br />');
        $("#content").append('<div class="left"><img src="'+$("#head").attr("src")+'" height="40" width="40" alt="head portrait" class="img-circle" style="float:left;"><div class="leftsend"><p>'+edit+''+ getNowFormatDate() + '</p><div class="leftarrow"></div></div></div>');
        // 然后添加到聊天区(毕竟自己发给别人的记录也要显示)
        document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
        //让浏览器的滚动条每次都到最底端
        $.post("../backStage/send_content.php",
        // 进行ajax POST请求，上面是接收请求PHP地址
            {
                content: edit,
                // 传发送的内容
                getter:$('#getter').text(),
                // 传当前的用户名(或者是昵称)
                sender:$('#sender').text()
                // 传要发给那位好友的昵称
            },
            function (data) {
                console.log(data);
                // 打印console
            });
        // 调用成功后调用回调函数
            }
        }
     };
 // }
// else{
// $('content').html('没有加载完成！');
// }
// } 
//=====发送消息结束=====