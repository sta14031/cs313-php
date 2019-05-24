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

echo "<ul>\n";
$table = $_GET["table"];
$column = $_GET["column"];
$query = strtolower($_GET["query"]);

$results = $db->query("SELECT * FROM $table WHERE $column LIKE '%$query%'");

if (empty($results)) {
    echo "Nothing found matching that search! Please try again.";
} else {
    foreach ($results as $row) {
        echo "<li>" . $row[$column] . "</li>\n";
    }
    echo "</ul>";
}
`
?>