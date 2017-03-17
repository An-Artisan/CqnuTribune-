<?php

	$address = $_POST['address'];
	// 获取数据库地址
	$port = $_POST['port'];
	// 获取端口号
	$username = $_POST['username'];
	// 获取数据库用户名
	$password = $_POST['password'];
	// 获取数据库密码
	$conn = mysqli_connect($address,$username,$password,'',$port);
	// 建立链接
	mysqli_query($conn, "set names utf8");
		//查询的字符格式设置为utf-8
	if (!$conn)
	{
	die('Could not connect: ' . mysqli_error());
	}
   	if(
   		mysqli_query($conn,"CREATE DATABASE makefriend") 
   		&& mysqli_query($conn,"CREATE DATABASE manager") 
   		&& mysqli_query($conn,"CREATE DATABASE private_message")
   		&& mysqli_query($conn,"CREATE DATABASE secondhand")
   		&& mysqli_query($conn,"CREATE DATABASE study_note")
   		&& mysqli_query($conn,"CREATE DATABASE user"))
	{		
		  mysqli_select_db($conn,'makefriend');
		  // 切换数据库 在此数据库下建立表	
		  mysqli_query($conn,"CREATE TABLE `tree_publish` (
		  `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '树洞回复id',
		  `p_number` int(11) NOT NULL COMMENT '根据树洞的id对应回复树洞的编号',
		  `p_content` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '回复树洞内容',
		  `p_sender` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '回复用户',
		  `p_getter` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '树洞的发布用户',
		  `p_praise` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '回复点赞人数',
		  `p_time` datetime NOT NULL COMMENT '回复时间',
		  `p_content_is_read` tinyint(4) NOT NULL COMMENT '用户是否已经读取这条未读消息',
		  PRIMARY KEY (`p_id`,`p_number`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1");
		  // 建立树洞回复表
		  mysqli_query($conn,"CREATE TABLE `treehole` (
		  `h_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '发布树洞id',
		  `h_content` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '发布树洞的内容',
		  `h_praise` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '树洞的点赞人数',
		  `h_name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '发布树洞用户',
		  `h_time` datetime NOT NULL COMMENT '发布树洞时间',
		  PRIMARY KEY (`h_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1");
		  // 建立树洞发布表
	      mysqli_select_db($conn,'manager');
	      // 切换数据库 在此数据库下建立表
	      mysqli_query($conn,"CREATE TABLE `announcement` (
		  `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告id',
		  `a_content` varchar(255) NOT NULL COMMENT '公告内容',
		  `a_time` datetime NOT NULL COMMENT '发布公告时间',
		  PRIMARY KEY (`a_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8");
		  // 建立发布公告表
		  mysqli_query($conn,"CREATE TABLE `configuration` (
		  `configuration_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '配置id',
		  `service_hotline` char(11) NOT NULL COMMENT '服务电话',
		  `service_qq` char(11) NOT NULL COMMENT '服务qq',
		  `service_wechat` char(20) NOT NULL COMMENT '服务微信',
		  `service_weibo` char(20) NOT NULL COMMENT '服务微博',
		  `baidu_statistics` text NOT NULL COMMENT '百度统计代码',
		  `copy_right` text NOT NULL COMMENT '版权信息',
		  PRIMARY KEY (`configuration_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
		  // 建立网站配置表
		  mysqli_query($conn,"CREATE TABLE `friendly_link` (
		  `friendly_link_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '友情链接id',
		  `friendly_link_sort` int(11) NOT NULL COMMENT '友情链接排序',
		  `friendly_link_name` varchar(255) NOT NULL COMMENT '友情链接名称',
		  `friendly_link_url` varchar(255) NOT NULL COMMENT '友情链接url',
		  PRIMARY KEY (`friendly_link_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8");
		  // 建立友情链接表
		  mysqli_query($conn,"CREATE TABLE `navigation` (
		  `navigation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '导航id',
		  `navigation_sort` int(255) NOT NULL COMMENT '导航排序',
		  `navigation_name` varchar(255) NOT NULL COMMENT '导航名称',
		  `navigation_alias` varchar(255) NOT NULL COMMENT '导航别名',
		  `navigation_url` varchar(255) NOT NULL COMMENT '导航url',
		  PRIMARY KEY (`navigation_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");	
		  // 建立导航表
		  mysqli_query($conn,"CREATE TABLE `seo` (
		  `seo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'seo id',
		  `seo_name` varchar(255) NOT NULL COMMENT 'seo的名称',
		  `seo_title` varchar(255) NOT NULL COMMENT 'seo的标题',
		  `seo_keywords` varchar(255) NOT NULL COMMENT 'seo的关键字',
		  `seo_description` varchar(255) NOT NULL COMMENT 'seo的描述',
		  `seo_author` varchar(255) NOT NULL COMMENT 'seo的作者',
		  PRIMARY KEY (`seo_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8");
		  // 建立网站seo优化表
		  mysqli_select_db($conn,'private_message');
	      // 切换数据库 在此数据库下建立表
	      mysqli_query($conn,"CREATE TABLE `user_list` (
		  `list_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '好友列表id',
		  `user_getter` varchar(255) NOT NULL COMMENT '消息发送人',
		  `user_sender` varchar(255) NOT NULL COMMENT '消息接收人',
		  PRIMARY KEY (`list_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8");
		  // 建立好友列表表
		  mysqli_query($conn,"CREATE TABLE `webchat_message` (
		  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息id',
		  `content` text NOT NULL COMMENT '消息内容',
		  `sender` varchar(20) NOT NULL COMMENT '发送消息用户',
		  `getter` varchar(20) NOT NULL COMMENT '接收消息用户',
		  `time` datetime NOT NULL COMMENT '发送消息时间',
		  PRIMARY KEY (`m_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8");
		  // 建立私信聊天表
		  mysqli_select_db($conn,'secondhand');
	      // 切换数据库 在此数据库下建立表
	      mysqli_query($conn,"CREATE TABLE `goods` (
		  `item_number` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品编号',
		  `user_number` int(11) NOT NULL COMMENT '用户编号',
		  `title` varchar(90) NOT NULL COMMENT '标题',
		  `address` tinyint(4) NOT NULL DEFAULT '1' COMMENT '地址',
		  `description` varchar(150) NOT NULL COMMENT '描述',
		  `shelves` char(10) NOT NULL DEFAULT '未下架' COMMENT '是否下架',
		  `price` float(10,2) NOT NULL COMMENT '价格',
		  `prime_cost` float(10,2) NOT NULL COMMENT '原价',
		  `bargained` char(10) NOT NULL DEFAULT '可小刀' COMMENT '可否小刀',
		  `picture` varchar(255) NOT NULL COMMENT '商品图片',
		  `start_time` datetime NOT NULL COMMENT '发起时间',
		  `stop_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '结束时间',
		  `click_rate` int(10) NOT NULL DEFAULT '0' COMMENT '点击率',
		  `top_category` tinyint(4) NOT NULL COMMENT '一级分类',
		  PRIMARY KEY (`item_number`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8");
		  // 建立商品表
	      mysqli_query($conn,"CREATE TABLE `goods_address` (
		  `address_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地址id',
		  `address_sort` int(11) NOT NULL COMMENT '地址排序',
		  `address_name` varchar(100) NOT NULL COMMENT '地址名称',
		  PRIMARY KEY (`address_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8");
		  // 建立地址表
	      mysqli_query($conn,"CREATE TABLE `goods_comment` (
		  `item_number` int(11) NOT NULL COMMENT '商品编号',
		  `comment_number` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言编号',
		  `comment_time` datetime NOT NULL COMMENT '留言时间',
		  `comment_content` varchar(255) NOT NULL COMMENT '留言内容',
		  `comment_name` varchar(50) NOT NULL COMMENT '留言人',
		  `comment_isread` tinyint(4) NOT NULL COMMENT '是否已读',
		  PRIMARY KEY (`comment_number`,`item_number`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8");
		  // 建立商品评论表
	      mysqli_query($conn,"CREATE TABLE `goods_top_type` (
		  `top_category` int(10) NOT NULL AUTO_INCREMENT COMMENT '一级分类编号',
		  `top_sort` int(11) NOT NULL COMMENT '一级分类排序',
		  `top_name` varchar(50) NOT NULL COMMENT '一级分类名称',
		  PRIMARY KEY (`top_category`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8");
		  // 建立商品分类表
	      mysqli_query($conn,"CREATE TABLE `index_banner` (
		  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
		  `banner_sort` int(11) NOT NULL COMMENT '图片排序',
		  `banner_picture` varchar(255) NOT NULL COMMENT '图片地址',
		  PRIMARY KEY (`banner_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8");
		  // 建立二手市场banner图片表
		  mysqli_select_db($conn,'study_note');
	      // 切换数据库 在此数据库下建立表
	      mysqli_query($conn,"CREATE TABLE `study_publish` (
		  `s_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '发布笔记id',
		  `s_title` varchar(255) NOT NULL COMMENT '发布笔记标题',
		  `s_content` varchar(255) NOT NULL COMMENT '发布笔记内容',
		  `s_picture` varchar(255) DEFAULT NULL COMMENT '发布笔记的图片地址',
		  `s_name` varchar(255) NOT NULL COMMENT '发布人',
		  `s_time` datetime NOT NULL COMMENT '发布笔记的时间',
		  PRIMARY KEY (`s_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8");
		  // 建立发布笔记表
	      mysqli_query($conn,"CREATE TABLE `study_reply` (
		  `r_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复id',
		  `r_number` int(11) NOT NULL COMMENT '根据发布笔记的id所联系的编号',
		  `r_sender` varchar(255) NOT NULL COMMENT '回复人',
		  `r_getter` varchar(255) NOT NULL COMMENT '被回复人',
		  `r_content` varchar(255) NOT NULL COMMENT '回复内容',
		  `r_time` datetime NOT NULL COMMENT '回复时间',
		  `r_content_is_read` varchar(255) NOT NULL COMMENT '是否已读',
		  PRIMARY KEY (`r_id`,`r_number`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");
		  // 建立回复笔记表
		  mysqli_select_db($conn,'user');
	      // 切换数据库 在此数据库下建立表
	      mysqli_query($conn,"CREATE TABLE `administrator` (
		  `administrator_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
		  `administrator_user` varchar(20) NOT NULL COMMENT '管理员用户名',
		  `administrator_password` varchar(60) NOT NULL COMMENT '管理员密码',
		  PRIMARY KEY (`administrator_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
		  // 建立管理员用户表
	      mysqli_query($conn,"CREATE TABLE `user_information` (
		  `user_number` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户编号',
		  `user_name` varchar(50) NOT NULL COMMENT '用户名',
		  `user_password` varchar(60) NOT NULL COMMENT '用户密码',
		  `user_gender` varchar(10) NOT NULL COMMENT '性别',
		  `user_photo` varchar(25) NOT NULL DEFAULT 'default.jpeg' COMMENT '用户照片',
		  `user_email` varchar(50) NOT NULL COMMENT '用户邮箱',
		  `user_phone` varchar(12) NOT NULL COMMENT '用户手机号码',
		  `user_signature` varchar(255) NOT NULL COMMENT '用户签名',
		  `register_time` datetime NOT NULL COMMENT '注册时间',
		  PRIMARY KEY (`user_number`,`user_name`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8");
		  // 建立用户信息表
	      mysqli_query($conn,"CREATE TABLE `webchat_activecode` (
		  `c_id` int(11) NOT NULL AUTO_INCREMENT,
		  `username` char(20) NOT NULL DEFAULT '',
		  `code` char(16) NOT NULL DEFAULT '',
		  `expire` int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`c_id`)
		  ) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8");
		  // 建立邮件已读表
		  $insert_configuration = "INSERT INTO manager.configuration (`service_hotline`,`service_qq`,`service_wechat`,`service_weibo`,`baidu_statistics`,`copy_right`) VALUES ('13330295142','1090035743','m1090035743','不敢为天下','<script></script>','Copyright © 2016 重庆师范大学  计算机与信息科学学院 梦创空间版权所有©')";
		  mysqli_query($conn,$insert_configuration);
		  // 插入版权信息数据
		  $insert_friendly_link = "INSERT INTO manager.friendly_link (`friendly_link_sort`,`friendly_link_name`,`friendly_link_url`) VALUES (1,'重庆师范大学官网','http://www.cqnu.edu.cn/'),(2,'重庆师范大学教务系统','http://jwxt.cqnu.edu.cn/(bx1tyafxaknzqsi3sy4mrh55)/Default2.aspx'),(3,'重庆师范大学研究生院','http://graduate.cqnu.edu.cn/'),(4,'重庆师范大学本科招生信息网','http://zsb.cqnu.edu.cn/')";
		  mysqli_query($conn,$insert_friendly_link);
		  // 插入友情链接数据
		  $insert_navigation = "INSERT INTO manager.navigation (`navigation_sort`,`navigation_name`,`navigation_alias`,`navigation_url`) VALUES (1,'网站首页','cqnuTribune','http://cqnuer.joker1996.com/'),(2,'二手市场','secondHands','http://cqnuer.joker1996.com/secondHands/index/secondHands.php'),(3,'失物招领','articlesFound','http://www.baidu.com'),(4,'学霸笔记','superScholarNote','http://cqnuer.joker1996.com/mySchool/frontEnd/mySchool.php'),(5,'重师论坛','friendTribune','http://cqnuer.joker1996.com/makeFriends/frontEnd/makeFriends.php'),(6,'个人中心','personalCenter','http://cqnuer.joker1996.com/secondHands/publishSecondGoods/frontEnd/index.php'),(7,'消息中心','messageCenter','http://cqnuer.joker1996.com/secondHands/publishSecondGoods/frontEnd/index.php?iframe=information.php')";
		  mysqli_query($conn,$insert_navigation);
		  // 插入导航栏数据
		  $insert_seo = "INSERT INTO manager.seo (`seo_name`,`seo_title`,`seo_keywords`,`seo_description`,`seo_author`) VALUES ('网站首页','重师论坛','重师论坛，虫师，二手市场，二手交易，失物招领，重庆师范大学，虫师女生，重师女生','用于重师学生的一个网站，主要是交友，发布二手商品，失物招领等','刘强'),('二手市场','重师二手交易','二手市场，二手交易，重师二手市场，重师闲置物品','用于重师学生二手物品的交易','刘强'),('失物招领','重师失物招领','重师失物招领，校园卡遗失，丢东西，捡东西','用于重师学生的遗失物品寻找和发布','王春花'),('重师论坛','重师交友论坛','重师论坛，学霸笔记，找女朋友','用于重师学生交友，闲谈','刘强'),('学霸笔记','学霸笔记','重庆师范大学，重师','重师学子的学习交流，论坛','刘强')";
		  mysqli_query($conn,$insert_seo);
		  // 插入seo网站优化数据
		  $insert_goods_address = "INSERT INTO secondhand.goods_address (`address_sort`,`address_name`) VALUES (1,'重师雅风苑'),(2,'重庆畅风苑'),(3,'重师清风苑'),(4,'重师惠风苑'),(5,'重师和风苑'),(6,'重师嘉风苑'),(7,'重师师大苑'),(8,'重师教师宿舍')";
		  mysqli_query($conn,$insert_goods_address);
		  // 插入重师地址数据
		  $insert_goods_top_type = "INSERT INTO secondhand.goods_top_type (`top_sort`,`top_name`) VALUES (1,'居家'),(2,'食品'),(3,'电子数码'),(4,'洗护用品'),(5,'衣服首饰'),(6,'其他物品')";
		  mysqli_query($conn,$insert_goods_top_type);
		  // 插入商品分类数据
		  $insert_secondhand_banner = "INSERT INTO secondhand.index_banner (`banner_sort`,`banner_picture`) VALUES (1,'slide-01.jpg'),(2,'slide-02.jpg'),(3,'slide-03.jpg')";
		  mysqli_query($conn,$insert_secondhand_banner);
		  // 插入seo网站优化数据
		  $admin_password = '$10$utgf4D2NZb7KmuBBtAU03OqES/.vUD8OTEqUD2qX7Ou/2OFhQ8cK2';
		  $insert_administrator = "INSERT INTO user.administrator (`administrator_user`,`administrator_password`) VALUES ('administrator','" . '$2y$10$TFt1Vem.2fiqasDXjsR8OuPhEQR7GpKWIoteTjznECOuZQV/QsBoq' . "')";
		  mysqli_query($conn,$insert_administrator);
		  // 插入超级管理员用户和密码
		  echo "建立数据库及表成功，请前往数据库查看!";
		  echo "<br>";
		  echo "请牢记后台管理账号和密码！";
		  echo "<br>";
		  echo "后台管理员账号：administrator 后台管理员密码：administratorHelloWorld";

	}
	else
	{
	echo "creating database fail!";
	}

	mysqli_close($conn);
?>
