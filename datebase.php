<?php 
include_once("conf.php");
$conf = conf();
$dbname = trim($conf['dateBaseName']);
$host =  trim($conf['host']);
$user = trim($conf['db user']);
$pass = trim($conf['db password']);
try {
	$pdo = new PDO ("mysql:dbname=$dbname;host=$host", $user, $pass);
	$pdo->exec('SET NAMES "utf8"');
	$pdo->query('SET NAMES "utf8"');
	
} catch(PDOException $e) {
	echo "Возникла ошибка соединения с БД ".$e->getMessage();
    exit();
}
unset ($conf, $dbname, $host, $user, $pass);
?>