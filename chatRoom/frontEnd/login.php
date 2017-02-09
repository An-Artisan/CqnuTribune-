<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
	session_start();
	$_SESSION['user'] = 'liuqiang';
	 ?>
	<form action="chatRoom.php" method="POST">
		<input type="text" name="user">
		<input type="submit" value="登录">
	</form>
</body>
</html>