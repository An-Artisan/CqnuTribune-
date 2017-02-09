<?php 
    require '../../cqnu.class/all.class/all.class.php';
    // 引用所有类
    session_start();
    //开启session，一定要在实例化Code对象前开启
    // $user = addslashes($_POST['administrator_name']);
    // $password = addslashes($_POST['administrator_pass']);
    // // 过滤特殊字符，防sql注入
    // $verify = $_POST['administrator_verify'];
    // if(strtoupper($verify) != $_SESSION['code']){
    //     // 转换成大写。大小写等效
    //     exit(json_encode(array('state' =>'0')));
    // }
    // // 验证码不正确
    // $sql = "select * from user.administrator where administrator_user = '".$user."'";
    // // 查询用户输入的用户名
    // $select = Select::create_singleton();
    // // 实例化查询对象
    // $result = $select -> select($sql);
    // // 获取结果集
    // // var_dump($result);
    // if(!$result->num_rows){
    //     exit(json_encode(array('state' =>'0')));
    // }
    // // 用户不存在就返回0
    // $encrypt_password = mysqli_fetch_object($result)->administrator_password;
    // // 获取密码
    // $encrypt = Encrypt::create_singleton();
    // // 实例化Encrypt对象(静态方法获取对象)
    // if($encrypt->verify($password,$encrypt_password)){
    //     // 进行匹配，成功设置标记
    //     $_SESSION['administrator'] = $user;
    //     // 设置管理员登陆标记
    //     exit(json_encode(array('state' =>'1')));
    // }
    // exit(json_encode(array('state' =>'0')));
    // // 失败返回0
     $encrypt = Encrypt::create_singleton();
    // 实例化Encrypt对象(静态方法获取对象)
    $password = addslashes('administratorHelloWorld');
    // 过滤特殊字符，防sql注入
    if($encrypt->verify($password,'$2y$10$TFt1Vem.2fiqasDXjsR8OuPhEQR7GpKWIoteTjznECOuZQV/QsBoq')){
        // 进行匹配，成功设置标记
        echo 1;
    }

?>