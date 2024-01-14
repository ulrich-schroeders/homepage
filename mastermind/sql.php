<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; charset=utf-8');
	
	function connectToSQL() {
		$servername = "ulrich-schroeders.de/mastermind";
		$username = "d03b468f";
		$password = "i*poe6Am6nlE89PAbhBmBrKW2";
		$database = "d03b468f";
		$sqlDB = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
		$sqlDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $sqlDB;
	}
?>