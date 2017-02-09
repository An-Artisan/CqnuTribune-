<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-6
* @Content: 后台管理系统-商品分类-修改商品
* @Last Modified time: 2016-11-8
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
    <script src="../js/goods_modify.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="goods-modify" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">商品分类</li>
        </ol>

        <div class="title">
            <p>添加分类</p>
        </div>
        <div class="operate">
            <a href="goods-add.php"><span class="glyphicon glyphicon-plus"></span>添加分类</a>
            <a href="goods.php"><span class="glyphicon glyphicon-refresh"></span>全部分类</a>
        </div>
        <div class="content">
            <table class="tab1 table-bordered">
                <tr>
                    <th>
                        ID：
                    </th>
                    <td>
                         <input type="text" id="modify_id" disabled="disabled" value="<?php echo $_GET['top_category']; ?>" class="form-control sm-input">
                    </td>
                </tr>
                <tr>
                    <th>分类标题：</th>
                    <td>
                        <input type="text" id="modify_name" onblur="modify_check(this);" value="<?php echo $_GET['top_name']; ?>" class="form-control md-input">

                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button type="button" id="modify_submit" class="btn btn-primary btn-sm">提交</button>
                        <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='goods.php'">返回</button>
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
