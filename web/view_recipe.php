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
$stmt->bindValue(':id', intval($recipeID), PDO::PARAM_INT);
$stmt->execute();
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

//$result = $db->fetch("SELECT * FROM Recipes WHERE RecipeId = $recipeID");

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
        
        <div id="content">
            <h3><?php echo $recipe["recipename"]; ?></h3>
            Ingredients: <br />
            <ul>
            <?php
            $id = $recipe["recipeid"];
            /*foreach ($db->query(
                "SELECT IngredientName FROM Ingredients WHERE IngredientId =
                    (SELECT RecipeJoin.IngredientId FROM RecipeJoin LEFT JOIN
                    Recipes ON Recipes.RecipeId = RecipeJoin.RecipeId
                    WHERE Recipes.RecipeId = $id);") as $row)*/
                {
                    echo "<li>";
                    // Test code
/*                    foreach ($row as $key => $value) {
                        echo "$key => $value";
                    }*/
                    echo "</li>";
                }
            )
            ?>
            </ul>
        </div>
    </div>
</body>
</html>