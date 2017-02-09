<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$seo_id = $_POST['seo_id'];
$seo_title = $_POST['seo_title'];
$seo_keywords = $_POST['seo_keywords'];
$seo_description = $_POST['seo_description'];
$seo_author = $_POST['seo_author'];
// 获取ajax传的数据
$update = Update::create_singleton();
// 获取更新sql对昂
$arrayName = array('seo_title' => $seo_title,'seo_keywords' => $seo_keywords,'seo_description' => $seo_description,'seo_author' => $seo_author);
// 更新地址名
if($update->update('manager.seo',$arrayName,'seo_id','=',$seo_id)){
	exit(json_encode(array('state' =>'1')));
	// 如果更新成功就返回json数组的state为1
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>