layui.use('layer', function(){
layer.config({extend:'../../../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../../../styles/moon/style.css'

});
});
// 引用表情
function dataCheckInput(){
      var name = document.getElementById('username');
      var gender = document.getElementById('gender');
      var email = document.getElementById('email');
      var phone = document.getElementById('phone');
      var length = strlen(name.value);
      if(length<4 || length>10){
      layer.confirm('昵称汉字长度不能少于2个长度，不能多余5个.英文字符不能少于4个长度，不能多余10个长度~', {
          btn: ['确定','取消'] //按钮
        }, function(){
        location.reload(true);
        });
          return false;
      }
      // 判断昵称长度
      var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
      if(!reg.test(email.value)){
      layer.confirm('邮箱格式不正确，请重新输入~', {
          btn: ['确定','取消'] //按钮
        }, function(){
        location.reload(true);
        });
          return false;
      }
      // 判断邮箱格式
      var filter=/^1(3|4|5|7|8)\d{9}$/; 
      if(!filter.test(phone.value)){
      layer.confirm('手机号码格式不正确，请重新输入~', {
          btn: ['确定','取消'] //按钮
        }, function(){
        location.reload(true);
        });
          return false;
      }
      // 手机号码格式

      return true;
}
function updatefile(){
      var pic = document.getElementById('upfile').files[0];
      var img = document.getElementById('photo');
      var str = pic.name;
      // 获取文件名
      var type = 0;
      str = str.substr(str.indexOf('.'));
      // 获取文件类型
      switch(str)
      {
      case '.jpg':
        type = 1;
        break;
      case '.JPG':
        type = 1;
        break;
      case '.JPEG':
        type = 1;
        break;
      case '.jpeg':
        type = 1;
        break;
      case '.gif':
        type = 1;
        break;
      case '.GIF':
        type = 1;
        break;
      case '.png':
        type = 1;
        break;
      case '.PNG':
        type = 1;
        break;
      default:
        type = 0;
      }
      if(!type){
        layer.confirm('暂不支持上传除jpg,jpeg,gif外其他类型的文件，请重新选择！', {
          btn: ['确定','取消'] //按钮
        }, function(){
        location.reload(true);
        });
          return false;
      }
      // 只支持图片类型
      img.src = window.URL.createObjectURL(pic);
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
