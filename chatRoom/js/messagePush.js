    //=====接收当前用户的所有未读消息=====
    /* * *********************************************
     * @思路：    
                  1：发送ajax请求接收全部未读消息
                  2：成功后循环json数据，因为是json数据里面嵌套了数组，所有需要循环
                    2.1：如果有数据等于当前选择的用户，就不改变前段的消息提醒，否则改变json数据里面的用户消息提醒
                    2.2：再次执行ajax轮询
     * @功能:     实现接收当前用户的所有未读消息
     * @作者:     不敢为天下
     * @时间：    2016-10-25
    */
    $(function(){
        var setting = {
            type: 'POST',
            // POST提交
            url:'../backStage/message_push.php',
            // PHP接收地址
            dataType:'json',
            // 返回json格式
            data:{sender:$('#sender').text()},
            // 传过去的数据 当前登录昵称
            success:function(json){
             jQuery("div[name='friend']").each(function(){
             for( var i in json){
             if(jQuery(this).children("div").first().children("h4").first().text() == i && i != $('#getter').text()){
                // 如果后台返回的数据里面有this用户，那么就证明这个this用户有给当前用户的未读消息，并且不能等于当前已经选择的用户
                jQuery(this).children("div").first().children("h3").first().text(json[i][0]);
                // 写入内容
                jQuery(this).children("div").last().children("p").first().text(json[i][1]);
                // 写入时间
                jQuery(this).children("div").last().children("span").first().text('1');
                // 写入消息提示
             }
            }
        });    
               // 如果不等于当前选择的用户就存进数组

               $.ajax(setting);
                // 立马再次执行ajax长轮询
            }
        };
    $.ajax(setting);
    // 调用第一次ajax程序
    });