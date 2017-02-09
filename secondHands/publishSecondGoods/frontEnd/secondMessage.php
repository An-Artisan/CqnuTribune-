<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../css/ch-ui.admin.css">
    <link rel="stylesheet" href="../../font/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../styles/css/bootstrap.min.css">
    <script type="text/javascript" src="../../../styles/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../../js/ch-ui.admin.js"></script>
    <script type="text/javascript" src="../../../styles/layui/layui.js"></script>
    <script src="../../../styles/js/loading.js"></script>
    <script src="js/secondMessage.js"></script>
</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">个人中心</a> &raquo; <a href="#">二手市场</a> &raquo; 商品清单
    </div>
    <!--面包屑导航 结束-->
    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
     

        <div class="result_wrap">
            <div class="result_content">
                <?php 
                 require '../../../cqnu.class/all.class/all.class.php';
                            session_start();
                            // 开启SESSION
                            $user = $_SESSION['user'];
                            // 获取当前用户
                            $show_data= 6;
                            //一页显示多少记录
                            $select = Select::create_singleton();
                            //实例化查询对象
                            $sql = "select count(*)  as c from secondhand.goods g left join secondhand.goods_comment c on g.item_number = c.item_number where c.comment_name ='" . $user . "'";
                            // 这里自己写查询记录总数的sql语句
                            $count = $select->page_count($sql);
                            //获取表记录总数
                            if ($count) {
                 ?>
                <table class="list_tab">
                    <tr>

                        <th>商品标题</th>
                        <th>评论内容</th>
                        <th>评论时间</th>
                        <th>操作</th>
                    </tr>
                       <?php 
                          
                            $page = isset($_GET['page'])?$_GET['page']:1;
                            //如果没有接收到浏览器传过来的参数，说明就是首页。
                            $sql = "select g.title,g.item_number,c.comment_content,c.comment_number,c.comment_time from secondhand.goods g left join secondhand.goods_comment c on g.item_number = c.item_number where c.comment_name ='" . $user . "' order by comment_time desc limit " . ($page - 1) * $show_data . ", $show_data"; 
                            // 查询用户的留言
                            $result = $select->select($sql);
                            //查询第多少页的数据

                            //=====循环这些数据=====
                            while($data = mysqli_fetch_object($result)) {
                                   
                        ?>
                    <tr>
                        <td>
                            <a href="../../index/details.php?item_number=<?php echo $data->item_number ?>" target='_blank' ><?php echo $data->title ?></a>
                        </td>
                        <td><?php echo $data->comment_content ?></td>
                        <td><?php echo $data->comment_time ?></td>
                        <td>
                        <a onclick="ask(this);" name="<?php echo $data->comment_number ?>"  >删除留言</a>
                        </td>
                    </tr>
                      
                 <?php }
                    //=====循环数据结束=====
                 ?>
               
                </table>

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
                            echo "<div align='center'>你还没有发布任何的二手商品，有闲置的物品，就赶快发布吧~~
                                <a href='publishGoods.php' target='main'    >点我发布！~</a>
                            </div>";
                            // 没有数据就给用户提醒
                        }
                         ?>
                </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
</body>
</html>