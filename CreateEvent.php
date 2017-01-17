<?php 
include_once 'datebase.php';
if (isset($_POST['relize'])) :
	$e_date = $_POST['date'];
	$e_time = $_POST['time'];
	$datetime = $e_date.$e_time;
	$datetime = substr($datetime,0,12);
	#check whether the file is loaded
    if(is_uploaded_file($_FILES["downimg"]["tmp_name"])) :?>
	    <p>file download succesfull</p>
	<?move_uploaded_file($_FILES["downimg"]["tmp_name"], "img/".$datetime.'.jpg');
    else :?>
		<p>Ошибка загрузки файла</p>
	<?endif;
	$e_nameevent = $_POST['name_event'];
	$e_descrip = $_POST['description'];
	$e_tlow = $_POST['ticket_low'];
	$e_tmid = $_POST['ticket_mid'];
	$e_thigh = $_POST['ticket_high'];
	$create = $pdo->query("INSERT INTO `Hall`.`event` (`name`, `description`, `date`, `time`, `t_low`, `t_mid`, `t_high`) 
	VALUES ('$e_nameevent', '$e_descrip', '$e_date', '$e_time', '$e_tlow', '$e_tmid', '$e_thigh');");
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
$create = $pdo->query("INSERT INTO `Hall`.`ev_hall` (`datetime`, `free`) 
VALUES ('$primkey' , '$str_evhall');");
	#var_dump($primkey);
	#var_dump($str_evhall);
?>
<p>Концерт создан</p>
<?endif;?>
