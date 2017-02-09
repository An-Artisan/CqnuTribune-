 <?php 
    //=====聊天框中的上传图片，缩小比例，添加水印=====
    /* * *********************************************
    * @思路：
    1：先调用上传文件类上传文件
    2：上传成功后调用缩略图类，按比例放大缩小，覆盖原来的文件。
    3：然后把缩略图文件(也是原来的文件名)传给水印类添加水印，然后覆盖原来的文件。
    4：返回图片的绝对路径给Editor，显示在编辑框中
    * @功能:     上传图片，缩小比例，添加水印
    * @作者:     不敢为天下
    * @时间：    2016-10-14
    */
    require '../../cqnu.class/all.class/all.class.php';
    // 引用全部类
    define("THIS_PATH", "../img/"); 
    // 定义当前路径下面的images为一个常量
    //======单文件或者多文件上传类实例开始======
    $up = new fileupload();
    //设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)

    $up -> set("path", THIS_PATH);
    // 这里设置上传的图片路径，类里面默认路径是当前目录的upload。如果没有此目录会自动创建
    $up -> set("maxsize", 10485760);
    // 设置图片的最大字节 1M=1048576 B(字节)
    $up -> set("allowtype", array("gif", "png", "jpg","jpeg"));
    // 设置允许上传类型 (默认的类型gif,png,jpg,jpeg)
    if($up -> upload("myFileName")) {
      //使用对象中的upload方法， 就可以上传文件，方法需要传一个上传表单的名字 pic, 如果成功返回true, 失败返回false
    //======缩略图剪裁开始======
    // $_path = THIS_PATH.$up->getFileName();  
    // $_img = new Image($_path);//$_path为图片文件的路径  
    // $_img->thumb(500, 500);  
    // $_img->out();  
    //======缩略图剪裁结束======

    //======水印类实例开始======
    // $waterprint = new WaterMask(THIS_PATH.$up->getFileName()); 
    // //实例化对象 里面放图片路径
    // $waterprint->waterImg = THIS_PATH.'waterprint.png'; 
    // //水印图片路径
    // $waterprint->transparent = 45; 
    // //水印透明度 
    // $waterprint->pos = 10;  
    //设置水印的位置
    /*
    1: //上左 2: //上中 3: //上右 4: //中左 
    5: //中中 6: //中右 7: //下左 8: //下中 
    其余的数字都是下右
    */
    // $waterprint->output(); 
    // //输出水印图片文件覆盖到输入的图片文件 
    //======水印类实例结束======

    exit("../img/".$up->getFileName());
    //获取上传后文件名子可以存进数据库
    // 然后返回给Edit
    } else {
        echo '<pre>';
        var_dump($up->getErrorMsg());
         //获取上传失败以后的错误提示
        echo '</pre>';
    }
    //======单文件或者多文件上传类实例结束======

 ?>