	$query = $pdo->query("SELECT * FROM `event` WHERE date = (SELECT MAX(date) FROM event)");
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
					<h2><?php echo"$near_date[name]"?></h2>
					<div class = "imgCenter"><?php echo "<img src='$img_src', alt='картинка с изображением'></img>";?></div>
				</td>
				<td><?php echo"$near_date[date] в "; echo"$time"; ?>  </td>
			</tr>
			<tr>
				<td>Цены на билет:</br> от <?php echo"$near_date[t_low]"?> руб </td>
			</tr>
			<tr>
				<td>до <?php echo"$near_date[t_high]" ?> руб</td>
			</tr>
			<tr>
				<td>
				<a href='buy.html' name='b_buy'>Купить билет</a>
				</td>
			</tr>
		</table>
	</body>	
</html>

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
	//$query = $pdo->query("SELECT * FROM `event`");
	//$near_event = $query->fetch();
	$query ="SELECT * FROM `event` ORDER BY `event`.`date` ASC, `event`.`time` ASC";
	$near_event = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
	$i=0;
	while($i<=4){
$near_date = $near_event[i];
$img_src = '/img/'.$near_date[date].$near_date[time];
$img_src =substr("$img_src",0,17);
$time= substr("$near_date[time]",0,5);
echo "<table cellpadding='14'>
			<tr>
				<td rowspan='4'>
					<h2> <?php echo '$near_date[name]'?></h2>
					<div class = 'imgCenter'><?php echo '<img src='$img_src', alt='картинка с изображением'></img>';?></div>
				</td>
				<td><?php echo'$near_date[date] в '; echo'$time'; ?>  </td>
			</tr>
			<tr>
				<td>Цены на билет:</br> от <?php echo'$near_date[t_low]'?> руб </td>
			</tr>
			<tr>
				<td>до <?php echo'$near_date[t_high]' ?> руб</td>
			</tr>
			<tr>
				<td>
				<a href='buy.html' name='b_buy'>Купить билет</a>
				</td>
			</tr>
		</table>";

$i++;		
}
?>