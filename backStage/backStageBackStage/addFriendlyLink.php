<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
if (empty($_POST['friendly_link_name']) || empty($_POST['friendly_link_url']) || empty($_POST['friendly_link_sort'])) {
	exit(json_encode(array('state' =>'0')));
	// 插入失败返回0
}
$sort = $_POST['friendly_link_sort'];
$name = $_POST['friendly_link_name'];
$url = $_POST['friendly_link_url'];
// 获取ajax传的数据
$insert = Insert::create_singleton();
// 获取插入对象
$arrayName = array('friendly_link_sort' => $sort, 'friendly_link_name' => $name ,'friendly_link_url' => $url);
// 打包数组
if($insert->insert('manager.friendly_link',$arrayName)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>