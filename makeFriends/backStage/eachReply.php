<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$content = $_POST['content'];
$senderName = $_POST['senderName'];
$treeHoleId = $_POST['treeHoleId'];
$getterName = $_POST['getterName'];
// 获取ajax传的数据

$insert = Insert::create_singleton();
// 获取插入对象
$time = date('Y-m-d H:i:s',time());
// 一定要放在实例化对象后面。不然没有设置时区格式
$arrayName = array('p_number' => $treeHoleId, 'p_content' => $content,'p_sender' => $senderName , 'p_getter' => $getterName ,'p_time' => $time , 'p_content_is_read' => 0);
// 打包数组
if($insert->insert('makefriend.tree_publish',$arrayName)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>