<!-- /*
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-06
* @Content: 后台管理系统-自定义导航
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
    <script type="text/javascript" src="../js/navigation_delete.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="navs" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer"  onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">自定义导航</li>
        </ol>

        <div class="title">
            <p>自定义导航列表</p>
        </div>
        <div class="operate">
            <a href="navs-add.php"><span class="glyphicon glyphicon-plus"></span>添加导航</a>
            <a href="navs.php"><span class="glyphicon glyphicon-refresh"></span>全部导航</a>
        </div>
        <div class="content">
            <table id="tab1" class="table table-bordered table-hover">
                <thead>
                    <td>排序</td>
                    <td>ID</td>
                    <td>导航名称</td>
                    <td>导航别名</td>
                    <td>导航地址</td>
                    <td>操作</td>
                </thead>
                <tbody>
                 <?php
                require '../../cqnu.class/all.class/all.class.php';
                $select = Select::create_singleton();
                $sql = "select * from manager.navigation order by navigation_sort";
                $result = $select->select($sql);
                while($data = mysqli_fetch_object($result)) {
                 ?>
                    <tr>
                        <td><input class="form-control input1" type="text" name="" value="<?php echo $data->navigation_sort; ?>"></td>
                        <td><?php echo $data->navigation_id; ?></td>
                        <td><?php echo $data->navigation_name; ?></td>
                        <td><?php echo $data->navigation_alias; ?></td>
                        <td><?php echo $data->navigation_url; ?></td>
                        <td>
                            <a href="navs-modify.php?navigation_id=<?php echo $data->navigation_id ?>&navigation_name=<?php echo $data->navigation_name ?>&navigation_alias=<?php echo $data->navigation_alias ?>&navigation_url=<?php echo $data->navigation_url ?> ">修改</a>

                            <a style="cursor:pointer" onclick="delete_navigation(this);" name="<?php echo $data->navigation_id; ?>" >删除</a>
                        </td>
                    </tr>
                <?php }?>
                   
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
