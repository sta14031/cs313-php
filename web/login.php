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
    <title>Log in</title>
</head>
<body>
    <h1>Log in</h1>
    <hr />
    <?php require("navbar.php"); ?>
    <div id="container">
        <div id="content">
            Name: <input type="text" name="username" />
        </div>
    </div>
</body>
</html>