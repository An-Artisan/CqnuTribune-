<?php 
require '../../../cqnu.class/all.class/all.class.php';
// 引入所有类
$s_id = $_POST['s_id'];
// 获取留言编号
$s_picture = $_POST['s_picture'];
// 获取用户发布的图片名称
if(!empty($s_picture)){
	// 如果为空表示用户发布笔记的时候没有选择图片
	$s_picture = explode('@',$s_picture);
	// 把字符串的图片名称合并成数组
	for($i = 0; $i < count($s_picture)-1; $i++){ 
	unlink('../../../mySchool/images/'. $s_picture[$i]);
	}
	// 执行删除
}
// 删除发布时的图片
$delete = Delete::create_singleton();
// 获得删除对象
if($delete->delete('study_note.study_publish','s_id','=',$s_id) && $delete->delete('study_note.study_reply','r_number','=',$s_id)){
	exit(json_encode(array('state' =>'1')));
}
// 如果删除成功就返回状态为1(代表删除成功)
exit(json_encode(array('state' =>'0')));
// 否则就返回状态为0(代表删除失败)
// boolean delete( string $str,string $str1,string $str2, string $str3 )  返回值布尔型(true,false)参数1:数据表 参数2:字段名 参数3:操作符 参数4:值
 ?>