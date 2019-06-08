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
    <link rel="stylesheet" type="text/css" href="recipe.css" />
    <title>Recipe Browser</title>
</head>
<body>
    <h1>Recipe Browser</h1>
    <hr />

    <div id="container">
        <?php require("sidebar.php"); ?>
        
        <div id="content">
            <h3>Latest Recipes</h3>
            <ul>
            <?php
            foreach ($db->query("SELECT RecipeName, RecipeId FROM Recipes ORDER BY Last_Updated DESC") as $i => $row)
            {
                // Only display the first 25 recipes
                if ($i < 25)
                {
                    echo "<li><a href='view_recipe.php?recipe=" . $row['recipeid'];
                    echo "'>" . $row['recipename'] . "</a></li>\n";
                }
            }
            ?>
            </ul>
        </div>
    </div>
</body>
</html>