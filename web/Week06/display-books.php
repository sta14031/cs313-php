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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../assignments.css">
    <title>Books</title>
</head>
<body>
    <h1>Search results</h1>
    <hr />
    <table>
    <?php
    $book = $_POST["book"];
    foreach ($db->query("SELECT * FROM Scriptures WHERE book = '$book'") as $row) {
        echo "<tr><td><b>" . $row['book'] . " " . $row["chapter"] . ":";
        echo $row["verse"] . "</b></td><td>-</td><td>\"" . $row['content'] . "\"</td></tr>\n";
    }
    ?>
    </table>
    <a href="team_activity_05.php">Back to scripture resources</a>
</body>
</html>