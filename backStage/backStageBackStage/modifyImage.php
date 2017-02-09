<!DOCTYPE html>
<html>
<head>
    <!-- layer框架 -->
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>

</head>
<body>
</body>
</html>
<?php 
	require '../../cqnu.class/all.class/all.class.php';
	// 引用所有类
	$banner_id = $_POST['banner_id'];
	// 获取form表单数据
	$select = Select::create_singleton();
	// 获取查询对象
	$sql = "select banner_picture from secondhand.index_banner where banner_id = ".$banner_id;
	// 查询要更改id的图片
	$result = $select->select($sql);
	// 执行查询
	$data = mysqli_fetch_object($result);
	// 获取结果集
	$old_picture = $data->banner_picture;
	// 获取原来的图片
	if(!unlink ('../../secondHands/img/'.$old_picture)){
		    echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('更换图片失败~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=image.php';
            });  });</script>";
            // top.location.href针对iframe跳转。表示最外层top跳转
            exit();
		}
	// 删除旧图片失败
 	$up = new fileupload();
    //设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
    $up -> set("path", "../../secondHands/img/");
    // 这里设置上传的图片路径，类里面默认路径是当前目录的upload。如果没有此目录会自动创建
    $up -> set("maxsize", 10485760);
    // 设置图片的最大字节 1M=1048576 B(字节)
    $up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
    // 设置允许上传类型 (默认的类型gif,png,jpg,jpeg)
    if($up -> upload("pic")) {
    	//使用对象中的upload方法， 就可以上传文件，方法需要传一个上传表单的名字 pic, 如果成功返回true, 失败返回false
		$update = Update::create_singleton();
		// 获取更新对象
		$arrayName = array('banner_picture' => $up->getFileName()[0]);
		// 打包数组
		if($update->update('secondhand.index_banner',$arrayName,'banner_id','=',$banner_id)){
		echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('更改图片成功~~', {
            btn: ['确定'], //按钮
            icon: 1
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=image.php';
            });  });</script>";
            // top.location.href针对iframe跳转。表示最外层top跳转
		}
		// 插入数据库成功 
		else {
    	echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('插入数据库失败，请稍后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=image.php';
            });  });</script>";
            // top.location.href针对iframe跳转。表示最外层top跳转
		}
		// 插入数据库失败
    }else{
    	echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('".$up->getErrorMsg()."', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            top.location.href='../backStageFrontEnd/index.php?iframe=image.php';
            });  });</script>";
            // top.location.href针对iframe跳转。表示最外层top跳转
    } 
    // 上传图片失败
      

 ?>