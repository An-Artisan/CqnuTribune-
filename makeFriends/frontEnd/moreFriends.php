<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-20
* @Content: 交友论坛-更多朋友搜索界面
* @Last Modified time: 2016-11-20
* ================================================
*/ -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>更多朋友</title>
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
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>
    <!--当前页面自定义css -->
    <link rel="stylesheet" type="text/css" href="../css/moreFriends.css">
</head>
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
                $gender = isset($_GET['gender'])?$_GET['gender']:null;
                // 获取分页
                if(!($gender == '男' || $gender == '女') && $gender != null){
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
                        require '../../cqnu.class/all.class/all.class.php';
                        $select = Select::create_singleton();
                         // 获取查询对象
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
        <div class="search row">
            <div class="wrapper">
                <div class="part part1">
                    <span class="glyphicon glyphicon-search">&nbsp;我要找</span>
                    <select class="select1" id="gender">
                        <option selected="slected" value="">请选择</option>
                        <option  value="男">男生</option>
                        <option value="女">女生</option>
                    </select>
                </div>
                <button id="search" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                    搜索
                </button>
            </div>
        </div>
        
        <div id="result" class="search-result">
            <div class="row">
            <?php
            if(isset($_GET['gender'])){ 
            $sql = "select * from user.user_information where user_gender = '".$_GET['gender']."' order by user_name";
            // 查询性别
            }else{
            $sql = "select * from user.user_information";
            // 查询所有的用户
            }
            $result = $select->select($sql);
            // 获取结果集
            while ($data = mysqli_fetch_object($result)) {
                // 获取数据
            ?>
                <div class="col-md-2 col-sm-3 col-xs-4 one">
                    <img src="../../register/img/<?php echo $data->user_photo; ?>" alt="">
                    <p><?php echo $data->user_signature; ?></p>
                    <div class="info">
                        <div class="intro">
                            <p><a href="../../chatRoom/frontEnd/chatRoom.php?user=<?php echo $data->user_name;?>" target="_blank"><?php echo $data->user_name;?></a></p>
                        </div>
                    </div>
                </div>
            <?php }?>
            </div>
            </div>
    </section>
    <!-- section2 over -->


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
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
    <!-- 登录滑块js -->
    <script src="../../styles/js/login.js"></script>
    <!-- 登录 -->
    <script type="text/javascript" src="../../styles/plugins/loginDialog/js/popupBox.js"></script>
    <!-- 顶部导航条active -->
    <script type="text/javascript" src="../../styles/js/setting.js"></script>
    <script type="text/javascript" src="../js/moreFriends.js"></script>
</html>
