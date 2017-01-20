<?php
if (isset ($_POST['f_submit'])) :
	$datetime = htmlspecialchars($_POST['n']);
	$accept_pl = $_POST['a'];
	$email = htmlspecialchars($_POST['e']);
	$count_pl = count($accept_pl);
	$time = date("H:i");
	$H = date('H')-1;			#true hour
	$true_time = date("Y-m-d {$H}:i");
	$h1 = 'Подтверждение оплаты';
	include '/template/template4.html';
	if ($count_pl > 0){
		include_once 'datebase.php';
		$query = $pdo->prepare("SELECT free, engaged FROM `ev_hall` WHERE datetime=?");
		$query->bindParam(1, $datetime, PDO::PARAM_STR);
		$query->execute();
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
		$request = $pdo->prepare("UPDATE ev_hall SET engaged=? WHERE datetime=?;");
		$request->bindParam(1, $engaged, PDO::PARAM_STR);
		$request->bindParam(2, $datetime, PDO::PARAM_STR);
		$request->execute();
	}
	include '/template/template5.html';
endif;?>
