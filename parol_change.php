<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<link href='style.css' rel='stylesheet'>
		<title><?echo $h1;?></title>
	</head>
	
<?php
session_start();
if (isset($_SESSION['name'])):?>
	<a href='adminroom.php'>К созданию концерта</a></br>
	<form method='post'>
	<input style='height: 30px; width: 400px' type='password' name='cur_pas' placeholder='Введите текущий пароль' maxlength='20' required />
	<input style='height: 30px; width: 400px' type='password' name='new_pas' placeholder='Новый пароль' maxlength='20' required />
	<input style='height: 30px; width: 400px' type='password' name='re_new_pas' placeholder='Новый пароль еще раз' maxlength='20' required />
	<input type='submit' name='change' value='Сменить'>
	</form>
	<?
	if (isset($_POST['change'])){
		$cur_pas= $_POST['cur_pas'];
		$new_pas= $_POST['new_pas'];
		$re_new_pas= $_POST['re_new_pas'];
		if($new_pas==$re_new_pas):
			include_once 'datebase.php';
			$query = $pdo->query("SELECT pass FROM auth WHERE pass='$cur_pas';");
			$pass_db = $query->fetch();
			if ($pass_db):?>
				<?$request = $pdo->query("UPDATE auth SET pass='$new_pas' WHERE login='{$_SESSION['name']}';");
				unset($cur_pas, $new_pas, $re_new_pas, $pass_bd);?>
				<h3>Пароль успешно изменен</h3>
			<?else :
				unset($cur_pas, $new_pas, $re_new_pas, $pass_bd);?>
				<h3>Пароль не изменен. Вы ввели неверный пароль</h3>
			<?endif;
		else :
			unset($cur_pas, $new_pas, $re_new_pas, $pass_bd);?>
			<h3>Пароль не изменен. Вы ввели разные пароли</h3>
		<?endif;
	}
endif;?>

</html>
