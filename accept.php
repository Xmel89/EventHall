<?php
echo"<a href='index.php'>На главную</a>";
if (isset ($_POST['f_submit'])){
$datetime = $_POST['n'];
$accept_pl=$_POST['a'];
$count_pl=count($accept_pl);
	if ($count_pl > 0){
		echo "<h3>Вы подтвердили {$count_pl} мест(о)</h3></br>";
	}

	else {
		echo "<h3>Места не подтверждены. Возможно вы промахнулись мимо чекбокса. Не расстраивайтесь и попробуйте еще раз.</h3>";
		}
}
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
exit();}
$query = $pdo->query("SELECT free, engaged FROM `ev_hall` WHERE datetime = '$datetime'");
$info_hall = $query->fetch();// получаем инфу о местах
$free = explode('/',$info_hall[0]);
$engaged= explode('/',$info_hall[1]);
?>
