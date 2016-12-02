<?php 
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
exit();}
$query = $pdo->query("SELECT COUNT(*) FROM event");
	$count_ev = $query->fetch();
	$query = $pdo->query("SELECT * FROM `event` WHERE date = (SELECT MAX(date) FROM event)");
$near_date = $query->fetch();
$img_src = '/img/'.$near_date[3].$near_date[4];
$img_src =substr("$img_src",0,17);
$time= substr("$near_date[4]",0,5);
?>
	<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-'>
		<link href='style.css' rel='stylesheet'>
		<title>Концертный зал</title>
	</head>
	<body>
		<header>
			<h1>Концертный зал</h1>
		</header>
		<table cellpadding='14'>
			<tr>
				<td rowspan='4'>
					<h2><?php echo"$near_date[1]"?></h2>
					<div class = "imgCenter"><?php echo "<img src='$img_src', alt='картинка с изображением'></img>";?></div>
				</td>
				<td><?php echo"$near_date[3] в "; echo"$time"; ?>  </td>
			</tr>
			<tr>
				<td>Цены на билет:</br> от <?php echo"$near_date[5]"?> руб </td>
			</tr>
			<tr>
				<td>до <?php echo"$near_date[7]" ?> руб</td>
			</tr>
			<tr>
				<td>
				<a href='buy.html' name='b_buy'>Купить билет</a>
				</td>
			</tr>
		</table>
	</body>	
</html>