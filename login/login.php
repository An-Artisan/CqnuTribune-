<?php 
require '../cqnu.class/all.class/all.class.php';
$user = $_POST['user'];
$password = $_POST['password'];
$sql = "select * from user.user_information where user_name = '".$user."'";
$select = Select::create_singleton();
$result = $select -> select($sql);
// var_dump($result);
if(!$result->num_rows){
	exit(json_encode(array('state' =>'0')));
}
$encrypt_password = mysqli_fetch_object($result)->user_password;
$encrypt = Encrypt::create_singleton();
// 实例化Encrypt对象(静态方法获取对象)
if($encrypt->verify($password,$encrypt_password)){
	session_start();
	$_SESSION['user'] = $user;
	exit(json_encode(array('state' =>'1')));
}
exit(json_encode(array('state' =>'0')));

 ?>