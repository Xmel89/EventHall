<?php
#script for delete reserve place
try {
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
} catch (PDOException $e) {
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
	exit();
}
$current_date = "'CURRENT_DATE'";
$i = 0;
$query = $pdo->prepare("SELECT * FROM `ev_hall` WHERE datetime>=? AND engaged!=?");
$query->bindParam(1, $current_date, PDO::PARAM_STR);
$query->bindParam(2, $i, PDO::PARAM_INT);
$query->execute();
$event = $query->fetchAll(PDO::FETCH_ASSOC);
$H = date('H')-2;	#time rush real time on one hour, so two hours ago 
$time = date("Y-m-d {$H}:i");
while ($i<=count($event)) {
	$datetime = $event[$i][datetime];
	$engaged = explode('/', $event[$i][engaged]);
	$free = explode('/', $event[$i][free]);
	foreach ($engaged as $key=>$value) {
		if (is_numeric($value)) {
			if ($value*10%10==0) {
				$date_buy = new DateTime($engaged[$key+2]);
				$date_close = new DateTime($time);
				if ($date_buy <= $date_close) {
					$key_free = array_search($value+0.1, $free);
					$free[$key_free]-=0.1;
					unset($engaged[$key],$engaged[$key+1],$engaged[$key+2]);
					prev($engaged);
				}
			}
		}	
	}
	$i++;
	$engaged = implode('/',$engaged);
	$free = implode('/',$free);
	$request = $pdo->prepare("UPDATE ev_hall SET engaged = ?, free = ? WHERE datetime = ?;");
	$request->bindParam(1, $engaged, PDO::PARAM_STR);
	$request->bindParam(2, $free, PDO::PARAM_STR);
	$request->bindParam(3, $datetime, PDO::PARAM_STR);
	$request->execute();
}