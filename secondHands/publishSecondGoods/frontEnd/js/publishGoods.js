layui.use('layer', function(){
layer.config({extend:'../../../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../../../styles/moon/style.css'

});
});
// 引用表情
 function selfile(){
            var imgs = document.getElementsByTagName("img");
            // 先看页面有没有img图片(有可能用户选择一次图片，然后反悔，重新选择)
            for(i=0; i<imgs.length; i++)
            imgs[i].parentNode.removeChild(imgs[i]);
            // 然后先删除用户之前上传的图片 
            var pic = document.getElementById('pic').files;
            // 二进制对象
            for(var i = 0;i < pic.length;i++){
            str = pic[i].name;
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
            var img = document.createElement('img');
            // 创建img对象
             document.getElementById('append').appendChild(img);
            // 追加到p标签下面
            document.getElementsByTagName('img')[i].style.width = 100 + 'px';
            // 设置图片的宽度
            document.getElementsByTagName('img')[i].style.height = 100 + 'px';
            // 设置图片的高度
            img.src = window.URL.createObjectURL(pic[i]);
            // 把二进制对象直接读成浏览器显示的资源
            }
        }
function checkInput(){
      var pic = document.getElementById('pic').files;
      if($("#select_top_category").val()!=0 && $("#title").val()!='' && $("#price").val()!='' && $("#prime_cost").val()!='' && $("#select_bargained").val()!=0 && $('#select_address').val()!=0 && $('#description').val()!='' && pic.length != 0){
            return true;
      }
      // 如果必填信息不为空就可以提交
      else{
      layer.alert('你未上传图片或者标题、价格，原价等必填信息为空或未选择分类、地址、可否小刀。为了更好的售卖，请填写完整信息在发布商品吧~');
      }
      // 否则给用户提示，不能提交
      return false;
}