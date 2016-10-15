<?php 
	require '../cqnu_class/all.class/all.class.php';
	// 引用全部类
		$redis = new Redis();    
	//   实例化Redis数据库
		$redis->pconnect("localhost","6379");  
	//   连接redis
		$redis->select(1);
		// 选择数据库
        $sender = $_POST['sender'];
        $getter = $_POST['getter'];
        $content = $_POST['content'];
        // $sender = 'liuqiang';
        // $getter = '李四';
        // $content = '哈哈';
//        更新一条消息
        $content = $content . '&@part' . date("Y-m-d H:i:s", time());
        $key_name = $sender.'to'.$getter;
       	 $id = $key_name . '!@#$id';
       // exit($key_name);
        if(!$redis->exists($id)){
        	  $redis->set($id,1);
        	  $value = 1;
        }
        else if($redis->get($id) == 3){
				 $sql = "insert into  `webchat_message` (`content`,`sender`,`getter`,`time`) values ";
				 $sender = "'" .$sender ."',";
				 $getter = "'" .$getter ."',";
				for($i = 1;$i<4;$i++){
					 $str = $redis->get($key_name.$i);
					 $arr = explode("&@part",$str);

					 $content_sql =  "('".$arr[0]."',";
					 $time =  "'".$arr[1] ."'),";
					 $sql .= $content_sql . $sender .$getter .$time;	
				}
				$sql = substr($sql,0,-1);
				$select = Select::create_singleton();
				$select->query($sql);
				$redis->flushDb();
				$value = 1;
				// exit($sql); 
        }else{
        	$value = $redis->get($id);
        	$value ++;
        	$redis->delete($id);
        	$redis->set($id,$value);
        }
        $key = $key_name . $value;
        $redis->set($key,$content);
        
        if($redis->exists($key_name)){
        	$redis->delete($key_name);
        	// 如果存在就删除，这里主要是做消息通知
        }
		$redis->set($key_name,$content);
		// 设置最新的消息
    	exit('success');

 ?>