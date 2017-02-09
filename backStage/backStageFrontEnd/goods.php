<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-6
* @Content: 后台管理系统-商品分类
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
    <script type="text/javascript" src="../js/goods_delete.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="goods" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">商品分类</li>
        </ol>

        <div class="title">
            <p>商品分类列表</p>
        </div>
        <div class="operate">
            <a href="goods-add.php"><span class="glyphicon glyphicon-plus"></span>添加分类</a>
            <a href="goods.php"><span class="glyphicon glyphicon-refresh"></span>全部分类</a>
        </div>
        <div class="content">
            <table id="tab1" class="table table-bordered table-hover">
                <thead>
                    <td>排序</td>
                    <td>ID</td>
                    <td>分类标题</td>
                    <td>操作</td>
                </thead>
                <tbody>
                <?php 
                require '../../cqnu.class/all.class/all.class.php';
                $select = Select::create_singleton();
                $sql = "select * from secondhand.goods_top_type order by top_sort";
                $result = $select->select($sql);
                while($data = mysqli_fetch_object($result)) {
                 ?>
                    <tr>
                        <td><input class="form-control input1" type="text" name="" value="<?php echo $data->top_sort ?>"></td>
                        <td><?php echo $data->top_category ?></td>
                        <td><?php echo $data->top_name ?></td>
                        <td>
                            <a href="goods-modify.php?top_category=<?php echo $data->top_category;?>&top_name=<?php echo $data->top_name; ?>">修改</a>
                            <a style="cursor:pointer" onclick="delete_top_category(this);" name="<?php echo $data->top_category; ?>">删除</a>
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
