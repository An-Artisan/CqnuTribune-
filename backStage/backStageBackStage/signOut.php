<?php 
session_start();
// 开启session
unset($_SESSION['administrator']); 
// 摧毁当前用户的标记
header("Location: http://cqnuer.joker1996.com");
// 跳转到登陆界面
 ?>