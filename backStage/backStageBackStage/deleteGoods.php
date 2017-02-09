<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$top_category = $_POST['top_category'];
// 获取ajax传的数据
$delete = Delete::create_singleton();
// 获取插入对象
if($delete->delete('secondhand.goods_top_type','top_category','=',$top_category)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>