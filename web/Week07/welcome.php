<?php
session_start();
require("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../homepage.css">
    <title>Welcome!</title>
</head>
<body>
    <h1>Welcome!</h1>
    <div class="small">
    <?php
    if ($_SESSION["user"]) {
        $stmt = $db->prepare("SELECT * FROM Activity7Users WHERE UserId = " . $_SESSION["user"]);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<p>Welcome, " . $user['username'] . "!</p>
        <br /> <a href='log_out.php'>Log out</a>";
    } else {
        echo "<p>Welcome to the page. You may sign in if you have an account, or sign up if you are a new user.</p>
        <br /> <a href='sign_in.php'>Sign in</a>
        <br /> <a href='sign_up.php'>Sign up</a>"
    }
    ?>
    </div>
</body>
</html>