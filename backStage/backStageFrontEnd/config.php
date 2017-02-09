<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-7
* @Content: 后台管理系统-网站配置
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
    <script src="../js/config_modify.js"></script>
</head>
<?php 
require '../backStageBackStage/notice.php'
 ?>
<!-- 没有登录的进入该地址，提示用户登陆后台 -->
<body>
    <div id="config" class="container-fluid wrapper nav-right">
        <ol class="breadcrumb bread">
            <li>
                <span class="glyphicon glyphicon-home"></span>
               <a style="cursor:pointer" onclick="top.location.href='index.php';">首页</a>
            </li>
            <li class="active">配置项管理</li>
        </ol>

        <div class="title">
            <p>配置项列表</p>
        </div>
        <div class="operate">
        </div>
        <div class="content">
            <table id="tab1" class="table table-bordered table-hover">
                <thead>
                    <td>标题</td>
                    <td>内容</td>
                </thead>
                <tbody>
                    <?php 
                    require '../../cqnu.class/all.class/all.class.php';
                    // 引用所有类
                    $select = Select::create_singleton();
                    // 获取查询对象
                    $sql = "select * from manager.configuration";
                    // 获取网站配置信息
                    $result = $select->select($sql);
                    // 获取查询结果集
                    $data = mysqli_fetch_object($result);
                     ?>
                    <tr>
                        
                        <td>客服电话</td>
                        <td><input class="form-control input2" id="phone" type="text" name="" value="<?php echo $data->service_hotline; ?>"></td>
                    </tr>
                    <tr>
                       
                        <td>客服QQ</td>
                        <td><input class="form-control input2" id="qq" type="text" name="" value="<?php echo $data->service_qq; ?>"></td>
                    </tr>
                     <tr>
                       
                        <td>官方微信</td>
                        <td><input class="form-control input2" id="wechat" type="text" name="" value="<?php echo $data->service_wechat; ?>"></td>
                    </tr>
                    <tr>
                        <td>新浪微博</td>
                        <td>
                        <input class="form-control input2" id="weibo" type="text" name="" value="<?php echo $data->service_weibo; ?>" >
                        </td>
                    </tr>
                    <tr>
                        
                        <td>统计代码</td>
                        <td>
                            <textarea class="form-control" id="baidu_statistics" rows="6" ><?php echo $data->baidu_statistics; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>版权信息</td>
                        <td>
                            <textarea class="form-control" id="copyright" rows="3"><?php echo $data->copy_right; ?></textarea>
                            <input type="hidden" id="id" value="<?php echo $data->configuration_id; ?>" >
                        </td>
                    </tr>
                    <tr>
                    <td>
                        <button type="button" id="config_modify_submit" class="btn btn-primary btn-xm btn-block">修改</button>
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
    <script type="text/javascript" src="../js/delete.js"></script>
</body>
</html>
