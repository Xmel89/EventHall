<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<link href='style.css' rel='stylesheet'>
		<title><?=$h1?></title>
	</head>
<a href='index.php'>На главную</a>

<?php
if (isset ($_POST['f_submit'])):
$datetime = $_POST['n'];
$accept_pl=$_POST['a'];
$email = $_POST['e'];
$count_pl=count($accept_pl);
$time = date("H:i");
$H = date('H')-1;			#true hour
$true_time=date("Y-m-d {$H}:i");
	if ($count_pl > 0 & $count_pl <= 5):
		include_once'datebase.php';
		$query = $pdo->query("SELECT free, engaged FROM `ev_hall` WHERE datetime = '$datetime'");
		$info_hall = $query->fetch();			#get information about place
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
		if ($request):?>
		<h3>Вы успешно забронировали <?=$count_pl?> мест(о). На ваш e-mail отправлена ссылка для оплаты. Пожалуйста, не забудьте оплатить до <?=$time?></h3>
		<?endif?>
	<?elseif ($count_pl > 5) :?>
		<h3>Места не забронированны. Все хотят послушать хороший концерт, поэтому выбирайте не более 5 мест</h3>
	<?else :?>
		<h3>Места не забронированны. Возможно вы промахнулись мимо чекбокса или кто-то был порасторопнее вас. Не расстраивайтесь и попробуйте еще раз.</h3>
	<?endif;?>
<?endif;?>
</html>
