<?php 
$e_name = $_POST['n'];
$img_src = $_POST['i'];
$near_date = explode("," , $e_name);
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
				
					<p>{$near_date[3]} в {$time}<div align='right'><a href='index.php' align='right' name='b_buy'>на главную</a></div></p>
					<h2>{$near_date[1]}</h2>
				<tr >	<td ><div class = 'imgCenter'><img src='{$img_src}' alt='картинка с изображением' width = '600' height='400'></img></div>
					<div><p>{$near_date[2]}</p></div></td >
				</tr>
			</tr>
		</table>
		<div><p>Выберите место, а затем нажмите кнопку 'Купить'</p>
		<table cellpadding='2'>
			<tr>
			<td class='blat'><div>билет за {$near_date[5]} руб</div></td>
			<td class='mid'>билет за {$near_date[6]} руб</td>
			<td class='bitch'>билет за {$near_date[7]} руб</td>
			<td class='rip'>занятые места</td>
			</tr><input type='submit' name='f_submit' value='Купить'/></div>
			</table>
			</body>
			</html>
			";
?>