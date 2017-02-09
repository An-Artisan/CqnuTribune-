//=====接收未读消息=====
/* * *********************************************
* 
* @功能:     发送一条ajax请求到后台清理缓存用户
* @作者:     不敢为天下
* @时间：    2016-10-26
*/
$(function(){
        var setting = {
            type: 'POST',
            // POST提交
            url:'../backStage/clear_user_redis.php',
            // PHP接收地址
            }
        
    $.ajax(setting);
    // 调用第一次ajax程序
    });