<?php 

    //=====发送单条即时消息=====
    /* * *********************************************
    * @思路：
      1.设置每条对应的id记录(比如 张三给李四发送第一条消息 那么就设置 key为'张三to李四1'，
        发送第二条消息，那么key为 '张三to李四2' .... 以此类推，然后再接收全部消息的时候
        可以根据这个key循环来找到这些消息)
      2.设置最新的即时消息，如果已经存在了，删除这个id 再次设置它的最新消息
        (比如 张三给李四发送第一条消息的内容为'你好李四，我是张三！' 那么key为'张三to李四'
         如果发送第二条消息的内容为'李四，我是张三发的第二条消息！' 那么这时先删除之前内容
         为'你好李四，我是张三！'的内容，然后再设置 key为'张三to李四'的值为'李四，我是张三
         发的第二条消息！'，其实就是覆盖。当然看到这里会想到一个问题，如果连续发了三条消息
         但是我们的key'张三to李四'中只有一条消息是吧。怎么收到全部的消息呢。这就是第一步设
         置每条记录对应一个key，然后循环这个key 找到全部发送的消息。) 这个最新的即时消息key
         还有一个作用就是做消息通知，因为里面只装一条消息，而且返回到ajax客户端的时候就已经
         把这个key删除了。所以只要这个即使消息记录存在就代表有未读的消息，在赋值给一个新的
         key，用来做推送使用
      3.设置一个最新的list Key 用来显示前端的好友列表
    * @功能:     发送单条即时消息
    * @作者:     不敢为天下
    * @时间：    2016-10-12
    */
    require '../../cqnu.class/all.class/all.class.php';
	    // 引用全部类
		$redis = new Redis();    
	    //   实例化Redis数据库
		$redis->pconnect("localhost","6379");  
	    //   连接redis
		$redis->select(1);
		// 选择数据库
        $sender = $_POST['sender'];
        // 获取发送人的昵称
        $getter = $_POST['getter'];
        // 获取接收人的昵称
        $content = $_POST['content'];
        // 获取消息
        $content = $content . '&@part' . date("Y-m-d H:i:s", time());
        // 然后把内容和当前时间以&@part拼接起来，到时候好分离
        $key = $sender.'to'.$getter;
        // 把发送人和接收人拼接成一个字符串作为key
       	$id = $key . '!@#$id';
        // 设置key为$id的字符串(用来记录消息的多少)
        if(!$redis->exists($key.'list'))
        {   
           $redis->set($key.'list',$content);
           // 设置最新的消息，用来做列表显示
           $insert = Insert::create_singleton();
           $arrayName = array('user_sender' => $sender, 'user_getter' => $getter);
           $insert->insert('private_message.user_list',$arrayName); 
        }
        if(!$redis->exists($id)){
            // 如果不存在这个key，代表没发送过消息
        	  $redis->set($id,1);
            // 就设置key为$id的字符串为1
        	  $value = 1;
            // 设置一个value为1 用于下面的每条对应的id记录写入缓存服务器
        }
        else{
            // 否则代表发送过消息了
        	$value = $redis->get($id);
            // 先获取这个里面的id值
        	$value ++;
            // 然后自增1(方便下面用来做每条消息记录)
        	$redis->incr($id);
            // 缓存服务器里面的值也增1(incr()函数全称increase 意思是增加，这里表示自增1)
        }
        $key_id = $key . $value;
        // 设置每条消息对应的key_id
        $redis->set($key_id,$content);
        // 然后设置每条消息对应的内容
		$redis->set($key,$content);
		// 设置最新的消息,默认覆盖之前的
        $redis->set($key.'push',$content);
        // 设置最新的消息,默认覆盖之前的
        $redis->close();
        // 关闭reids连接，以免多人使用，导致并发ajax程序的reids资源消耗过
        exit('success');

 ?>