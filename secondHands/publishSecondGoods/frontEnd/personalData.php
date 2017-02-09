<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	 <link rel="stylesheet" href="../../publishStyle/css/ch-ui.admin.css">
    <link rel="stylesheet" href="../../publishStyle/font/css/font-awesome.min.css">
    <script src="../../../styles/js/loading.js"></script>
    <style>
        .img-rounded{
        border-radius: 50%;
        }
    </style>
</head>
<body>
	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">个人中心</a> &raquo; 个人资料
	</div>
	<!--面包屑导航 结束-->

	<?php 
        require '../../../cqnu.class/all.class/all.class.php';
        session_start();
        $user = $_SESSION['user'];
        // 获取当前用户
        $select = Select::create_singleton();
        // 获取查询对象
        $sql = "select * from user.user_information where user_name = '" . $user . "'";
        // 查询当前用户的所有信息
        $result = $select->select($sql);
        $data = mysqli_fetch_object($result);    
     ?>
    <div class="result_wrap">
        <div class="result_title">
            <h3>用户基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>昵称/用户名</label><span><?php echo $data->user_name ?></span>
                </li>
                <li>
                    <label>性别</label><span><?php echo $data->user_gender ?></span>
                </li>
                <li>
                    <label>邮箱</label><span><?php echo $data->user_email ?></span>
                </li>
                <li>
                    <label>电话号码</label><span><?php echo $data->user_phone ?></span>
                </li>
                <li>
                    <label>注册时间</label><span><?php echo $data->register_time ?></span>
                </li>
                <li>
                    <label>头像</label><span><img class="img-rounded" width="100px" height="100px" src="../../../register/img/<?php echo $data->user_photo ?>" ></span>
                </li>
                <!-- 输出到界面上 -->
            </ul>
        </div>
    </div>



</body>
</html>