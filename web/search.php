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

$table = $_GET["table"];
$column = $_GET["column"];
$query = strtolower($_GET["query"]);

// Sanitize query
$query = preg_replace("/[^a-zA-Z0-9\ ]/", "", $query);

$results = $db->query("SELECT * FROM $table WHERE $column ILIKE '%$query%'");

if ($results->rowCount() == 0) {
    echo "<p>Nothing found matching that search! Please try again.</p>";
} else {
    echo "<ul>\n";

    if ($table == "recipes") {
        echo "<li><a href='view_recipe.php?recipe=" . $row["RecipeId"];
        echo ">" . $row[$column] . "</a></li>";

    } else {
        foreach ($results as $row) {
            echo "<li>" . $row[$column] . "</li>\n";
        }
    }
    echo "</ul>";
}

?>