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
if (empty($_POST['content']) || empty($_POST['title']) || empty($_SESSION['user'])) {
	echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('你未登录或标题为空~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            top.location.href='../frontEnd/mySchool.php';
            });  });</script>";
// top.location.href针对iframe跳转。表示最外层top跳转
            exit();
}
$content = $_POST['content'];
$title = $_POST['title'];
// 获取post传的数据
$user = $_SESSION['user'];
$img = '';
// 复制一个空
if(!empty($_FILES['pic']['name'][0])){
	$up = new fileupload();
    //设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)

    $up -> set("path", "../images/");
    // 这里设置上传的图片路径，类里面默认路径是当前目录的upload。如果没有此目录会自动创建
    $up -> set("maxsize", 10485760);
    // 设置图片的最大字节 1M=1048576 B(字节)
    $up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
    // 设置允许上传类型 (默认的类型gif,png,jpg,jpeg)
    if($up -> upload("pic")) {
    	 //使用对象中的upload方法， 就可以上传文件，方法需要传一个上传表单的名字 pic, 如果成功返回true, 失败返回false
        echo '<pre>';
        // var_dump($up->getFileName());
        //获取上传后文件名子可以存进数据库
        echo '</pre>';
  
    } else {
        echo '<pre>';
        var_dump($up->getErrorMsg());
         //获取上传失败以后的错误提示
        echo '</pre>';
    }
    //======单文件或者多文件上传类实例结束======
    foreach ($up->getFileName() as $key => $value) {
    $img .= $value . '@';
    // 获取所有图片的路径

    //======缩略图剪裁开始======
	//使用方法：  
	$_img = new Image('../images/'.$value);//$_path为图片文件的路径  
	$_img->thumb(400, 400);  
	$_img->out();  
	//======缩略图剪裁结束======

    //======水印类实例开始======
 //    $waterprint = new WaterMask('../images/'.$value); 
	// //实例化对象 里面放图片路径
	// $waterprint->waterImg = '../images/waterprint.png'; 
	// //水印图片路径
	// $waterprint->transparent = 45; 
	// //水印透明度 
	// $waterprint->pos = 10;  
	//设置水印的位置
	/*
	1: //上左 2: //上中 3: //上右 4: //中左 
 	5: //中中 6: //中右 7: //下左 8: //下中 
 	其余的数字都是下右
	*/
	// $waterprint->output(); 
	// //输出水印图片文件覆盖到输入的图片文件 
 	//======水印类实例结束======
    }
}
$insert = Insert::create_singleton();
// 获取插入对象
$time = date('Y-m-d H:i:s',time());
// 一定要放在实例化对象后面。不然没有设置时区格式
$arrayName = array('s_title' => $title , 's_content' => $content, 's_picture' => $img , 's_name' => $user , 's_time' => $time );
// 打包数组
if(!$insert->insert('study_note.study_publish',$arrayName)){
	echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('发布失败，请稍后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            top.location.href='../frontEnd/mySchool.php';
            });  });</script>";
// top.location.href针对iframe跳转。表示最外层top跳转
}else{
	echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('发布成功~~', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../frontEnd/mySchool.php';
            });  });</script>";
// top.location.href针对iframe跳转。表示最外层top跳转
}

 ?>
</body>
</html>
