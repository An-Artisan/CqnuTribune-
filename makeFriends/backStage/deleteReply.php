<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$p_id = $_POST['p_id'];
// 获取ajax传的数据

$delete = Delete::create_singleton();
// 获取插入对象
if($delete->delete('makefriend.tree_publish','p_id','=',$p_id)){
	exit(json_encode(array('state' =>'1')));
}
// 删除成功返回1
exit(json_encode(array('state' =>'0')));
// 删除失败返回0
 ?>