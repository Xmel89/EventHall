<?php
session_start();
$auth == false;
include_once 'datebase.php';
if (isset($_POST['ubmit'])) {
	$e_login = $_POST['login'];
	$e_password = md5($_POST['password']);
	$query = $pdo->query("SELECT pass FROM auth WHERE login='$e_login'");
	$user_pass = $query->fetch();
	if (md5($user_pass[0]) == $e_password) :
		session_start();
		$_SESSION ['name'] = $e_login;
	else :?>
		<div>Неверный логин или пароль</div>	
	<?endif;
}
if (isset($_POST['logout'])) {
	unset ($_SESSION['name']);
	session_destroy();
}
if (isset($_SESSION ['name'])) :
	header('location:adminroom.php');
	exit;
else :?>
	
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
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
</html>
<?endif;?>
