<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<link href='style.css' rel='stylesheet'>
		<title><?=$h1?></title>
	</head>
<a href='index.php'>На главную</a>

<?php
if (isset ($_POST['f_submit'])) :
	$datetime = $_POST['n'];
	$accept_pl = $_POST['a'];
	$email = $_POST['e'];
	$count_pl = count($accept_pl);
	$time = date("H:i");
	$H = date('H')-1;			#true hour
	$true_time = date("Y-m-d {$H}:i");
	if ($count_pl > 0){
		include_once 'datebase.php';
		$query = $pdo->query("SELECT free, engaged FROM `ev_hall` WHERE datetime = '$datetime'");
		$info_hall = $query->fetch();			#get information about place
		$free = explode('/',$info_hall[0]);
		$engaged = $info_hall[1];
		if (empty($engaged)){
			$engaged = array();
		} else {
			$engaged = explode('/',$info_hall[1]);
		}
		foreach ($accept_pl as $value) {
			$key = array_search($value-0.1, $engaged);
			$engaged[$key] += 0.1;
			}
		$engaged = implode('/',$engaged);
		$request = $pdo->query("UPDATE ev_hall SET engaged='$engaged' WHERE datetime='$datetime';");
	}
	if ($request):?>
		<h3>Вы подтвердили <?=$count_pl?> мест(о):
		</h3></br>
	<?endif;?>
<?else :?>
	<h3>Места не подтверждены. Возможно вы промахнулись мимо чекбокса. Не расстраивайтесь и попробуйте еще раз.</h3>
<?endif?>
<html>
