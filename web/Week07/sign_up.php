<?php

if (isset($_GET['error'])) {
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
    <script type="text/javascript">
    
    </script>
    <title>Sign up</title>
</head>
<body>
    <h1>Create a new user</h1>
    <div class="small">
        <form action="new_user.php" method="POST">
        <?php
        if (isset($GLOBALS['error']) && $GLOBALS["error"] == "nameinuse") {
            echo "<span class='error'>* The username is already in use.</span><br />";
        }
        ?>
        <table>
            <tr><td>Name:</td><td><input type="text" name="username" /></td></tr>
            <tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
            <tr><td colspan="2"><button type="submit">Register</button></td></tr>
        </table>
        </form>
    </div>
</body>
</html>