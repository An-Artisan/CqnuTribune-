/**
* ================================================
* title：chatRoom.js
* time: 2016-10-23
* author: 杨凤玲
* content: 聊天室（chatRomm.html）小屏登录时，弹出聊天界面2
* ================================================
*/

    if (screen.width < 768){
        var target = document.getElementById("one");
        target.onclick = function objclick() {
             window.location.assign('http://yfl995.dev.dxdc.net/task_bs/chatRoom2.html');
        }
    }
