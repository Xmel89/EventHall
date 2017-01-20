<?php
session_start();
if (isset($_SESSION['name'])){
	$a = False;
	if (isset($_POST['change'])){
		$cur_pas= $_POST['cur_pas'];
		$new_pas= $_POST['new_pas'];
		$re_new_pas= $_POST['re_new_pas'];
		if($new_pas==$re_new_pas){
			include_once 'datebase.php';
			$query = $pdo->prepare("SELECT pass FROM auth WHERE pass=?;");
			$query->bindParam(1, $cur_pas, PDO::PARAM_STR);
			$query->execute();
			$pass_db = $query->fetch();
			if ($pass_db){
				$request = $pdo->query("UPDATE auth SET pass='$new_pas' WHERE login='{$_SESSION['name']}';");
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
	include '/template/template8.html';
	var_dump ($messege);
}
