      layui.use('layer', function(){
      layer.config({extend:'../../styles/moon/style.css'});
      // 引用表情
      layer.config({

      skin:'layer-ext-moon',

      extend:'../../styles/moon/style.css'

      });
      });
      // 引用表情

      function picture_sort_check(sorf){
      var reg = new RegExp("^[0-9]*$");
      if(!reg.test(sorf.value) || sorf.value == ''){
      layer.confirm('请输入数字排序，并且是整数且不能为空~', {
      btn: ['确定','取消'] //按钮
      }, function(){
      location.reload(true);
      });
      }

      }
      // 排序的输入限制

      function checkImg(){
      var pic = document.getElementById('input1').files;
      if(pic.length != 0){
      return true;
      }
      // 如果必填信息不为空就可以提交
      else{
      layer.alert('你未选择图片！');
      }
      // 否则给用户提示，不能提交
      return false;
      }
      function selfile(){

      var pic = document.getElementById('input1').files[0];
      // 二进制对象
      str = pic.name;
      // 获取文件名
      str = str.substr(str.indexOf('.'));
      // 获取文件类型
      if(!(str == '.jpg' || str == '.JPG' || str == '.JPEG' || str == '.png'|| str == '.PNG'|| str == '.GIF' || str == '.jpeg' || str == '.gif')){
      layer.confirm('暂不支持上传除jpg,jpeg,gif外其他类型的文件，请重新选择！', {
      btn: ['确定','取消'] //按钮
      }, function(){
      location.reload(true);
      });
      return false;
      }
      // 只支持图片类型
      var img = document.getElementById('img1');
      img.style.width = 100 + 'px';
      // 设置图片的宽度
      img.style.height = 100 + 'px';
      // 设置图片的高度
      img.src = window.URL.createObjectURL(pic);
      // 把二进制对象直接读成浏览器显示的资源
      }