<!-- /*
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-17
* @Content: 后台管理系统-mysql日志
* @Last Modified time: 2016-11-17
* ================================================
*/ -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" type="text/css" href="../../styles/css/bootstrap.min.css">
    <!-- 重置css -->
    <link rel="stylesheet" href="../../styles/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/background.css">
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <script src="../../styles/js/loading.js"></script>
    <script type="text/javascript" src="../js/clean_sql.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="mysql" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">mysql日志</li>
        </ol>

        <div class="title">
            <p>mysql日志</p>
        </div>
        <div class="operate">
            <a id="trash"><span class="glyphicon glyphicon-trash"></span>清空日志内容</a>
        </div>
        <div id="content" class="content">
            <p>
            <?php 
                $fp = fopen("../../cqnu.class/all.class/mysql.class/sql.log", "r"); 
                if($fp){ 
                for($i=1;!feof($fp);$i++){ 
                echo fgets($fp). "<br />"; 
                    } 
                } 
                else{ 
                echo "打开文件失败"; 
                    } 
                fclose($fp); 
            ?>     
            </p>
        </div>
    </div>

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
</body>
</html>
