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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>交友论坛</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/info.css">
</head>
<body>
    <?php 
    require '../../../cqnu.class/all.class/all.class.php';
    session_start();
    $user = $_SESSION['user'];
    // 获取当前用户
    $arr_push = 0;
    // 设置初始私信数
    $redis = new Redis();    
    //实例化Redis数据库
    $redis->pconnect("localhost","6379");  
    //长连接redis(这里的长连接是缓存服务器redis长连接不是ajax长连接)
    $redis->select(1);
    // 选择1号数据库
    $sql = 'select  user_name from user.user_information where user_name != "'.$user.'"';
    // 查询所有用户，不包括当前登陆用户
    $select = Select::create_singleton();
    // 获得对象
    $result = $select->select($sql);
    // 获得结果集
     for ($i=0; $row = mysqli_fetch_object($result); $i++) { 
            // $redis->set($i,$row->user_name);
            // 设置用户到缓存
            if( $redis->exists($row->user_name.'to'.$user) ){
            $arr_push ++;
            // 获取私信的数目 

            }

    }
    $count = $arr_push;
    // 获取私信总数
    $select = Select::create_singleton();
    // 获取查询对象
    $sql_second_count = "select  count(*) as c from user.user_information as u left join (secondhand.goods as g left join  secondhand.goods_comment as c on g.item_number = c.item_number) on u.user_number=g.user_number where u.user_name='".$_SESSION['user']."' and c.comment_isread = 0";
    $count = $select->page_count($sql_second_count);
    // 获取有多少条未读二手市场消息
    $sql_second = "select  c.item_number,c.comment_content,c.comment_time,c.comment_name from user.user_information as u left join (secondhand.goods as g left join  secondhand.goods_comment as c on g.item_number = c.item_number) on u.user_number=g.user_number where u.user_name='".$_SESSION['user']."' and c.comment_isread = 0 order by comment_isread asc , comment_time desc ";
    // 查看当前用户的商品留言信息
    $result_second = $select->select($sql_second);
    // 获取二手市场未读消息的结果集
    $sql_treehole_publish_content_count = "select count(*) as c from makefriend.tree_publish p LEFT JOIN makefriend.treehole t ON t.h_id = p.p_number  where t.h_name = '".$_SESSION['user']."' and p.p_content_is_read = 0 and p.p_getter = ''";
    $count += $select->page_count($sql_treehole_publish_content_count);
    // 获取有多少条发布的树洞回复数量(这里不包括里面互相回复的数量)
    $sql_treehole_publish_content = "select p.p_sender,p.p_content,p.p_number,p.p_time from makefriend.tree_publish p LEFT JOIN makefriend.treehole t ON t.h_id = p.p_number  where t.h_name = '".$_SESSION['user']."' and p.p_content_is_read = 0 and p.p_getter = '' order by p_time desc";
    $result_treehole_publish_content = $select->select($sql_treehole_publish_content);
    // 获取回复树洞的结果集
    $sql_treehole_each_publish_count = "select count(*) as c from makefriend.tree_publish p LEFT JOIN makefriend.treehole t ON t.h_id = p.p_number  where t.h_name = '".$_SESSION['user']."' and p.p_content_is_read = 0 and p.p_getter != ''";
    $count += $select->page_count($sql_treehole_each_publish_count);
    // 获取在其他帖子回复我的数量
    $sql_treehole_each_publish = "select p.p_sender,p.p_content,p.p_number,p.p_time from makefriend.tree_publish p LEFT JOIN makefriend.treehole t ON t.h_id = p.p_number  where  p.p_content_is_read = 0 and p.p_getter = '".$_SESSION['user']."' order by p_time desc";
    $result_treehole_each_publish = $select->select($sql_treehole_each_publish);
    // 获取在其他帖子回复我的结果集
    $result_study_note_reply_count = "select count(*) as c from study_note.study_publish p LEFT JOIN study_note.study_reply r ON p.s_id = r.r_number  where r.r_content_is_read = 0 and p.s_name = '" . $_SESSION['user'] ."'";
    $count += $select->page_count($result_study_note_reply_count);
    // 获取回复学霸笔记的总数
    $sql_result_study_note_reply = "select s_id,s_title,r_sender,r_time,r_content from study_note.study_publish p LEFT JOIN study_note.study_reply r ON p.s_id = r.r_number  where r.r_content_is_read = 0 and p.s_name = '" . $_SESSION['user'] ."'";
    $result_study_note_reply = $select->select($sql_result_study_note_reply);
    // 获取在学霸笔记回复我的结果集
     ?>
    <section id="info" class="container">
        <div class="row">
            <div>
                <h3>全部消息</h3>
                <?php 
                    if($arr_push){
                ?>
                <div class="box">
                    <p class="content"><span class="glyphicon glyphicon-list-alt"></span><a href="../../../chatRoom/frontEnd/chatRoom.php" target="_blank">有你的<?php echo $arr_push; ?>条私信，请点击查看！</a></p>
                </div>
                <?php }?> 
                <?php 
                while(($data_study_note = mysqli_fetch_object($result_study_note_reply)) && $data_study_note->s_title){
                 ?>
                <div class="box">
                    <p class="time"><?php echo $data_study_note ->r_time; ?></p>
                    <p class="content"><span class="glyphicon glyphicon-list-alt"></span><a href=""><?php echo $data_study_note->r_sender; ?></a>在你的主题"<?php echo $data_study_note->s_title;?>"回复了你：<a href="../../../mySchool/frontEnd/details.php?number=<?php echo $data_study_note->s_id; ?>" target="_blank"><?php echo $data_study_note->r_content;?></a></p>
                </div>
                <?php }?>
                <!-- 学霸笔记未读消息--> 
                <?php 
                while(($data_second = mysqli_fetch_object($result_second)) && $data_second->comment_content){
                 ?>
                <div class="box">
                    <p class="time"><?php echo $data_second ->comment_time; ?></p>
                    <p class="content"><span class="glyphicon glyphicon-list-alt"></span><a href=""><?php echo $data_second->comment_name; ?></a>留言内容为：<a href="../../index/details.php?item_number=<?php echo $data_second->item_number; ?>" target="_blank"><?php echo $data_second->comment_content;?></a></p>
                </div>
                <?php }?>
                <!-- 二手市场未读消息-->
                <?php 
                while(($data_treehole_publish_content = mysqli_fetch_object($result_treehole_publish_content)) && $data_treehole_publish_content->p_sender){
                 ?>
                <div class="box">
                    <p class="time"><?php echo $data_treehole_publish_content ->p_time; ?></p>
                    <p class="content"><span class="glyphicon glyphicon-list-alt"></span><a href=""><?php echo $data_treehole_publish_content->p_sender; ?></a>回复你：<a href="../../../makeFriends/frontEnd/treeHole.php?p_number=<?php echo $data_treehole_publish_content->p_number; ?>" target="_blank"><?php echo $data_treehole_publish_content->p_content;?></a></p>
                </div>
                <?php }?>
                <!-- 回复树洞的未读消息-->
                <?php 
                while(($data_treehole_each_publish = mysqli_fetch_object($result_treehole_each_publish)) && $data_treehole_each_publish->p_sender){
                 ?>
                <div class="box">
                    <p class="time"><?php echo $data_treehole_each_publish ->p_time; ?></p>
                    <p class="content"><span class="glyphicon glyphicon-list-alt"></span><a href=""><?php echo $data_treehole_each_publish->p_sender; ?></a>回复你：<a href="../../../makeFriends/frontEnd/treeHole.php?p_number=<?php echo $data_treehole_each_publish->p_number; ?>" target="_blank"><?php echo $data_treehole_each_publish->p_content;?></a></p>
                </div>
                <?php }?>
                <!-- 树洞里互相回复的未读消息-->
            </div>
        </div>
    </section>
</body>
</html>
