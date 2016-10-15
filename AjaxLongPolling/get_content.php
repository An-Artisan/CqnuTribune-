<?php 
//         session_write_close();
// //        接触session锁，重要。在框架开发中，多个ajax并发程序经过session中间件，会导致程序卡死
        set_time_limit(0);
//        设置响应时间为无限
        $redis = new Redis();    
	//   实例化Redis数据库
		$redis->pconnect("localhost","6379");  
	//   长连接redis
		$redis->select(1);
		$sender = $_POST['sender'];
        $getter = $_POST['getter'];
        // $sender = 'liuqiang';
        // $getter = '李四';
        $key = $getter."to".$sender;
        while (true) {
			   if ($redis->exists($key)) {
						$value =  $redis->get($key);
						$redis->delete($key);
						// 获取到了值就把这个key删掉
						exit($value);
//   				退出脚本并返回数据

				}
				        usleep(5000);
//            每隔1/1000秒执行一次
            }
 
 ?>