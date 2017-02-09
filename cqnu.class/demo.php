<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="all.class/pager.class/pager.css">
	<!-- 引用分页类显示信息css文件 -->
</head>
<body>
	<?php 
	require 'all.class/all.class.php';
	// 引用所有的类文件

	// =====更改数据库连接信息开始=====
	// $conn = MysqlConn::create_singleton();
	// $conn->servername = 'localhost';
	// $conn->username = 'root';
	// $conn->password = null;
	// $conn->dbName = 'secondhand';
	// =====更改数据库连接信息结束=====


	// ====插入一条记录类实例开始====	 
	   // $insert = Insert::create_singleton();
	   // $arrayName = array('username' => 'xiaoming', 'password' => '123456' , 'content' => 'HelloWorld!' );
	   // $insert->insert('demo',$arrayName); 
	//    boolean insert( string $str,array $array )  返回值布尔型(true,false) 参数1:数据表 参数2:数组
	// ====插入一条记录类实例结束====	


    // ====删除记录类实例开始====
	// $delete = Delete::create_singleton();
	// $delete->delete('demo','username','=','liuqiang');
	//    boolean delete( string $str,string $str1,string $str2, string $str3 )  返回值布尔型(true,false)参数1:数据表 参数2:字段名 参数3:操作符 参数4:值
	// // ====删除记录类实例结束====


	// //====更新记录类实例开始====
	// $update = Update::create_singleton();
	// $arrayName = array('username' => 'xiaohua','password' => '111111','content' => '111');
	// $update->update('demo',$arrayName,'id','=','25');
	// boolean update( string $str,array $array,string $str1,string str2,string str3 )  返回值布尔型(true,false) 参数1:数据表 参数2:数组,参数3:字段名,参数4:操作符,参数5:值
	// //====更改记录类实例结束====


	// //=====查询类实例开始=====
	// $select = Select::create_singleton();
	// $sql = "select * from test.demo";
	// $result = $select->select($sql);
	// // var_dump($result);
	// while($data = mysqli_fetch_object($result)) {

	// 			echo $data->content,'<br>';	

	// 	}
	// boolean/result select(string $sql)  返回值布尔型(结果集,false) 参数1:sql语句
	// //====查询类实例结束=====


	//======分类类实例开始=====
	// $show_data= 2;
	// //一页显示多少记录
	// $select = Select::create_singleton();
	//实例化查询对象
	// $sql = "select count(*) as c from  secondhand.goods a left join user.user_information b  on a.user_number=b.user_number  WHERE b.user_name = '刘强' ";
	// // 这里自己写查询记录总数的sql语句
	// $count = $select->page_count($sql);
	// //获取表记录总数
	// $page = isset($_GET['page'])?$_GET['page']:1;
	// //如果没有接收到浏览器传过来的参数，说明就是首页。
	// $sql="select title,price,bargained,click_rate,shelves,user_name,start_time,stop_time,address from  secondhand.goods a left join user.user_information b  on a.user_number=b.user_number WHERE b.user_name = '刘强' order BY start_time desc" . " limit " . ($page - 1) * $show_data . ", $show_data"; 
	// $result = $select->select($sql);
	// //查询第多少页的数据
	// while ($data = mysqli_fetch_object($result)) {
	// 	echo $data->user_name,'<br>';
	// }
	// //输入到浏览器上
	// $myPage=new pager($count,intval($page),$show_data);     
	// //实例化分页对象，参数需要总数，第几页，显示多少也
 // 	 $pageStr= $myPage->GetPagerContent();    
 // 	//进行分页
 // 	 echo $pageStr;
 	//输入分页 
	//======分类类实例结束=====


	//======邮件发送类实例开始=====
	// $send = Mail::create_singleton();
	// //实例化发送邮件对象
	// $send->setUsername('13330295142@163.com');
	// // 设置转发邮箱的服务器用户名
	// $send->setPassword('yatou199412');
	// //设置转发邮箱的服务器密码
	// $send->setFrom('13330295142@163.com');
	// //设置转发的邮件地址(必须有一个转发的邮件地址，一般是用163的邮箱)
	// $send->setFromName('www.joker1996.com');
	// // 设置发送人显示的姓名或者地址
	// $send->setSubject('测试');
	// // 设置发送的主题
	// $send->setBody('用类测试邮箱是否发送成功！');
	// // 设置发送的主体内容
	// $send->setAddAdress('1090035743@qq.com','刘强');
	// // 增加一个收件人地址(邮件目的地址).以及发送人的名字
	// if($send->sendEmail()){
	// 	echo 'ok';
	// }else{
	// 	echo '发送邮件失败，请稍后再试~';
	// }
	// // 发送邮件，发送失败会写入日志文件
	//======邮件发送类实例结束=====


	//======验证码类实例开始======
	// session_start();
	//开启session，一定要在实例化Code对象前开启
	// $code = new Code();
	//实例化验证码GD库类
	// $code->make();
	//显示验证码
	// $_SESSION['code'] = $code->get();
	// 把验证码存进session
	// echo $_SESSION['code'];
	// //输出。

	/* 注意，$code->make()和$code->get() 不能放进一个页面，也就是说一个页面只能显示一个
	要么显示验证码，要么显示验证码的图片
	*/
	//======验证码类实例结束======


	//======获取客户端真实IP类实例======
	//  $ip = new GetIp();
	// //实例化GetIp对象
 	// 	echo $ip->get_ip();
 	//  //得到真实的客户端IP
   	/*
	在虚拟机测试显示 '::1' 说明你的电脑开启了ipv6支持,这是ipv6下的本地回环地址的表示。
	因为你访问的时候用的是localhost访问的，是正常情况。
	使用ip地址访问或者关闭ipv6支持都可以不显示这个。传到服务器就能正常显示客户端IP
   	*/
    //======获取客户端真实IP类实例结束======


    //======获取客户端的地理位置开始=====
	// $position = new GetPosition();
	// //实例化对象
	// echo $position->get_position();
	// //得到位置
	//======获取客户端的地理位置结束


    //======密码加密类实例开始======
	// $encrypt = Encrypt::create_singleton();
 //    // 实例化Encrypt对象(静态方法获取对象)
	// $encrypt_password =  $encrypt -> encrypt('administratorHelloWorld');
	// //给密码加密
	// echo $encrypt_password;
	// //输出加密后的字符串
	// echo '<br>';
	// //换行
	// var_dump($encrypt->verify('yatou19941209',$encrypt_password));
	// 验证输入的密码和加密后的密码是否一致 返回值1/0。 
	//======密码加密类实例结束======

	
 	//======单文件或者多文件上传类实例开始======
    // $up = new fileupload();
    // //设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)

    // $up -> set("path", "./images/");
    // // 这里设置上传的图片路径，类里面默认路径是当前目录的upload。如果没有此目录会自动创建
    // $up -> set("maxsize", 10485760);
    // // 设置图片的最大字节 1M=1048576 B(字节)
    // $up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
    // // 设置允许上传类型 (默认的类型gif,png,jpg,jpeg)
    // if($up -> upload("pic")) {
    // 	 //使用对象中的upload方法， 就可以上传文件，方法需要传一个上传表单的名字 pic, 如果成功返回true, 失败返回false
    //     echo '<pre>';
    //     var_dump($up->getFileName());
    //     //获取上传后文件名子可以存进数据库
    //     echo '</pre>';
  
    // } else {
    //     echo '<pre>';
    //     var_dump($up->getErrorMsg());
    //      //获取上传失败以后的错误提示
    //     echo '</pre>';
    // }
    //======单文件或者多文件上传类实例结束======

    //======缩略图剪裁开始======
	//使用方法：  
	// $_path = './all.class/waterprint.class/waterprint.png';  
	// $_img = new Image($_path);//$_path为图片文件的路径  
	// $_img->thumb(100, 100);  
	// $_img->out();  
	//======缩略图剪裁结束======
	
    //======水印类实例开始======
    // foreach ($up->getFileName() as $key => $value) {
    // $waterprint = new WaterMask('images/'.$value); 
	//实例化对象 里面放图片路径
	// $waterprint->waterImg = 'waterprint.png'; 
	//水印图片路径
	// $waterprint->transparent = 45; 
	//水印透明度 
	// $waterprint->pos = 10;  
	//设置水印的位置
	/*
	1: //上左 2: //上中 3: //上右 4: //中左 
 	5: //中中 6: //中右 7: //下左 8: //下中 
 	其余的数字都是下右
	*/
	// $waterprint->output(); 
	// //输出水印图片文件覆盖到输入的图片文件 
 	//======水印类实例结束======
    // }
 	//======敏感词汇过滤类开始======

	// $filter = new SensitiveWordFilter(__DIR__ . '/all.class/sendsitivewordfilter/words.txt');
 	// //初始化对象
	/*
	初始化传入词库文件路径，词库文件每个词一个换行符。
	如：
	敏感1
	敏感2
	第一个参数传入要过滤的字符串，第二个是匹配的字间距，
	比如'枪支'是一个敏感词，想过滤'枪||||支'的时候，
	就需要指定一个两个字的间距，可以根据情况设定，
	超过指定间距就不会过滤。所有匹配的敏感词会被替换为'*'。
	*/
	// echo $filter->filter('大鸡巴',0);
	// //敏感词开始过滤
	//======敏感词汇过滤类结束======


	 ?>

</body>
</html>