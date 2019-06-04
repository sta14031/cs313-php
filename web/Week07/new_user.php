<?php
session_start();

try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

//require("db.php");

$username = $_POST["username"];
$password = $_POST["password"];

$hashedpw = password_hash($password);

$db->query("INSERT INTO Activity7Users (UserName, UserPassword) VALUES ($username, $hashedpw)");

//$_SESSION["user"] = $db->lastInsertId();

header('Location: ' . "welcome.php");
die();

?>