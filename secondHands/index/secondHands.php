<!--
/**
* ================================================
* title：secondHands.html
* time: 2016-10-11
* author: 杨凤玲
* content: 二手市场首页
* ================================================
*/
-->
<!DOCTYPE html>
<html>
<head>
    <title>二手平台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- bootstrap -->
    <link rel="stylesheet" href="../../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../styles/css/bootstrap-responsive.css">
    <!-- 重置样式 -->
    <link rel="stylesheet" href="../../styles/css/reset.css">
    <!-- 引用插件css -->
    <link rel="Stylesheet" href="../../styles/plugins/loginDialog/css/loginDialog.css" />

    <link rel="stylesheet" href="../../styles/plugins/slide/css/drag.css">
    <script src="../../styles/plugins/slide/js/jquery-1.7.2.min.js"></script>
    <script src="../../styles/plugins/slide/js/drag.js"></script>

    <!-- 自定义 css -->
    <link rel="stylesheet" href="../css/secondHands.css">
    <!-- layer框架 -->
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>
    <!-- 分类js -->
    <script src="../js/secondhands.js"></script>
    


</head>
<body>
<div id="user" style="display:none;"><?php session_start(); $_SESSION['user'] = '李四';echo $_SESSION['user']; ?></div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#">首页</a></li>
                    <li class="active" ><a href="#">二手市场</a></li>
                    <li><a href="#">失物招领</a></li>
                    <li><a href="#">交友论坛</a></li>
                    <li><a href="#">我的私信</a></li>
                      <?php 
                        if(!isset($_SESSION['user'])){
                               echo '<li><a onclick="login()" >个人中心</a></li>'; 
                        }
                        else{
                            echo '<li><a href="http://localhost/CqnuTribune/secondHands/publishSecondGoods/frontEnd/index.php" target="_blank">个人中心</a></li>';
                        }
                         ?>
                  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" id="example" class="hidden-xs hidden-sm visible-md visible-lg">登录</a></li>
                    <li><a href="http://yfl995.dev.dxdc.net/task_bs/login.html"  class="visible-sm visible-xs hidden-md hidden-lg">登录</a></li>
                    <div id="LoginBox">
                        <div class="row1">
                            登录窗口
                            <a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">×</a>
                        </div>
                        <div class="row-login">
                            用户:
                            <span class="inputBox">
                                <input type="text" id="txtName" placeholder="账号/邮箱" />
                            </span>
                            <a href="javascript:void(0)" title="提示" class="warning" id="warn">*</a>
                        </div>
                        <div class="row-login">
                            密码:
                            <span class="inputBox">
                                <input type="text" id="txtPwd" placeholder="密码" />
                            </span>
                            <a href="javascript:void(0)" title="提示" class="warning" id="warn2">*</a>
                        </div>

                        <center><div id="drag"></div></center>
                        <script type="text/javascript">
                            $('#drag').drag();
                        </script>
                        <!-- 登录验证滑块 over -->

                        <div align="center">
                            <form>
                                <button herf="#" type="button" class="btn btn-primary" disabled="disabled" id="loginbtn">登录</button>
                            </form>
                        </div>
                    </div>

                    <li><a href="#">注册</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--     nav over -->

    <!-- 响应式轮播图 -->
    <div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0"
            class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active" style="background:#223240;">
                <a href="#"><img src="../img/slide-01.jpg" alt="第一张"></a>
            </div>
            <div class="item" style="background:#F5E4DC;">
                <a href="#"><img src="../img/slide-02.jpg" alt="第二张"></a>
            </div>
            <div class="item" style="background:#DE2A2D;">
                <a href="#"><img src="../img/slide-03.jpg" alt="第三张"></a>
            </div>
        </div>
        <a href="#myCarousel" data-slide="prev" class="carousel-control
        left">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a href="#myCarousel" data-slide="next" class="carousel-control
        right">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
    <section id="section2">
        <ol class="breadcrumb">
            <li><a href="#">主页</a></li>
            <li><a href="#">二手物品</a></li>
            <li class="active"><a href="">最新闲置</a></li>
            <li><a href="#">了解更多</a></li>
        </ol>

        <div class="row">
    <?php 
    require '../../cqnu.class/all.class/all.class.php';
    $sql="select title,price,picture,item_number,user_number from secondhand.goods where shelves = '未下架' order by start_time desc limit 4";
    $select = Select::create_singleton();
    // 获得查询对象
    $result = $select->select($sql);
    //查询详情的数据
    while ($data = mysqli_fetch_object($result)) {
    // 循环数据
     ?>
          <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="thumbnail">
              <?php
               $picture = $data->picture; 
               $arr = explode("@",$picture);
               // 分离图片
               $picture = $arr[0];
               // 只取第一张图片
               ?>
              <img src="http://localhost/CqnuTribune/secondHands/publishSecondGoods/goodsImg/images/<?php echo $picture ?> " alt="goods">
              <!-- 输出第一张图片 -->
              <div class="caption">
                <h3> <?php echo $data->title ?> </h3>
                <!-- 输出标题 -->
                <p>￥：<?php echo $data->price ?> </p>
                <!-- 输出价格 -->
                <p>
                    <a href="http://localhost/CqnuTribune/secondHands/index/details.php?item_number= <?php echo $data->item_number ?> " class="btn btn-primary" role="button" target='_blank' >详情信息</a>
                </p>
                <!-- 给详情信息的a标记加上GET数据传过去 -->
              </div>
            </div>
          </div>
          <?php }?>
          <!-- 结束循环 -->
        </div>
    </section>
    <!-- section2 over -->
    
    <section id="section3">
      <ol class="breadcrumb">
            <li><a href="#">主页</a></li>
            <li><a href="#">二手物品</a></li>
            <li class="active"><a href="http://localhost/CqnuTribune/secondHands/index/secondHands.php">全部商品</a></li>
        </ol>
  
        <div class="container">
            <div class="col-md-3 col-sm-3 col-xs-3 nav">
                <ul id="category">
                    <li id="top">
                        <span class="glyphicon glyphicon-list"></span>
                        <a style="text-decoration:none;" class="hidden-xs">分类详情</a>
                    </li>
                    <?php 
                    $sql="select * from secondhand.goods_top_type ";
                    $select = Select::create_singleton();
                    // 获得查询对象
                    $result = $select->select($sql);
                    //查询详情的数据
                    while ($data = mysqli_fetch_object($result)) {
                    // 循环数据
                     ?>
                    <li>
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <a name="<?php echo $data->top_category ?>" href="#" class="hidden-xs"><?php echo $data->top_name?></a>
                    </li>
                    <!-- 输出所有的分类 -->
                    <?php } ?>
                    <li id="top">
                         <span class="glyphicon glyphicon-bullhorn"></span>
                        <?php 
                        if(!isset($_SESSION['user'])){
                               echo '<a  onclick="login()" class="hidden-xs">我要发布</a>'; 
                        }
                        else{
                            echo ' <a href="http://localhost/CqnuTribune/secondHands/publishSecondGoods/frontEnd/index.php" target="_blank" class="hidden-xs">我要发布</a>';
                        }
                         ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9 main">
                <?php 

                    $show_data= 12;
                    //一页显示多少记录
                    $select = Select::create_singleton();
                    //实例化查询对象
                    $category =  isset($_GET['category_name'])?$_GET['category_name']:null;
                    if(is_null($category)){
                     $sql = "select count(*) as c from secondhand.goods  where shelves = '未下架'";
                    }
                    else{
                    $sql = "select count(*) as c from secondhand.goods  where shelves = '未下架' and top_category = $category";
                    }
                    // 如果用户选择其他分类sql语句就多加一个top_category=选择的分类
                    $count = $select->page_count($sql);
                    //获取表记录总数
                    if ($count) {
                     $page = isset($_GET['page'])?$_GET['page']:1;
                        //如果没有接收到浏览器传过来的参数，说明就是首页。
                     if(is_null($category)){
                        $sql="select picture,title,description,item_number from  secondhand.goods  order by start_time desc" . " limit " . ($page - 1) * $show_data . ", $show_data"; 
                    }
                    else{
                        $sql="select picture,title,description,item_number from  secondhand.goods where shelves = '未下架' and top_category = $category order by start_time desc" . " limit " . ($page - 1) * $show_data . ", $show_data"; 
                    }
                    // 如果用户选择其他分类sql语句就多加一个top_category=选择的分类，获取所有数据
                        $result = $select->select($sql);
                        //=====循环这些数据=====
                        while($data = mysqli_fetch_object($result)) {
                 ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="media">
                        <a class="pull-left" href="http://localhost/CqnuTribune/secondHands/index/details.php?item_number=<?php echo $data->item_number ?>" target='_blank'>
                                 <?php 
                                   $picture = $data->picture; 
                                   // 获取图片
                                   $arr = explode("@",$picture);
                                   // 分离图片
                                 ?>
                            <img  class="media-object" src="http://localhost/CqnuTribune/secondHands/publishSecondGoods/goodsImg/images/<?php echo $arr[0] ?> " height="100" width="100"
                                 alt="媒体对象" >
                        </a>
                        <!-- 输出第一张图片 -->
                        <div class="media-body">
                            <h4 class="media-heading"> <?php echo $data->title ?> </h4>
                            <?php echo $data->description //输出描述 ?>
                        </div>
                    </div>
                </div>
               <?php  } ?>
                <div style="width:100%" class="page">
                <ul class="pagination">
                    <?php 
                        $myPage=new pager($count,intval($page),$show_data);     
                        //实例化分页对象，参数需要总数，第几页，显示多少也
                         $pageStr= $myPage->GetPagerContent();    
                        //进行分页
                         echo $pageStr ;
                        //输入分页 
                         }
                        else{
                            echo "<div align='center'>
                            当前分类没有任何商品！
                            </div>";
                            // 没有数据就给用户提醒
                        }
                    ?>
                </ul>
                </div>

            </div>
    </section>
    <!-- section3 over -->

    <section id="section4">
        <div class="title">
            <p>联系我们</p>
            <p>如有问题请联系我们，我们24小时竭诚为您服务</p>
        </div>
        <div class="contact hidden-xs">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="box">
                        <img src="../../styles/img/tel.jpg" height="60" width="60" alt="contact" />
                        <div class="text">
                            <p>客服电话：</p>
                            <p>400-123-8888</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="box">
                        <img src="../../styles/img/QQ.jpg" height="60" width="60" alt="contact" />
                        <div class="text">
                            <p>在线QQ客服：</p>
                            <p>1234556789</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="box">
                        <img src="../../styles/img/wechat.jpg" height="60" width="60" alt="contact" />
                        <div class="text">
                            <p>关注官方微信：</p>
                            <p>aboutmeaboutme</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="box">
                        <img src="../../styles/img/weibo.jpg" height="60" width="60" alt="contact" />
                        <div class="text">
                            <p>新浪微博：</p>
                            <p>aboutmeaboutme</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section4 over  -->

    <footer>
        <div class="aboutme">
            <p>
                <a href="#">关于我们&nbsp;&nbsp;</a>
                <a>|</a>
                <a href="#">&nbsp;&nbsp;联系我们</a>
            </p>
        </div>
        <div class="copy">
            <p>Copyright © 2016 重庆师范大学&nbsp;&nbsp;计算机与信息科学学院 梦创空间版权所有&copy;</p>
        </div>
    </footer>


    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-1.11.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>

    <script type="text/javascript" src="../../styles/plugins/loginDialog/js/popupBox.js"></script>

</body>
</html>
