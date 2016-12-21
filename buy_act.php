<?php
echo"<a href='index.php'>На главную</a>";
if (isset ($_POST['f_submit'])){
$datetime = $_POST['n'];
$accept_pl=$_POST['a'];
$email = $_POST['e'];
$count_pl=count($accept_pl);
$time = date("H:i");
$H = date('H')-1;//верное время
$true_time=date("Y-m-d {$H}:i");
	if ($count_pl > 0 & $count_pl <= 5){
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
		$engaged = $info_hall[1];
		if (empty($engaged)){
			$engaged = array();
		}
		else{
		$engaged= explode('/',$info_hall[1]);
		}
		$check_free = array_intersect($free, $accept_pl);
		if (count($check_free)==count($accept_pl)){
			foreach ($accept_pl as $value){
				$key = array_search($value, $free);
				$free[$key]+=0.1;
				array_push($engaged, $value, $email, $true_time);
			}
			$engaged = implode('/',$engaged);
			$free = implode('/',$free);
			$request = $pdo->query("UPDATE ev_hall SET free='$free' , engaged='$engaged' WHERE datetime='$datetime';");
		
		}
		if ($request){
		echo "<h3>Вы успешно забронировали {$count_pl} мест(о). На ваш e-mail отправлена ссылка для оплаты. Пожалуйста, не забудьте оплатить до {$time}</h3>";
		}
	}
	elseif ($count_pl > 5) {
		echo "<h3>Места не забронированны. Все хотят послушать хороший концерт, поэтому выбирайте не более 5 мест</h3>";
		}

	else {
		echo "<h3>Места не забронированны. Возможно вы промахнулись мимо чекбокса или кто-то был порасторопнее вас. Не расстраивайтесь и попробуйте еще раз.</h3>";
	}
}
?>