<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
if ( empty($_POST['a_content'])) {
	exit(json_encode(array('state' =>'0')));
	// 插入失败返回0
}
$a_content = $_POST['a_content'];
// 获取ajax传的数据
$insert = Insert::create_singleton();
// 获取插入对象
$arrayName = array( 'a_content' => $a_content );
// 打包数组
if($insert->insert('manager.announcement',$arrayName)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>