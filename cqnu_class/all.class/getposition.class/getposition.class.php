<?php 
/* * *********************************************
 * @类名:   GetPosition
 * @参数:     $position-定义所在城市位置变量
              $jsonAddress-定义API返回的json地址
 * @方法      get_position()-获得所在城市位置

 * @功能:     获取客户端所在城市位置
 * @作者:     不敢为天下
*/
class GetPosition{
    protected $position = null;
    // 定义位置
    protected $jsonAddress = null;
    // 定义返回json地址
    function __construct(){
      $ipContent  = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"); 
    //  获取新浪API接口返回的地址内容
      $jsonData = explode("=",$ipContent);   
    //  分离数组
      $Address = substr($jsonData[1], 0, -1);  
    // 截取字符串
      $this->jsonAddress = $Address;  
    // 把数据赋值给成员变量
    }  
    function get_position(){
    $ip_info=json_decode($this->jsonAddress); 
    //  对JSON 格式的字符串进行编码 
    foreach($ip_info as $item){
     if (!is_numeric($item)) {
          $this->position .= $item . ' ';
     }
         }
    // 得到需要的地址信息
         return $this->position;
    //  返回地址
    }
    
    }
 

 ?>