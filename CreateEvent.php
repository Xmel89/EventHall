<?php 
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
exit();}
 if (isset($_POST['relize'])){
	 $e_date = $_POST['date'];
	 $e_time = $_POST['time'];
	 $datetime = $e_date.$e_time;
	 $datetime = substr($datetime,0,12);
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["downimg"]["tmp_name"]))
   {echo 'file download succesfull ';
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
	move_uploaded_file($_FILES["downimg"]["tmp_name"], "img/".$datetime.'.jpg');
   } else {
 echo("Ошибка загрузки файла ");}
	$e_nameevent = $_POST['name_event'];
	$e_descrip = $_POST['description'];
	$e_tlow = $_POST['ticket_low'];
	$e_tmid = $_POST['ticket_mid'];
	$e_thigh = $_POST['ticket_high'];
	$create = $pdo->query("INSERT INTO `Hall`.`event` (`name`, `description`, `date`, `time`, `t_low`, `t_mid`, `t_high`) 
	VALUES ('$e_nameevent', '$e_descrip', '$e_date', '$e_time', '$e_tlow', '$e_tmid', '$e_thigh');");
	//Создание зала для БД
	$row=1;
	$colum=1;
	$ev_hall = array();
	while ($row<=15){
		while ($colum<=20)
			{$ev_hall[]=$row*100+$colum;
			$colum++;}
		$colum=1;
		$row++;
	}
$str_evhall=implode ('/' , $ev_hall);
$primkey=$e_date.' '.$e_time.':00';
$create = $pdo->query("INSERT INTO `Hall`.`ev_hall` (`datetime`, `free`) 
VALUES ('$primkey' , '$str_evhall');");
	//var_dump($primkey);
	//var_dump($str_evhall);
 echo "Концерт создан";}
?>