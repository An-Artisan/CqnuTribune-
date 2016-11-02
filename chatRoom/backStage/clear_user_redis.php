<?php 
		//=====接收未读消息=====
	    /* * *********************************************
	    * 
	    * @功能:     接受其他用户给当前用户的未读消息
	    * @作者:     不敢为天下
	    * @时间：    2016-10-29
	    */
        $redis = new Redis();    
		//实例化Redis数据库
		$redis->pconnect("localhost","6379");  
		//长连接redis(这里的长连接是缓存服务器redis长连接不是ajax长连接)
		$redis->select(1);
		// 选择1号数据库
		for ($i=0; $redis->get($i) ; $i++) { 
				$redis->delete($i);
		}
		// 清除用户缓存
		$redis->close();
		// 关闭redis链接。


 ?>