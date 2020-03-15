<?php
	$server = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'mydb';

	$dblink = mysqli_connect($server, $user, $password, $database);
	if(!$dblink)
	{
		die('Ошибка подключения к серверу баз данных.');
	}
?>