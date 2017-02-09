<?php 
	require 'mysql.class/mysql.class.php';
	// 引用mysql增查删改类
	require 'pager.class/pager.class.php';
	// 引用分页类
	require 'email.class/send.class.php';
	// 引用发送邮件类
	require 'code.class/Code.class.php';
	// 引用验证码类
	require 'getip.class/getip.class.php';
	// 引用获得IP类
	require 'encrypt.class/encrypt.class.php';
	// 引用密码加密类
	require 'waterprint.class/waterprint.class.php';
	// 引用图片水印类
    require "fileupload.class/fileupload.class.php";
    // 引用上传单文件或者多文件类
    require 'getposition.class/getposition.class.php';
    // 引用根据IP定位位置类
    require 'thumb.class/thumb.class.php';
    // 引用缩略图剪裁类
    require 'sendsitivewordfilter/SensitiveWordFilter.class.php';
    // 引用敏感词汇过滤类
 ?>