layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
// 引用表情
 function selfile(){
            var $current = $("#img");
            $current.find("img").each(function(i){ 
            $(this).remove();
            }); 
            // // 然后先删除用户之前上传的图片
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
            img.src = window.URL.createObjectURL(pic[i]);
            // 把二进制对象直接读成浏览器显示的资源
            }
            $current.find("img").each(function(i){ 
            $(this).width(100);
            $(this).height(100);
            }); 
            // 设置图片的宽度高度
        }