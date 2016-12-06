<?php 
function identif($eb)
{return $eb;}
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
		<table cellpadding='14'>
			<tr>
				<td rowspan='4'>
					<p>26 ноября 18:00<div align='right'><a href='index.html' align='right' name='b_buy'>на главную</a></div></p>
					<h2>Ичунь-Пань, концерт скрипки и фортепиано</h2>
					<img src='icpan.jpg'></img>
					<p>XI Международный конкурс имени П.И. Чайковского. Скрипачка Ичунь Пань (КНР, третья премия) во время выступления. Большой зал Московской государственной консерватории им. П.И. Чайковского.
 9 июня-1 июля 1998 года.</p>
				</td>
			</tr>
		</table>
		<div><p>Выберите место, а затем нажмите кнопку 'Купить'</p>
		<table cellpadding='2'>
			<tr>
			<td class='blat'>билет за 5000 руб</td>
			<td class='mid'>билет за 1500 руб</td>
			<td class='bitch'>билет за 500 руб</td>
			<td class='rip'>занятые места</td>
			</tr><input type='submit' name='f_submit' value='Купить'/></div>
			</table>
			</body>
			</html>
			";
?>