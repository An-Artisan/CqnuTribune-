<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	 <link rel="stylesheet" href="../../publishStyle/css/ch-ui.admin.css">
    <link rel="stylesheet" href="../../publishStyle/font/css/font-awesome.min.css">
    <script type="text/javascript" src="../../../styles/layui/layui.js"></script>
    <script type="text/javascript" src="../../../styles/js/jquery-3.1.1.min.js"></script>
    <script src="../../../styles/js/loading.js"></script>
    <script type="text/javascript" src="js/publishGoods.js"></script>
    <script src="js/update.js"></script>
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
		<i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">个人中心</a> &raquo; 修改资料
	</div>
	<!--面包屑导航 结束-->

	<?php 
        require '../../../cqnu.class/all.class/all.class.php';
        session_start();
        // 开启session
        $user = $_SESSION['user'];
        // 获取当前用户
        $select = Select::create_singleton();
        // 获取查询对象
        $sql = "select * from user.user_information where user_name = '" . $user . "'";
        // 查询当前用户的所有数据
        $result = $select->select($sql);
        $data = mysqli_fetch_object($result);    
     ?>
    <div class="result_wrap">
        <div class="result_title">
            <h3>修改基本信息</h3>
        </div>
        <div class="result_content">
        <form method="post" onsubmit="return dataCheckInput();"  enctype="multipart/form-data" action="../backStage/updatePersonalData.php" >
            <ul>
                <li>
                    <label>昵称/用户名</label><input id="username" name="username" type="text" value="<?php echo $data->user_name ?>">
                </li>

                <li>
                <label>性别</label>
                <select  name="gender">
                        <option value="男">男</option>
                        <option value="女">女</option>
                        <!-- 输出所有分类 -->
                </select>
                </li>
                <li>
                    <label>邮箱</label><input id="email" name="email" type="text" value="<?php echo $data->user_email ?>">
                </li>
                <li>
                    <label>电话号码</label><input id="phone" name="phone" type="text" value="<?php echo $data->user_phone ?>">
                </li>
                <li>
                    <label>更换头像</label><span><input id="upfile" name="pic" onchange="updatefile();" type="file"></span>
                </li>
                <li>
                    <label>头像</label><span><img id="photo" class="img-rounded" width="100px" height="100px" src="../../../register/img/<?php echo $data->user_photo ?>" ></span>
                </li>
                <li>
                    <label>&nbsp;&nbsp;</label><span><input id="submit" type="submit" name="submit" value="修改"></span>
                </li>
                <input type="hidden" name="photo" value="<?php echo $data->user_photo ?>" />
                <!-- 添加一个隐藏域，用来删除旧的图片 -->
            </ul>
        </form>
        </div>
    </div>
</body>
</html>