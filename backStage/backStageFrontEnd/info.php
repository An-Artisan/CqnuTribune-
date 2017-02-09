<!-- /*
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-06
* @Content: 后台管理系统-后台信息
* @Last Modified time: 2016-11-14
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
    <script src="../../styles/js/getNowTime.js"></script>
    <script src="../../styles/js/loading.js"></script>
    <script src="../js/dynamic_time.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <?php 
    require '../../cqnu.class/all.class/all.class.php';
    // 引用所有类
     ?>
    <div id="info" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">系统基本信息</li>
        </ol>

        <div class="content">
            <div>
                <h3>系统基本信息</h3>
            </div>
            <div>
                <ul>
                    <li>
                        <label>北京时间</label><span id="time" style="font-weight:bold"><?php  date_default_timezone_set('PRC'); //设置中国时区 
                         echo date('Y-m-d H:i:s',time()); ?></span>
                    </li>
                    <!-- 获取当前时间，并且每秒实时更新时间 -->
                    <li>
                        <label>操作系统</label><span> <?PHP echo  php_uname(); ?></span>
                    </li>
                    <!-- 获取当前的操作系统详细配置信息 -->
                    <li>
                        <label>运行环境</label><span> <?PHP echo $_SERVER ['SERVER_SOFTWARE']; ?></span>
                    </li>
                    <!-- 获取当前Web服务器的运行环境 -->
                    <li>
                        <label>SAPI Interface</label><span><?php echo php_sapi_name(); ?></span>
                    </li>
                    <!-- 获取当前PHP SAPI interface -->
                    <li>
                        <label>PHP版本</label><span><?PHP echo PHP_VERSION; ?></span>
                    </li>
                    <!-- 获取当前服务器的PHP版本 -->
                    <li>
                        <label>GD库版本</label><span><?php if(function_exists("gd_info")){ $gd = gd_info();$gdinfo = $gd['GD Version'];}else {$gdinfo = "未知";} echo $gdinfo; ?></span>
                    </li>
                    <!-- 获取当前图片处理GD图版本 -->
                    <li>
                        <label>Zend Gngine</label><span><?PHP echo zend_version(); ?></span>
                    </li>
                    <!-- 获取PHP核心Zend 引擎版本 -->
                    <li>
                        <label>Mysql支持</label><span><?php echo function_exists('mysqli_close')?"是":"否"; ?></span>
                    </li>
                    <!-- mysqli是否支持 -->
                    <li>
                        <label>Mysql版本</label><span><?php echo mysql_get_server_info(); ?></span>
                    </li>
                    <!-- 获取当前mysql版本 -->
                    <li>
                        <label>Mysql持续连接</label><span><?php echo get_cfg_var("mysql.allow_persistent")?"是 ":"否"; ?></span>
                    </li>
                    <!-- 获取mysql是否持续链接 -->
                    <li>
                        <label>Mysql最大连接数</label><span><?php echo get_cfg_var("mysql.max_links")==-1 ? "不限" : @get_cfg_var("mysql.max_links");?></span>
                    </li>
                    <!-- 获取mysql的最大连接数 -->
                    <li>
                        <label>运行占用最大内存</label><span><?PHP echo get_cfg_var ("memory_limit")?get_cfg_var("memory_limit"):"无" ?></span>
                    </li>
                    <!-- 获取脚本运行占用最大内存 -->
                    <li>
                        <label>上传附件限制</label><span><?PHP echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?></span>
                    </li>
                    <!-- 获取上传附件的最大限制 -->
                    <li>
                        <label>最大执行时间</label><span><?PHP echo get_cfg_var("max_execution_time")."秒 "; ?></span>
                    </li>
                    <!-- 获取脚本的最大执行时间 -->
                    <li>
                        <label>服务器域名</label><span><?php echo $_SERVER["HTTP_HOST"]; ?></span>
                    </li>
                    <!-- 获取服务器的域名 -->
                    <li>
                        <label>Host</label><span>
                        <?php 
                                 $ip = new GetIp();
                                 //实例化GetIp对象
                                 echo $ip->get_server_ip();
                                 //得到真实的服务器IP
                         ?>
                         </span>
                    </li>
                    <!-- 获取服务器的IP -->
                    <li>
                        <label>服务器语言</label><span><?php echo  $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></span>
                    </li>
                    <!-- 获取服务器支持的语言 -->
                    <li>
                        <label>Web端口号</label><span><?php echo $_SERVER['SERVER_PORT']; ?></span>
                    </li>
                    <!-- 获取服务器的Web端口号 -->
                </ul>
            </div>

            <div>
                <div>
                    <h3>使用帮助</h3>
                </div>
                <div>
                    <ul>
                        <li>
                            <label>官方交流QQ群：</label><span>589464375</span>
                        </li>
                        <li>
                            <label>官方交流邮箱：</label><span>13330295142@163.com</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
</body>
</html>
