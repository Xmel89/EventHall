<?php 
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
exit();}
 if (isset($_POST['relize'])){
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["downimg"]["tmp_name"]))
   {echo 'file download succesfull';
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
     move_uploaded_file($_FILES["downimg"]["tmp_name"], "img/".$_FILES["downimg"]["name"]);
   } else {
 echo("Ошибка загрузки файла");}
	$e_downimg = $_FILES["downimg"]["name"];
	$e_nameevent = $_POST['name_event'];
	$e_descrip = $_POST['description'];
	$e_date = $_POST['date'];
	$e_time = $_POST['time'];
	$e_tlow = $_POST['ticket_low'];
	$e_tmid = $_POST['ticket_mid'];
	$e_thigh = $_POST['ticket_high'];
	$create = $pdo->query("INSERT INTO `Hall`.`event` (`name`, `description`, `date`, `time`, `t_low`, `t_mid`, `t_high`, `img`) 
	VALUES ('$e_nameevent', '$e_descrip', '$e_date', '$e_time', '$e_tlow', '$e_tmid', '$e_thigh', '$e_downimg');");}
echo "Концерт создан"; 
var_dump ($e_downimg); 
?>