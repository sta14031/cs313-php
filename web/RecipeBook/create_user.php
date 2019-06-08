<?php
session_start();
require("db.php");

$username = $_POST['username'];
$password = $_POST['password'];
$hashedpw = password_hash($password, PASSWORD_DEFAULT);

// Does this username already exist in the page?
$stmt = $db->prepare("SELECT * FROM Users WHERE UserName ILIKE '" . $username . "'");
$stmt->execute();

if ($stmt->rowCount() > 0) {

    header("Location: signup.php?error=nameinuse");
    die();
}

// Register the new user
$stmt = $db->prepare("INSERT INTO Users (UserName, HashedPassword) VALUES (:username, :hashedpw)");
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':hashedpw', $hashedpw, PDO::PARAM_STR);
$stmt->execute();

$_SESSION["userid"] = $db->lastInsertId();

header("Location: recipe_home.php");
die();

?>