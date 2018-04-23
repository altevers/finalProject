<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = 'alteversa1';
$password = "ka7udrUB";

$database = new PDO('mysql:host=localhost;dbname=db_spring18_alteversa1', $username, $password);

function my_autoloader($class) {
    include 'class.' . $class . '.php';
}

spl_autoload_register('my_autoloader');

session_start();

$current_url = basename($_SERVER['REQUEST_URI']);


if (!isset($_SESSION["userID"])) {
    $user = new User(0, $database);
}


elseif (isset($_SESSION["userID"])) {
	$user = new User($_SESSION["userID"], $database);
}

?>

<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:700|Nunito+Sans" rel="stylesheet">