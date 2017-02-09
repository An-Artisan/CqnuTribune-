<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-07
* @Content: 后台管理系统-友情链接-添加链接
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
    <script src="../js/friendly_link_add.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="links-add" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">友情链接管理</li>
        </ol>

        <div class="title">
            <p>添加友情链接</p>
        </div>
        <div class="operate">
            <a href="links-add.html"><span class="glyphicon glyphicon-plus"></span>添加链接</a>
            <a href="links.php"><span class="glyphicon glyphicon-refresh"></span>全部链接</a>
        </div>
        <div class="content">
            <table id="tab1" class="table table-bordered">
                <tbody>
                    <tr>
                        <th>
                            <i class="require">*&nbsp;</i>链接名称：
                        </th>
                        <td>
                            <input type="text"   id="friendly_link_name" class="form-control sm-input">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <i class="require">*&nbsp;</i>url：
                        </th>
                        <td>
                            <input type="text"    id="friendly_link_url" class="form-control sm-input">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <i class="require">*&nbsp;</i>排序：
                        </th>
                        <td>
                            <input type="text" onblur="friendly_link_check(this);"  id="friendly_link_sort" class="form-control sm-input">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button type="button" id="friendly_link_submit" class="btn btn-primary btn-sm">提交</button>
                            <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='links.php'">返回</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
</body>
</html>
