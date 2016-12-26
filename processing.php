<?php
function proc_price($str){
	$near_date = explode("///" , $str);
	$datetime=$near_date[3].' '.$near_date[4];
	try{
		$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
		$pdo->exec('SET NAMES "utf8"');
		$pdo->query('SET NAMES "utf8"');
	}
	catch(PDOException $e){
		echo "Возникла ошибка соединения с БД ".$e->getMessage();
		exit();	
	}
	$query = $pdo->query("SELECT free FROM `ev_hall` WHERE datetime = '$datetime'");
	$info_hall = $query->fetch();// получаем инфу о местах
	$free = explode('/',$info_hall[0]);
	foreach ($free as $value){
		$row=(integer)($value/ 100);
		if ($row<=5 and (($value*10)%10)==0){$blat_fr++;}
		elseif ($row>5 and $row <=10 and (($value*10)%10)==0){$mid_fr++;}
		elseif ($row>10 and (($value*10)%10)==0){$bitch_fr++;}
	}
	$inf_place = array(0, 0, 0);
	if ($bitch_fr > 0){
		$inf_place[0]= 1;
	}
	if ($mid_fr > 0){
		$inf_place[1]= 1;
	}
	if ($blat_fr > 0){
		$inf_place[2]= 1;
	}
	return $inf_place;
}
?>