<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$a_id = $_POST['a_id'];
$a_content = $_POST['a_content'];
// 获取ajax传的数据
$update = Update::create_singleton();
$arrayName = array('a_content' => $a_content);

if($update->update('manager.announcement',$arrayName,'a_id','=',$a_id)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>