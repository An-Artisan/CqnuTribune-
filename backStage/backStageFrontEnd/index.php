 <!-- /*
* ================================================
* @Author: 杨凤玲
* @Date: 2016-10-29
* @Content: 后台管理系统-首页
* @Last Modified time: 2016-11-08
* ================================================
*/ -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>后台管理</title>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" type="text/css" href="../../styles/css/bootstrap.min.css">
    <!-- 重置css -->
    <link rel="stylesheet" href="../../styles/css/reset.css">
    <!-- 当前页面的css -->
    <link rel="stylesheet" href="../css/background.css">
    <script src="../../styles/js/loading.js"></script>
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="section1" class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-sm-3 col-xs-3 nav">
                <div class="logo">
                    <h1>项目后台管理系统</h1>
                </div>
                <div class="txt">
                    <ul id="ul1" class="ul-fa">
                        <li class="li-fa">
                            <div class="list">
                                <span class="glyphicon glyphicon-list-alt"></span>
                                <h2>内容管理</h2>
                            </div>
                            <ul class="ul-son" style="display: none;">
                                <li>
                                    <span class="glyphicon glyphicon-gift"></span>
                                    <a href="goods.php" target="main">商品分类</a>
                                </li>
                                <li>
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                    <a href="address.php" target="main">地址管理</a>
                                </li>
                                <li>
                                    <span class="glyphicon glyphicon-picture"></span>
                                    <a href="image.php" target="main">轮播图片</a>
                                </li>
                                <li>
                                    <span class="glyphicon glyphicon-edit"></span>
                                    <a href="notice.php" target="main">系统公告</a>
                                </li>
                            </ul>
                        </li>
                        <li class="li-fa">
                            <div class="list">
                                <span class="glyphicon glyphicon-cog"></span>
                                <h2>系统设置</h2>
                            </div>
                            <ul class="ul-son" style="display: none;">
                                <li>
                                    <span class="glyphicon glyphicon-heart-empty"></span>
                                    <a href="links.php" target="main">友情链接</a>
                                </li>
                                <li>
                                    <span class="glyphicon glyphicon-list"></span>
                                    <a href="navs.php" target="main">自定义导航</a>
                                </li>
                                <li>
                                    <span class="glyphicon glyphicon-move"></span>
                                    <a href="seo.php" target="main">SEO爬虫</a>
                                </li>
                                <li>
                                    <span class="glyphicon glyphicon-wrench"></span>
                                    <a href="config.php" target="main">网站配置</a>
                                </li>
                            </ul>
                        </li>
                           <li class="li-fa">
                            <div class="list">
                                <span class="glyphicon glyphicon-folder-open"></span>
                                <h2>项目日志</h2>
                            </div>
                            <ul class="ul-son" style="display: none;">
                                <li>
                                    <span class="glyphicon glyphicon-file"></span>
                                    <a href="mysqlLog.php" target="main">MySQL错误日志</a>
                                </li>
                                <li>
                                    <span class="glyphicon glyphicon-envelope"></span>
                                    <a href="emailLog.php" target="main">邮箱错误日志</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- txt over -->
                <div class="status-bar">
                    <p>欢迎登录：<span><?php echo $_SESSION['administrator'];?></span></p>
                    <button type="button" class="btn" onclick="window.location.href='../backStageBackStage/signOut.php'">退出账户</button>
                </div>
            </nav>
            <!-- nav over -->

            <div class="col-md-9 col-sm-9 col-xs-9 content">
                <iframe src="<?php echo isset($_GET['iframe'])?$_GET['iframe']:'info.php'; ?>" frameborder="0" width="100%" height="100%" name="main"></iframe>
            </div>
        </div>
    </div>

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
    <!--     <script src="js/background.js"></script> -->
    <script src="../../backStage/js/background.js"></script>
</body>
</html>
