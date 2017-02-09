//=====js获取当前时间戳(精确到秒)=====
/* * *********************************************
 * @思路：    
              1：实例化js时间日期对象Date()
              2：分别获取当前年，当前月，当前日，当前时，当前分，当前秒
                2.1：因为js月日时分秒只返回指定的对应的时间。比如 当前时间是
                     1996年8月1日凌晨4时6分5秒 那么js显示的是1996 8 1 4 6 5
                     不会像PHP一样显示完整，如果是PHP会显示 1996 08 01 04 06 05
                     所以要给时间加上分割符以及是个位时间的加上0
              3：拼接时间字符串，然后return 给调用函数
              
 * @功能:     js获取当前时间戳(完整版)
 * @作者:     不敢为天下
 * @时间：    2016-10-14
*/
//=====发送消息开始=====
function getNowFormatDate() {
    var date = new Date();
    // 实例化js事件对象
    var seperator1 = "-";
    // 年份和月份分隔符以及月份和小时分隔符
    var seperator2 = ":";
    // 小时和分钟分隔符，分钟和秒数分隔符
    var year = date.getFullYear();
    // 获取当前年月
    var month = date.getMonth() + 1;
    /* 
        获取当前月份
        PS：这里为什么要+1？因为js是老外发明的
        而外国人的月份从0开始的，0代表1月。11
        代表12月。就像外国人星期日作为一个星
        期的第一天一样。所以这里要+1
    */
    var strDate = date.getDate();
    // 获取当前日
    var hour = date.getHours();
    // 获取当前时
    var minutes = date.getMinutes();
    // 获取当前分
    var seconds = date.getSeconds();
    // 获取当前秒
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    // 如果当前月是个位，就给他前面加一个0
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    // 如果当前日是个位，就给他前面加一个0
    if (hour >= 0 && hour <= 9) {
        hour = "0" + hour;
    }
    // 如果当前时是个位，就给他前面加一个0
    if (minutes >= 0 && minutes <= 9) {
        minutes = "0" + minutes;
    }
    // 如果当前分是个位，就给他前面加一个0
    if (seconds >= 0 && seconds <= 9) {
        seconds = "0" + seconds;
    }
    // 如果当前分是个位，就给他前面加一个0
    var currentdate = year + seperator1 + month + seperator1 + strDate
        + " " + hour + seperator2 + minutes
        + seperator2 + seconds;
    // 拼接时间字符串
    return currentdate;
    // 返回给调用函数
}
function getNowFormatTime(){
    var date = new Date();
    // 实例化js事件对象
    var seperator2 = ":";
    // 小时和分钟分隔符，分钟和秒数分隔符
    var hour = date.getHours();
    // 获取当前时
    var minutes = date.getMinutes();
    // 获取当前分
    var seconds = date.getSeconds();
    // 获取当前秒
    if (hour >= 0 && hour <= 9) {
        hour = "0" + hour;
    }
    // 如果当前时是个位，就给他前面加一个0
    if (minutes >= 0 && minutes <= 9) {
        minutes = "0" + minutes;
    }
    // 如果当前分是个位，就给他前面加一个0
    if (seconds >= 0 && seconds <= 9) {
        seconds = "0" + seconds;
    }
    // 如果当前分是个位，就给他前面加一个0
    var currentdate =  hour + seperator2 + minutes
        + seperator2 + seconds;
    // 拼接时间字符串
    return currentdate;
    // 返回给调用函数
}
