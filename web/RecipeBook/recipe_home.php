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
    <title>Recipe Browser</title>
</head>
<body>
    <h1>Recipe Browser</h1>
    <hr />

    <div id="container">
        <?php require("sidebar.php"); ?>
        
        <div id="content">
            <h3>Top Recipes</h3>
        </div>
    </div>
</body>
</html>