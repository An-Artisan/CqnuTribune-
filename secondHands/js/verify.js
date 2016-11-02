/**
* ================================================
* title：verify.js
* time: 2016-10-8
* author: 杨凤玲
* content: register.html的表单验证js
* ================================================
*/

  function checkName(name){  //验证name
    if(name != ""){ //不为空则正确，当然也可以ajax异步获取服务器判断用户名不重复则正确
      document.images[0].setAttribute("src","./img/gou.png"); //对应图标
      document.images[0].style.display = "inline"; //显示
      return true;
    }else{ //name不符合
      document.images[0].setAttribute("src","./img/gantan.png"); //对应图标
      document.images[0].style.display = "inline"; //显示
      return false;
    }
  }
  function checkPassw(passw1,passw2){ //验证密码
    if(passw1.length < 6 || passw2.length < 6){

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
    }else{  //密码输入正确

      document.images[1].setAttribute("src","./img/gou.png");
      document.images[1].style.display = "inline";
      document.getElementById("p4").style.display = "none";
      document.getElementById("p3").style.display = "none";
      return true;
    }
  }
  function checkqq(qq) {  //验证QQ
        var pattern = /^\d{5,10}$/;
        if(!pattern.test(qq)) {  //qq格式不正确
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
    function checkTel(Tel) {  //验证手机
        var pattern = /^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/;
        if(!pattern.test(Tel)) {  //手机格式不正确
            document.images[3].setAttribute("src", "./img/gantan.png");
            document.images[3].style.display = "inline";
            return false;
        }
        else {

            document.images[3].setAttribute("src", "./img/gou.png");
            document.images[3].style.display = "inline";
            return true;
        }
  }
  function checkEmail(email){  //验证邮箱
    var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
    if(!pattern.test(email)){ //email格式不正确
      document.images[4].setAttribute("src","./img/gantan.png");
      document.images[4].style.display = "inline";
      document.getElementById("p1").style.display = "block";
      return false;
    }else{ //格式正确
      document.images[4].setAttribute("src","./img/gou.png");
      document.images[4].style.display = "inline";
      return true;
    }
  }
  function checkidCard(idCard) {  //验证身份证
        var pattern = /^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;
        if(!pattern.test(idCard)) {  //身份证格式不正确
            document.images[5].setAttribute("src", "./img/gantan.png");
            document.images[5].style.display = "inline";
            document.getElementById("p2").style.display = "block";


            return false;
        }
        else {
            document.images[5].setAttribute("src", "./img/gou.png");
            document.images[5].style.display = "inline";
            return true;
        }
  }



  var ele = { //存放各个input字段obj
      name: document.getElementById("name"),
      password: document.getElementById("password"),
      R_password: document.getElementById("R_password"),
      email: document.getElementById("email"),
      idCard: document.getElementById("idCard"),
      qq: document.getElementById("qq"),
      Tel: document.getElementById("Tel")

    };
    ele.name.onblur = function(){ //name失去焦点则检测
        checkName(ele.name.value);
    }
    ele.password.onblur = function(){ //password失去焦点则检测
        checkPassw(ele.password.value,ele.R_password.value);
    }
    ele.R_password.onblur = function(){ //R_password失去焦点则检测
        checkPassw(ele.password.value,ele.R_password.value);
    }
    ele.email.onblur = function(){ //email失去焦点则检测
        checkEmail(ele.email.value);
    }
    ele.idCard.onblur = function(){ //idCard失去焦点则检测
        checkidCard(ele.idCard.value);
    }
    ele.qq.onblur = function(){ //qq失去焦点则检测
        checkqq(ele.qq.value);
    }
    ele.Tel.onblur = function(){
        checkTel(ele.Tel.value);
    }

  function check(){  //表单提交则验证开始
    var ok = false;
    var nameOk = false;
    var emailOk = false;
    var passwOk = false;
    var idCardOk = false;
    var qqOk = false;
    var TelOk = false;

    if(checkName(ele.name.value)){ nameOk = true; }  //验证name
    if(checkPassw(ele.password.value,ele.R_password.value)){ passwOk = true; } //验证password
    if(checkEmail(ele.email.value)){ emailOk = true; }  //验证email
    if(checkidCard(ele.idCard.value)){ idCardOk = true; }  //验证idCard
    if(checkqq(ele.qq.value)){ qq = true; }  //验证qqTel
    if(checkTel(ele.Tel.value)){ Tel = true; }

    if(nameOk && passwOk && emailOk && idCardOk ){
      alert("Tip: 注册成功！");  //注册成功
      return true;
    }
    return false;  //有误，注册失败
  }
