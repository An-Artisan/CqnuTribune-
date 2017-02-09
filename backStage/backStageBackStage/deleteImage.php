<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$banner_id = $_POST['banner_id'];
// 获取ajax传的数据
$select = Select::create_singleton();
// 获取插入对象
$sql = "select banner_picture from secondhand.index_banner where banner_id = ".$banner_id;
// 查询要更改id的图片
$result = $select->select($sql);
// 执行查询
$data = mysqli_fetch_object($result);
// 获取结果集
$old_picture = $data->banner_picture;
// 获取要删除的图片名
$delete = Delete::create_singleton();
// 获取插入对象
if($delete->delete('secondhand.index_banner','banner_id','=',$banner_id)){
	if(!unlink ('../../secondHands/img/'.$old_picture)){
	   exit(json_encode(array('state' =>'0')));
	   // 删除图片失败
	}
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0

 ?>