<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
if (empty($_POST['seo_name']) || empty($_POST['seo_title']) || empty($_POST['seo_keywords'])|| empty($_POST['seo_description'])|| empty($_POST['seo_author'])) {
	exit(json_encode(array('state' =>'0')));
	// 插入失败返回0
}
$seo_name = $_POST['seo_name'];
$seo_title = $_POST['seo_title'];
$seo_keywords = $_POST['seo_keywords'];
$seo_description = $_POST['seo_description'];
$seo_author = $_POST['seo_author'];
// 获取ajax传的数据
$insert = Insert::create_singleton();
// 获取插入对象
$arrayName = array('seo_name' => $seo_name, 'seo_title' => $seo_title , 'seo_keywords' => $seo_keywords , 'seo_description' => $seo_description,'seo_author' => $seo_author );
// 打包数组
if($insert->insert('manager.seo',$arrayName)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>