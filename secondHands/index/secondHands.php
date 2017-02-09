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
    <?php 
    require '../../cqnu.class/all.class/all.class.php';
    // 引用所有类
     $select = Select::create_singleton();
    // 获取查询对象
    $sql = "select * from manager.seo where seo_name = '二手市场' order by seo_id";
    // 查询所有的导航信息
    $result = $select->select($sql);
    // 获取结果集
    $data = mysqli_fetch_object($result);
    // 获取数据
     ?>
    <title><?php echo $data->seo_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="keywords" content="<?php echo $data->seo_keywords; ?>" >
    <meta name="description" content="<?php echo $data->seo_description; ?>">
    <meta name="author" content="<?php echo $data->seo_author ?>" />
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
    <script src="../../styles/js/loading.js"></script>
    <!-- 分类js -->
    <script src="../js/secondhands.js"></script>
    <link rel="stylesheet" href="../../styles/css/pager.css">
    


</head>
<body>
<nav id="nav" class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">HelloWorld</a>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul id="ul1" class="nav navbar-nav">
                    <?php 
                        session_start(); 
                        $select = Select::create_singleton();
                        // 获取查询对象
                        $sql = "select * from manager.navigation order by navigation_sort";
                        // 查询所有的导航信息
                        $result = $select->select($sql);
                        // 获取结果集
                        while ($data = mysqli_fetch_object($result)) {
                            if($data->navigation_alias == 'messageCenter'){
                     ?>
                     <li class="dropdown message">
                        <?php 
                            if(!isset($_SESSION['user'])){
                        ?>
                        <a href="<?php echo $data->navigation_url;?>" class="dropdown-toggle" data-toggle="dropdown" target="_blank" ><?php echo $data->navigation_name;?><span class="caret"></span><span class="badge badge1">0</span></a>
                        <div class="dropdown-menu dropdown-menu1" role="menu">
                       
                        <div class="more">
                            <p><a href="../../chatRoom/frontEnd/chatRoom.php" target="_blank">&lt;&lt;我的私信</a></p>
                            <p><a href="../../secondHands/publishSecondGoods/frontEnd/index.php?iframe=information.php" target="_blank">查看全部消息&gt;&gt;</a></p>
                        </div>
                           
                        </div>
                        <?php 
                            }else{
                            $arr_push = 0;
                            // 设置初始私信数
                            $redis = new Redis();    
                            //实例化Redis数据库
                            $redis->pconnect("localhost","6379");  
                            //长连接redis(这里的长连接是缓存服务器redis长连接不是ajax长连接)
                            $redis->select(1);
                            // 选择1号数据库
                            $sender = $_SESSION['user'];
                            $sql = 'select  user_name from user.user_information where user_name != "'.$sender.'"';
                            // 查询所有用户，不包括当前登陆用户
                            $select = Select::create_singleton();
                            // 获得对象
                            $result = $select->select($sql);
                            // 获得结果集
                            for ($i=0; $row = mysqli_fetch_object($result); $i++) { 
                                    // $redis->set($i,$row->user_name);
                                    // 设置用户到缓存
                                    if( $redis->exists($row->user_name.'to'.$sender) ){
                                    $arr_push ++;
                                    // 获取私信的数目 

                                    }

                            }
                            $count = $arr_push;
                            // 获取私信总数
                            $select = Select::create_singleton();
                            // 获取查询对象
                            $sql_second_count = "select  count(*) as c from user.user_information as u left join (secondhand.goods as g left join  secondhand.goods_comment as c on g.item_number = c.item_number) on u.user_number=g.user_number where u.user_name='".$_SESSION['user']."' and c.comment_isread = 0";
                            $count += $select->page_count($sql_second_count);
                            // 获取有多少条未读二手市场消息
                            $sql_second = "select  c.item_number,c.comment_content,c.comment_time,c.comment_name from user.user_information as u left join (secondhand.goods as g left join  secondhand.goods_comment as c on g.item_number = c.item_number) on u.user_number=g.user_number where u.user_name='".$_SESSION['user']."' and c.comment_isread = 0";
                            // 查看当前用户的商品留言信息
                            $result_second = $select->select($sql_second);
                            // 获取二手市场未读消息的结果集
                            $sql_treehole_publish_content_count = "select count(*) as c from makefriend.tree_publish p LEFT JOIN makefriend.treehole t ON t.h_id = p.p_number  where t.h_name = '".$_SESSION['user']."' and p.p_content_is_read = 0 and p.p_getter = ''";
                            $count += $select->page_count($sql_treehole_publish_content_count);
                            // 获取有多少条发布的树洞回复数量(这里不包括里面互相回复的数量)
                            $sql_treehole_publish_content = "select p.p_sender,p.p_content,p.p_number from makefriend.tree_publish p LEFT JOIN makefriend.treehole t ON t.h_id = p.p_number  where t.h_name = '".$_SESSION['user']."' and p.p_content_is_read = 0 and p.p_getter = ''";
                            $result_treehole_publish_content = $select->select($sql_treehole_publish_content);
                            // 获取发布树洞的结果集
                            $sql_treehole_each_publish_count = "select count(*) as c from makefriend.tree_publish p LEFT JOIN makefriend.treehole t ON t.h_id = p.p_number  where p.p_content_is_read = 0 and p.p_getter =  '".$_SESSION['user']."'";
                            $count += $select->page_count($sql_treehole_each_publish_count);
                            // 获取在其他帖子回复我的数量
                            $sql_treehole_each_publish = "select p.p_sender,p.p_content,p.p_number from makefriend.tree_publish p LEFT JOIN makefriend.treehole t ON t.h_id = p.p_number  where p.p_content_is_read = 0 and p.p_getter = '".$_SESSION['user']."'";
                            $result_treehole_each_publish = $select->select($sql_treehole_each_publish);
                            // 获取在其他帖子回复我的结果集
                            $result_study_note_reply_count = "select count(*) as c from study_note.study_publish p LEFT JOIN study_note.study_reply r ON p.s_id = r.r_number  where r.r_content_is_read = 0 and p.s_name = '" . $_SESSION['user'] ."'";
                            $count += $select->page_count($result_study_note_reply_count);
                            // 获取回复学霸笔记的总数
                            $sql_result_study_note_reply = "select s_id,s_title,r_sender from study_note.study_publish p LEFT JOIN study_note.study_reply r ON p.s_id = r.r_number  where r.r_content_is_read = 0 and p.s_name = '" . $_SESSION['user'] ."'";
                            $result_study_note_reply = $select->select($sql_result_study_note_reply);
                            // 获取在学霸笔记回复我的结果集
                            
                        ?>
                         <a href="<?php echo $data->navigation_url;?>" class="dropdown-toggle" data-toggle="dropdown" target="_blank" ><?php echo $data->navigation_name;?><span class="caret"></span><span class="badge badge1"><?php echo $count;?></span></a>
                         <div class="dropdown-menu dropdown-menu1" role="menu">
                         <div class="more">
                                <p><a href="../../chatRoom/frontEnd/chatRoom.php" target="_blank">&lt;&lt;我的私信</a></p>
                                <p><a href="../../secondHands/publishSecondGoods/frontEnd/index.php?iframe=information.php" target="_blank">查看全部消息&gt;&gt;</a></p>
                         </div>
                            <?php 
                                if($arr_push){
                            ?>
                            <div class="main">
                                <a href="../../chatRoom/frontEnd/chatRoom.php" target="_blank" >有你的<?php echo $arr_push;?>条私信</a>
                            </div> 
                            <?php }?>
                            <?php 
                                while(($data_study_note = mysqli_fetch_object($result_study_note_reply)) && $data_study_note->s_title){
                            ?>
                            <div class="main">
                                <a href=""><?php echo $data_study_note->r_sender;?></a><a href="../../mySchool/frontEnd/details.php?number=<?php echo $data_study_note->s_id; ?>" target="_blank" >在你的主题<?php echo $data_study_note->s_title;?>回复了你的信息</a>
                            </div>
                            <?php }?>
                            <!-- 学霸笔记的未读消息-->                         
                            <?php 
                                while(($data_second = mysqli_fetch_object($result_second)) && $data_second->comment_content){
                            ?>
                            <div class="main">
                                <a href=""><?php echo $data_second->comment_name;?></a><a href="../../secondHands/index/details.php?item_number=<?php echo $data_second->item_number; ?>" target="_blank" >在二手市场给你有留言</a>
                            </div>
                            <?php }?>
                            <!-- 二手市场的未读消息-->
                            <?php 
                                while(($data_treehole_publish_content = mysqli_fetch_object($result_treehole_publish_content)) && $data_treehole_publish_content->p_sender){
                            ?>
                            <div class="main">
                                <a href=""><?php echo $data_treehole_publish_content->p_sender;?></a>在树洞回复你<a href="../../makeFriends/frontEnd/treeHole.php?p_number=<?php echo $data_treehole_publish_content->p_number; ?>" target="_blank" ><?php echo $data_treehole_publish_content->p_content; ?></a>
                            </div>
                            <?php }?>
                            <!-- 回复树洞的未读消息-->
                            <?php 
                                while(($data_treehole_each_publish = mysqli_fetch_object($result_treehole_each_publish)) && $data_treehole_each_publish->p_sender){
                            ?>
                            <div class="main">
                                <a href=""><?php echo $data_treehole_each_publish->p_sender;?></a>在树洞回复你<a href="../../makeFriends/frontEnd/treeHole.php?p_number=<?php echo $data_treehole_each_publish->p_number; ?>" target="_blank" ><?php echo $data_treehole_each_publish->p_content; ?></a>
                            </div>
                            <?php }?>
                            <!-- 树洞里互相回复的未读消息-->
                            </div>
                        <?php }?>
                    </li>
                    <?php }else{?>
                    <li><a href="<?php echo $data->navigation_url;?>" target="_blank"><?php echo $data->navigation_name;?></a></li>

                    <?php }}?>
                   
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!isset($_SESSION['user'])){ ?>
                    <li><a href="#" id="example">登录</a></li>
                    <?php }else{  
                        $sql_user_photo = "select user_photo from user.user_information where user_name = '" . $_SESSION['user'] . "'";
                        // 查询所有的导航信息
                        $u_photo = $select->select($sql_user_photo);
                    ?>
                    <span style="display:none;" id="u_photo"><?php echo mysqli_fetch_object($u_photo)->user_photo; ?></span>
                    <li><a id="user"><?php echo $_SESSION['user']; ?></a></li>
                    <?php  } ?>
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
                                <input type="password" id="txtPwd" placeholder="密码" />
                            </span>
                            <a href="javascript:void(0)" title="提示" class="warning" id="warn2">*</a>
                        </div>

                        <center><div id="drag"></div></center>
                        <script type="text/javascript">
                            $('#drag').drag();
                        </script>
                        <div align="center">
                            <form>
                                <button herf="#"  type="button" class="btn btn-primary" disabled="disabled" id="loginbtn">登录</button>
                            </form>
                        </div>
                    </div>
                    <li><a href="../../register/register.html" target="_blank">注册</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--     nav over -->

    <!--     nav over -->
    <!-- 响应式轮播图 -->
    <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
    <?php  
            $sql="select banner_picture from secondhand.index_banner order by banner_sort ";
            // 升序拉去所有banner图片
            $select = Select::create_singleton();
            // 获得查询对象
            $result = $select->select($sql);
            //查询详情的数据
            $flag = true;
            // 设置一个标记
            while ($data = mysqli_fetch_object($result)) {
            // 循环数据
                if ($flag) {
                echo '<div class="item active" style="background:#223240;"><a><img src="../img/'.$data->banner_picture.'" ></a></div>';
                $flag = false;
                }
                // 第一张图片要设置为active，所以添加了一个标记
                else{
                echo '<div class="item"  style="background:#223240;"><a><img src="../img/'.$data->banner_picture.'" ></a></div>';
                }
                // 其余的图片不需要active
            }
             ?>
    </div>
          
   <!--      <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0"
            class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol> -->

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
            <li><a>主页</a></li>
            <li><a>二手物品</a></li>
            <li class="active"><a>最新闲置</a></li>
            <li><a>了解更多</a></li>
        </ol>

        <div class="row">
    <?php 
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
              <img src="../publishSecondGoods/goodsImg/images/<?php echo $picture ?> " alt="goods">
              <!-- 输出第一张图片 -->
              <div class="caption">
                <h3> <?php echo $data->title ?> </h3>
                <!-- 输出标题 -->
                <p>￥：<?php echo $data->price ?> </p>
                <!-- 输出价格 -->
                <p>
                    <a class="btn btn-primary" role="button" href="details.php?item_number=<?php echo $data->item_number; ?> "  target='_blank' >详情信息</a>
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
            <li class="active"><a href="secondHands.php">全部商品</a></li>
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
                            echo ' <a href="../publishSecondGoods/frontEnd/index.php?iframe=publishGoods.php" target="_blank" class="hidden-xs">我要发布</a>';
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
                    $category =  isset($_GET['category_name'])?sql_injection($_GET['category_name']):null;
                    // 接收分类信息
                    function sql_injection($category_name){
                    if(!is_numeric($category_name)){
                    echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请遵守网络安全法！', {
                    btn: ['确定'], //按钮
                    icon: 5
                    }, function(){
                    window.location.href='secondHands.php';
                    });  });</script>";
                    exit();
                    }
                    // 防sql注入
                    return $category_name;
                    }

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
                        <a class="pull-left" href="details.php?item_number=<?php echo $data->item_number ?>" target='_blank'>
                                 <?php 
                                   $picture = $data->picture; 
                                   // 获取图片
                                   $arr = explode("@",$picture);
                                   // 分离图片
                                 ?>
                            <img  class="media-object" src="../publishSecondGoods/goodsImg/images/<?php echo $arr[0] ?> " height="100" width="100"
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
                <script>
                $(function() {
                    $('.pagination li a').click(function() { 
                        var page = $(this).attr('data-page');
                        window.location.href = 'secondHands.php?page=' + page;
                    });
                });
                </script>
                <ul class="pagination">
                    <?php 
                        $myPage=new pager(1,1);
                        // 输入两个1占位置。懒得修改分页类代码了     
                        echo $myPage->pagination($page,$count,$show_data)['html'];
                    }
                    else{
                        echo "<p class='no-content' >
                        当前分类没有任何商品！
                        </p>";
                        // 没有数据就给用户提醒
                        }
                    ?>
                </ul>
                </div>

            </div>
    </section>
    <!-- section3 over -->
    <?php 
        $select = Select::create_singleton();
        // 获取查询对象
        $sql = "select * from manager.configuration";
        // 获取网站配置信息
        $result = $select->select($sql);
        // 获取查询结果集
        $data = mysqli_fetch_object($result);
     ?>
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
                            <p><?php echo $data->service_hotline; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="box">
                        <img src="../../styles/img/QQ.jpg" height="60" width="60" alt="contact" />
                        <div class="text">
                            <p>在线QQ客服：</p>
                            <p><?php echo $data->service_qq; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="box">
                        <img src="../../styles/img/wechat.jpg" height="60" width="60" alt="contact" />
                        <div class="text">
                            <p>关注官方微信：</p>
                            <p><?php echo $data->service_wechat; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="box">
                        <img src="../../styles/img/weibo.jpg" height="60" width="60" alt="contact" />
                        <div class="text">
                            <p>新浪微博：</p>
                            <p><?php echo $data->service_weibo; ?></p>
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
            <p><?php echo $data->copy_right; ?></p>
        </div>
    </footer>
    <!-- 百度统计代码 -->
    <?php  echo $data->baidu_statistics;  ?>
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-1.11.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>

    <script type="text/javascript" src="../../styles/plugins/loginDialog/js/popupBox.js"></script>
    <script src="../../styles/js/login.js"></script>
</body>
</html>
