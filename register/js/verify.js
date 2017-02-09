/**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-10-8
* @Content: register.html的表单验证js
* @Last Modified time: 2016-11-8
* ================================================
*/
layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
// 引用表情
function checkName(name) {  //验证name
    var length = strlen(name);
    // 获取长度
    console.log(length);
    if(length<4 || length>10){
      layer.confirm('昵称汉字长度不能少于2个长度，不能多余5个.英文字符不能少于4个长度，不能多余10个长度~', {
          btn: ['确定','取消'] //按钮
        }, function(){
        location.reload(true);
        },function(){
          location.reload(true);
        });
          return false;
      }
    check_user_repeat(name);
    if(name != ""){ //不为空则正确，当然也可以ajax异步获取服务器判断用户名不重复则正确
        document.images[0].setAttribute("src","./img/gou.png"); //对应图标
        document.images[0].style.display = "inline"; //显示
        return true;
    }
    else { //name不符合
        document.images[0].setAttribute("src","./img/gantan.png"); //对应图标
        document.images[0].style.display = "inline"; //显示
        return false;
    }
}
function check_user_repeat(name){
        $.ajax({  
         type : "post",  
          url : "checkUser.php",  
          dataType:'json',
          data : {
                user: name,
                // 传注册的用户名
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state==0){
            layer.confirm('该用户已经存在，请重新输入用户名~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            location.reload(true);
            });
            }
          }  
        // 调用成功或者失败后，给用户提醒然后刷新页面
     }); 
}

function strlen(str){  
    var len = 0;  
    for (var i=0; i<str.length; i++) {   
     var c = str.charCodeAt(i);   
    //单字节加1   
     if ((c >= 0x0001 && c <= 0x007e) || (0xff60<=c && c<=0xff9f)) {   
       len++;   
     }   
     else {   
      len+=2;   
     }   
    }   
    return len;  
}  
// 计算字符串长度(英文占1个字符，中文汉字占2个字符)

function checkPassw(passw1,passw2){ //验证密码
    if(passw1.length < 6 ){
        document.images[1].setAttribute("src","./img/gantan.png");
        document.images[1].style.display = "inline";
        document.getElementById("p3").style.display = "block";
        document.getElementById("p4").style.display = "none";
        return false;
    }
    else if(passw1 !== passw2){ //两次密码不等
        document.images[1].setAttribute("src","./img/gantan.png");
        document.images[1].style.display = "inline";
        document.getElementById("p4").style.display = "block";
        document.getElementById("p3").style.display = "none";
        return false;
    }
    else {  //密码输入正确
        document.images[1].setAttribute("src","./img/gou.png");
        document.images[1].style.display = "inline";
        document.getElementById("p4").style.display = "none";
        document.getElementById("p3").style.display = "none";
        return true;
    }
}

function checkTel(Tel) {  //验证手机
    var pattern = /^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/;
    if (!pattern.test(Tel)) {  //手机格式不正确
        document.images[2].setAttribute("src", "./img/gantan.png");
        document.images[2].style.display = "inline";
        return false;
    }
    else {
        document.images[2].setAttribute("src", "./img/gou.png");
        document.images[2].style.display = "inline";
        return true;
    }
}
function checkEmail(email){  //验证邮箱
    var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
    if (!pattern.test(email)) { //email格式不正确
        document.images[3].setAttribute("src","./img/gantan.png");
        document.images[3].style.display = "inline";
        return false;
    }
    else { //格式正确
        document.images[3].setAttribute("src","./img/gou.png");
        document.images[3].style.display = "inline";
        return true;
    }
}


var ele = { //存放各个input字段obj
    name: document.getElementById("name"),
    password: document.getElementById("password"),
    R_password: document.getElementById("R_password"),
    Tel: document.getElementById("Tel"),
    email: document.getElementById("email")
};
    ele.name.onblur = function() { //name失去焦点则检测
        checkName(ele.name.value);
    }
    ele.password.onblur = function() { //password失去焦点则检测
        checkPassw(ele.password.value,ele.R_password.value);
    }
    ele.R_password.onblur = function() { //R_password失去焦点则检测
        checkPassw(ele.password.value,ele.R_password.value);
    }
    ele.Tel.onblur = function() {
        checkTel(ele.Tel.value);  //Tel失去焦点则检测
    }
    ele.email.onblur = function() { //email失去焦点则检测
        checkEmail(ele.email.value);
    }

function check() {  //表单提交则验证开始
    var ok = false;
    var nameOk = false;
    var passwOk = false;
    var TelOk = false;
    var emailOk = false;

    if (checkName(ele.name.value)) { nameOk = true; }  //验证name
    if (checkPassw(ele.password.value,ele.R_password.value)) { passwOk = true; } //验证password
    if (checkTel(ele.Tel.value)) { TelOk = true; }  //验证Tel
    if (checkEmail(ele.email.value)) { emailOk = true; }  //验证email

    if (nameOk && passwOk && TelOk && emailOk) {
        
        return true;
    }
    else {
        return false;  //有误，注册失败
    }
}



window.onload = function () {

    // 图像上传
    var input = document.getElementById('input1');
    input.onchange =  function () {
        var preview = document.getElementById('img1')
        var file  = document.getElementById('input1').files[0];
        str = file.name;
        // 获取文件名
        str = str.substr(str.indexOf('.'));
        // 获取文件类型
        if(!(str == '.jpg' || str == '.JPG' || str == '.JPEG' || str == '.png' || str == '.PNG' || str == '.GIF' || str == '.jpeg' || str == '.gif')){
            alert('暂且不支持此格式上传');
            location.reload(true);
            return false;
        }
        // 只允许上传图片类型的文件
        var reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
            preview.style.width = '100px';
            preview.style.height = '100px';
        }
        else {
            preview.src = "";
        }
    }

    // 点击注册
    var oBtn = document.getElementById('btn');
    btn.onclick = check;
};

