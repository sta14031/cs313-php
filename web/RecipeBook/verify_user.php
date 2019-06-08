<?php
session_start();

require("db.php");

$username = $_POST["username"];
$password = $_POST["password"];

// Verify the user
foreach ($db->query("SELECT * FROM Users WHERE UserName = '$username'") as $row) {
    if (password_verify($password, $row["hashedpassword"])) {
        // Success! log in the user
        $_SESSION["userid"] = $row["userid"];
        header("Location: recipe_home.php");
        die();
    } else {
        header("Location: login.php?error=badpw");
        die();
    }
}
?>