<?php 
$e_name = $_POST['n'];
$img_src = $_POST['i'];
$near_date = explode("///" , $e_name);
$time= substr("$near_date[4]",0,5);
echo "
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-'>
		<link href='style.css' rel='stylesheet'>
		<title>Касса</title>
	</head>
	<body>
		<header>
			<h1>Касса</h1>
		</header>
		<table>
			<tr>
				<td>
					<div align='right'><a href='index.php'>на главную</a></div>
					<h2>{$near_date[1]} </br>{$near_date[3]} в {$time}</h2>
					<div class = 'imgCenter'>
						<img src={$img_src} alt='картинка с изображением' width = '600' height='400'></img>
					</div>
						<p class='p'>{$near_date[2]}</p>
					
				</td>
			</tr>
		</table>
		<p align='center'>Выберите место, а затем нажмите кнопку 'Купить'</p>
		<div padding='auto'>
		<input type='submit' name='f_submit' value='Купить'/></div>
		<table cellpadding='5'>
			<tr>
			<td class='blat'>билет за {$near_date[5]} руб</td>
			<td class='mid'>билет за {$near_date[6]} руб</td>
			<td class='bitch'>билет за {$near_date[7]} руб</td>
			<td class='rip'>занятые места</td>
			</tr>
			</table>
			</body>
			</html>
			";
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
exit();}
$datetime=$near_date[3].' '.$near_date[4];
$query = $pdo->query("SELECT free, engaged FROM `ev_hall` WHERE datetime = '$datetime'");
$info_hall = $query->fetch();// получаем инфу о местах
$free = explode('/',$info_hall[0]);
$engaged= explode('/',$info_hall[1]);
$i=0;
while ($i < sizeof($free)){
	$place=$free[$i]%100;
	$row=(integer)($free[$i]/ 100);
	
	if ((($free[$i]*10)%10)!=0) {
		$sort='rip';
	}
	elseif ($row <= 5) {
		$sort='blat';
	}
	elseif (5 < $row and $row<=10){
		$sort='mid';
	}
	else {$sort='bitch';}
	
	$ceel = "<td class = '{$sort}'><p><input type='checkbox' name='a' value='{$free[i]}'> место {$place}</p></td>";
	$noceel = "<td class = '{$sort}'><p><input type='hidden' name='a' value='{$free[i]}'> место {$place}</p></td>";
	
	if ($i==0 or $i%20==0){
		if ($i==0){
			echo "<table cellpadding='7'>
			<tr>
			<td colspan='21'><h1>Сцена с артистами</h1></td>
			</tr>";}
		echo"<tr>
			<td>ряд {$row}</td>";
		if ($sort=='rip') {
			echo "{$noceel}";
		}
		else {
		echo "{$ceel}";}}
	else {
	if ($sort=='rip') {
			echo "{$noceel}";
		}
		else {
		echo "{$ceel}";};
		if (($i+1)%20==0){
			echo"</tr>"; 
			if ($i==299){
			echo"</table>";
				}
			}
		}
		$i++;
	};
var_dump($place);
var_dump($row);
var_dump((integer)(408.1/ 100));
var_dump((408.1*10)%10);
?>