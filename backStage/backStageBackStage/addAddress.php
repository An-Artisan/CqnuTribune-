<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
if (empty($_POST['address_sort']) || empty($_POST['address_name'])) {
	exit(json_encode(array('state' =>'0')));
	// 插入失败返回0
}
$sort = $_POST['address_sort'];
$name = $_POST['address_name'];
// 获取ajax传的数据
$insert = Insert::create_singleton();
// 获取插入对象
$arrayName = array('address_sort' => $sort, 'address_name' => $name );
// 打包数组
if($insert->insert('secondhand.goods_address',$arrayName)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>