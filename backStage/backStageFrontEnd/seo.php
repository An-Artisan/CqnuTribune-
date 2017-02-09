<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-7
* @Content: 后台管理系统-SEO爬虫
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
    <script type="text/javascript" src="../js/seo_delete.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="seo" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
                <a style="cursor:pointer"  onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">SEO爬虫</li>
        </ol>

        <div class="title">
            <p>SEO列表列表</p>
        </div>
        <div class="operate">
            <a href="seo-add.php"><span class="glyphicon glyphicon-plus"></span>添加配置项</a>
            <a href="seo.php"><span class="glyphicon glyphicon-refresh"></span>全部配置项</a>
        </div>
        <div class="content">
            <table id="tab1" class="table table-bordered table-hover">
                <thead>
                    <td>导航名称</td>
                    <td>网站标题</td>
                    <td>关键词</td>
                    <td>描述</td>
                    <td>网站作者</td>
                    <td>操作</td>
                </thead>
                <tbody>
                 <?php
                require '../../cqnu.class/all.class/all.class.php';
                // 引用所有类
                $select = Select::create_singleton();
                // 实例化数据库查询
                $sql = "select * from manager.seo order by seo_id";
                // 查找所有seo模块
                $result = $select->select($sql);
                while($data = mysqli_fetch_object($result)) {
                 ?>
                    <tr>
                        <td><?php echo $data->seo_name; ?></td>
                        <td><?php echo $data->seo_title; ?></td>
                        <td><?php echo $data->seo_keywords; ?></td>
                        <td><?php echo $data->seo_description; ?></td>
                        <td><?php echo $data->seo_author; ?></td>
                        <td>
                            <a href="seo-modify.php?seo_id=<?php echo $data->seo_id ?>&seo_name=<?php echo $data->seo_name ?>&seo_title=<?php echo $data->seo_title ?>&seo_keywords=<?php echo $data->seo_keywords ?>&seo_description=<?php echo $data->seo_description ?>&seo_author=<?php echo $data->seo_author ?> ">修改</a>

                            <a style="cursor:pointer" onclick="delete_seo(this);" name="<?php echo $data->seo_id; ?>" >删除</a>
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
