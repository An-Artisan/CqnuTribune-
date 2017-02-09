layui.use('layer', function(){
layer.config({extend:'../../../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../../../styles/moon/style.css'

});
});
// 引用表情
function changePass(){
	if(!($('#password').val()!='' && $('#password').val().length > 6 && $('#password').val().length<16 && $('#password_o').val()!='' && $('#password_c').val()!='')){
		layer.confirm('密码不能为空且新密码长度不能少于6位不能大于16位~', {
					btn: ['确定','取消'] //按钮
					}, function(){
					location.reload(true);	
					});
	return false;
	}
	return true;
}
function verify(){
	if($('#password').val()!=$('#password_c').val()){
		layer.confirm('两次密码不一致，请重新输入~', {
					btn: ['确定','取消'] //按钮
					}, function(){
					location.reload(true);
					});
					return false;
	}
}
function myFunction(){
	$(function(){
                var setting = {
                type: 'POST',
                // POST提交
                url:'../backStage/judge.php',
                // PHP接收地址
                dataType:'json',
                // 返回json格式
                data:{password_o:$('#password_o').val()},
                // 传过去的数据 
                success:function(data){
             		if(data.state==0){
						layer.confirm('原密码错误！请重新输入', {
						btn: ['确定','取消'] //按钮
						}, function(){
						location.reload(true);
						});
						return false;
						}
             		}
                }
         $.ajax(setting);
        // 调用ajax程序
            });
     

}
