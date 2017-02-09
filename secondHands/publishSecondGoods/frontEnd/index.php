<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>个人中心</title>
	<link rel="stylesheet" href="../../css/ch-ui.admin.css">
	<link rel="stylesheet" href="../../font/css/font-awesome.min.css">
	<script type="text/javascript" src="../../../styles/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../../js/ch-ui.admin.js"></script>
    <script type="text/javascript" src="../../../styles/layui/layui.js"></script>
    <script src="../../../styles/js/loading.js"></script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['user'])){
	echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请先登录后再试~', {
    btn: ['确定'], //按钮
    icon: 5
    }, function(){
    window.location.href='../../index/secondHands.php';
    });  });</script>";
exit();
// 如果用户直接赋值的链接进来，表示没有传item_number值，就提示用户登陆后在试试
}
?>
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">个人中心</div>
			<ul>
				<li><a href="#" class="active">首页</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
			
				<li>当前用户：<?php echo $_SESSION['user']; ?></li>
				<li><a href="pass.html" target="main">修改密码</a></li>
				<li><a href="#">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
			<li>
            	<h3><i class="fa fa-fw fa-info-circle"></i>个人中心</h3>
                <ul class="sub_menu">
                    <li><a href="personalData.php" target="main"><i class="fa fa-fw fa-info"></i>个人资料</a></li>
                    <li><a href="update.php" target="main"><i class="fa fa-fw fa-pencil-square-o"></i>修改资料</a></li>
                    <li><a href="information.php" target="main"><i class="fa fa-fw  fa-envelope-square"></i>通知中心</a></li>
                </ul>
            </li>

            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>二手市场</h3>
                <ul class="sub_menu">
                    <li><a href="publishGoods.php" target="main"><i class="fa fa-fw fa-plus-square"></i>发布商品</a></li>
                    <li><a href="goodsList.php" target="main"><i class="fa fa-fw fa-list-ul"></i>我的发布</a></li>
                    <li><a href="secondMessage.php" target="main"><i class="fa fa-fw fa-comment"></i>我的留言</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-mortar-board"></i>论坛管理</h3>
                <ul class="sub_menu">
                    <li><a href="cqnuerTreeHole.php" target="main"><i class="fa fa-fw fa-tree"></i>我的树洞</a></li>
                    <li><a href="cqnuerTreeHolePublish.php" target="main"><i class="fa fa-fw fa-reply-all"></i>我的回复</a></li>
                </ul>
            </li>
            <li>
                <h3><i class="fa fa-fw fa-pencil"></i>学霸笔记</h3>
                <ul class="sub_menu">
                    <li><a href="cqnuerStudyNote.php" target="main"><i class="fa fa-fw  fa-pencil-square"></i>我的笔记</a></li>
                    <li><a href="cqnuerStudyNotePublish.php" target="main"><i class="fa fa-fw fa-reply"></i>我的回复</a></li>
                </ul>
            </li>
            <!-- <li>
            	<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
                <ul class="sub_menu">
                    <li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>
                    <li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
                    <li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
                    <li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>
                </ul>
            </li> -->
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="<?php echo isset($_GET['iframe'])?$_GET['iframe']:'personalData.php'; ?>" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2016. Powered By <a href="http://www.joker1996.com">www.joker1996.com</a>
	</div>
	<!--底部 结束-->
</body>
</html>