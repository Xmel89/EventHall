<?php
$auth==false;
    try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
	exit;
}	
if (isset($_POST['ubmit'])){
	$e_login = $_POST['login'];
	$e_password = $_POST['password'];

	$query = $pdo->query("SELECT pass FROM auth WHERE login='$e_login'");
	$user_pass = $query->fetch();
		if ($user_pass[0]==$e_password) {
			$auth = true;
			require('adminroom.php'); 
		}
		else {
			echo "<div>Неверный логин или пароль</div>";	
		}
	}

if ($auth==false){
	echo "
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-'>
		<link href='style.css' rel='stylesheet'>
		<title>Вход</title>
	</head>
	<body>
		<header>
			<h1>Вход в Админку</h1>
		</header>
		<div align='center'>
			<form method='post' action='admin.php'>
				<input type='text' name='login' placeholder='Логин' required /></br>
				<input type='password' name='password' placeholder='Пароль' required /></br>
				<input type='submit' name='ubmit' value='Войти'/>
			</form>
		</div>
	</body>
</html>";
}
?>