
<!-- /**
* ================================================
* title：chatRoom.html
* time: 2016-10-17
* author: 杨凤玲
* content: 聊天室
* ================================================
*/ -->
<!DOCTYPE html>
<html>
<head>
    <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../../styles/css/bootstrap.min.css">
    <!-- 自定义css -->
    <link rel="stylesheet" href="../css/chatRoom.css">
    <link rel="stylesheet" href="../../styles/css/reset.css">
    <!-- 插件css -->
    <link rel="stylesheet" type="text/css" href="../../styles/Editor/dist/css/wangEditor.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <script src="../../styles/layui/layui.js"></script>
    <script src="../../styles/js/loading.js"></script>
    <script src="../../styles/js/getNowTime.js"></script>
    <script src="../js/dynamicTime.js"></script>
    <?php
    require '../../cqnu.class/all.class/all.class.php';
    // 引用所有类 
    session_start();
    // 开启SESSION
    if(!isset($_SESSION['user'])){
    echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请先登录后再试~', {
        btn: ['确定'], //按钮
        icon: 5
        }, function(){
        window.location.href='../../secondHands/index/secondHands.php';
        });  });</script>";
    exit();
    // 如果用户直接赋值的链接进来，就提示用户登陆后在试试
    }
    $user = isset($_GET['user'])?$_GET['user']:null;
    if($user == $_SESSION['user']){
    echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('不能自己私信自己~', {
    btn: ['确定'], //按钮
    icon: 5
    }, function(){
    window.location.href='../../secondHands/index/secondHands.php';
    });  });</script>";
    exit();
    }
    // 不能自己私信自己
    $sql = "select user_photo from user.user_information where user_name = '".$_SESSION['user']."'";
    $select = Select::create_singleton();
    // 获得对象
    $result = $select->select($sql);
    // 获得结果集
    $photo = mysqli_fetch_object($result)->user_photo;
    ?>
</head> 
<body>
<body>
<audio id="voice" >
    <source id="start" src="../voice/chatVoice.wav" type="audio/wav">
</audio>
    <div class="fakeloader"></div>
    <div class="content bgcolor-8">
        <h1 style="text-align:center;"></h1>
        <div id="chat">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-9 col-md-9">
                        <div class="row">
                            <div id="list" class="col-sm-4 col-md-4 list ">
                                <div class="me">
                                    <img id="head" src="../../register/img/<?php echo $photo; ?>" height="50" width="50" alt="head portrait" class="img-circle">
                                    <div class="text">
                                        <h3 id="sender"><?php echo $_SESSION['user']; ?></h3>
                                        <p id="time"></p>
                                    </div>

                                </div>
                                <div class="others" style="overflow:auto;">
                                <?php 
                                 /*
                                    获取好友列表开始
                                 */   
                                 
                                 // 如果是在其他页面点进这个页面就把传过来的用户显示到聊天界面上
                                 if(!is_null($user)){
                                    $sql = "select user_photo from user.user_information where user_name = '".$user."'";
                                    $select = Select::create_singleton();
                                    // 获得对象
                                    $result = $select->select($sql);
                                    // 获得结果集
                                    $photo = mysqli_fetch_object($result)->user_photo;
                                    echo '<div id="one" name="friend" class="one"><img src="../../register/img/'.$photo.'" height="50" width="50" alt="head portrait" class="img-circle"><div class="box"><h4>'.$user.'</h4><h3></h3></div><div class="box2"><p></p><span class="badge"></span></div></div>';
                                    // 输出头像，用户昵称等信息
                                    $sql = "select DISTINCT b.user_name,b.user_photo  from private_message.user_list a inner join user.user_information b on a.user_sender = b.user_name where a.user_getter = '" .$_SESSION['user']."'";
                                    // 查询之前用户给当前用户有没有发送消息，如果有，显示到当前列表
                                    $select = Select::create_singleton();
                                    // 获得对象
                                    $result = $select->select($sql);
                                    // 获得结果集
                                    while ($data = mysqli_fetch_object($result)) {
                                         if($data->user_name!=$user){
                                            echo '<div id="one" name="friend" class="one"><img src="../../register/img/'.$data->user_photo.'" height="50" width="50" alt="head portrait" class="img-circle"><div class="box"><h4>'.$data->user_name.'</h4><h3></h3></div><div class="box2"><p></p><span class="badge"></span></div></div>';
                                         }
                                    }
                                    // 输出所有和当前用户有联系的用户
                                 } else{
                                    $sql = "select DISTINCT b.user_name,b.user_photo  from private_message.user_list a inner join user.user_information b on a.user_sender = b.user_name where a.user_getter = '" .$_SESSION['user']."'";
                                    $select = Select::create_singleton();
                                    // 获得对象
                                    $result = $select->select($sql);
                                    // 获得结果集
                                    while ($data = mysqli_fetch_object($result)) {
                                            echo '<div id="one" name="friend" class="one"><img src="../../register/img/'.$data->user_photo.'" height="50" width="50" alt="head portrait" class="img-circle"><div class="box"><h4>'.$data->user_name.'</h4><h3></h3></div><div class="box2"><p></p><span class="badge"></span></div></div>';
                                    }
                                 } 
                                // 如果是直接点进私信模块的话，就显示所有和当前用户有关系的联系人 
                                 ?>

                                </div>
                            </div>
                            <div id="chat2" class="col-sm-8 col-md-8 hidden-xs chat">
                                <div class="title">
                                    <p id="getter"></p>
                                </div>
                                <div id="content" class="content">
                                <p class="no-content">当前未选择好友！</p>
                                </div>
                                <div>
                                    <div id="div1" >
                                    <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3 special">

                    </div>
                </div>

            </div>
            <!-- container over -->
        </div>
        <!-- chat over -->
    </div>



   
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
    <!--引入wangEditor.js-->
    <script type="text/javascript" src="../../styles/Editor/dist/js/wangEditor.js"></script>
    <script type="text/javascript" src="../js/userDefined.js"></script>
    <!-- 长轮询js -->
    <script type="text/javascript" src="../js/clearUserRedis.js"></script>
    <script type="text/javascript" src="../js/getMessage.js"></script>
    <script type="text/javascript" src="../js/sendMessage.js"></script>
    <script type="text/javascript" src="../js/messagePush.js"></script>



</body>
</html>
