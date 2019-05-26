<?php
    session_start();
    $recipeID = $_GET["recipe"];

try
{
    $dbUrl = getenv('DATABASE_URL');

    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}

// This will fetch only the one row (since id is a primary key, there should only be one row)
$stmt = $db->prepare("SELECT * FROM Recipes WHERE RecipeId = :id");
$stmt->bindValue(':id', $recipeID, PDO::PARAM_INT);
$stmt->execute();
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="recipe.css" />
    <title></title>
</head>
<body>
    <h1>Recipes</h1>
    <hr />

    <?php require("navbar.php"); ?>

    <div id="container">
        <?php require("sidebar.php"); ?>
        
        <div id="content" class="recipe_container">
            <h3><?php echo $recipe["recipename"]; ?></h3>
            <div id="recipe_details">
                Ingredients: <br />
                <ul>
                <?php
                $id = $recipe["recipeid"];
                /*foreach ($db->query(
                    "SELECT IngredientName FROM Ingredients WHERE IngredientId =
                        (SELECT RecipeJoin.IngredientId FROM RecipeJoin LEFT JOIN
                        Recipes ON Recipes.RecipeId = RecipeJoin.RecipeId
                        WHERE Recipes.RecipeId = $id)") as $row)*/
                foreach ($db->query("SELECT IngredientId, Measurement FROM RecipeJoin LEFT JOIN
                        Recipes ON Recipes.RecipeId = RecipeJoin.RecipeId
                        WHERE Recipes.RecipeId = $id") as $row)
                {
                    $stmt = $db->prepare("SELECT IngredientName FROM Ingredients WHERE IngredientId = :id");
                    $stmt->bindValue(':id', $row["ingredientid"], PDO::PARAM_INT);
                    $stmt->execute();
                    $ingredient = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    echo "<li>" . $ingredient["ingredientname"] . " - " . $row["measurement"] . "</li>";
                }
                ?>
                </ul> <br />

                Methods: <br />
                <?php echo $recipe["methods"]; ?>
            </div>
            <div id="recipe_info">
                
            </div>
        </div>
    </div>
</body>
</html>