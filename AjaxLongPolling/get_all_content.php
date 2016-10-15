<?php 
	require '../cqnu_class/all.class/all.class.php';
	// 引用全部类
	$redis = new Redis();    
	//   实例化Redis数据库
		$redis->pconnect("localhost","6379");  
	//   长连接redis
	    $sender = $_POST['sender'];
        $getter = $_POST['getter'];
		// $sender = 'liuqiang';
		// $getter = '新浪新闻';
		$sql = "select `content`,`time` from `webchat_message` where sender = '".$getter ."' and getter = '".$sender . "'";
		$select = Select::create_singleton();
		$result = $select->select($sql);
		while ($row = mysqli_fetch_object($result)) {
				$arr[] = $row->content.'&@part' . $row->time;
		}
		$redis->select(1);
		 $key_name = $getter.'to'.$sender;
       	 $id = $key_name . '!@#$id';
       	 $num = $redis->get($id);
       	 $num_one = 1;
		while ($num) {
				$all = $key_name . $num_one;
				$arr[] = $redis->get($all);
				$num_one++;
				$num --;
		}
		$redis->delete($key_name);
		// var_dump($arr);
		$arr = json_encode($arr);
		exit($arr);


 ?>