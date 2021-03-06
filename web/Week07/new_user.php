<?php
session_start();

require("db.php");

$username = $_POST["username"];
$password = $_POST["password"];

$hashedpw = password_hash($password, PASSWORD_DEFAULT);

// Does this username already exist in the page?
$stmt = $db->prepare("SELECT * FROM Activity7Users WHERE UserName ILIKE '" . $username . "'");
$stmt->execute();

if ($stmt->rowCount() > 0) {

    header("Location: sign_up.php?error=nameinuse");
    die();
}

// Register the new user
$stmt = $db->prepare("INSERT INTO Activity7Users (UserName, UserPassword) VALUES (:username, :hashedpw)");
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':hashedpw', $hashedpw, PDO::PARAM_STR);
$stmt->execute();

$_SESSION["user"] = $db->lastInsertId();

header("Location: welcome.php");
die();

?>