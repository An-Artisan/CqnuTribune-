<?php 
    require '../../cqnu.class/all.class/all.class.php';
    // 引用所有类
    session_start();
    //开启session，一定要在实例化Code对象前开启
    $code = new Code();
    //实例化验证码GD库类
    $code->make();
    //显示验证码
    $_SESSION['code'] = $code->get();
    //把验证码存进session
?>