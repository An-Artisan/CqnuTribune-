<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-6
* @Content: 后台管理系统-屏蔽词汇-修改屏蔽字
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
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <script src="../../styles/js/loading.js"></script>
    <script src="../js/image_modify.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="image-modify" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">轮播图片</li>
        </ol>

        <div class="title">
            <p>修改轮播图</p>
        </div>
        <div class="operate">
            <a href="image-add.php"><span class="glyphicon glyphicon-plus"></span>修改轮播图</a>
            <a href="image.php"><span class="glyphicon glyphicon-refresh"></span>全部轮播图</a>
        </div>
        <div class="content">
        <form action="../backStageBackStage/modifyImage.php" onsubmit="return modify_check_img();" method="post" enctype="multipart/form-data">
            <table class="tab1 table-bordered">
                <tr>
                    <th>ID：</th>
                    <td>
                        <input  disabled="disabled" value="<?php echo $_GET['banner_id']; ?>" type="text" class="form-control sm-input">
                    </td>
                </tr>
                <tr>
                    <th>上传图片：</th>
                    <td>
                        <div class="form-group">
                            <input id="input1" name="pic[]" type="file"/>
                            <?php 
                            require '../../cqnu.class/all.class/all.class.php';
                            // 引用所有类
                            $select = Select::create_singleton();
                            // 获取查询对象
                            $sql = "select banner_picture from secondhand.index_banner where banner_id = ".$_GET['banner_id'];
                            // 查询要更改id的图片
                            $result = $select->select($sql);
                            // 执行查询
                            $data = mysqli_fetch_object($result);
                            // 获取结果集
                            $old_picture = $data->banner_picture;
                            // 获取图片
                             ?>
                            <img class="img-rounded" style="width:120px;height:120px;" id="img1" src="../../secondHands/img/<?php echo $old_picture; ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" name="submit" class="btn btn-primary btn-sm" value="提交">
                        <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='image.php'">返回</button>
                    </td>
                </tr>
            </table>
            <input  name="banner_id" value="<?php echo $_GET['banner_id']; ?>" type="hidden" >
        </form>
        </div>
    </div>

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
    <script src="../js/image.js"></script>
</html>
