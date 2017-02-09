<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	 <!-- layer框架 -->
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>
</head>
<body>
<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
session_start();
// 开启session
$content = $_POST['content'];
$sender = $_SESSION['user'];
$getter = $_POST['s_name'];
$r_number = $_POST['s_id'];
// 获取post传的数据
$insert = Insert::create_singleton();
// 获取插入对象
$time = date('Y-m-d H:i:s',time());
// 一定要放在实例化对象后面。不然没有设置时区格式
$arrayName = array('r_number' => $r_number , 'r_sender' => $sender, 'r_getter' => $getter , 'r_content' => $content , 'r_time' => $time , 'r_content_is_read' => 0);
// 打包数组
if(!$insert->insert('study_note.study_reply',$arrayName)){
	echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('发布失败，请稍后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            top.location.href='../frontEnd/details.php?number=".$r_number."';
            });  });</script>";
// top.location.href针对iframe跳转。表示最外层top跳转
}else{
	echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('发布成功~~', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../frontEnd/details.php?number=".$r_number."';
            });  });</script>";
// top.location.href针对iframe跳转。表示最外层top跳转
}

 ?>
</body>
</html>
