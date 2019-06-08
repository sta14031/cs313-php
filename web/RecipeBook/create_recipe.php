<?php

require("db.php");

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
        :typeId,
        :methods,
        :skillId,
        :prepTime,
        NOW(),
        NOW()
    )');

$stmt->bindValue(':recipeName', $recipeName, PDO::PARAM_STR);
$stmt->bindValue(':typeId', $recipeType, PDO::PARAM_INT);
$stmt->bindValue(':methods', $methods, PDO::PARAM_STR);
$stmt->bindValue(':skillId', $skill, PDO::PARAM_INT);
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

header("Location: view_recipe.php?recipe=" . $recipeId);
die();
?>