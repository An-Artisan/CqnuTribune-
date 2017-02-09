<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
if (empty($_POST['navigation_name']) || empty($_POST['navigation_alias']) || empty($_POST['navigation_url'])|| empty($_POST['navigation_sort'])) {
	exit(json_encode(array('state' =>'0')));
	// 插入失败返回0
}
$navigation_name = $_POST['navigation_name'];
$navigation_alias = $_POST['navigation_alias'];
$navigation_url = $_POST['navigation_url'];
$navigation_sort = $_POST['navigation_sort'];
// 获取ajax传的数据
$insert = Insert::create_singleton();
// 获取插入对象
$arrayName = array('navigation_name' => $navigation_name, 'navigation_alias' => $navigation_alias , 'navigation_url' => $navigation_url , 'navigation_sort' => $navigation_sort );
// 打包数组
if($insert->insert('manager.navigation',$arrayName)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>