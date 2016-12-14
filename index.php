<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-'>
		<link href='style.css' rel='stylesheet'>
		<title>Концертный зал</title>
	</head>
	<body>
		<header>
		<?
		$H = date('H')-1;//верное время
		$true_time=date("Y-m-d {$H}:i e");
		echo $true_time ?>
		
			<h1>Концертный зал</h1>
		</header>
<?php 
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
exit();}
	$query ="SELECT * FROM `event` WHERE date>=CURRENT_DATE ORDER BY `event`.`date` ASC, `event`.`time` ASC";
	$near_event = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
	$i=0;
$size_neev = sizeof($near_event);
$no_event="<h3>Карнавала не будет</br>
Все утонут в слезах</br>
Я моторы в гондолах</br>
Разбираю на части</br>

Подметаешь лепестки</br>
В иссохшихся площадях</br>
Пытаешь гладить на ощупь</br>
Ошарашенный страстью</br>

Но карнавала не будет</br>
Карнавала нет...
</h3>";
if ($size_neev==0) {
echo "{$no_event}";
}
else { 
if ($size_neev > 5){
	$mn=true;
	$max_neev = $size_neev;
	$size_neev=5;
}
	while($i<$size_neev){
$near_date = $near_event[$i];
if ($near_date[date] == date("Y-m-d") and $near_date[time] < date("{$H}:i:s")){//выводит события время которых ещё не прошло (при нехвате скила sql)
	if ($mn==true and $size_neev<max_neev){
		$size_neev++;
	}
	$i++;
	$no_ev=true;
	continue;
}
$no_ev= false;
$img_src = '/img/'.$near_date[date].$near_date[time];
$img_src =substr("$img_src",0,17);
$img_src .='.jpg';
$time= substr("$near_date[time]",0,5);
$str_nd=implode ("///" , $near_date);
echo "<table cellpadding='14'>
			<tr>
				<td rowspan='4'>
					<h2>{$near_date['name']}</h2>
					<div class = 'imgCenter'><img src='{$img_src}' alt='картинка с изображением' width = '300' height='200'></img></div>
				</td>
				<td>{$near_date['date']}</br> в {$time} </td>
			</tr>
			<tr>
				<td>Цены на билет:</br> от {$near_date['t_low']} руб </td>
			</tr>
			<tr>
				<td>до {$near_date['t_high']} руб</td>
			</tr>
			<tr>
				<td><form method='post' action='testbuy.php' enctype='multipart/form-data' content = $n>
				<input type='submit' name='buy' value='Купить билет'>
				<input type='hidden' name='n' value='$str_nd'>
				<input type='hidden' name='i' value='$img_src'>
				</form>
				</td>
			</tr>
		</table>
	</body>	
</html>";
$i++;
}}
if ($no_ev==true){
	echo $no_event;
}
?>