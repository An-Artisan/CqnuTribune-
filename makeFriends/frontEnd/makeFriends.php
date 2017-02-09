<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-15
* @Content: 交友论坛
* @Last Modified time: 2016-11-19
* ================================================
*/ -->
<!DOCTYPE html>
<html>
<head>
<?php 
    require '../../cqnu.class/all.class/all.class.php';
    // 引用所有类
     $select = Select::create_singleton();
    // 获取查询对象
    $sql = "select * from manager.seo where seo_name = '重师论坛' order by seo_id";
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>交友论坛</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../../styles/css/bootstrap.min.css">
    <!-- 重置css -->
    <link rel="stylesheet" type="text/css" href="../../styles/css/reset.css">
    <!-- 引用插件css -->
    <link rel="Stylesheet" href="../../styles/plugins/loginDialog/css/loginDialog.css" />
    <!-- 登录弹窗及滑块 -->
    <link rel="stylesheet" href="../../styles/plugins/slide/css/drag.css">
    <script src="../../styles/plugins/slide/js/jquery-1.7.2.min.js"></script>
    <script src="../../styles/plugins/slide/js/drag.js"></script>
    <link rel="stylesheet" type="text/css" href="../../styles/Editor/dist/css/wangEditor.css">
    <!-- 照片墙 -->
     <!-- layer框架 -->
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="../plugins/photoWall/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../plugins/photoWall/css/style.css" />
    <script type="text/javascript" src="../plugins/photoWall/js/modernizr.custom.26633.js"></script>
    <noscript>
        <link rel="stylesheet" type="text/css" href="../plugins/photoWall/css/fallback.css" />
    </noscript>
    <!--当前页面自定义css -->
    <link rel="stylesheet" type="text/css" href="../css/makeFriend.css">
    <script src="../js/publishTreeHole.js"></script>
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
            <?php   
                $page = isset($_GET['page'])?$_GET['page']:null;
                // 获取分页
                if(!is_numeric($page) && $page != null){
                    echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请遵守网络安全法！', {
                        btn: ['确定'], //按钮
                        icon: 5
                        }, function(){
                        window.location.href='makeFriends.php';
                        });  });</script>";
                    exit();
                }
                // 防sql注入
            ?>
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
                            // 获取当前用户
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

    <section id="section1" class="jumbotron">
        <div class="text">
            <p>Nice To Meet You</p>
            <p>The new website immedately online</p>
            <p>Mahter and child care</p>
        </div>
    </section>
    <!-- section1 over -->

    <section id="section2" class="container-fluid">
        <div class="search">
            <button class="btn btn-group btn-group-sm">男生</button>
            <button class="btn btn-group btn-group-sm">女生</button>
            <button class="btn btn-group btn-group-sm">随机</button>
            <button class="btn btn-group btn-group-sm" onclick="window.location.href='moreFriends.php'">更多朋友</button>
        </div>
        <div class="container">
            <section class="main">
                <div id="ri-grid" class="ri-grid ri-grid-size-2">
                    <ul>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/1.jpg"></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/2.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/3.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/4.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/5.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/6.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/7.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/8.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/9.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/10.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/11.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/12.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/13.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/14.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/15.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/16.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/17.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/18.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/19.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/20.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/21.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/22.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/23.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/24.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/25.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/26.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/27.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/28.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/29.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/30.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/31.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/32.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/33.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/34.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/35.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/36.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/37.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/38.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/39.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/40.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/41.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/42.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/43.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/44.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/45.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/46.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/47.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/48.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/49.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/50.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/51.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/52.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/53.jpg"/></a></li>
                        <li><a href="#"><img src="../plugins/photoWall/images/medium/54.jpg"/></a></li>
                    </ul>
                </div>
            </section>
        </div>
    </section>
    <!-- section2 over -->

    <section id="section3" class="container-fluid">
        <div class="row">
            <div class="">
                <h2>树洞心情</h2>
                <div id="list" class="container-fluid container-fluid1">
                 <?php 
                    
                    $show_data = 1;
                    $sql = "select count(*) as c from makefriend.treehole t  left join user.user_information u on t.h_name = u.user_name";   
                    $count = $select->page_count($sql);
                    $page = isset($_GET['page'])?$_GET['page']:1;
                    $sql = "select t.h_id,t.h_content,t.h_name,t.h_praise,t.h_time ,u.user_photo from makefriend.treehole t  left join user.user_information u on t.h_name = u.user_name  limit " . ($page - 1) * $show_data . ", $show_data";
                    // 查询所有的导航信息
                    $result = $select->select($sql);
                    // 获取结果集
                    while ($data = mysqli_fetch_object($result)) {
                 ?>

                    <div class="box row">
                        <a class="close" href="javascript:;">×</a>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                           <img  style="width:70px;height:70px;" src="../../register/img/<?php echo $data->user_photo;?>"  alt="" class="head">
                           <p class="username"><?php echo $data->h_name; ?></p>
                           <span style="display:none;"><?php echo $data->h_id;?></span>
                        </div>
                        <div class="content col-md-10 col-sm-10 col-xs-10">
                            <div class="main">
                                <p class="line"><?php echo $data->h_content; ?></p>
                                <img alt="" class="pic">
                                <div class="info">
                                    <p class="time"><?php echo $data->h_time; ?></p>
                                    <?php if(strstr($data->h_praise, @$_SESSION['user'])){ ?>
                                    <a class="praise" href="javascript:;">已赞</a>
                                    <?php }else{?>
                                    <a class="praise" href="javascript:;">赞</a>
                                    <?php }?>
                                    <a class="comment-more" href="javascript:;" title="">全部评论</a>
                                </div>
                                <div class="praise-total" total="<?php echo count(explode('&',$data->h_praise))-1; ?>" style="display: display;">
                                     <?php echo count(explode('&',$data->h_praise))-1;?>个人觉得很赞 
                                </div>
                                <div id="comment-main" class="comment-main" style="display: none;">
                                    <div class="comment">
                                        <?php
                                            $sql_reply = "select t.p_id,t.p_content,t.p_sender,t.p_getter,t.p_praise,t.p_time,u.user_photo from makefriend.tree_publish t  left join user.user_information u on t.p_sender = u.user_name where p_number = " . $data->h_id . " order by p_time";
                                            $result_reply = $select->select($sql_reply);
                                            // 获取结果集
                                            while ($data_reply = mysqli_fetch_object($result_reply)) {
                                        ?>
                                        <div id = "<?php echo $data_reply->p_id;?>" class="part row" user="user">
                                            <div class="col-md-1 col-sm-1 col-xs-1">
                                                <img class="head1" src="../../register/img/<?php echo $data_reply->user_photo;?>" alt="">
                                            </div>
                                            <div class="specific col-md-11  col-sm-11  col-md-xs">
                                                <p class="line"><span class='user'>
                                                <?php 
                                                    if($data_reply->p_getter){
                                                        echo $data_reply->p_sender . '</span><span style="color:#369;">回复' . $data_reply->p_getter . ':</span>';
                                                    }else{
                                                        echo  $data_reply->p_sender;
                                                    }
                                                ?>
                                                </span><?php echo $data_reply->p_content;?></p>
                                                <div class="info1">
                                                    <p class="time"><?php echo $data_reply->p_time;?></p>
                                                    <?php
                                                        if($data_reply->p_sender == $_SESSION['user']){
                                                    ?>
                                                    <a href="javascript:;" class="comment-operate">删除</a>
                                                    <?php }else{?>
                                                    <a href="javascript:;" class="comment-operate">回复</a>
                                                    <?php }?>
                                                    <?php if(strstr($data_reply->p_praise, $_SESSION['user'])){ ?>
                                                    <a href="javascript:;" class="comment-praise"  style="display:inline-block;"><?php echo count(explode('&',$data_reply->p_praise))-1;?>赞/已赞</a>
                                                    <?php }else{?>
                                                    <a href="javascript:;" class="comment-praise" total="<?php echo count(explode('&',$data_reply->p_praise))-1;?>" my="0" style="display:inline-block;"><?php echo count(explode('&',$data_reply->p_praise))-1;?>赞</a>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }?>
                                      

                                    </div>
                                    <div class="text-box">
                                        <textarea class="form-control form-control1" autocomplete="off"></textarea>
                                        <button type="button" class="btn btn-primary btn-sm btn-off">回复</button>
                                        <span class="word">0/140</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <nav>
            <script>
                $(function() {
                    $('.pagination li a').click(function() { 
                        if(!$(this).attr('class')){
                        var page = $(this).attr('data-page');
                        window.location.href = 'makeFriends.php?page=' + page;
                        }
                    });
                });
            </script>
            <?php 
                $myPage=new pager(1,1);
                // 输入两个1占位置。懒得修改分页类代码了     
                echo $myPage->pagination($page,$count,$show_data)['html'];
             ?>
                
            </nav>
            <div class="col-md-12 col-sm-12 col-xs-12 editor">
                <div>
                    <div id="div1" >
                    <p></p>
                    </div>
                </div>
                <button type="" id="publishTreeHole" class="btn btn-default">提交</button>
            </div>
        </div>
    </section>
    <!-- section3 over -->

    <section id="section6" class="container-fluid section6">
        <div class="row">
            <div class="txt col-md-6">
                <h3>你知道我在这里等你吗......</h3>
                <p>One is always on a strange road, watching strange scenery and listening to strange music.Then one day, </p>
                <p>you will find that the things you try hard to forget are already gone.</p>
                <p>I love and am used to keeping a distance with those changed things、Only in this way can I know what will not be abandoned by time.Forexample, when you love someone,</p>
                <p>changes are all around.Then I stepbackward and watching it silently, then I see the true feelings.</p>
            </div>
            <div class="photo col-md-6">
                <img src="../img/heart2.png" class="img-responsive" alt="Responsive image">
            </div>
        </div>
    </section>
    <!-- section6 over -->

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
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/login.js"></script>
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
    <!-- 登录滑块js -->
    <script type="text/javascript" src="../../styles/plugins/loginDialog/js/popupBox.js"></script>
    <!-- 顶部导航条active -->
    <script type="text/javascript" src="../../styles/js/setting.js"></script>
    
    <script src="../../styles/js/loading.js"></script>
    <!--引入jquery和wangEditor.js-->
    
    <script type="text/javascript" src="../../styles/Editor/dist/js/wangEditor.js"></script>
    <script type="text/javascript" src="../../styles/js/userDefined.js"></script>
    <!-- 照片墙 -->
    <script type="text/javascript" src="../plugins/photoWall/js/jquery.min.js"></script>
    <script type="text/javascript" src="../plugins/photoWall/js/jquery.gridrotator.js"></script>
    <script type="text/javascript" src="../plugins/photoWall/js/userdefined.js"></script>
    <script type="text/javascript" src="../js/makeFriends.js"></script>

</body>
</html>
