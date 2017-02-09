<?php 
require '../../../cqnu.class/all.class/all.class.php';
// 引入所有类
session_start();
$user = $_SESSION['user'];
// 获取当前用户
$password = $_POST['password_o'];
$sql = "select * from user.user_information where user_name = '".$user."'";
$select = Select::create_singleton();
// 获取查询对象
$result = $select -> select($sql);
// 获取结果
$encrypt_password = mysqli_fetch_object($result)->user_password;
$encrypt = Encrypt::create_singleton();
// 实例化Encrypt对象(静态方法获取对象)
if($encrypt->verify($password,$encrypt_password)){
	exit(json_encode(array('state' =>'1')));
}
// 判断原密码和输入的密码是否相等
exit(json_encode(array('state' =>'0')));
 ?>