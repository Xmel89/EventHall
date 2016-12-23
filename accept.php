<?php
session_start();
if (isset($_SESSION['name'])){
echo"<a href='index.php'>На главную</a>";
if (isset ($_POST['f_submit'])){
	$datetime = $_POST['n'];
	$accept_pl=$_POST['a'];
	$email = $_POST['e'];
	$count_pl=count($accept_pl);
	$time = date("H:i");
	$H = date('H')-1;//верное время
	$true_time=date("Y-m-d {$H}:i");
	if ($count_pl > 0){
		try{
			$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
			$pdo->exec('SET NAMES "utf8"');
			$pdo->query('SET NAMES "utf8"');
		}
		catch(PDOException $e){
			echo "Возникла ошибка соединения с БД ".$e->getMessage();
			exit();
		}
		$query = $pdo->query("SELECT free, engaged FROM `ev_hall` WHERE datetime = '$datetime'");
		$info_hall = $query->fetch();// получаем инфу о местах
		$free = explode('/',$info_hall[0]);
		$engaged = $info_hall[1];
		if (empty($engaged)){
			$engaged = array();
		}
		else{
			$engaged= explode('/',$info_hall[1]);
		}
		foreach ($accept_pl as $value){
			$key = array_search($value-0.1, $engaged);
			$engaged[$key]+=0.1;
			}
			$engaged = implode('/',$engaged);
			$request = $pdo->query("UPDATE ev_hall SET engaged='$engaged' WHERE datetime='$datetime';");
		}
		if ($request){
			echo "<h3>Вы подтвердили {$count_pl} мест(о):
			</h3></br>";
		}
}


	else {
		echo "<h3>Места не подтверждены. Возможно вы промахнулись мимо чекбокса. Не расстраивайтесь и попробуйте еще раз.</h3>";
	}
}
?>
