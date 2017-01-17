<?php 
$array = file('conf');
$dbname = trim($array[0]);
$host =  trim($array[1]);
$user = trim($array[2]);
$pass = trim($array[3]);
try{
	$pdo = new PDO ("mysql:dbname=$dbname;host=$host", $user, $pass);
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
} catch(PDOException $e) {
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
    exit();
}
unset ($array, $dbname, $host, $user, $pass);
?>