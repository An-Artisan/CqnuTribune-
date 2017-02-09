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
    <script type="text/javascript" src="js/goodsList.js"></script>
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
                            $show_data= 1;
                            //一页显示多少记录
                            $select = Select::create_singleton();
                            //实例化查询对象
                            $sql = "select count(*) as c from  secondhand.goods a left join user.user_information b  on a.user_number=b.user_number  WHERE b.user_name = '" . $user ."'";
                            // 这里自己写查询记录总数的sql语句
                            $count = $select->page_count($sql);
                            //获取表记录总数
                            if ($count) {
                 ?>
                <table class="list_tab">
                    <tr>

                        <th>标题</th>
                        <th>价格</th>
                        <th>点击</th>
                        <th>可否小刀</th>
                        <th>是否下架</th>
                        <th>发布用户</th>
                        <th>发布时间</th>
                        <th>结束时间</th>
                        <th>发布地址</th>
                        <th>操作</th>
                    </tr>
                       <?php 
                          
                            $page = isset($_GET['page'])?$_GET['page']:1;
                            //如果没有接收到浏览器传过来的参数，说明就是首页。
                            $sql="select item_number,b.user_number,title,price,bargained,click_rate,shelves,user_name,start_time,stop_time,address from  secondhand.goods a left join user.user_information b  on a.user_number=b.user_number WHERE b.user_name = '" . $user . "' order BY shelves desc, start_time desc" . " limit " . ($page - 1) * $show_data . ", $show_data"; 
                            // 一次接受多少的数据 limit限制，这里是联合查询,先按下架字段排序，在按时间排序
                            $result = $select->select($sql);
                            //查询第多少页的数据

                            //=====循环这些数据=====
                            while($data = mysqli_fetch_object($result)) {
                                   
                        ?>
                    <tr>
                        <td>
                            <a href="#"><?php echo $data->title ?></a>
                        </td>
                        <td><?php echo $data->price ?></td>
                        <td><?php echo $data->click_rate ?></td>
                        <td><?php echo $data->bargained ?></td>
                        <td><?php echo $data->shelves ?></td>
                        <td><?php echo $data->user_name ?></td>
                        <td><?php echo $data->start_time ?></td>
                        <td>
                        <?php
                         if($data->stop_time == '0000-00-00 00:00:00'){echo '未结束';}
                         // 如果是默认的时间，就表示交易未结束
                         else{
                            echo $data->stop_time;
                            // 如果不是默认的时间，就代表交易结束
                         }
                         ?>
                        </td>
                        <td>
                        <?php
                        $sql = "select address_name from secondhand.goods_address where address_id = " . $data->address;
                        // 查询id对应的地址。这里考虑到后台用户会增加地址，所以用这种方式
                        $result_address = $select->select($sql);
                        // 查询结果集，只有一条，因为id是唯一的
                        echo  mysqli_fetch_object($result_address)->address_name;
                        // 输出地址
                         ?>
                        </td>
                        <td>
                        <a  href="../../index/details.php?item_number=<?php echo $data->item_number ?>" target='_blank' >商品详情</a>
                        <a onclick="ask(this);" name="<?php echo $data->item_number ?>"  >交易成功</a>
                        <a onclick="ask(this);" name="<?php echo $data->item_number ?>"  >删除商品</a>
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