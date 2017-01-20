<?php
if (isset ($_POST['f_submit'])){
$datetime = htmlspecialchars( $_POST['n']);
$accept_pl = $_POST['a'];
$email = htmlspecialchars($_POST['e']);
$count_pl = count($accept_pl);
$time = date("H:i");
$H = date('H')-1;			#true hour
$true_time=date("Y-m-d {$H}:i");
$h1 = 'Покупка билета';
include '/template/template4.html';
	if ($count_pl > 0 & $count_pl <= 5){
		include_once'datebase.php';
		$query = $pdo->prepare("SELECT free, engaged FROM `ev_hall` WHERE datetime=?");
		$query->bindParam(1, $datetime, PDO::PARAM_STR);
		$query->execute();
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
	}
	include '/template/template5.html';
}
?>
