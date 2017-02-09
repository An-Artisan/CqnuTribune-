<?php 
require '../../../cqnu.class/all.class/all.class.php';
// 引入所有类
$item_number = $_POST['content'];
// 获取商品编号
$delete = Delete::create_singleton();
// 获得删除对象
$select = Select::create_singleton();
// 获取插入对象
$sql = "select picture from secondhand.goods where item_number = ".$item_number;
// 查询要更改id的图片
$result = $select->select($sql);
// 执行查询
$data = mysqli_fetch_object($result);
// 获取结果集
$old_picture = $data->picture;
// 获取要删除的图片名
if($delete->delete('secondhand.goods','item_number','=',"$item_number")){
	$picture_array = explode('@',$old_picture); 
	// 获取所有图片
	for ($i = 0; $i < count($picture_array)-1; $i ++) {
	   // 这里要减一的原因是，前面字符串合成数组后，分离最后一个空格。
	   if(!unlink ('../goodsImg/images/'.$picture_array[$i])){
	   exit(json_encode(array('state' =>'0')));
	   // 删除图片失败
	   }
	}
	// 删除商品图片
	if(!$delete->delete('secondhand.goods_comment','item_number','=',"$item_number")){
		exit(json_encode(array('state' =>'0')));
		// 删除评论失败
	}
	// 删除商品评论
	exit(json_encode(array('state' =>'1')));
}
// 如果删除成功就返回状态为1(代表删除成功)
exit(json_encode(array('state' =>'0')));
// 否则就返回状态为0(代表删除失败)
// boolean delete( string $str,string $str1,string $str2, string $str3 )  返回值布尔型(true,false)参数1:数据表 参数2:字段名 参数3:操作符 参数4:值


 ?>