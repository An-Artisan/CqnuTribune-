<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
if (empty($_POST['praiseName']) || empty($_POST['p_id'])) {
	exit(json_encode(array('state' =>'0')));
	// 插入失败返回0
}
$praiseName = $_POST['praiseName'].'&';
$p_id = $_POST['p_id'];
// 获取ajax传的数据
$select = Select::create_singleton();
// 获得更新对象
if($select->query("update makefriend.tree_publish set  p_praise = concat(p_praise,'".$praiseName."') where p_id = '" . $p_id ."'")){
	// 获取赞
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>