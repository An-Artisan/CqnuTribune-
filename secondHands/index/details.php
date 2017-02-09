<!--
/**
* ================================================
* title：details.html
* time: 2016-10-7
* author: 杨凤玲
* content: 商品细节以及评论
* ================================================
*/
-->
<!DOCTYPE html>
<html>
<head>
    <title>二手平台/详情信息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../styles/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../../styles/css/bootstrap.css" >
    <!-- 自定义 css -->
    <link rel="stylesheet" href="../../styles/css/reset.css">
    <link rel="stylesheet" href="../css/details.css">

    <!-- 引用插件css -->
    <link rel="Stylesheet" href="../../styles/plugins/loginDialog/css/loginDialog.css" />
    <link rel="stylesheet" href="../../styles/plugins/slide/css/drag.css">
    <script src="../../styles/plugins/slide/js/jquery-1.7.2.min.js"></script>
    <script src="../../styles/plugins/slide/js/drag.js"></script>
    
    <script type="text/javascript" src="../plugins/Superslide/JS_nEW/jquery.SuperSlide.2.1.js"></script>
    
    <!-- 商品轮播 css -->
    <link rel="stylesheet" type="text/css" href="../plugins/Superslide/css_new/reset_new.css">

    <link rel="stylesheet" type="text/css" href="../../styles/Editor/dist/css/wangEditor.min.css">
    <link rel="stylesheet" href="../css/secondHands.css">
    <!-- layer框架 -->
    <script type="text/javascript" src="../../styles/layui/layui.js"></script>
    <script src="../../styles/js/loading.js"></script>
</head>
<body>
<?php 
  session_start();
  require '../../cqnu.class/all.class/all.class.php';
    // 引用所有类
  $select = Select::create_singleton();
    // 获取查询对象
  if(!isset($_GET['item_number'])||!isset($_SESSION['user'])){
      echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请先登录后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            window.location.href='secondHands.php';
            });  });</script>";
      exit();
      // 如果用户直接赋值的链接进来，表示没有传item_number值，就提示用户登陆后在试试
 }
 ?>
    
<div id="item_number" style="display:none;" ><?php echo $_GET['item_number']; ?></div>
    
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

    <?php 
    $item_number = $_GET['item_number'];
    // 获取商品编号
    if(!is_numeric($item_number)){
        echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请遵守网络安全法！', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            window.location.href='secondHands.php';
            });  });</script>";
        exit();
    }
    // 防sql注入

    $select = Select::create_singleton(); 
    // 获得查询对象
    $sql = "select count(*) as c from secondhand.goods where item_number = " . $item_number;
    if(!$select->page_count($sql)){
        echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('该商品不存在！', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            window.location.href='secondHands.php';
            });  });</script>";
        exit();
    }
    // 防止用户篡改$_GET 信息
    $sql = "update secondhand.goods set click_rate = click_rate+1 where item_number = $item_number ";
    $select->query($sql);
    // 添加点击率
    $sql="select item_number,b.user_number,picture,description,user_phone,title,price,prime_cost,bargained,click_rate,shelves,user_name,start_time,stop_time,address from  secondhand.goods a left join user.user_information b  on a.user_number=b.user_number where a.item_number = '".$item_number."'";
    // 联合查询此商品的数据
    $result = $select->select($sql);
    //查询详情的结果集
    $data = mysqli_fetch_object($result);    
    // 获取这条商品的详细信息
     ?>
    <section id="goods" class="goods">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 img">
                    <div class="wall">
                        <div class="focusBox">
                            <ul class="pic">
                             <?php 
                                   $picture = $data->picture; 
                                   // 获取图片
                                   $arr = explode("@",$picture);
                                   // 分离图片
                                   $length = count($arr)-1;
                                   // 这里一定要减一，因为最后一个数组是空字符串
                                   for ($i = 0; $i < $length; $i++) {
                                    // 循环图片
                                 ?>
                                <li><a><img src="../publishSecondGoods/goodsImg/images/<?php echo $arr[$i] ?> "/></a></li>
                                <?php } 
                                // 输出图片到界面上，结束循环
                                ?>
                            </ul>
                             <a class="prev" href="javascript:void(0)"></a>
                            <a class="next" href="javascript:void(0)"></a>
                            <ul class="hd">
                             <?php for ($i=0; $i < $length; $i++) { 
                                // 循环图片下面的小圆点
                             ?>
                              <li></li>
                              <?php }?>
                              <!-- 结束循环 -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="title">
                        <h1> <?php echo $data->title ?> </h1>
                        <!-- 输出标题 -->
                    </div>
                    <div class="price">
                         <p>现价<span>¥<?php echo $data->price ?></span></p>
                        <!-- 输出现价 -->
                        <p>原价：<s>¥<?php echo $data->prime_cost ?></s></p>
                        <!-- 输出原价 -->
                        <p>|<i class="glyphicon glyphicon-phone-alt"></i>
                            <?php echo $data->user_phone ?>
                            <!-- 输出联系人电话 -->
                        </p>
                    </div>
                    <div class="description col-xs-12">
                        <p><span>描述：</span> <?php echo $data->description ?></p>
                    </div>
                    <div class="more col-xs-12">
                        <div class="table-responsive">
                          <table class="table" >
                              <thead>
                                <th>点击率</th>
                                <th>可否小刀</th>
                                <th>是否下架</th>
                                <th>发布用户</th>
                                <th>发布时间</th>
                                <th>结束时间</th>
                                <th>发布地址</th>
                              </thead>
                              <tr>
                                <td> <?php echo $data->click_rate ?> </td>
                                <!-- 点击率 -->
                                <td> <?php echo $data->bargained ?> </td>
                                <!-- 是否小刀 -->
                                <td> <?php echo $data->shelves ?> </td>
                                <!-- 是否下架 -->
                                <td> 
                                <?php 
                                    echo $data->user_name;
                                    if($data->user_name == $_SESSION['user']){
                                        $update = Update::create_singleton();
                                        // 实例化更新对象
                                        $arrayName = array('comment_isread' => 1);
                                        // 标记留言为已读
                                        $update->update('secondhand.goods_comment',$arrayName,'item_number','=',$item_number);
                                        // 更新数据
                                    }

                                ?> 
                                </td>
                                <!-- 发布用户 -->
                                <td> <?php echo $data->start_time; ?> </td>
                                <!-- 发布时间 -->
                                <td> 
                                <?php 
                                if($data->stop_time == '0000-00-00 00:00:00'){
                                    echo '未结束';
                                }
                                else{
                                    echo $data->stop_time;
                                }
                                // 如果是默认的时间，就表示交易未结束
                                 ?> 
                                 </td>
                                <td>
                                <?php 
                                $address_id = $data->address;
                                $sql = "select address_name from secondhand.goods_address where address_id = '" . $address_id . "'";
                                // 查询地址
                                $result_address = $select->select($sql);
                                // 获取结果集
                                $data_address = mysqli_fetch_object($result_address);
                                // 获取地址
                                echo $data_address->address_name;
                                // 输出地址
                                 ?>
                                </td>
                              </tr>
                          </table>
                        </div>
                    </div>

                    <div class="button col-xs-12">
                        <button type="button" class="active btn btn-warning col-xs-5 col-sm-4 col-md-4"><?php echo $data->shelves ?></button>
                        <div class="col-xs-2 col-sm-4 col-md-4">
                        </div>
                        <a type="button" href="../../chatRoom/frontEnd/chatRoom.php?user=<?php echo $data->user_name ?>" class="btn btn-info col-xs-5 col-sm-4 col-md-4" target='_blank' >私信卖家</a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-2 col-md-2 hot">
                    <h2><span class="glyphicon glyphicon-stats"></span>热门点击排行</h2>
                    <ol>
                        <?php 
                        $sql="select item_number,title from secondhand.goods order by click_rate desc limit 0,5";
                        // 联合查询此商品的数据
                        $select = Select::create_singleton(); 
                        // 获得查询对象
                        $result = $select->select($sql);
                        //查询详情的结果集
                        while($data = mysqli_fetch_object($result)){
                         ?>
                        <li><a href="details.php?item_number=<?php echo $data->item_number ?>"> <?php echo $data->title ?> </a></li>
                       <?php } ?>
                    </ol>
                    <!-- 点击率最高的五个商品 -->
                </div>
            </div>
        </div>
    </section>
<!--     goods over -->
    
    <section id="content" class="container-fluid content">
      <div class="row prompt">
            <p>商品评价</p>
            <div class="rightarrow"></div>
        </div>
    <?php 
                    $show_data= 4;
                    //一页显示多少记录
                    $sql = "select count(*) as c  from secondhand.goods_comment a inner join `user`.user_information b on a.comment_name = b.user_name where a.item_number = $item_number";
                    $count = $select->page_count($sql);
                    //获取表记录总数
                    if ($count) {
                     $page = isset($_GET['page'])?$_GET['page']:1;
                        //如果没有接收到浏览器传过来的参数，说明就是首页。
                     $sql = "select comment_time,comment_content,comment_name,user_photo  from secondhand.goods_comment a inner join `user`.user_information b on a.comment_name = b.user_name where a.item_number = $item_number order by comment_time desc limit " . ($page - 1) * $show_data . ", $show_data";
                    // 获取分页数据
                    $result = $select->select($sql);
                    //=====循环这些数据=====
                    while($data = mysqli_fetch_object($result)) {

     ?>
        <div class="row">
            <div class="col-xs-3">
                    <img class="img-responsive" src="../../register/img/<?php echo $data->user_photo; ?>"/>
                    <button class="btn button-default">
                        <a href="../../chatRoom/frontEnd/chatRoom.php?user=<?php echo $data->comment_name; ?>" target="_blank" >私信</a>
                    </button>
                    <p><a href="#">用户名：<?php echo $data->comment_name; ?> </a></p>
                </div>
            <div class="col-xs-9">
                <div class="time">
                    <p>回复于： <?php echo $data->comment_time; ?> </p>
                </div>
                <div class="content">
                    <p><?php echo $data->comment_content; ?></p>
                </div>
            </div>
        </div>
        <?php }?>
        <!-- 结束循环 -->
               <div  class="page">
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
                            echo '  <div class="row message"><div class="no-content"><p>当前商品没有任何评论，快来第一个评论吧~~</p></div></div>';
                            // 没有数据就给用户提醒
                        }
                    ?>
                </ul>
                </div>

            </div>
            <div class="row">
            <div id="editor">
                <div id="div1" class="div1">
                <p></p>
                </div>
               <button  id="submit" type="button" class="btn btn-default">提交</button>
            </div>
        </div>
    </section>
    <!--     content over -->

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

    <script type="text/javascript" src="../../styles/plugins/loginDialog/js/popupBox.js"></script>
    <script type="text/javascript" src="../plugins/Superslide/JS_nEW/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="../plugins/Superslide/JS_nEW/jquery.SuperSlide.2.1.js"></script>
    <script type="text/javascript" src="../plugins/Superslide/JS_nEW/goodPlay.js"></script>

    <!--引入jquery和wangEditor.js-->
    <script type="text/javascript" src="../../styles/Editor/dist/js/wangEditor.js"></script>
    <script type="text/javascript" src="../js/userDefined.js"></script>
    <script type="text/javascript" src="../js/details.js"></script>
    <script type="text/javascript" src="../../styles/js/setting.js"></script>

</body>
</html>