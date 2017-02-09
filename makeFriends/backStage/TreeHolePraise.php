<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
if (empty($_POST['praiseName']) || empty($_POST['treeHoleId'])) {
	exit(json_encode(array('state' =>'0')));
	// 插入失败返回0
}
$praiseName = $_POST['praiseName'].'&';
$treeHoleId = $_POST['treeHoleId'];
// 获取ajax传的数据
$select = Select::create_singleton();
// 获得更新对象
if($select->query("update makefriend.treehole set h_praise = concat(h_praise,'".$praiseName."') where h_id = '" . $treeHoleId ."'")){
	// 获取赞
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>