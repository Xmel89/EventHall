<?php
session_start();
if (isset($_SESSION['name'])) {
$login = $_SESSION['name'];
	if (isset($_POST['change'])) {
		$cur_pas= $_POST['cur_pas'];
		$new_pas= $_POST['new_pas'];
		$re_new_pas= $_POST['re_new_pas'];
		if($new_pas==$re_new_pas) {
			include_once 'datebase.php';
			$query = $pdo->prepare("SELECT pass FROM auth WHERE pass=?;");
			$query->bindParam(1, $cur_pas, PDO::PARAM_STR);
			$query->execute();
			$pass_db = $query->fetch();
			if ($pass_db) {
				$request = $pdo->prepare("UPDATE auth SET pass=? WHERE login= ?;");
				$request->bindParam(1, $new_pas, PDO::PARAM_STR);
				$request->bindParam(2, $login, PDO::PARAM_STR);
				$request->execute();
				$messege = 1;
				unset($cur_pas, $new_pas, $re_new_pas, $pass_bd);
			} else {
				$messege = 1.2;
				unset($cur_pas, $new_pas, $re_new_pas, $pass_bd);
			}
		} else {
			$messege = 0;
			unset($cur_pas, $new_pas, $re_new_pas, $pass_bd);
		}
	}
	include 'template/template8.html';
}
