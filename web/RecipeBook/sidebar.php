<?php
# This file provides a sidebar to all pages
require("db.php");
?>
<div id="sidebar">
    <h3>Navigation</h3>
    <hr />
    <a href="recipe_home.php">Home</a> <br />
    <a href="../assignments.php">Back to assignments page</a> <br />
    <a href="../index.php">Back to class home page</a> <br />
    
    <h3>Search functions</h3>
    <hr />
    <a href="search_recipes.php">Search recipes</a> <br />
    <a href="search_ingredients.php">Search ingredients</a> <br />
    <a href="search_users.php">Search users</a> <br />

    <h3>Login</h3>
    <hr />
    <?php
        if (!isset($_SESSION["userid"])) {
            echo "You are not logged in.<br />";
            echo "<a href='signup.php'>Sign up</a><br /><a href='login.php'>Log in</a>";
        } else {
            $stmt = $db->prepare("SELECT UserName FROM Users WHERE UserId = " . $_SESSION["userid"]);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "Welcome, " . $user["username"] . "!<br /><a href='logout.php'>Log out</a>";
        }
    ?> <br />
    <h3>User functions</h3>
    <hr />
    <a href="new_recipe.php">Add a new recipe</a> <br />
    <a href="select_recipe.php">Modify a recipe</a> <br />
</div>