<?php
session_start();

require("db.php");

$username = $_POST["username"];
$password = $_POST["password"];

$hashedpw = password_hash($password);

$db->query("INSERT INTO Activity7Users (UserName, UserPassword)
    VALUES ($username, $hashedpw)");

$_SESSION["user"] = $db->lastInsertId();

header('Location: ' . "welcome.php");
die();

?>