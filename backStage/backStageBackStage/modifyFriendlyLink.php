<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$friendly_link_id = $_POST['friendly_link_id'];
$friendly_link_name = $_POST['friendly_link_name'];
$friendly_link_url = $_POST['friendly_link_url'];
// 获取ajax传的数据
$update = Update::create_singleton();
$arrayName = array('friendly_link_name' => $friendly_link_name,'friendly_link_url' => $friendly_link_url);

if($update->update('manager.friendly_link',$arrayName,'friendly_link_id','=',$friendly_link_id)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>