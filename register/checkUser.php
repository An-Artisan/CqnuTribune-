<?php 
require '../cqnu.class/all.class/all.class.php';
// 引用所有类
$user = $_POST['user'];
$select = Select::create_singleton();
//实例化查询对象
$sql = "select count(*) as c  from user.user_information where user_name = '" . $user . "'";
// 查询用户要注册的用户名是否存在
if($select->page_count($sql)){
	exit(json_encode(array('state' =>'0')));
}
// 如果查询到有用户已经注册，就返回0
exit(json_encode(array('state' =>'1')));
 ?>