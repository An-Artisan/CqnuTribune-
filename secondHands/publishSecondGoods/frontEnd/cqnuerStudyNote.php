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
    <script type="text/javascript" src="js/deleteStudyNote.js"></script>
</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">个人中心</a> &raquo; <a href="#">学霸笔记</a> &raquo; 我的笔记
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
                            $sql = "select count(*) as c from study_note.study_publish where study_publish.s_name = '" . $_SESSION['user'] . "'";
                            // 这里自己写查询记录总数的sql语句
                            $count = $select->page_count($sql);
                            //获取表记录总数
                            if ($count) {
                 ?>
                <table class="list_tab">
                    <tr>

                        <th>标题</th>
                        <th>内容</th>
                        <th>发布用户</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                       <?php 
                          
                            $page = isset($_GET['page'])?$_GET['page']:1;
                            //如果没有接收到浏览器传过来的参数，说明就是首页。
                            $sql = "select *  from study_note.study_publish where study_publish.s_name = '" . $_SESSION['user'] . "' order by s_time desc limit ". ($page - 1) * $show_data . ", $show_data"; 
                            // 查询当前用户发布的树洞
                            $result = $select->select($sql);
                            //查询第多少页的数据

                            //=====循环这些数据=====
                            while($data = mysqli_fetch_object($result)) {
                                   
                        ?>
                    <tr>
                        <td><?php echo $data->s_title; ?></td>
                        <td><kbd><?php echo htmlentities($data->s_content); ?></kbd></td>
                        <td><?php echo $data->s_name; ?></td>
                        <td><?php echo $data->s_time; ?></td>
                        <td>
                        <a  href="../../../MySchool/frontEnd/details.php?number=<?php echo $data->s_id; ?>" target='_blank' >详情</a>
                        <a onclick="ask(this);" name="<?php echo $data->s_id; ?>" id="<?php echo $data->s_picture; ?>" >删除</a>
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
                            echo "<div align='center'>你还没有发布任何的树洞帖子</div>";
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