<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-7
* @Content: 后台管理系统-SEO修改
* @Last Modified time: 2016-11-24
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
    <script type="text/javascript" src="../js/seo_modify.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="seo-modify" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer"  onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">SEO修改</li>
        </ol>

        <div class="title">
            <p>SEO列表</p>
        </div>
        <div class="operate">
            <a href="seo-add.php"><span class="glyphicon glyphicon-plus"></span>添加配置项</a>
            <a href="seo.php"><span class="glyphicon glyphicon-refresh"></span>全部配置项</a>
        </div>
        <div class="content">
            <table id="tab1" class="table table-bordered">
                <input type="hidden" id="seo_id" value="<?php echo $_GET['seo_id']; ?>" >
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>导航名称：
                    </th>
                    <td>
                    <label><?php echo $_GET['seo_name'] ?></label>
                    </td>
                </tr>
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>网站标题：
                    </th>
                    <td>
                        <input type="text" id="seo_title" value="<?php echo $_GET['seo_title']; ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>关键词：
                    </th>
                    <td>
                        <input type="text" id="seo_keywords" value="<?php echo $_GET['seo_keywords']; ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>描述：
                    </th>
                    <td>
                        <textarea class="form-control" id="seo_description" rows="3"><?php echo $_GET['seo_description']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                        <i class="require">*&nbsp;</i>网站作者：
                    </th>
                    <td>
                        <input type="text" id="seo_author" value="<?php echo $_GET['seo_author']; ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button type="button" id="seo_submit" class="btn btn-primary btn-sm">提交</button>
                        <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='seo.php'">返回</button>
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
