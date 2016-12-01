<?php 
try{
	$pdo = new PDO ("mysql:dbname=Hall;host=127.0.0.1:3306", "root", "");
	$pdo->exec('SET NAMES "utf8"');
}catch(PDOException $e){
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
exit();}
$query = $pdo->query("SELECT COUNT(*) FROM event");
	$count_ev = $query->fetch();
	var_dump ($count_ev[0]) ;
echo "<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-">
		<link href="style.css" rel="stylesheet">
		<title>Концертный зал</title>
	</head>
	<body>
		<header>
			<h1>Концертный зал</h1>
		</header>
		<table cellpadding="14">
			<tr>
				<td rowspan='4'>
					<h2>Ичунь-Пань, концерт скрипки и фортепиано</h2>
					<img src='scrip.jpg'></img>
				</td>
				<td>Дата</td>
			</tr>
			<tr>
				<td>Цена от</td>
			</tr>
			<tr>
				<td>до</td>
			</tr>
			<tr>
				<td>
				<a href='buy.html' name="b_buy">Купить билет</a>
				</td>
			</tr>
		</table>"
	?>