<?php 
/* * *********************************************
 * @类名:   Mail
 * @参数:   $mail - 连接句柄
 *          $ins-单例模式保存对象
 * @方法	create_singleton()-获取对象
 			setUsername()-设置用户名
 			setPassword()-设置用户名
 			setFrom()-设置转发邮件地址
 			setFromName()-设置发送人显示的姓名或者地址
 			setSubject()-设置发送的主题
 			setBody()-设置发送主体内容
 			setAddAdress()-增加一个收件人地址(邮件目的地址).以及发送人的名字
 			sendEmail()-发送邮件
 * @功能:   发送邮件
 * @作者:   不敢为天下
	1、引入
	2、实例化
	3、配置属性
	4、调用发送
*/

class Mail{
	
	protected  $mail = null;
	// 定义连接句柄
	protected static $ins = null;
	// 定义对象存放静态变量
	final protected function __construct(){
		require 'PHPMailer/class.phpmailer.php';
		// 引用文件类
		$this->mail = new PHPMailer();
		// 实例化对象的时候吧PHPmailer赋值给email
		$this->mail->CharSet = 'UTF-8';
		// 设置字符集，163邮箱不设置，会乱码
		date_default_timezone_set('PRC');
		// 时区设置。
		$this->mail->IsSMTP();
		// 开启SMTP协议
		$this->mail->Host = 'smtp.163.com';	
		// 转发主机smtp.163.com
		$this->mail->Port = 25;
		// 端口号 25
		$this->mail->SMTPAuth = true;
		// 自动转发，是
	}
	// 禁止继承类覆盖构造函数
	public function create_singleton(){
		if(self::$ins == null){
			self::$ins = new self();
		}
		// 如果静态变量为null的话就创建一个对象
			return self::$ins;
		// 如果静态变量不为null的话，就直接返回当前的对象
	}
		
	final protected function __clone(){

	}
		// 禁止克隆对象
	public function setUsername($username){
			$this->mail->Username = $username;
	}
	// 设置转发邮箱的服务器用户名
	public function setPassword($password){
			$this->mail->Password = $password;
	}
	// 设置转发邮箱的服务器密码
	public function setFrom($from){
			$this->mail->From = $from;
	}
	// 设置转发的邮件地址(必须有一个转发的邮件地址，一般是用163的邮箱)
	public function setFromName($name){
			$this->mail->FromName = $name;
	}
	// 设置发送人显示的姓名或者地址
	public function setSubject($subject){
			$this->mail->Subject = $subject;
	}
	// 设置发送的主题
	public function setBody($body){
			$this->mail->Body = $body;
	}
	// 设置发送的主体内容
	public function setAddAdress($email,$name){
		$this->mail->AddAddress($email,$name);
	}
	// 增加一个收件人地址(邮件目的地址).以及发送人的名字
	public function sendEmail(){
		if(!$this->mail->send()){
				$error_info = $this->mail->ErrorInfo;
				// 错误信息
				$log = EmailLog::create_singleton();
				// 实例化LOG
				$log->write($error_info);
				// 写入错误信息
				return 0;
		}
		else{
			return 1;
		}
	}
	// 发送邮件

}
//=====单例模式结束=====
class EmailLog{
	protected $open = null;
	// 定义打开文件句柄
	protected static $ins = null;
	// 保存对象
	protected static $path = 'sql.log';
	// 定义日志文件路径
	public function create_singleton(){
	if(self::$ins == null){
		self::$ins = new self();
	}
	// 如果静态变量为null的话就创建一个对象
		return self::$ins;
	// 如果静态变量不为null的话，就直接返回当前的对象
	}

	final protected function __clone(){

	}
	// 禁止克隆对象
	public function write($error_info){
		// 定义写入日志函数

		$email_fail = '邮件失败提示信息:';
		// 日志提示
		$error_info = $email_fail.$error_info;
		// 拼接
		$error_info .= "\n\r";
		// 在linux中\r是换行,windows中，\n\r都可以换行
		$error_time = "错误时间:";
		// 设置错误时间
		$time =  date("Y-m-d H:i:s");
		// 获取当前时间
		$error_time = $error_time.$time;
		// 拼接
		$error_time .= "\n\r";
		// 在linux中\r是换行,windows中，\n\r都可以换行
		fwrite($this->open,$error_info);
		// 写入文件
		fwrite($this->open,$error_time);
		// 写入文件
		
	}
	final protected function __construct(){
		$this->open = fopen($this->path,"a");
		// 实例化对象时，把打开文件的句柄赋值给类保护变量$open
	}
		//禁止继承类覆盖构造函数
}
//=====单例模式结束=====



 ?>