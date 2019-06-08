<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="recipe.css" />
    <title>Log in | Recipe Book</title>
</head>
<body>
    <h1>Log in</h1>
    <hr />
    <div id="container">
        <div id="content">
        <form action="verify_user.php" method="POST">
        <table>
            <tr><td>Name:</td><td><input type="text" name="username" required /></td></tr>
            <tr><td>Password:</td><td><input type="password" name="password" required /></td></tr>
            <tr><td colspan="2"><button type="submit">Log in</button></td></tr>
            <?php
            if ($_GET['error'] == 'badpw') {
                echo "<span class='error' style='display: inline;'>* The password does not match.</span>";
            }
            ?>
        </table>
        </form>
        </div>
    </div>
</body>
</html>