<?php 
session_start();
$action = 'buy_act.php';
$buy = 'Забронировать';
$a = false;
$required = 'required';
if (isset($_SESSION['name'])) {
	$buy = 'Подтвердить';
	$a = true;
	$action = 'accept.php';
	$required = NULL;
}
if (isset($_POST['buy'])){
	$e_name = htmlspecialchars($_POST['n']);
	$img_src = htmlspecialchars($_POST['i']);
}
$near_date = explode("///" , $e_name);
$time = substr("$near_date[4]",0,5);
$datetime = $near_date[3].' '.$near_date[4];
$form = "<form method='post' action='{$action}'>
<input type='email' name='e' placeholder='Ваш e-mail' {$required} >
<input type='submit' name='f_submit' value='{$buy}'/>
<input type='hidden' name='n' value='{$datetime}'>";
include '/template/template9.html';
include 'datebase.php';
$query = $pdo->prepare("SELECT free, engaged FROM `ev_hall` WHERE datetime=?");
$query->bindParam(1, $datetime, PDO::PARAM_STR);
$query->execute();
$info_hall = $query->fetch(); 
$free = explode('/',$info_hall[0]);
$engaged = explode('/',$info_hall[1]);
$i = 0;
while ($i < sizeof($free)) {
	$b = false;
	$place = $free[$i]%100;
	$row = (integer)($free[$i]/ 100);
	$title = '';
	if ($a){	
		$key = array_search($free[$i]-0.1, $engaged);
		if (is_int($key)) {
			$title = $engaged[$key+1];
		}
		$key = array_search($free[$i], $engaged);
		if (is_int($key)) {
			$b = true;
			$title = $engaged[$key+1];
		}
	}
	$p_teg = "<p class= 'chk2' title='{$title}'>место</br> {$place}</p>";
	if ((($free[$i]*10)%10) != 0) {#define type place
		$sort = 'del';
	} elseif ($row <= 5) {
		$sort='high';
	} elseif (5 < $row and $row <= 10) {
		$sort = 'mid';
	} else {
		$sort = 'low';
	}
	$ceel = "<td class = '{$sort}'><input type='checkbox'  class='chk' name='a[]' value='{$free[$i]}'>{$p_teg}</td>";
	$noceel = "<td class = '{$sort}'></br><input type='hidden' name='b' value='{$free[$i]}' > {$p_teg}</td>";
	$paid = "<td class = '{$sort}'></br><input type='hidden' name='b' value='{$free[$i]}' > {$p_teg}</td>";
	if ($a) {	
		list ($ceel, $noceel) = array($noceel, $ceel);
	}
	include '/template/template10.html';
	$i++;
}
?>
