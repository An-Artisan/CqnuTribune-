<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2017-01-17
* @Content: 首页
* @Last Modified time: 2017-01-17
* ================================================
*/ -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cqnuer</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <!-- 重置css -->
    <link rel="stylesheet" type="text/css" href="styles/css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/homePage.css">
</head>
<body>
    <div id="wrapper" class="wrapper">
        <nav>
            <div class="top">
                <div class="logo">
                    <img src="img/logo.png" alt="">
                    <h1>CQNU Tribune</h1>
                </div>
                <ul>
                    <li><a href="index.html" title="">首页</a>&nbsp;/&nbsp;</li>
                    <li><a href="#" title="">关于我们</a>&nbsp;/&nbsp;</li>
                    <li><a href="backStage/backStageFrontEnd/login.html" title="">管理员登录</a></li>
                </ul>
            </div>
        </nav>
        <?php 
        require 'cqnu.class/all.class/all.class.php';
        // 引用所有类
         $select = Select::create_singleton();
        // 获取查询对象
        $sql = "select * from manager.announcement order by a_time";
        // 查询所有的导航信息
        $result = $select->select($sql);
        // 获取结果集
        
         ?>
        <section id="section1">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 one">
                    <!-- 公告开始 -->
                    <div  id="mooc">
                    <!--  头部 -->
                        <h3  class="title" id="moocTitle">最新公告</h3>
                        <!--  头部结束 -->
                        <!--  中间 -->
                        <div  id="moocBox">
                            <ul id="con1">
                                <?php 
                                while ($data = mysqli_fetch_object($result)){
                                // 获取数据
                                 ?>
                                <li><a href="#"><?php echo $data->a_content;?></a></li>
                                <?php }?>
                            </ul>
                            <ul id="con2">
                            </ul>
                        </div>
                        <!--  中间结束 -->
                    </div>
                    <!-- 公告结束 -->
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 one">
                    <div class="box2">
                    <h3 class="title">友情链接</h3>
                    <div class="row photo">
                        <?php 
                        $sql = "select * from manager.friendly_link order by friendly_link_sort";
                        // 查询所有的导航信息
                        $result = $select->select($sql);
                        // 获取结果集
                        while ($data = mysqli_fetch_object($result)) {
                         ?>
                        <div class="col-md-3 col-sm-3 col-xs-3"><a href="<?php echo $data->friendly_link_url;?>"><?php echo $data->friendly_link_name;?></a></div>
                        <?php }?>
                    </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 one">
                    <div class="box2 info">
                        <h3 class="title">板块分类<a href="#" target="_self">了解更多>></a></h3>
                        <p>二手交易---校园二手平台<a href="secondHands/index/secondHands.php" target="_blank">GO</a></p>
                        <p>失物招领---发布各种失物招领消息<a href="#">GO</a></p>
                        <p>交友论坛---校内交友社区<a href="makeFriends/frontEnd/makeFriends.php" target="_blank" >GO</a></p>
                        <p>学霸笔记---分享各种笔记<a href="mySchool/frontEnd/mySchool.php" target="_blank">GO</a></p>
                    </div>
                </div>
            </div>
        </section>
        <div class="footer"><p>Copyright © 2016 重庆师范大学  计算机与信息科学学院 梦创空间版权所有©</p></div>
    </div>

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="styles/js/jquery-3.1.1.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="styles/js/bootstrap-3.3.0.min.js"></script>
<script type="text/javascript">
 var area = document.getElementById('moocBox');
 var con1 = document.getElementById('con1');
 var con2 = document.getElementById('con2');
 var speed1 = 50;
 area.scrollTop = 0;
 con2.innerHTML = con1.innerHTML;
 function scrollUp(){
     if(area.scrollTop >= con1.scrollHeight) {
         area.scrollTop = 0;
         }else{
           area.scrollTop ++;
         }
}
var myScroll = setInterval("scrollUp()",speed1);
area.onmouseover = function(){
     clearInterval(myScroll);
    }
area.onmouseout = function(){
     myScroll = setInterval("scrollUp()",speed1);
    }
 </script>
</body>
</html>
