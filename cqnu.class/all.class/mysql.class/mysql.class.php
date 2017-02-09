<?php 
/*
		           _ooOoo_
                  o8888888o
                  88" . "88
                  (| -_- |)
                  O\  =  /O
               ____/`---'\____
             .'  \\|     |//  `.
            /  \\|||  :  |||//  \
           /  _||||| -:- |||||-  \
           |   | \\\  -  /// |   |
           | \_|  ''\---/''  |   |
           \  .-\__  `-`  ___/-. /
         ___`. .'  /--.--\  `. . __
      ."" '<  `.___\_<|>_/___.'  >'"".
     | | :  `- \`.;`\ _ /`;.`/ - ` : | |
     \  \ `-.   \_ __\ /__ _/   .-` /  /
======`-.____`-.___\_____/___.-`____.-'======
                   `=---='
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
       	  佛祖保佑       永无BUG
*/
/* * *********************************************
 * @类名:   	MysqlConn
 * @参数:   	$ins-单例模式保存对象
 				$servername-服务器地址
 				$username-数据库用户名
 				$password-数据库密码
 				$dbName-数据库
 				$conn-连接句柄

 * @方法	    conn()-连接数据库
	 			set_timezone()-设置中国时区
 * @功能:   	单例模式连接数据库
 * @作者:   	不敢为天下
*/
class MysqlConn{
	protected static  $ins = null;
	// 保存对象
	public   $servername = 'localhost';
	// 服务器地址
	public   $username = 'root';
	// 数据库用户名
	public   $password = '';
	// 数据库登陆密码
	public   $dbName = 'private_message';
	// 数据库
	protected $conn = null;
	public function create_singleton(){
		if(self::$ins == null){
			self::$ins = new self();
		}
		// 如果静态变量为null的话就创建一个对象
			return self::$ins;
		// 如果静态变量不为null的话，就直接返回当前的对象
	}
	public function conn(){
	$this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		// 建立mysql数据库连接
	$this->set_timezone();
		// 设置时区
	return $this->conn;
		// 返回连接句柄
	}
	private function set_timezone(){
		date_default_timezone_set('PRC');
		//时区设置为中华人民共和国
		mysqli_query($this->conn, "set names utf8");
		//查询的字符格式设置为utf-8
	}
	final protected function __construct(){

	}
	// 禁止继承类覆盖构造函数
	public function __destruct() {
		if (!empty ($this->conn)) {
			mysqli_close($this->conn);
		}
		// 关闭连接
	}
	//析构函数，自动关闭数据库,垃圾回收机制
	final protected function __clone(){

	}
	// 禁止克隆对象
}
// =====单例模式结束=====
/* * *********************************************
 * @类名:   	Insert
 * @参数:   	$ins-单例模式保存对象
 				$conn-连接句柄

 * @方法	    create_singleton()-获取对象
	 			insert()-添加一条数据
 * @功能:   	添加一条数据
 * @作者:   	不敢为天下
*/
class Insert{
	protected static $conn = null;
	// 定义连接句柄
	protected static $ins = null;
	// 保存对象
	final protected function __construct(){
		$mysql = MysqlConn::create_singleton();
	//  实例化mysqlconn连接对象
		$this->conn = $mysql->conn();
	//  得到连接句柄
	}
	// 禁止继承类覆盖构造函数
	public function insert($table,$array){
			$sql_field = "insert into " . $table . " (";
			// 定义insert语句前半部分
			$sql_value = "values (";
			// 定义insert语句后半部分
			foreach ($array as $key => $value) {
					$field[] = $key;
					// 获取字段存在一个数组
					$field_value[] = addslashes($value);
					// 获取值存在一个数组,并且过滤不安全的字符串，防sql注入
			}
			
			for ($i = 0; $i < count($field); $i ++) {
				// count()求数组的长度
				if($i == count($field)-1){
				$sql_field .= $field[$i] . ") ";
				$sql_value .= "'".$field_value[$i] . "'" . ") ";
				}
				// 如果是最后一个字段就不加逗号，而是加后半括号
				else{
				$sql_field .= $field[$i]. ",";
				$sql_value .= "'".$field_value[$i]."'" . ",";
				}
				// 如果不是最后一个字段就加逗号
			}
			$sql = $sql_field.$sql_value;
			// 拼接字符串
			// echo $sql;
			// 输入测试语句
			if(mysqli_query($this->conn,$sql)){
				// 执行查询
				return true;
				// 如果插入成功就返回true
			}
			else{
				// 查询失败
				$reason = mysqli_error($this->conn);
				// 错误原因
				$log = Log::create_singleton();
				// 实例化日志对象
				$log->write($sql,$reason);
				// 写入日志
				return false;
			}
			
			
	}
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
}
//=====单例模式结束=====
/* * *********************************************
 * @类名:   	Log
 * @参数:   	$ins-单例模式保存对象
 				$open-连接句柄

 * @方法	    create_singleton()-获取对象
	 			write()-添加错误信息到日志
 * @功能:   	把错误信息写进日志文件
 * @作者:   	不敢为天下
*/
class Log{
	protected $open = null;
	// 定义打开文件句柄
	protected static $ins = null;
	// 保存对象
	protected $path = 'sql.log';
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
	public function write($sql,$reason){
		// 定义写入日志函数

		$notice_sql = '错误语句:';
		// 日志提示
		$sql = $notice_sql.$sql;
		// 拼接
		$sql .= "\n\r";
		// 在linux中\r是换行,windows中，\n\r都可以换行
		$notice_reason = "错误原因:";
		// 日志提示
		$reason = $notice_reason.$reason;
		// 拼接
		$reason .= "\n\r";
		// 在linux中\r是换行,windows中，\n\r都可以换行
		$notice_time = "错误时间:";
		$time =  date("Y-m-d H:i:s");
		// 获取当前时间
		$time = $notice_time.$time;
		// 拼接
		$time .= "\n\r";
		// 在linux中\r是换行,windows中，\n\r都可以换行
		fwrite($this->open,$sql);
		// 写入文件
		fwrite($this->open,$reason);
		// 写入文件
		fwrite($this->open,$time);
		// 写入文件
		fclose($this->open);
		// 关闭句柄
	}
	final protected function __construct(){
		$this->open = fopen($this->path,"a");
		// 实例化对象时，把打开文件的句柄赋值给类保护变量$open
	}
		//禁止继承类覆盖构造函数
}
//=====单例模式结束=====
/* * *********************************************
 * @类名:   	Delete
 * @参数:   	$ins-单例模式保存对象
 				$conn-连接句柄

 * @方法	    create_singleton()-获取对象
	 			delete()-删除指定的记录
 * @功能:   	删除数据库记录
 * @作者:   	不敢为天下
*/
class Delete{
	protected static $conn = null;
	// 定义连接句柄
	protected static $ins = null;
	// 保存对象
	final protected function __construct(){
		$mysql = MysqlConn::create_singleton();
	//  实例化mysqlconn连接对象
		$this->conn = $mysql->conn();
	//  得到连接句柄
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
	public function delete($table,$field,$operator,$value){
		// 需要传入4个参数，表名，字段名，操作符，值
		$sql = "delete from $table where $field " . $operator . "'" . $value . "'";
		// 拼接sql语句
		// echo $sql;
		// 测试语句
		if(mysqli_query($this->conn,$sql)){
				// 执行查询
				return true;
				// 如果插入成功就返回true
			}
			else{
				// 查询失败
				$reason = mysqli_error($this->conn);
				// 错误原因
				$log = Log::create_singleton();
				// 实例化日志对象
				$log->write($sql,$reason);
				// 写入日志
				return false;
			}
	}
}
//=====单例模式结束=====
/* * *********************************************
 * @类名:   	Update
 * @参数:   	$ins-单例模式保存对象
 				$conn-连接句柄

 * @方法	    create_singleton()-获取对象
	 			update()-更新指定的记录
 * @功能:   	更新记录
 * @作者:   	不敢为天下
*/
class Update{
	protected static $conn = null;
	// 定义连接句柄
	protected static $ins = null;
	// 保存对象
	final protected function __construct(){
		$mysql = MysqlConn::create_singleton();
	//  实例化mysqlconn连接对象
		$this->conn = $mysql->conn();
	//  得到连接句柄
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
	public function update($table,$array,$field,$operator,$value){
		// 需要传入5个参数，表名，数组，字段，操作符，值

			$value = "'".addslashes($value)."'";
			// 给值加上分隔符,过滤不安全的字符串，防sql注入
			$sql = "update $table set ";
			// 拼接sql语句
			foreach ($array as $k => $v) {
				$sql .= $k . "=" . "'" . addslashes($v) . "',";
			}
			// 拼接传过来的参数为一个sql语句,过滤不安全的字符串，防sql注入
			$sql = substr($sql, 0, -1);
			// 删除最后一个逗号
			$sql .= " where $field" . $operator . "$value";
			// 完成拼接
			// echo $sql;
			// 输入测试语句
			if(mysqli_query($this->conn,$sql)){
				// 执行查询
				return true;
				// 如果插入成功就返回success
			}
			else{
				// 查询失败
				$reason = mysqli_error($this->conn);
				// 错误原因
				$log = Log::create_singleton();
				// 实例化日志对象
				$log->write($sql,$reason);
				// 写入日志
				return false;
			}
	}

}
//=====单例模式结束=====
/* * *********************************************
 * @类名:   	Selete
 * @参数:   	$ins-单例模式保存对象
 				$conn-连接句柄
				$result-保存结果集
 * @方法	    create_singleton()-获取对象
	 			select()-查询指定的SQL语句，返回结果集
	 			query()-执行查询语句
	 			page_result()-查询分页结果集
	 			page_count()-查询表中记录总数
 * @功能:   	查询记录
 * @作者:   	不敢为天下
*/
class Select{
	protected static $conn = null;
	// 定义连接句柄
	protected static $ins = null;
	// 保存对象
	protected $result = null;
	// 保存结果集
	final protected function __construct(){
		$mysql = MysqlConn::create_singleton();
	//  实例化mysqlconn连接对象
		$this->conn = $mysql->conn();
	//  得到连接句柄
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
	public function select($sql){
		 if($this->result = mysqli_query($this->conn,$sql)){
				// 执行查询
				return $this->result;
				// 返回结果集
			}
		else {
			// 查询失败
			$reason = mysqli_error($this->conn);
			// 错误原因
			$log = Log::create_singleton();
			// 实例化日志对象
			$log->write($sql,$reason);
			// 写入日志
			return false;
				}
	}

	public function query($sql){
		 if(mysqli_query($this->conn,$sql))
		 // 执行查询语句
		 	return true;
		 else
		 	return false;
	}
	public function page_count($sql){
				$row = mysqli_fetch_assoc(mysqli_query($this->conn,$sql));
				$count = $row['c'];
				// 获取表总数
				return $count;
	}
	public function __destruct(){
			if(!empty($this->result)){
				// 不为空就释放结果
				mysqli_free_result($this->result);
				// 释放结果
			}
	}
	// 析构函数，自动释放结果集，垃圾回收机制
}
//=====单例模式结束=====



?>


