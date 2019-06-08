<?php
    session_start();
    // Is the user logged in?
    if (!isset($_SESSION['userid'])) {
        header("Location: recipe_home.php");
        die();
    }

    $recipeID = $_GET["recipe"];

    require("db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="recipe.css" />
    <title>Modify Recipes</title>
</head>
<body>
    <h1>Modify a recipe</h1>
    <hr />

    <div id="container">
        <?php require("sidebar.php"); ?>

        <!-- The user will select a recipe to modify -->
        <div id="content"><ul>
        <?php
        foreach($db->query('SELECT * FROM Recipes WHERE Creator = ' . $_SESSION["userid"]) as $row) {
            echo "<li>
                <form action='modify_recipe.php' method='POST'>
                    <input type='hidden' name='recipeId' value='" . $row['recipeid'] . "' />
                    <button type='submit' class='recipeSubmit'>" . $row['recipename'] . "</button>
                </form>
                </li>";
        }
        ?>
        </ul></div>
    </div>
</body>
</html>