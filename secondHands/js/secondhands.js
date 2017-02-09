layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
// 引用layer前段框架
$(function(){
$("#category li").each(function(){
    $(this).click(function(){
 	if($(this).attr('id')!='top'){
 		// 第一个li的分类详情不能点击
   	window.location.href="../index/secondHands.php?category_name="+$(this).children('a').first().attr('name'); 
	}
});
});
});
// 点击分类传分类的id到当前界面
function login(){
layer.msg('请先登录后再试~');
var s = document.getElementById('example');
s.click();
}
// 如果用户session不存在提示用户先登录