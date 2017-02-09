<?php 
if(file_put_contents('../../cqnu.class/all.class/mysql.class/sql.log','') == 0){
	exit(json_encode(array('state' =>'1')));
}
// 插入成功返回1
exit(json_encode(array('state' =>'0')));
// 插入失败返回0
 ?>