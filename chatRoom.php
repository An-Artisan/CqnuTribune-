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
    <link rel="stylesheet" type="text/css" href="wangEditor-2.1.20/dist/css/wangEditor.min.css">

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
                            <div class="others" style="overflow:auto;">
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
    <script type="text/javascript" src="wangEditor-2.1.20/dist/js/lib/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="wangEditor-2.1.20/dist/js/wangEditor.min.js"></script>
    <!--这里引用jquery和wangEditor.js-->
    <script  type="text/javascript">
        var friendList = document.getElementsByName('friend');
        // 获取name集合
        for(var i = 0;i < friendList.length;i ++){
            friendList[i].onclick = function(){
                for (var j = 0; j < friendList.length; j++) {
                 friendList[j].style.backgroundColor = '#32343a';
                 friendList[j].index = j;
                }
                 // 先还原之前的颜色
                this.style.backgroundColor = '#666';
                // 在设置凹凸背景色
                $('#getter').text($(this).children("h4").first().text());
                // 设置点击当前用户的昵称
                $(function(){
                    var all = {
                        type: 'POST',
                        // POST提交
                        url:'http://localhost/chatRoom/AjaxLongPolling/get_all_content.php',
                        // 接受PHP地址
                        dataType:'json',
                        // 返回数据格式：json
                        data:{sender:$('#sender').text(),getter:$('#getter').text()},
                        // 提交的数据
                        success:function(data){
                         // $('#content').html("<b>" + data + "</b>");
                         var all = '';
                         for(var i=0;i<data.length;i++){
                         var nums = data[i].indexOf("&@part"); 
                         var content = data[i].substring(0,nums);
                         var date = data[i].substring(nums+6);
                                all += content + '<br />' + date;
                         }
                          // content = content + '<br />' + date;
                           $('#content').html(all);
                           // 在赋值
                         document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
                              //            让浏览器的滚动条每次都到最底端 
                         // console.log(data);
                        }
                        // 调用成功回调函数
                    };
                    $.ajax(all);


                });
                    if(flag){
                    $(function(){
                        flag = 0;
                        var active_user = $('#getter').text();
                        var setting = {
                            type: 'POST',
                            url:'http://localhost/chatRoom/AjaxLongPolling/get_content.php',
                            // dataType:'json',
                            data:{sender:$('#sender').text(),getter:$('#getter').text()},
                            success:function(data){
                            if($('#getter').text() == active_user){
                            // $('#content').html(data);
                               var all_data = $('#content').html();
                               var nums = data.indexOf("&@part"); 
                               var content = data.substring(0,nums);
                               var date = data.substring(nums+6);
                               content = content + '<br />' + date;
                               all_data = all_data +  '<br />' + content;
                               $('#content').html(all_data);
                               // alert(all_data);
                               document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
                              //            让浏览器的滚动条每次都到最底端   
                             setTimeout(function(){$.ajax(setting)},1000);
                                // $.ajax(setting);
                                //    立马再次执行ajax轮询
                            }
                          
                            }
                        };
                        $.ajax(setting);
                    }); 
                    // 接受
                }
            }
            // 在定义所点击的颜色样式
        }
    document.onkeydown = function (event) {
    var e = event || window.event || arguments.callee.caller.arguments[0];
    if (e && e.keyCode == 13) { // 按 enter  e.ctrlKey代表ctrl
        if (editor.$txt.html() != '<p><br></p>') {
            var all_data_one = $('#content').html();
            var edit = editor.$txt.html();
            var all_data_one = all_data_one + '<br />'+ edit;
            $('#content').html(all_data_one);
             editor.$txt.html('<p><br></p>');
            $.post("http://localhost/chatRoom/AjaxLongPolling/send_content.php",
//                          ajax的post请求到wangEditor/getContent.php路由
                {
                    content: edit,
//                          传用户注册的用户名验证
                    getter:$('#getter').text(),
                    sender:$('#sender').text()

                },
                function (data) {
                        
                        // var newData=data.replace(/\s/g,'');
                        /* 这里有个奇怪的BUG，每次返回值总会带一些空格。
                           于是我用正则表达式去出掉了空格在判断
                        */
                        
                        //    清空编辑器
                        // if (newData != 'success') { 
                        //     alert('发送消息失败');
                        // }
     

                });
         
        }
    }

};

    </script>


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
        'insertcode',
        'undo',
        'redo',
        'fullscreen'
     ];

     // 仅仅想移除某几个菜单，例如想移除『插入代码』和『全屏』菜单：
     // 其中的 wangEditor.config.menus 可获取默认情况下的菜单配置
     // editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
     //     if (item === 'insertcode') {
     //         return null;
     //     }
     //     if (item === 'fullscreen') {
     //         return null;
     //     }
     //     return item;
     // });

    editor.create();
    editor.$txt.html('<p><br></p>');
</script>
</body>
</html>
