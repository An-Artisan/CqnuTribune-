<?php 
require '../../../cqnu.class/all.class/all.class.php';
// 引入所有类
$h_id = $_POST['h_id'];
// 获取留言编号
$select = Select::create_singleton();
$sql = "select h_content from makefriend.treehole where h_id = " . $h_id;
// 获取内容
$result = $select->select($sql);
// 执行查询
$data = mysqli_fetch_object($result);
// 获取内容结果集
$str = $data->h_content;
// 把内容赋值给str变量
function get_between($input, $start, $end) {
  $substr = substr($input, strlen($start)+strpos($input, $start),
 (strlen($input) - strpos($input, $end))*(-1)); 
  return $substr;
}
// get_between 取str中间内容
$start = "img/";
// 开始是img/
$end = '" alt';
// 结束是 " alt 
$i = 0;
// 设置数组标记
$arr = [];
// 设置数组
while (1) {
if(get_between($str, $start, $end)){
	$arr[$i] = get_between($str, $start, $end);
	// 取图片名存在数组中
}else{
	break;
	// 如果没找到就跳出循环
}
$str = substr($str,strpos($str,$arr[$i])+30);
// 把新的字符串赋值给$str
$i++;
// 数组下标+1
}
foreach ($arr as  $value) {
	unlink('../../../makeFriends/img/' . $value);
}
// 删除图片
$delete = Delete::create_singleton();
// 获得删除对象
if($delete->delete('makefriend.treehole','h_id','=',$h_id) && $delete->delete('makefriend.tree_publish','p_number','=',$h_id) ){
	exit(json_encode(array('state' =>'1')));
}
// 如果删除成功就返回状态为1(代表删除成功)
exit(json_encode(array('state' =>'0')));
// 否则就返回状态为0(代表删除失败)
// boolean delete( string $str,string $str1,string $str2, string $str3 )  返回值布尔型(true,false)参数1:数据表 参数2:字段名 参数3:操作符 参数4:值

 ?>