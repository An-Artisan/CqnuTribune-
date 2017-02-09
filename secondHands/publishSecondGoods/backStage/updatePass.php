<!DOCTYPE html>
<html>
<head>
    <!-- layer框架 -->
    <script type="text/javascript" src="../../../styles/layui/layui.js"></script>

</head>
<body>
</body>
</html>
<?php 
require '../../../cqnu.class/all.class/all.class.php';
// 引入所有类
session_start();
// 开启session
$encrypt = Encrypt::create_singleton();
// 实例化Encrypt对象(静态方法获取对象)
$encrypt_password =  $encrypt -> encrypt($_POST['password']);
//给密码加密
$update = Update::create_singleton();
$arrayName = array('user_password' => $encrypt_password);
$update->update('user.user_information',$arrayName,'user_name','=',$_SESSION['user']);
// 更新数据
echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('修改密码成功~', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../frontEnd/index.php?iframe=personalData.php';
            });  });</script>";
// top.location.href针对iframe跳转。表示最外层top跳转
 ?>