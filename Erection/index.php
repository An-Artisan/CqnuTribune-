<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="../styles/css/bootstrap.min.css">
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../styles/js/jquery-3.1.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../styles/js/bootstrap-3.3.0.min.js"></script>
</head>
<body>
	<form action="createData.php" method="post">
	<label for="">主机名或者IP地址</label>
	<input type="text"  class="form-control" name="address" placeholder="Username" aria-describedby="basic-addon1" value="localhost">
	<label for="">端口</label>
	<input type="text" class="form-control" name="port" placeholder="Username" aria-describedby="basic-addon1" value="3306">
	<label for="">用户名</label>
	<input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="basic-addon1" value="root">
	<label for="">密码</label>
	<input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon1" >
	<input type="submit" value="生成数据库及表" name="subtmi" class="btn btn-default">
	<label for="">PS:如果是远程服务器的数据库(代表填写是是IP地址)，可能生成数据库和表以及数据速度较慢，请耐心等待！</label>
</body>
</html>