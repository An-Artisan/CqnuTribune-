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
$old_picture = $_POST['photo'];
$name = $_POST['username'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
if(!empty($_FILES['pic']['name'][0])){
$up = new fileupload();
//设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
$up -> set("path", "../../../register/img/");
// 这里设置上传的图片路径，类里面默认路径是当前目录的upload。如果没有此目录会自动创建
$up -> set("maxsize", 10485760);
// 设置图片的最大字节 1M=1048576 B(字节)
$up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
// 设置允许上传类型 (默认的类型gif,png,jpg,jpeg)
if($up -> upload("pic")) {
	 //使用对象中的upload方法， 就可以上传文件，方法需要传一个上传表单的名字 pic, 如果成功返回true, 失败返回false
	 $picture = $up->getFileName();
     //获取上传后文件名子可以存进数据库
} else {
    echo '<pre>';
    var_dump($up->getErrorMsg());
     //获取上传失败以后的错误提示
    echo '</pre>';
}
$update = Update::create_singleton();
$arrayName = array('user_name' => $name,'user_gender' => $gender,'user_photo' => $picture,'user_email' => $email,'user_phone' => $phone);
$update->update('user.user_information',$arrayName,'user_name','=',$_SESSION['user']);
// 更新数据
if($old_picture != 'default.jpeg'){
	unlink ('../../../register/img/'.$old_picture);
	// 删除之前的头像
}
}
// 更改头像
else{
$update = Update::create_singleton();
$arrayName = array('user_name' => $name,'user_gender' => $gender,'user_email' => $email,'user_phone' => $phone);
// 更新数据
$update->update('user.user_information',$arrayName,'user_name','=',$_SESSION['user']);
}
// 没有更改头像
echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('更新资料成功~', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../frontEnd/index.php?iframe=personalData.php';
            });  });</script>";
// top.location.href针对iframe跳转。表示最外层top跳转
 ?>