<!-- /*
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-06
* @Content: 后台管理系统-自定义导航-添加导航
* @Last Modified time: 2016-11-08
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
    <script src="../js/navigation_add.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="navs-add" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">自定义导航管理</li>
        </ol>

        <div class="title">
            <p>编辑自定义导航</p>
        </div>
        <div class="operate">
            <a href="navs-add.html"><span class="glyphicon glyphicon-plus"></span>添加导航</a>
            <a href="navs.php"><span class="glyphicon glyphicon-refresh"></span>全部导航</a>
        </div>
        <div class="content">
            <table id="tab1" class="table table-bordered">
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>导航名称：
                    </th>
                    <td>
                        <input type="text" id="navigation_name" class="form-control xs-input">
                    </td>
                </tr>
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>导航别名
                    </th>
                    <td>
                         <input type="text" id="navigation_alias" class="form-control xs-input">
                    </td>
                </tr>
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>URL：
                    </th>
                    <td>
                        <input type="text" id="navigation_url" class="form-control sm-input">
                    </td>
                </tr>
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>排序：
                    </th>
                    <td>
                        <input id="navigation_sort" onblur="navigation_check_sort(this);" type="text" class="form-control xs-input">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button type="button" id="navigation_submit" class="btn btn-primary btn-sm">提交</button>
                        <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='navs.php'">返回</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
</body>
</html>
