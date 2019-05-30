<?php
# This file provides a sidebar to all pages
?>
<div id="sidebar">
    <h3>Search functions</h3>
    <hr />
    <a href="search_recipes.php">Search recipes</a> <br />
    <a href="search_ingredients.php">Search ingredients</a> <br />
    <a href="search_users.php">Search users</a> <br />

    <h3>Login</h3>
    <hr />
    <?php
        if (!isset($_SESSION["username"])) {
            echo "You are not logged in.<br />";
            echo "<a href='register.php'>Sign up</a><br /><a href='login.php'>Log in</a>";
        } else {
            echo "Welcome, " . $_SESSION["username"] . "!<br /><a href='logout.php'>Log out</a>";
        }
    ?> <br />
    <h3>User functions</h3>
    <hr />
    <a href="new_recipe.php">Add a new recipe</a> <br />
</div>