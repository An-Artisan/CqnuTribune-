layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

skin:'layer-ext-moon',

extend:'../../styles/moon/style.css'

});
});
// 引用表情
function modify_check_img(){
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