<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$modify_id = $_POST['top_category'];
$name = $_POST['top_name'];
// 获取ajax传的数据
$update = Update::create_singleton();
$arrayName = array('top_name' => $name);

if($update->update('secondhand.goods_top_type',$arrayName,'top_category','=',$modify_id)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>