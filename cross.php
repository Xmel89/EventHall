<?php
//script for delete reserve place
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
}
catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
	exit();
} 
$query ="SELECT * FROM `ev_hall` WHERE datetime>=CURRENT_DATE AND engaged!=0";
$event = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
$i=0;
$H = date('H')-2;// time rush real time on one hour, so two hours ago 
$time = date("Y-m-d {$H}:i");
while($i<=count($event)){
	$datetime = $event[$i][datetime];
	$engaged = explode('/', $event[$i][engaged]);
	$free = explode('/', $event[$i][free]);
	foreach($engaged as $key=>$value){
		if (is_numeric($value)) {
			if ($value*10%10==0){
				if ($engaged[$key+2]<=$time){
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
	$request = $pdo->query("UPDATE ev_hall SET engaged='$engaged', free='$free' WHERE datetime='$datetime';");
}
?>