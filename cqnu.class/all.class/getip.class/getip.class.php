<?php 
/* * *********************************************
 * @类名:   GetIp
 * @参数:     $realip - 地址保存的保护类成员变量
 * @方法      get_ip()-获取真实IP
               
 * @功能:   获取客户端真实IP，可以去除代理IP地址找到真正IP
 * @作者:   不敢为天下
*/
class GetIp{
    protected  $realip = null;
    // 真实的IP地址
    protected  $server_ip = null;
    // 服务器的真实IP地址
    public function get_ip(){
        if (isset($_SERVER)){
                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                    $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                    // 如果设置了代理服务器就获取客户端的真实IP
            } else {
                    $realip = $_SERVER["REMOTE_ADDR"];
                    // 没有设置代理服务器就直接获取服务器根据客户端指定的IP
                    }
            } 
                    return $realip;
                    // 返回IP
        }
    public function get_server_ip() { 
        if (isset($_SERVER)) { 
            if($_SERVER['SERVER_ADDR']) {
                $server_ip = $_SERVER['SERVER_ADDR']; 
            } else { 
                $server_ip = $_SERVER['LOCAL_ADDR']; 
            } 
        } else { 
            $server_ip = getenv('SERVER_ADDR');
        } 
        return $server_ip; 
        }
    }

  


 ?>