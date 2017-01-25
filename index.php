<?php 
session_start();
$buy = 'Купить билет';
$h1 = 'Концертный зал';
if (isset($_SESSION['name'])) {
	$buy = 'Выбрать';
	$h1 = 'Выбери концерт:';
}	
$H = date('H')-1;	#true hour
$true_time = date("Y-m-d {$H}:i e");
include 'datebase.php';
$current_date = "'CURRENT_DATE'";
$query = $pdo->prepare("SELECT * FROM `event` WHERE date>=? ORDER BY `event`.`date` ASC, `event`.`time` ASC");
$query->bindParam(1, $current_date, PDO::PARAM_STR);
$query->execute();
$near_event = $query->fetchAll(PDO::FETCH_ASSOC);
$size_neev = sizeof($near_event);
$i = 0;
$no_ev = false;
include 'template/template1.html';
if ($size_neev > 0) { 
	if ($size_neev > 5) {
		$mn = true;
		$max_neev = $size_neev;
		$size_neev = 5;
	}
	while ($i < $size_neev) {	
		$near_date = $near_event[$i];
		if ($near_date[date] == date("Y-m-d") and $near_date[time] < date("{$H}:i:s")) {
			if ($mn == true and $size_neev < max_neev) {
				$size_neev++;
			}
			$i++;
			$no_ev = true;
			continue;
		}
		$img_src = '/img/'.$near_date[date].$near_date[time];
		$img_src = substr("$img_src",0,17);
		$img_src .= '.jpg';
		$time = substr("$near_date[time]", 0, 5);
		$str_nd = implode ("///", $near_date);
		include_once 'processing.php';
		$inf = proc_price($str_nd);
		$t_low = $near_date['t_low'];
		$t_mid = $near_date['t_mid'];
		$t_high = $near_date['t_high'];
		$submit = 'submit';
		if (in_array('1', $inf)) {
			if ($inf[0] == 1) {
				$of = $t_low;
			}
			elseif ($inf[1] == 1) {
				$of = $t_mid;
			}
			else {
				$of = $t_high;
			}
			if ($inf [2] == 1) {
				$to = $t_high;
			}
			elseif ($inf[1] == 1) {
				$to = $t_mid;
			}
			else {
				$to = $t_low;
			}
			$str_of = 'от '.$of.' руб';
			$str_to = 'до '.$to.' руб';
		}
		else {
			$submit = 'hidden';
			$str_of = 'Билетов нет';
			$str_to = '';
		}
		include 'template/template2.html';
		$i++;
	}
}
elseif ($no_ev == true || $size_neev == 0) {
	include 'template/template3.html';
}	
