<?php 

session_start();
$action='buy_act.php';
$buy='Забронировать';
$a = false;
$required = 'required';
if (isset($_SESSION['name'])){
	//echo "<form method='post' action='{$logout}'><input type='submit' name='logout' value='Logout'/></form>";
	$buy='Подтвердить';
	$a = true;
	$action='accept.php';
	$required =NULL;
}
if (isset($_POST['buy'])){
$e_name = $_POST['n'];
$img_src = $_POST['i'];
}
$near_date = explode("///" , $e_name);
$time= substr("$near_date[4]",0,5);
$datetime=$near_date[3].' '.$near_date[4];
$form = "<form method='post' action='{$action}'>
<input type='email' name='e' placeholder='Ваш e-mail' {$required} >
<input type='submit' name='f_submit' value='{$buy}'/>
<input type='hidden' name='n' value='{$datetime}'>";
echo "
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
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
		<h3 align='center'>Выберите место и введите e-mail, а затем нажмите кнопку \"{$buy}\"</h3>
		<div padding='auto'>
		{$form}
		
		<table cellpadding='5'>
			<tr>
			<td class='blat'>билет за {$near_date[5]} руб</td>
			<td class='mid'>билет за {$near_date[6]} руб</td>
			<td class='bitch'>билет за {$near_date[7]} руб</td>
			<td class='rip'>занятые места</td>
			</tr>
			</table>
			</body>
			</html>";
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
exit();}
$query = $pdo->query("SELECT free, engaged FROM `ev_hall` WHERE datetime = '$datetime'");
$info_hall = $query->fetch();// получаем инфу о местах
$free = explode('/',$info_hall[0]);
$engaged= explode('/',$info_hall[1]);
$i=0;
while ($i < sizeof($free)){
	$b=false;
	$place=$free[$i]%100;
	$row=(integer)($free[$i]/ 100);
	$herny = 'место '.'</br>'.$place;
	if ($a){	
		$key = array_search($free[$i]-0.1, $engaged);
		if (is_int($key)){
			$herny = $engaged[$key+1].'</br></br>'.$place;
		}
		$key = array_search($free[$i], $engaged);
		if (is_int($key)){
			$b=true;
			$herny = $engaged[$key+1];
		}
	}
	
	if ((($free[$i]*10)%10)!=0) {//определяем тип мест
		$sort='rip';
	}
	elseif ($row <= 5) {
		$sort='blat';
	}
	elseif (5 < $row and $row<=10){
		$sort='mid';
	}
	else {$sort='bitch';}
	
	$ceel = "<td class = '{$sort}'><p><input type='checkbox' name='a[]' value='{$free[$i]}'>{$herny}</p></td>";
	$noceel = "<td class = '{$sort}'><p><input type='hidden' name='b' value='{$free[$i]}'> {$herny}</p></td>";
	$paid = "<td class = '{$sort}'><p><input type='hidden' name='b' value='{$free[$i]}'> {$herny}</p></td>";
	if ($a){	
		list ($ceel, $noceel)= array($noceel, $ceel);
	}
	if ($i==0 or $i%20==0){
		if ($i==0){
			echo "<table cellpadding='7'>
			<tr>
			<td colspan='21'><h1>Сцена с артистами</h1></td>
			</tr>";}
		echo"<tr>
			<td>ряд {$row}</td>";
		if ($sort=='rip') {
			if ($b){
				echo "{$paid}";
			}
			else{
			echo "{$noceel}";
			}	
		}
		else {
		echo "{$ceel}";}}
	else {
	if ($sort=='rip') {
		if ($b){
				echo "{$paid}";
			}
			else{
			echo "{$noceel}";
			}	
		}
		else {
		echo "{$ceel}";}
		if (($i+1)%20==0){
			echo"</tr>"; 
			if ($i==299){
			echo"</table></form></div>";
				}
			}
		}
	$i++;
}
?>