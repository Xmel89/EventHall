<?php
function proc_price($str) { 			#This function get information about place
	$near_date = explode("///" , $str);
	$datetime = $near_date[3].' '.$near_date[4];
	include 'datebase.php';
	$query = $pdo->prepare("SELECT free FROM `ev_hall` WHERE datetime=?");
	$query->bindParam(1, $datetime, PDO::PARAM_STR);
	$query->execute();
	$info_hall = $query->fetch();
	$free = explode('/',$info_hall[0]);
	foreach ($free as $value){
		$count_in_class = 5;
		$row = (integer)($value/ 100);
		if ($row <= $count_in_class and (($value * 10) % 10) == 0) {
			$low_fr++;
		} elseif ($row > $count_in_class  and $row <= $count_in_class*2 and (($value * 10) % 10) == 0) {
			$mid_fr++;		#for mid price group
		} elseif ($row > $count_in_class*2 and (($value * 10) % 10) == 0){
			$high_fr++;
		}		#for high price group
	}
	$inf_place = array(0, 0, 0);
	if ($low_fr > 0) {
		$inf_place[0] = 1;
	}
	if ($mid_fr > 0) {
		$inf_place[1] = 1;
	}
	if ($high_fr > 0) {
		$inf_place[2] = 1;
	}
	return $inf_place;
}
?>