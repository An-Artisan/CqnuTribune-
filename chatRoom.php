<!-- /**
* ================================================
* title：chatRoom.html
* time: 2016-10-14
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
    <!-- Bootstrap -->
      <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="css/chatRoom.css">
    <link rel="stylesheet" type="text/css" href="Editor/dist/css/wangEditor.min.css">
</head>
<body>
    <div id="sender" style="display:none;"><?php echo $_POST['user']; ?></div>
    <div id="chat">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-9 col-md-9">
                    <div class="row">
                        <div id="list" class="col-sm-3 col-md-3 list ">
                            <div class="me">
                                <img src="img/head.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                <h3>昵称昵称</h3>
                                <div class="icon">
                                    <span class="glyphicon glyphicon-comment"></span>
                                    <span class="glyphicon glyphicon-th-list"></span>
                                </div>
                            </div>
                            <div class="search">
                                <span class="glyphicon glyphicon-search"></span>
                                <input type="text" class="form-control" placeholder="查找联系人或群">
                            </div>
                            <div class="others" >
                                <div name="friend" class="one">
                                    <img src="img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <h4>liuqiang</h4>
                                    <br>
                                    <h5>http://t.cn/RcQ5dOs</h5>
                                </div>
                                <div name="friend" class="one">
                                    <img src="img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <h4>李四</h4>
                                    <br>
                                    <h5>http://t.cn/RcQ5dOs</h5>
                                </div>
                                <div name="friend" class="one">
                                    <img src="img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <h4>王五</h4>
                                    <br>
                                    <h5>http://t.cn/RcQ5dOs</h5>
                                </div>
                                <div name="friend" class="one">
                                    <img src="img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <h4>新浪新闻</h4>
                                    <br>
                                    <h5>http://t.cn/RcQ5dOs</h5>
                                </div>
                                <div name="friend" class="one">
                                    <img src="img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <h4>新浪新闻</h4>
                                    <br>
                                    <h5>http://t.cn/RcQ5dOs</h5>
                                </div>
                                <div name="friend" class="one">
                                    <img src="img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <h4>新浪新闻</h4>
                                    <br>
                                    <h5>http://t.cn/RcQ5dOs</h5>
                                </div>
                                <div name="friend" class="one">
                                    <img src="img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <h4>新浪新闻</h4>
                                    <br>
                                    <h5>http://t.cn/RcQ5dOs</h5>
                                </div>
                                <div name="friend" class="one">
                                    <img src="img/sina-icon.jpg" height="50" width="50" alt="head portrait" class="img-circle">
                                    <h4>新浪新闻</h4>
                                    <br>
                                    <h5>http://t.cn/RcQ5dOs</h5>
                                </div>
                            </div>
                        </div>
                        <div id="chat2" class="col-sm-9 col-md-9 hidden-xs chat">
                            <div class="title">
                                <p id="getter">昵称昵称</p>
                                <!-- <span class="glyphicon glyphicon-plus"></span>
                                <span class="glyphicon glyphicon-chevron-down"></span> -->
                            </div>
                            <div id="content" style="overflow:auto;" class="content">
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
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="js/bootstrap.min.js"></script>

    <!--引入jquery和wangEditor.js-->
    <script type="text/javascript" src="Editor/dist/js/lib/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="Editor/dist/js/wangEditor.js"></script>
    <!--这里引用jquery和wangEditor.js-->
    <script type="text/javascript" src="js/getNowTime.js"></script>
    <script type="text/javascript" src="js/getMessage.js"></script>
    <script type="text/javascript" src="js/sendMessage.js"></script>
    <!-- <script type="text/javascript" src="js/messagePush.js"></script> -->
    <script type="text/javascript">
    if (screen.width < 768){
        var target = document.getElementById("one");
        target.onclick = function objclick() {
             window.location.assign('http://yfl995.dev.dxdc.net/task_bs/chatRoom2.html');
        }
    }
    var editor = new wangEditor('div1');
    // 普通的自定义菜单
    editor.config.menus = [
        'source',
        '|',
        'bold',
        'underline',
        'italic',
        'strikethrough',
        'eraser',
        'forecolor',
        'bgcolor',
        '|',
        'quote',
        'fontfamily',
        'fontsize',
        '|',
        'link',
        'unlink',
        'emotion',
        '|',
        'img',
     ];
      editor.config.uploadImgUrl = './uploadFile/upload.php';
      // 添加上传图片后台地址
      editor.config.hideLinkImg = true;
      // 隐藏网络路径图片引用功能
      editor.config.uploadImgFileName = 'myFileName';
      // 设置拖拽，复制，上传图片的共同FileName为'myFileName' 方便统一
      editor.create();
      // 创建编辑器
      editor.$txt.html('<p><br></p>');
      // 清空编辑器
</script>
</body>
</html>
