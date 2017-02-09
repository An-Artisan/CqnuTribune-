<?php 
require '../../cqnu.class/all.class/all.class.php';
// 引用所有类
$id = $_POST['id'];
$phone = $_POST['phone'];
$qq = $_POST['qq'];
$wechat = $_POST['wechat'];
$weibo = $_POST['weibo'];
$baidu_statistics = $_POST['baidu_statistics'];
$copyright = $_POST['copyright'];
// 获取ajax传的数据
$update = Update::create_singleton();
// 获取更新对象
$arrayName = array('service_hotline' => $phone , 'service_qq' => $qq , 'service_wechat' => $wechat , 'service_weibo' => $weibo , 'baidu_statistics' => $baidu_statistics , 'copy_right' => $copyright);
// 打包数组
if($update->update('manager.configuration',$arrayName,'configuration_id','=',$id)){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>