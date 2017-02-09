<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$modify_id = $_POST['address_id'];
$name = $_POST['address_name'];
// 获取ajax传的数据
$update = Update::create_singleton();
// 获取更新sql对昂
$arrayName = array('address_name' => $name);
// 更新地址名
if($update->update('secondhand.goods_address',$arrayName,'address_id','=',$modify_id)){
	exit(json_encode(array('state' =>'1')));
	// 如果更新成功就返回json数组的state为1
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>