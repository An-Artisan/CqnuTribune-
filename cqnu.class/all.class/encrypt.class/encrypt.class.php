<?php 
/* * *********************************************
 * @类名:   Code
 * @参数:   	$ins-单例模式保存对象
 * @方法	    create_singleton()-获取对象
	 			encrypt()-进行字符串加密
 				verify()-加密验证
 * @功能:   密码加密及验证
 * @作者:   不敢为天下
*/
class Encrypt{
   
   protected static $ins = null;
	// 保存对象
	public function create_singleton(){
	if(self::$ins == null){
		self::$ins = new self();
	}
	// 如果静态变量为null的话就创建一个对象
		return self::$ins;
	// 如果静态变量不为null的话，就直接返回当前的对象
	}
	final protected function __construct(){
		
	}
	// 禁止继承类重写构造函数
	final protected function __clone(){

	}
	// 禁止克隆对象
	public function encrypt($password){
		return password_hash($password, PASSWORD_DEFAULT);	
		// 进行密码加密 (60个字符以上的长度)
		/*
		这里采用的是Password Hashing API 加密，模式是默认，
		默认的模式是Bcrypt。单独的Bcrypt加密不太好，所以Password Hashing API结合了传统的加密进行改良。传统的MD5加密安全性不是很好，
		已经被大多数人所知。许多框架就是使用这种方法加密比如:laravel
		*/
	}
	public function verify($password,$encrypt_password){
		if(password_verify($password, $encrypt_password)){
			return true;
		}
		// 如果输入的密码和是原先加密的密码就返回true
		return false;
		// 否则就返回flase

	}
	
}


 ?>