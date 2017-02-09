<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
if (empty($_POST['modify_navigation_id']) || empty($_POST['modify_navigation_name'])|| empty($_POST['modify_navigation_url'])) {
	exit(json_encode(array('state' =>'0')));
	// 插入失败返回0
}
// 判断是否有空的内容
$modify_navigation_id = $_POST['modify_navigation_id'];
$modify_navigation_name = $_POST['modify_navigation_name'];
$modify_navigation_url = $_POST['modify_navigation_url'];
// 获取ajax传的数据
$update = Update::create_singleton();
$arrayName = array('navigation_name' => $modify_navigation_name , 'navigation_url' => $modify_navigation_url);
// 打包数组
if($update->update('manager.navigation',$arrayName,'navigation_id','=',$modify_navigation_id)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>