<?php

if (isset($_GET['error']) {
    $GLOBALS["error"] = $_GET["error"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../homepage.css">
    <title>Sign in</title>
</head>
<body>
    <h1>Enter your credentials:</h1>
    <div class="small">
        <form action="verify_user.php" method="POST">
        <?php
        if (isset($GLOBALS['error']) && $GLOBALS["error"] == "badpw") {
            echo "<span class='error'>* Password does not match.</span><br />";
        }
        ?>
        <table>
            <tr><td>Name:</td><td><input type="text" name="username" /></td></tr>
            <tr><td>Password:</td><td><input type="text" name="password" /></td></tr>
            <tr><td colspan="2"><button type="submit">Log in</button></td></tr>
        </table>
        </form>
    </div>
</body>
</html>