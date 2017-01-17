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
	$e_name = $_POST['n'];
	$img_src = $_POST['i'];
}
$near_date = explode("///" , $e_name);
$time = substr("$near_date[4]",0,5);
$datetime = $near_date[3].' '.$near_date[4];
$form = "<form method='post' action='{$action}'>
<input type='email' name='e' placeholder='Ваш e-mail' {$required} >
<input type='submit' name='f_submit' value='{$buy}'/>
<input type='hidden' name='n' value='{$datetime}'>";
?>
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
					<h2><?=$near_date[1]?> </br><?=$near_date[3]?> в <?=$time?></h2>
					<div class = 'imgCenter'>
						<img src=<?=$img_src?> alt='картинка с изображением' width = '600' height='400'></img>
					</div>
						<p class='p'><?=$near_date[2]?></p>
					
				</td>
			</tr>
		</table>
		<h3 align='center'>Выберите место и введите e-mail, а затем нажмите кнопку <?=$buy?>"</h3>
		<div padding='auto'>
		<?=$form?>
		
		<table cellpadding='10'>
			<tr>
			<td class='high'>билет за <?=$near_date[5]?> руб</td>
			<td class='mid'>билет за <?=$near_date[6]?> руб</td>
			<td class='low'>билет за <?=$near_date[7]?> руб</td>
			<td class='del'>занятые места</td>
			</tr>
			</table>
			</body>
			</html>
<?
include 'datebase.php';
$query = $pdo->query("SELECT free, engaged FROM `ev_hall` WHERE datetime = '$datetime'");
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
	}?>
	<?if ($i == 0 or $i%20 == 0):?>
		<?if ($i == 0):?>
			<table cellpadding='5'>
			<tr>
			<td colspan='21'><h1>Сцена с артистами</h1></td>
			</tr>
		<?endif;?>
		<tr>
		<td>ряд <?=$row?></td>
		<?if ($sort == 'del'):?>
			<?if($b):?>
				<?=$paid?>
			<?else:?>
				<?=$noceel?>
			<?endif;?>
		<?else:?>
			<?=$ceel?>
		<?endif;?>
	<?else:?>
		<?if ($sort == 'del'):?> 
			<?if ($b):?>
				<?=$paid?>
			<?else:?>
				<?=$noceel?>
			<?endif;?>
		<?else:?>
			<?=$ceel?>
		<?endif;?>
		<?if (($i+1)%20 == 0):?>
			</tr>
			<?if ($i == 299):		# 299 - count place in event hall, counting from zero?>
				</table></form></div>
			<?endif;?>
		<?endif;?>
	<?endif;?>
	<?$i++;
}
?>
