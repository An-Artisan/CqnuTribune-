<?php 
require '../../../cqnu.class/all.class/all.class.php';
// 引入所有类
$comment_number = $_POST['comment_number'];
// 获取留言编号
$delete = Delete::create_singleton();
// 获得删除对象
if($delete->delete('secondhand.goods_comment','comment_number','=',$comment_number)){
	exit(json_encode(array('state' =>'1')));
}
// 如果删除成功就返回状态为1(代表删除成功)
exit(json_encode(array('state' =>'0')));
// 否则就返回状态为0(代表删除失败)
// boolean delete( string $str,string $str1,string $str2, string $str3 )  返回值布尔型(true,false)参数1:数据表 参数2:字段名 参数3:操作符 参数4:值

 ?>