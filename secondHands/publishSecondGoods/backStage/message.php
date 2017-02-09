<?php 
require '../../../cqnu.class/all.class/all.class.php';
session_start();
$content = $_POST['content'];
$user =  $_SESSION['user'];
$item_number = $_POST['item_number'];
$time = date("Y-m-d H:i:s",time());
$insert = Insert::create_singleton();
$arrayName = array('item_number' => "$item_number", 'comment_time' => "$time" , 'comment_content' => "$content",'comment_name'=>"$user" , 'comment_isread' => 0);
if($insert->insert('secondhand.goods_comment',$arrayName)){
	exit(json_encode(array('state' =>'1')));
}
// 如果删除成功就返回状态为1(代表删除成功)
exit(json_encode(array('state' =>'0')));
// 否则就返回状态为0(代表删除失败)
// boolean delete( string $str,string $str1,string $str2, string $str3 )  返回值布尔型(true,false)参数1:数据表 参数2:字段名 参数3:操作符 参数4:值

 ?>