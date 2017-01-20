<?php
session_start();
$auth == false;
include_once 'datebase.php';
if (isset($_POST['ubmit'])) {
	$e_login = htmlspecialchars($_POST['login']);
	$e_password = htmlspecialchars(md5($_POST['password']));
	$query = $pdo->prepare("SELECT pass FROM auth WHERE login=?");
	$query->bindParam(1, $e_login, PDO::PARAM_STR);
	$query->execute();
	$user_pass = $query->fetch();
	if (md5($user_pass[0]) == $e_password) {
		session_start();
		$_SESSION ['name'] = $e_login;
		$incorrect = False;
	} else {
		$incorrect = True;	
	}
}
if (isset($_POST['logout'])) {
	unset ($_SESSION['name']);
	session_destroy();
}
if (isset($_SESSION ['name'])) {
	header('location:adminroom.php');
	exit;
} else {	
	include '/template/template6.html';
}
