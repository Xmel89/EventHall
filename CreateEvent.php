<?php 
include_once 'datebase.php';
if (isset($_POST['relize'])) {
	$e_date = htmlspecialchars($_POST['date']);
	$e_time = htmlspecialchars($_POST['time']);
	$datetime = $e_date.$e_time;
	$datetime = substr($datetime,0,12);
	#check whether the file is loaded
    include 'template/template7.html';
	$e_nameevent = $_POST['name_event'];
	$e_descrip = $_POST['description'];
	$e_tlow = $_POST['ticket_low'];
	$e_tmid = $_POST['ticket_mid'];
	$e_thigh = $_POST['ticket_high'];
	$create = $pdo->prepare("INSERT INTO `Hall`.`event` (`name`, `description`, `date`, `time`, `t_low`, `t_mid`, `t_high`) 
	VALUES (:e_nameevent, :e_descrip, :e_date, :e_time, :e_tlow, :e_tmid, :e_thigh);");
	$create->bindParam(':e_nameevent', $e_nameevent, PDO::PARAM_STR);
	$create->bindParam(':e_descrip', $e_descrip, PDO::PARAM_STR);
	$create->bindParam(':e_date', $e_date, PDO::PARAM_STR);
	$create->bindParam(':e_time', $e_time, PDO::PARAM_STR);
	$create->bindParam(':e_tlow', $e_tlow, PDO::PARAM_INT);
	$create->bindParam(':e_tmid', $e_tmid, PDO::PARAM_INT);
	$create->bindParam(':e_thigh', $e_thigh, PDO::PARAM_INT);
	$create->execute();
	#create hall in datebase
	$count_row = 15;
	$count_colum = 20;
	$converter = 100;		#convert number row and column in datebase format.
	$row = 1;
	$colum = 1;
	$ev_hall = array();
	while ($row <= $count_row) {
		while ($colum <= $count_colum) {
			$ev_hall[] = $row*$converter+$colum;
			$colum++;
		}
		$colum = 1;
		$row++;
	}
	$str_evhall = implode ('/' , $ev_hall);
	$primkey = $e_date.' '.$e_time.':00';
	$createhall = $pdo->prepare("INSERT INTO `Hall`.`ev_hall` (`datetime`, `free`) 
	VALUES (':primkey' , ':str_evhall');");
	$createhall->bindParam(':primkey', $primkey, PDO::PARAM_STR);
	$createhall->bindParam(':str_evhall', $str_evhall, PDO::PARAM_STR);
	$createhall->execute();
}
