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

</head>
<body>
<?php 
  if(!isset($_GET['item_number'])){
      echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请先登录后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            window.location.href='http://localhost/CqnuTribune/secondHands/index/secondHands.php';
            });  });</script>";
      exit();
      // 如果用户直接赋值的链接进来，表示没有传item_number值，就提示用户登陆后在试试
 }
 ?>
    
<div id="item_number" style="display:none;" ><?php echo $_GET['item_number']; ?></div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#">首页</a></li>
                    <li class="active"><a href="#">二手市场</a></li>
                    <li><a href="#">失物招领</a></li>
                    <li><a href="#">交友论坛</a></li>
                    <li><a href="#">我的私信</a></li>
                    <li><a href="http://localhost/CqnuTribune/secondHands/publishSecondGoods/frontEnd/index.php?iframe=pass.html" target="_blank">个人中心</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" id="example">登录</a></li>
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
                                <input type="text" id="txtPwd" placeholder="密码" />
                            </span>
                            <a href="javascript:void(0)" title="提示" class="warning" id="warn2">*</a>
                        </div>

                        <center><div id="drag"></div></center>
                        <script type="text/javascript">
                            $('#drag').drag();
                        </script>
                        <div align="center">
                            <form>
                                <button herf="#" type="button" class="btn btn-primary" disabled="disabled" id="loginbtn">登录</button>
                            </form>
                        </div>
                    </div>
                    <li><a href="#">注册</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--     nav over -->
    <?php 
    require '../../cqnu.class/all.class/all.class.php';
    $item_number = $_GET['item_number'];
    $select = Select::create_singleton(); 
    // 获得查询对象
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
                                <li><a><img src="http://localhost/CqnuTribune/secondHands/publishSecondGoods/goodsImg/images/<?php echo $arr[$i] ?> "/></a></li>
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
                                <td> <?php echo $data->user_name ?> </td>
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
                        <button type="button" class="btn btn-info col-xs-5 col-sm-4 col-md-4">私信卖家</button>
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
                        <li><a href="http://localhost/CqnuTribune/secondHands/index/details.php?item_number=<?php echo $data->item_number ?>"> <?php echo $data->title ?> </a></li>
                       <?php } ?>
                    </ol>
                    <!-- 点击率最高的五个商品 -->
                </div>
            </div>
        </div>
    </section>
<!--     goods over -->
    
    <section id="content" class="container-fluid content">
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
                    <img class="img-responsive" src="http://localhost/CqnuTribune/register/img/<?php echo $data->user_photo; ?>"/>
                    <button class="btn button-default">
                        <a href="#">私信</a>
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
                            echo "<div align='center'>
                            当前商品没有任何评论，快来第一个评论吧~~
                            </div>";
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

    <script type="text/javascript" src="../../styles/plugins/loginDialog/js/popupBox.js"></script>
    <script type="text/javascript" src="../plugins/Superslide/JS_nEW/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="../plugins/Superslide/JS_nEW/jquery.SuperSlide.2.1.js"></script>
    <script type="text/javascript" src="../plugins/Superslide/JS_nEW/goodPlay.js"></script>

    <!--引入jquery和wangEditor.js-->
    <script type="text/javascript" src="../../styles/Editor/dist/js/wangEditor.js"></script>
    <script type="text/javascript" src="../js/userDefined.js"></script>
    <script type="text/javascript" src="../js/details.js"></script>

</body>
</html>