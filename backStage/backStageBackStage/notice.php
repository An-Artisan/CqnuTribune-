<?php 
session_start();
// 开启session
if(!isset($_SESSION['administrator'])){
    echo "<script>layui.use('layer', function(){layer.config({extend:'../../styles/moon/style.css'}); layer.config({    skin:'layer-ext-moon',    extend:'../../styles/moon/style.css'});   layer.confirm('请先登录后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            window.location.href='../backStageFrontEnd/login.html';
            });  });</script>";
      exit();
    // 防止非法进入后台系统

}
?>