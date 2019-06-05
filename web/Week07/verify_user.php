<?php
session_start();

require("db.php");

$username = $_POST["username"];
$password = $_POST["password"];

// Verify the user
foreach ($db->query("SELECT * FROM Activity7Users WHERE UserName = '$username'") as $row) {
    if (password_verify($password, $row["userpassword"])) {
        // Success! log in the user
        $_SESSION["user"] = $row["userid"];
        header("Location: welcome.php");
        die();
    } else {
        header("Location: sign_in.php?error=badpw");
        die();
    }
}
?>