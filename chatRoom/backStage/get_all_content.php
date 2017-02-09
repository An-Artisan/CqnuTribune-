<?php 	
		//=====获取全部即时消息=====
		/* * *********************************************
		* @思路：
		1：查找缓存服务器有没有双方的消息，如果有，写进数据库
		2：查找双方的所有消息，返回给ajax
		* @功能:     获取全部即时消息
		* @作者:     不敢为天下
		* @时间：    2016-10-12
		*/
		require '../../cqnu.class/all.class/all.class.php';
		// 引用全部类
		$redis = new Redis();    
		//   实例化Redis数据库
		$redis->pconnect("localhost","6379");  
		//   长连接redis
	    $sender = $_POST['sender'];
        $getter = $_POST['getter'];
        // 接受ajax传过来的发送人和接收人
        $arr = [];
        /* 定义一个空数组，(这里如果不事先定义，
           后面返回数据的时候，如果数据库和redis
           缓存服务器没有数据的话，会提示$arr变量
           没有定义)
        */
		$get_message = $getter.'to'.$sender;
		// 设置接收信息的key 
		$send_message = $sender.'to'.$getter;
		// 设置发送信息的key
		$redis->select(1);
		// 选择1号数据库
       	$get_id = $get_message . '!@#$id';
       	// 设置发送人接收对方所有缓存信息的id编号(接收人+to+发送人+!@#$id)为key
       	$send_id = $send_message .'!@#$id';
       	// 设置接收人接收对方所有缓存信息的id编号(发送人+to+接收人+!@#$id)为key
       	$get_num = $redis->get($get_id);
       	// 获取对方所有缓存信息的id
       	$get_num?$redis->delete($get_id):null;
       	// 如果有数据就删除这个id编号
       	$send_num = $redis->get($send_id);
       	// 获取获取当前用户所有缓存信息的id
       	$send_num?$redis->delete($send_id):null;
       	// 如果有数据就删除这个id编号

       	//=====获取对方发给当前用户的所有缓存数据开始===== 
       	$number = 1;
       	// 设置一个变量从1开始取数据
		while ($get_num) {
				$record_id = $get_message . $number;
				// 拼凑key
				$get_content[] = $redis->get($record_id);
				// 获取key里面的数据存在数组中
				$redis->delete($record_id);
				// 删除这个key
				$number++;
				// 增1
				$get_num --;
				// 减1
		}
		//=====获取对方发给当前用户的所有缓存数据结束===== 

		//=====获取当前用户发给对方的所有缓存数据开始===== 
		$number = 1;
		while ($send_num) {
				$record_id = $send_message . $number;
				// 拼凑key
				$send_content[] = $redis->get($record_id);
				// 获取key里面的数据存在数组中
				$redis->delete($record_id);
				// 删除这个key
				$number++;
				// 增1
				$send_num --;
				// 减1
		}
		//=====获取当前用户发给对方的所有缓存数据结束===== 
		// 取对方的信息没有取出来，还要排序。
		$redis->delete($get_message);
		// 删除对方发给当前用户的即使消息

		/* $redis->delete($send_message);
		这里不能删除当前用户发给对方的缓存信息，
		(因为对方没有在线接收到当前用户发过去的消息，
		你就刷新了再次发送一次ajax请求，就删除了这条即使消息，
		对方不能收到。所以这里不能删除)*/
		$redis->close();
		// 关闭reids连接，以免多人使用，导致并发ajax程序的reids资源消耗过多
		$sql = "insert into  private_message.webchat_message (`content`,`sender`,`getter`,`time`) values ";
		/*
		当当前用户选择一个好友时就要把缓存服务器里面的所有数据写进mysql数据库以免丢失
		所以这里要拼接sql语句
		*/
		$sender_sql = "'" .$sender ."',";
		// 给当前用户加上两个单引号，sql语句的规定，不然会出错
		$getter_sql = "'" .$getter ."',";
		// 给接受用户加上两个单引号，sql语句的规定，不然会出错

		// =====写入数据库函数开始=====
		function write_mysql($array,$getter,$sender,$sql){
		$get_length = count($array);
		// 接收传过来的数组，获取它的长度
		for($i = 0;$i<$get_length;$i++){
			 $arr = explode("&@part",$array[$i]);
			 // 分割记录字符串成数组，因为发送消息的页面是用&@part拼接，前面是记录，后面是发送时间
			 $content_sql =  "('".addslashes($arr[0])."',";
			 // 加上前小括号，单引号，逗号
			 $time =  "'".$arr[1] ."'),";
			 // 加上单引号，后括号，逗号
			 $sql .= $content_sql . $getter .$sender .$time;	
			 // 拼接
		}
		$sql = substr($sql,0,-1);
		// 删除最后一个多余的逗号
		$select = Select::create_singleton();
		// 用静态方法的单例模式获取对象
		$select->query($sql);
		// 执行sql语句，写入数据库
		}
		// =====写入数据库函数结束=====

		isset($get_content)?write_mysql($get_content,$getter_sql,$sender_sql,$sql):null;
		// 如果缓存服务器里面有对方用户发过来的消息就写入数据库
		isset($send_content)?write_mysql($send_content,$sender_sql,$getter_sql,$sql):null;
		// 如果缓存服务器里面有当前用户发过去的消息就写入数据库
		$sql = "select `content`,`time`,`sender` from private_message.webchat_message where sender = '".$getter ."' and getter = '".$sender . "' or sender =  '".$sender."' and getter = '".$getter."' order by time asc";
		/*
		   查找数据库中sender(发送人)和getter(接收人)都是传过来的sender和getter 或者
		   sender(发送人)和getter(接收人)都是传过来的getter和sender
		   总之就是查询他们两个人的所有记录
		*/
		$select = Select::create_singleton();
		// 获得对象
		$result = $select->select($sql);
		// 获得结果集
		while ($row = mysqli_fetch_object($result)) {
					$arr[] = $row->sender;
					// 发送人保存到数组
					$arr[] = $row->content;
					// 内容保存到数组
					$arr[] = $row->time;
					// 时间保存到数组
		}
		// 把内容时间保存到数组
		$arr = json_encode($arr);
		// 解码成json格式字符串
		exit($arr);
		// 返回给ajax

 ?>