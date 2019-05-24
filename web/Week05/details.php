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
    <title>Scripture Details</title>
</head>
<body>
    <h1>Your scripture:</h1>
    <hr />
    <?php
    $id = $_GET["id"];
    // This should not be a for loop since there will only ever be
    // one scripture with the given ID. However I do not know
    // yet how to do it any other way.
    foreach ($db->query("SELECT * FROM Scriptures WHERE id = '$id'") as $row) {
        echo "<b>" . $row['book'] . " " . $row["chapter"] . ":";
        echo $row["verse"] . "</b> - \"" . $row['content'] . "\"</td></tr>\n";
    }
    ?>
    <br />
    <a href="team_activity_05.php">Back to scripture resources</a>
</body>
</html>