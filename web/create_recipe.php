<?php

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

$recipeName = $_POST['recipeName'];
$prepTime = $_POST['prepTime'];
$skill = $_POST['skill'];
$recipeType = $_POST['recipeType'];
$methods = $_POST['methods'];

$ingredients = $_POST['ingredients'];
$measurements = $_POST['measurements'];

// Create the actual recipe
$stmt = $db->prepare('INSERT INTO Recipes (
        Creator,
        RecipeName, 
        RecipeType,
        Methods,
        Skill,
        PrepTime,
        Date_Created,
        Last_Updated
    ) VALUES (
        2,
        :recipeName,
        (SELECT TypeId FROM RecipeTypes WHERE TypeName = :typeName),
        :methods,
        (SELECT LevelId FROM SkillLevel WHERE SkillName = :skill),
        :prepTime,
        NOW(),
        NOW()
    )');

$stmt->bindValue(':recipeName', $recipeName, PDO::PARAM_STR);
$stmt->bindValue(':typeName', $recipeType, PDO::PARAM_INT);
$stmt->bindValue(':methods', $methods, PDO::PARAM_STR);
$stmt->bindValue(':skill', $skill, PDO::PARAM_INT);
$stmt->bindValue(':prepTime', $prepTime, PDO::PARAM_INT);
$stmt->execute();

$recipeId = $db->lastInsertId();

// Add the ingredients
foreach ($ingredients as $key => $ing) {
    $stmt = $db->prepare('INSERT INTO Recipes_Ingredients (
        RecipeId,
        IngredientId,
        Measurement
    ) VALUES (
        :recipeId,
        :ingredientId,
        :measurement
    )');
    $stmt->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
    $stmt->bindValue(':ingredientId', $ing, PDO::PARAM_INT);
    $stmt->bindValue(':measurement', $measurements[$key], PDO::PARAM_STR);
    $stmt->execute();

}

header("Location: recipe_home.php");
die();
?>