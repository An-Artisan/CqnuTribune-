<?php 
		//=====接收未读消息=====
	    /* * *********************************************
	    * @思路：
	      1.如果缓存里没有用户的话去后台取所有和当前用户是好友的用户赋值给数组
	      2.循环这个用户数组，然后把每一个用户里面的即使消息，按指定字符分割成数组存进数组，形成
	      	一个二维数组，然后删除这个即时通信的key
	      3.添加一个判断，如果返回值的arr_push[]数组为空的话，代表没有未读消息，那么就继续执行长
	      	轮询，直到有未读消息后返回给前端的ajax
	    * @功能:     接受其他用户给当前用户的未读消息
	    * @作者:     不敢为天下
	    * @时间：    2016-10-26
	    */
	    require '../../cqnu.class/all.class/all.class.php';
		// 引用全部类
        set_time_limit(0);
		//设置响应时间为无限(因为php动态脚本默认支持执行30秒，超过30秒就会报错提醒响应时间超过30秒)
        $redis = new Redis();    
		//实例化Redis数据库
		$redis->pconnect("localhost","6379");  
		//长连接redis(这里的长连接是缓存服务器redis长连接不是ajax长连接)
		$redis->select(1);
		// 选择1号数据库
		$sender = $_POST['sender'];
		// 获取当前用户
		if(!$redis->get(0)){
		// 如果缓存里面没有用户信息，就从数据库拉取
		$sql = 'select  user_name from user.user_information where user_name != "'.$sender.'"';
		// 查询所有用户，不包括当前登陆用户
		$select = Select::create_singleton();
		// 获得对象
		$result = $select->select($sql);
		// 获得结果集
		for ($i=0; $row = mysqli_fetch_object($result); $i++) { 
			 	$redis->set($i,$row->user_name);
			 	// 设置用户到缓存
		}
		}
		// 获得所有用户
		while (true) {
			for ($i = 0; $value = $redis->get($i); $i++) { 
				if( $redis->exists($value.'to'.$sender.'push') ){
					$arr_push[$value] = explode("&@part",$redis->get($value.'to'.$sender.'push'));
					// 把分离的内容和时间放进数组，形成一个二维数组 
					$redis->delete($value.'to'.$sender . 'push'); 
					// 然后删除这个即时通信的key
				}
			}
	    // 遍历所有好友列表对当前用户的未读记录
			// print_r($arr_push);
		if(!empty($arr_push)){
		$redis->close();
		// 关闭连接
		$value = json_encode($arr_push);
		// 解析成json格式字符串
		exit($value);
		/*
		 退出脚本并返回数据 注意：这里一定要用exit
		 虽然echo也行。exit是停止脚本运行，而如果是
		 echo 的话也会返回到ajax客户端，但是如果下面
		 还有语句，会继续执行，知道脚本停止。上面说过
		 结束php程序之后过一段时间才会停止脚本运行
		*/
		}
		usleep(5000);
		}

 ?>