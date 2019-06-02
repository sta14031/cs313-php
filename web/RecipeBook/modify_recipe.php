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

$recipeId = $_POST['recipeId'];
$stmt = $db->prepare("SELECT * FROM Recipes WHERE RecipeId = $recipeId");
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
    <script src="../jquery-3.3.1.min.js"></script>
    <title>Modify a Recipe</title>
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
    <h1>Modify a recipe</h1>
    <hr />

    <div id="container">
        <?php require("sidebar.php"); ?>
        
        <form action="update_recipe.php" method="POST">
            <input type="hidden" name="recipeId" value="<?php echo $recipeId; ?>" />
            <table>
                <tr><td>Name:</td><td colspan=2><input type="text" name="recipeName" value='<?php
                    echo $recipe["recipename"];
                ?>' /></td></tr>
                <tr><td>Preparation time:</td><td><input type="number" value='<?php
                    echo $recipe["preptime"];
                ?>' class="numInput" name="prepTime" /></td><td>minutes</td></tr>
                <tr><td>Skill level:</td><td colspan=2><select name="skill">
                <?php
                $stmt = $db->prepare("SELECT SkillName FROM SkillLevel WHERE LevelId = " . $recipe["skill"]);
                $stmt->execute();
                $skill = $stmt->fetch(PDO::FETCH_ASSOC);

                foreach ($db->query("SELECT * FROM SkillLevel") as $row) {
                    echo "<option value='" . $row["levelid"] . "'";
                    if ($skill["skillname"] == $row["skillname"]) {
                        echo " selected";
                    }
                    echo ">" . $row["skillname"] . "</option>\n";
                }
                ?>
                </select></td></tr>
                <tr><td>Type of recipe:</td><td colspan=2><select name="recipeType">
                <?php
                $stmt = $db->prepare("SELECT TypeName FROM RecipeTypes WHERE TypeId = " . $recipe["recipetype"]);
                $stmt->execute();
                $typeName = $stmt->fetch(PDO::FETCH_ASSOC);

                foreach ($db->query("SELECT * FROM RecipeTypes") as $row) {
                    echo "<option value='" . $row["typeid"] . "'";
                    if ($type["typename"] == $row["typename"]) {
                        echo " selected";
                    }
                    echo ">" . $row["typename"] . "</option>\n";
                }
                ?>
                </select></td></tr>
            </table> <br />

        Number of ingredients: <input id="numIngredients" class="numInput" type="number" min="1" value="<?php
            $stmt = $db->prepare("SELECT COUNT(*) FROM (SELECT * FROM Recipes_Ingredients ri WHERE ri.RecipeId = $recipeId) src");
            $stmt->execute();
            $count = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $count["count"];
        ?>" /> <br />
        <div id="ingredient_select">
            <?php
            $ings = $db->query("SELECT * FROM Ingredients ORDER BY IngredientName");

            foreach($db->query("SELECT ri.IngredientId, ri.Measurement, i.IngredientName FROM Recipes_Ingredients ri LEFT JOIN
                        Recipes r ON ri.RecipeId = r.RecipeId LEFT JOIN
                        Ingredients i ON ri.IngredientId = i.IngredientId
                        WHERE ri.RecipeId = $recipeId") as $row)
            {
                echo "<select name='ingredients[]'>";
                foreach($ings as $ing) {
                    echo "<option value='" . $ing['ingredientid'] . "'";
                    if ($row['ingredientname'] == $ing['ingredientname']) {
                        echo " selected";
                    }
                    echo ">" . $ing['ingredientname'] . "</option>";
                }
                echo "</select> Amount: <input type='text' ";
                echo "name='measurements[]' value='";
                echo $row['measurement'] . "/><br />\n";
            }
            ?>
        </div>
        
        Instructions:<br /><textarea name="methods" rows="15" cols="80"><?php
            echo $recipe["methods"];
        ?></textarea> <br />
        <button type="submit">Apply changes</button>
        </form>
    </div>
</body>
</html>