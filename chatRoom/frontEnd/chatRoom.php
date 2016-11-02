
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
    <!-- <link rel="stylesheet" href="../../styles/layui/css/layui.css"> -->
    <script src="../../styles/layui/layui.js"></script>
    <script src="../js/loading.js"></script>
    
</head> 
<body>
<body>
<audio id="voice" >
    <source id="start" src="../voice/chatVoice.wav" type="audio/wav">
</audio>
 <div id="sender" style="display:none;"><?php echo $_POST['user']; ?></div>
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
                                    <img src="../img/head.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <div class="text">
                                        <h3>liuqiang</h3>
                                        <p>2016-10-19 23:23</p>
                                    </div>

                                </div>
                                <div class="search">
                                    <span class="glyphicon glyphicon-search"></span>
                                    <input type="text" class="form-control" placeholder="查找联系人或群">
                                </div>
                                <div class="others" style="overflow:auto;">
                                    <div id="one" name="friend" class="one">
                                        <img src="../img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                        <div class="box">
                                            <h4>wangwu</h4>
                                            <h3></h3>
                                        </div>
                                        <div class="box2">
                                            <p></p>
                                            <span class="badge"></span>
                                        </div>
                                    </div>
                                    <div id="one" name="friend" class="one">
                                        <img src="../img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                        <div class="box">
                                            <h4>lisi</h4>
                                            <h3></h3>
                                        </div>
                                        <div class="box2">
                                            <p></p>
                                            <span class="badge"></span>
                                        </div>
                                    </div>
                                    <div id="one" name="friend" class="one">
                                        <img src="../img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                        <div class="box">
                                            <h4>liuqiang</h4>
                                            <h3></h3>
                                        </div>
                                        <div class="box2">
                                            <p></p>
                                            <span class="badge"></span>
                                        </div>
                                    </div>
                                    <div id="one" name="friend" class="one">
                                        <img src="../img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                        <div class="box">
                                            <h4>新浪新闻新浪新闻</h4>
                                            <h3></h3>
                                        </div>
                                        <div class="box2">
                                            <p></p>
                                            <span class="badge"></span>
                                        </div>
                                    </div>
                                    <div id="one" name="friend" class="one">
                                        <img src="../img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                        <div class="box">
                                            <h4>新浪新闻新浪新闻</h4>
                                            <h3></h3>
                                        </div>
                                        <div class="box2">
                                            <p></p>
                                            <span class="badge"></span>
                                        </div>
                                    </div>
                                    <div id="one" name="friend" class="one">
                                        <img src="../img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                        <div class="box">
                                            <h4>新浪新闻新浪新闻</h4>
                                            <h3></h3>
                                        </div>
                                        <div class="box2">
                                            <p>2014-05-16 23:00:00</p>
                                            <span class="badge">14</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="chat2" class="col-sm-8 col-md-8 hidden-xs chat">
                                <div class="title">
                                    <p id="getter"></p>
                                </div>
                                <div id="content" class="content">
                                    <div class="right">
                                        <img src="../img/head.jpg" height="40" width="40" alt="head portrait" class="img-circle" style="float:right;">
                                        <div class="rightsend">
                                            <p>2014-05-16 23:00:00 </p>
                                            <div class="rightarrow"></div>
                                        </div>
                                    </div>
                                    <div class="left">
                                        <img src="../img/sina-icon.jpg" height="40" width="40" alt="head portrait" class="img-circle" style="float:left;">
                                        <div class="leftsend">
                                            <p>左边左边左边左边左边左边左边左边左边左边左边</p>
                                            <div class="leftarrow"></div>
                                        </div>
                                    </div>
                                    <div class="left">
                                        <img src="../img/sina-icon.jpg" height="40" width="40" alt="head portrait" class="img-circle" style="float:left;">
                                        <div class="leftsend">
                                            <p>左边左边左边左边左边左边左边左边左边左边左边</p>
                                            <div class="leftarrow"></div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <img src="../img/head.jpg" height="40" width="40" alt="head portrait" class="img-circle" style="float:right;">
                                        <div class="rightsend">
                                            <p>右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边右边</p>
                                            <div class="rightarrow"></div>
                                        </div>
                                    </div>
                                     <div class="right">
                                        <img src="../img/head.jpg" height="40" width="40" alt="head portrait" class="img-circle" style="clear: both; float:right;">
                                        <div class="rightsend">
                                            <p>右边右边右边右边右边右边右边右边右边右边</p>
                                            <div class="rightarrow"></div>
                                        </div>
                                    </div>
                                    <div class="left">
                                        <img src="../img/sina-icon.jpg" height="40" width="40" alt="head portrait" class="img-circle" style="float:left;">
                                        <div class="leftsend">
                                            <p>左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边左边
                                            </p>
                                            <div class="leftarrow"></div>
                                        </div>
                                    </div>
                                    <div class="left">
                                        <img src="../img/sina-icon.jpg" height="40" width="40" alt="head portrait" class="img-circle" style="float:left;">
                                        <div class="leftsend">
                                            <p>左边左边左边左边左边左边左边左边左边左边左边</p>
                                            <div class="leftarrow"></div>
                                        </div>
                                    </div>
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



     <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../styles/js/bootstrap-3.3.0.min.js"></script>
    <!--引入wangEditor.js-->
    <script type="text/javascript" src="../../styles/Editor/dist/js/wangEditor.js"></script>
    <script type="text/javascript" src="../js/userDefined.js"></script>
    <!-- 长轮询js -->
    <script type="text/javascript" src="../js/clearUserRedis.js"></script>
    <script type="text/javascript" src="../js/getNowTime.js"></script>
    <script type="text/javascript" src="../js/getMessage.js"></script>
    <script type="text/javascript" src="../js/sendMessage.js"></script>
    <script type="text/javascript" src="../js/messagePush.js"></script>



</body>
</html>
