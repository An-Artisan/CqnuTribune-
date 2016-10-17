//=====接受全部消息和接受即时单条消息=====
/* * *********************************************
 * @思路：    
              1：单击每个div中的用户改变此div块的颜色标识
                1.1：同时清空聊天区域的内容
              2：同时发送ajax请求接收全部消息
                2.1：把接收到的全部消息写进布局好的聊天区域
              3：同时发送ajax长轮询请求接收单条即使通信消息
                3.1：把接收到的单条消息追加到聊天区域
              
 * @功能:     实现即时通信拉取全部消息和即时单条消息
 * @作者:     不敢为天下
*/
var friendList = document.getElementsByName('friend');
// 获取name集合
for (var k = 0; k < friendList.length; k ++){
        friendList[k].index = k;
        // 给每个div列表赋值一个index属性
        friendList[k].mark = k;
        // 给每个div列表赋值一个mark属性
}
// 主要是用来标识一个好友只执行一次get_content获取内容的ajax程序
for(var i = 0;i < friendList.length;i ++){
    friendList[i].onclick = function(){
        // 没点击一个好友产生的事件
        for (var j = 0; j < friendList.length; j++) {
         friendList[j].style.backgroundColor = '#32343a';
        }
         // 先还原之前的颜色
        this.style.backgroundColor = '#666';
        // 在设置凹凸背景色
        $('#getter').text($(this).children("h4").first().text());
        // 更改与某人聊天的昵称
        $('#content').html('');
        // 清空聊天记录区的内容

        //=====接受全部聊天记录开始=====
        $(function(){
            var get_all_content = {
                type: 'POST',
                // POST提交
                url:'http://test_chat.joker1996.com/AjaxLongPolling/get_all_content.php',
                // 接受PHP地址
                dataType:'json',
                // 返回数据格式：json
                data:{sender:$('#sender').text(),getter:$('#getter').text()},
                // 提交的数据
                success:function(data){
                 var all_record = '';
                    // 设置接受所有聊天记录的变量
                 for(var i=0;i<data.length;i++){
                    // 循环json内容
                    var content = data[i] + '<br />' + data[++i] + '<br />';
                    // data[i]表示记录 data[++i]表示发送记录时间
                    all_record += content;
                    // 获取总和记录
                 }
                   $('#content').html(all_record);
                    // 添加到聊天区
                 document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
                    //让浏览器的滚动条每次都到最底端 
                }
                 // 调用成功回调函数
            };
            $.ajax(get_all_content);
        // 执行ajax调用程序
        });
        //=====接受全部聊天记录结束=====


        // =====接受即时消息开始=====
        if(this.index++ == this.mark){
            $(function(){
                var active_user = $('#getter').text();
                // 获取当前聊天好友昵称
                var setting = {
                    type: 'POST',
                    // POST提交
                    url:'http://test_chat.joker1996.com/AjaxLongPolling/get_content.php',
                    // PHP接收地址
                    dataType:'json',
                    // 返回json格式
                    data:{sender:$('#sender').text(),getter:$('#getter').text()},
                    // 传过去的数据 当前登录昵称，发送消息的好友昵称
                    success:function(data){
                    if($('#getter').text() == active_user){
                       //  如果聊天区上面的好友昵称是之前获取的昵称就执行下面语句 
                       var  all_data =  data[0]+ '<br />' + data[1];
                       //  获取好友给当前用户发的信息 data[0]是聊天记录，data[1]是发送时间
                       if(typeof(all_data) != "undefined"){
                       $("#content").append(all_data);
                        //  添加到聊天区(追加方式)
                        }
                       //  这里有个莫名其妙的bug，有时候第一条发送的消息是undefined
                       document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
                       //  让浏览器的滚动条每次都到最底端   

                    }
                       $.ajax(setting);
                       //  立马再次执行ajax长轮询
                    }
                };
            $.ajax(setting);
            // 调用第一次ajax程序
            }); 
        }
        //=====接收即时消息结束=====
    }
}