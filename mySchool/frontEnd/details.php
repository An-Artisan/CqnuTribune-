<!-- /**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-25
* @Content: 交友论坛-贴吧
* @Last Modified time: 2016-11-25
* ================================================
*/ -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>笔记详情</title>
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
    <script src="../js/details.js"></script>
    <link rel="stylesheet" type="text/css" href="../../styles/Editor/dist/css/wangEditor.min.css">
    <!--当前页面自定义css -->
    <link rel="stylesheet" type="text/css" href="../css/details.css">
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
                        window.location.href='mySchool.php';
                        });  });</script>";
                    exit();
                }
                // // 防sql注入
                session_start();
                $number = $_GET['number'];
                // 获取商品编号
                if(!isset($_GET['number'])||!isset($_SESSION['user'])){
                  echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请先登录后再试~', {
                        btn: ['确定'], //按钮
                        icon: 5
                        }, function(){
                        window.location.href='mySchool.php';
                        });  });</script>";
                  exit();
                  // 如果用户直接赋值的链接进来，表示没有传item_number值，就提示用户登陆后在试试
            }
            if(!is_numeric($number)){
                echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请遵守网络安全法！', {
                    btn: ['确定'], //按钮
                    icon: 5
                    }, function(){
                    window.location.href='mySchool.php';
                    });  });</script>";
                exit();
            }
            // 防sql注入

            ?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul id="ul1" class="nav navbar-nav">
                    <?php 
                        require '../../cqnu.class/all.class/all.class.php';
                        // 引用所有类
                        $select = Select::create_singleton();
                        // 获取查询对象
                        $sql_content_is_read = "update study_note.study_reply set r_content_is_read = 1 where r_number = ".$number." and r_getter = '".$_SESSION['user']."'";
                        // 修改未读信息为已读信息
                        $select->select($sql_content_is_read);
                        // 执行查询
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
    <?php
    $select = Select::create_singleton();
    // 获取查询对象
    $number = $_GET['number'];
    $sql = "select s_id,s_title,s_content,s_name,s_picture,s_time,u.user_photo from user.user_information as u left join study_note.study_publish as s on s.s_name = u.user_name where s.s_id = " . $number;
    // 查询所有的导航信息
    $result = $select->select($sql);
    // 获取结果集
    $data = mysqli_fetch_object($result);
    // 获取数据

    ?>
    <section id="section2">
        <div id="s_id" style="display:none"><?php echo $number; ?></div>
        <div class="title">
            <h4><?php echo $data->s_title;?></h4>
        </div>
        <div id="list" class="container-fluid container-fluid1">
            <div class="box row">
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <img src="../../register/img/<?php echo $data->user_photo;?>" alt="" class="head">
                    <p class="owner"><span class="glyphicon glyphicon-user"></span>楼主</p>
                    <p class="name" id="name"><?php echo $data->s_name;?></p>
                    <a href="../../chatRoom/frontEnd/chatRoom.php?user=<?php echo $data->s_name;?>" target="_blank"><button type="button" class="btn btn-primary btn-sm">私信</button></a>
                </div>
                <div class="content col-md-10 col-sm-10 col-xs-10">
                    <div class="main">
                        <p class="line"><?php echo $data->s_content;?></p>
                        <!-- <img src="../../register/img/<?php echo $data->user_photo;?>" alt="" class="pic"> -->
                        <?php 
                           $picture = $data->s_picture; 
                           // 获取图片
                           $arr = explode("@",$picture);
                           // 分离图片
                           $length = count($arr)-1;
                           // 这里一定要减一，因为最后一个数组是空字符串
                           for ($i = 0; $i < $length; $i++) {
                            // 循环图片
                        ?>
                        <img src="../images/<?php echo $arr[$i] ?>" alt="">
                        <?php } 
                            // 输出图片到界面上，结束循环
                        ?>
                       
                        
                    </div>
                </div>
            </div>
            <?php
                $show_data = 6;
                // 每页显示一条记录
                $sql = "select count(*) as c from user.user_information as u left join study_note.study_reply as s on s.r_sender = u.user_name where s.r_number = " . $number;  
                $count = $select->page_count($sql);
                // 获取记录总数
                $page = isset($_GET['page'])?$_GET['page']:1;
                // 获取地址栏的分页 
                $sql_reply = "select r_number,r_sender,r_content,r_getter,r_time,u.user_photo from user.user_information as u left join study_note.study_reply as s on s.r_sender = u.user_name where s.r_number = " . $number ." order by r_time limit " . ($page - 1) * $show_data . ", $show_data";
                 // 查询所有的导航信息
                $result_reply = $select->select($sql_reply);
                // 获取结果集
                while ($data_reply = mysqli_fetch_object($result_reply)){
                // 获取数据
             ?>
            <div class="box row">
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <img src="../../register/img/<?php echo $data_reply->user_photo;?>" alt="" class="head">
                    <p class="name"><?php echo $data_reply->r_sender;?></p>
                    <a href="../../chatRoom/frontEnd/chatRoom.php?user=<?php echo $data_reply->r_sender;?>" target="_blank"><button type="button" class="btn btn-primary btn-sm">私信</button></a>
                </div>
                <div class="content col-md-10 col-sm-10 col-xs-10">
                    <div class="main">
                        <p class="line"><?php echo $data_reply->r_content;?></p>
                        <div class="info">
                            <p class="time"><?php echo $data_reply->r_time;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        <form action="../backStage/replyNote.php" method="post" >
        <textarea id="textarea1" name="content" style="height:150px !important;">
        
        </textarea>
        <input type="hidden" name="s_id" value="<?php echo $data->s_id;?>" />
        <input type="hidden" name="s_name" value="<?php echo $data->s_name;?>" />
        <input type="submit" name="submit" class="btn btn-info" value="发表" />
        </form>
        <script>
        $(function() {
            $('.pagination li a').click(function() { 
                if(!$(this).attr('class')){
                var page = $(this).attr('data-page');
                window.location.href = 'details.php?page=' + page + '&number=' + $('#s_id').text();
                }
            });
        });
        </script>
        <?php 
            $myPage=new pager(1,1);
            // 输入两个1占位置。懒得修改分页类代码了     
            echo $myPage->pagination($page,$count,$show_data)['html'];
        ?>
    </section>
    
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
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
    <!-- 登录滑块js -->
    <script type="text/javascript" src="../../styles/plugins/loginDialog/js/popupBox.js"></script>
    <!-- 顶部导航条active -->
    <script type="text/javascript" src="../../styles/js/setting.js"></script>

    <!--引入jquery和wangEditor.js-->
    <script type="text/javascript" src="../../styles/Editor/dist/js/lib/jquery-2.2.1.js"></script>
    <script type="text/javascript" src="../../styles/Editor/dist/js/wangEditor.js"></script>
    <script type="text/javascript" src="../js/userDefined.js"></script>

</body>
</html>
