<?php 
require '../../../cqnu.class/all.class/all.class.php';
// 引用所有类
$item_number = $_POST['content'];
//====更新记录类实例开始====
$stop_time = date('Y-m-d H:i:s',time());
// 获取当前时间
$update = Update::create_singleton();
// 获得更新对象
$arrayName = array('shelves' => "已下架",'stop_time' => "$stop_time");
// 更改那些字段，那些值
if($update->update('secondhand.goods',$arrayName,'item_number','=',"$item_number")){
	exit(json_encode(array('state' =>'1')));
}
// 如果更新成功就返回state状态为1(代表更新成功)
	exit(json_encode(array('state' =>'0')));
// 否则就返回state状态为0(代表更新失败)
// boolean update( string $str,array $array,string $str1,string str2,string str3 )  返回值布尔型(true,false) 参数1:数据表 参数2:数组,参数3:字段名,参数4:操作符,参数5:值
//====更改记录类实例结束====

 ?>