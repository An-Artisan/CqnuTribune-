//=====接受全部消息和接受即时单条消息=====
/* * *********************************************
 * @思路：    
              1：单击每个div中的用户改变此div块的颜色标识
                1.1：同时清空聊天区域的内容
                1.2: 同时清空推送消息区域的内容
                1.3: 同时取消前一次的ajax程序
              2：同时发送ajax请求接收全部消息
                2.1：把接收到的全部消息写进布局好的聊天区域
              3：同时发送ajax长轮询请求接收单条即使通信消息
                3.1：如果不等于之前的好友，就不添加消息到聊天区域
                3.2：把接收到的单条消息追加到聊天区域
              
 * @功能:     实现即时通信拉取全部消息和即时单条消息
 * @作者:     不敢为天下
 * @时间：    2016-10-8
*/
var friendList = document.getElementsByName('friend');
// 获取name集合
for (var k = 0; k < friendList.length; k ++){
        friendList[k].index = k;
        // 给每个div列表赋值一个index属性
        friendList[k].mark = k;
        // 给每个div列表赋值一个mark属性
}
var audio = document.getElementById("voice");
//获取聊天提示音
for(var i = 0;i < friendList.length;i ++){
    friendList[i].onclick = function(){
        // $.ajax(setting).abort();
        // 每当你切换一个用户聊天，就结束之前聊天的用户的ajax程序
        for (var j = 0; j < friendList.length; j++) {
         friendList[j].style.backgroundColor = '#32343a';
        }
        // 先还原之前的颜色
        this.style.backgroundColor = '#666';
        // 在设置凹凸背景色
        jQuery(this).children("div").first().children("h3").first().text('');
        // 清空消息推送记录
        jQuery(this).children("div").last().children("p").first().text('');
        // 清空消息推送时间
        jQuery(this).children("div").last().children("span").first().text('');
        // 清空消息推送提示图标
        $('#getter').text($(this).children("div").first().children("h4").first().text());
        // 更改与某人聊天的昵称
        $('#content').html('');
        // 清空聊天记录区的内容
        var friend_head = jQuery(this).children("img").first().attr('src');
        //=====接受全部聊天记录开始=====
        $(function(){
            var get_all_content = {
                type: 'POST',
                // POST提交
                url:'../backStage/get_all_content.php',
                // 接受PHP地址
                dataType:'json',
                // 返回数据格式：json
                data:{sender:$('#sender').text(),getter:$('#getter').text()},
                // 提交的数据
                success:function(data){

                 var all_record = '';
                    // 设置接受所有聊天记录的变量
                 var content = '';
                    // 设置中间内容变量
                 var sender = $('#sender').text();
                 for(var i=0;i<data.length;i++){
                    // 循环json内容
                    if(data[i]== sender){
                    // 判断消息左右的摆放
                    all_record += '<div class="left"><img src="'+$("#head").attr("src")+'" height="40" width="40" alt="head portrait" class="img-circle" style="float:left;"><div class="leftsend"><p>'+data[++i]+''+ data[++i] + '</p><div class="leftarrow"></div></div></div>';
                   }
                   else{
                    all_record += '<div class="right"><img src="'+ friend_head +'" height="40" width="40" alt="head portrait" class="img-circle" style="clear: both;float:right;"><div class="rightsend"><p>'+data[++i]+''+ data[++i] + '</p><div class="rightarrow"></div></div></div>';
                   }
                   // all_record 获取总和记录
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
                // 获得当前聊天好友
                var setting = {
                type: 'POST',
                // POST提交
                url:'../backStage/get_content.php',
                // PHP接收地址
                dataType:'json',
                // 返回json格式
                data:{sender:$('#sender').text(),getter:$('#getter').text()},
                // 传过去的数据 当前登录昵称，发送消息的好友昵称
                success:function(data){
                if( data[0] != '' && active_user == $('#getter').text()){
                   /*  
                        这里有个莫名其妙的bug，有时候连续发送的消息快了返回值是空
                        但是却把数据存到了redis缓存服务器里面了。是PHP后台执行的
                        长轮询的时候导致的。所以这里要判断data[0] 不为空。不然会
                        输出undefined。
                   */
                   var all_data = '<div class="right"><img src="' + friend_head + '" height="40" width="40" alt="head portrait" class="img-circle" style="clear: both;float:right;"><div class="rightsend"><p>'+data[0]+''+ data[1] + '</p><div class="rightarrow"></div></div></div>';
                   //  获取好友给当前用户发的信息 data[0]是聊天记录，data[1]是发送时间
                   $("#content").append(all_data);
                    //  添加到聊天区(追加方式)

                    audio.play();
                     /*
                     * jquery选择器所以返回的是jquery对象而非dom对象，
                     * 而jquery对象是没有play()方法的，你要么将jquery对象转换成dom对象，
                     * 要么使用源生选择器document.getElementById
                     * 这里选择用的是原生的js代码
                     * 
                     */
                   document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
                   //  让浏览器的滚动条每次都到最底端  
                    $.ajax(setting);
                   //  立马再次执行ajax长轮询 
                }
                 
                }

            }
        $.ajax(setting);
        // 调用第一次ajax程序
        //=====接收即时消息结束=====
         });
        }
    }
 }