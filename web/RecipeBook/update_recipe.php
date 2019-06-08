<?php

require("db.php");

$recipeId = $_POST['recipeId'];
$recipeName = $_POST['recipeName'];
$prepTime = $_POST['prepTime'];
$skill = $_POST['skill'];
$recipeType = $_POST['recipeType'];
$methods = $_POST['methods'];

$ingredients = $_POST['ingredients'];
$measurements = $_POST['measurements'];

// Create the actual recipe
$stmt = $db->prepare('UPDATE Recipes SET
        RecipeName = :recipeName,
        RecipeType = :typeId,
        Methods = :methods,
        Skill = :skillId,
        PrepTime = :prepTime,
        Last_Updated = NOW()
    WHERE RecipeId = :recipeId');

$stmt->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
$stmt->bindValue(':recipeName', $recipeName, PDO::PARAM_STR);
$stmt->bindValue(':typeId', $recipeType, PDO::PARAM_INT);
$stmt->bindValue(':methods', $methods, PDO::PARAM_STR);
$stmt->bindValue(':skillId', $skill, PDO::PARAM_INT);
$stmt->bindValue(':prepTime', $prepTime, PDO::PARAM_INT);
$stmt->execute();

// Add the ingredients
/*foreach ($ingredients as $key => $ing) {
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
}*/

header("Location: view_recipe.php?recipe=" . $recipeId);
die();
?>