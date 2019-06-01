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
    <title><?php echo $recipe["recipename"]; ?> | Recipe Book</title>
</head>
<body>
    <h1><?php echo $recipe["recipename"]; ?></h1>
    <hr />

    <?php require("navbar.php"); ?>

    <div id="container">
        <?php require("sidebar.php"); ?>
        
        <div id="content" class="recipe_container">
            <div id="recipe_details">
                Ingredients: <br />
                <ul>
                <?php
                $id = $recipe["recipeid"];
                foreach ($db->query("SELECT ri.IngredientId, ri.Measurement, i.IngredientName FROM Recipes_Ingredients ri LEFT JOIN
                        Recipes r ON ri.RecipeId = r.RecipeId LEFT JOIN
                        Ingredients i ON ri.IngredientId = i.IngredientId
                        WHERE ri.RecipeId = $id") as $row)
                {                    
                    echo "<li>" . $row["ingredientname"] . " - " . $row["measurement"] . "</li>";
                }
                ?>
                </ul> <br />

                Preparation: <br />
                <?php echo $recipe["methods"]; ?>
            </div>
            <div id="recipe_info">
            <?php
            $stmt = $db->prepare("SELECT SkillName FROM SkillLevel WHERE LevelId = :id");
            $stmt->bindValue(':id', $recipe["skill"], PDO::PARAM_INT);
            $stmt->execute();
            $skill = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $db->prepare("SELECT UserName FROM Users WHERE UserId = :id");
            $stmt->bindValue(':id', $recipe["creator"], PDO::PARAM_INT);
            $stmt->execute();
            $creator = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "Preparation time: " . $recipe["preptime"] . " minutes<br />\n";
            echo "Skill level: " . $skill["skillname"] . "<br />\n<span class='info'>";
            echo "Contributed by: " . $creator["username"] . "<br />\nLast updated: ";
            echo $recipe["last_updated"] . "</span>";

            ?>
            </div>
        </div>
    </div>
</body>
</html>