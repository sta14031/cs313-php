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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="recipe.css" />
    <script src="../jquery-3.3.1.min.js"></script>
    <title>New Recipe</title>
</head>
<body>
    <script type="text/javascript">
    <?php
    // Get the list of all ingredients
    echo "var ingredients = [";
    foreach ($db->query("SELECT * FROM Ingredients ORDER BY IngredientName") as $row) {
        echo "['" . $row["ingredientid"] . "', '";
        echo $row["ingredientname"] . "'], "; // Javascript is fine with trailing comma
    }
    echo "];\n";
    ?>

    function populate(num) {
        var str = "";
        for (i = 0; i < num; i++) {
            str = str + "<select name='ingredients[]'>";
            ingredients.forEach(function(ing, i) {
                str = str + "<option value='" + ing[0];
                str = str + "'>" + ing[1] + "</option>";
            });
            str = str + "</select> Amount: ";
            str = str + "<input type='text' name='measurements[]' /><br />";
        }
       $("div#ingredient_select").html(str);
    }

    // After the document is loaded, populate the first input
    $(document).ready(function(){
        populate(1);
        $("input#numIngredients").change(function(){
            populate($("input#numIngredients").val());
        });
    });
    </script>
    <h1>Add a new recipe</h1>
    <hr />

    <?php require("navbar.php"); ?>

    <div id="container">
        <?php require("sidebar.php"); ?>
        
        <form action="create_recipe.php" method="POST">
            <table>
                <tr><td>Name:</td><td colspan=2><input type="text" name="recipeName" /></td></tr>
                <tr><td>Preparation time:</td><td><input type="number" class="numInput" name="prepTime" /></td><td>minutes</td></tr>
                <tr><td>Skill level:</td><td colspan=2><select name="skill">
                <?php
                foreach ($db->query("SELECT * FROM SkillLevel") as $row) {
                    echo "<option value='" . $row["levelid"];
                    echo "'>" . $row["skillname"] . "</option>\n";
                }
                ?>
                </select></td></tr>
                <tr><td>Type of recipe:</td><td colspan=2><select name="recipeType">
                <?php
                foreach ($db->query("SELECT * FROM RecipeTypes") as $row) {
                    echo "<option value='" . $row["typeid"];
                    echo "'>" . $row["typename"] . "</option>\n";
                }
                ?>
                </select></td></tr>
            </table> <br />

        Number of ingredients: <input id="numIngredients" class="numInput" type="number" min="1" value="1" /> <br />
        <div id="ingredient_select">
            
        </div>
        
        Instructions:<br /><textarea name="methods" rows="15" cols="80"></textarea> <br />
        <button type="submit">Create new recipe!</button>
        </form>
    </div>
</body>
</html>