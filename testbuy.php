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
?>