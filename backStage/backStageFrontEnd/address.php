<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-7
* @Content: 后台管理系统-地址管理
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
    <script type="text/javascript" src="../js/address_delete.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="address" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">地址管理</li>
        </ol>

        <div class="title">
            <p>地址管理列表</p>
        </div>
        <div class="operate">
            <a href="address-add.php"><span class="glyphicon glyphicon-plus"></span>添加地址</a>
            <a href="address.php"><span class="glyphicon glyphicon-refresh"></span>全部地址</a>
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
                $sql = "select * from secondhand.goods_address order by address_sort";
                $result = $select->select($sql);
                while($data = mysqli_fetch_object($result)) {
                 ?>
                    <tr>
                        <td><input class="form-control input1" type="text" name="" value="<?php echo $data->address_sort ?>"></td>
                        <td><?php echo $data->address_id ?></td>
                        <td><?php echo $data->address_name ?></td>
                        <td>
                           
                            <a href="address-modify.php?address_id=<?php echo $data->address_id;?>&address_name=<?php echo $data->address_name; ?>">修改</a>
                            <a style="cursor:pointer" onclick="delete_address(this);" name="<?php echo $data->address_id; ?>">删除</a>
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
