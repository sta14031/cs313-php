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
    <title>Scriptures</title>
</head>
<body>
    <h1>Scripture Resources</h1>
    <hr />
    <h2>Search for a book:</h2>
    <form action="display-books.php" method="POST">
        Book: <input type="text" name="book" />
        <button type="submit">Search!</button>
    </form>
    <hr />
    <?php
    foreach ($db->query('SELECT * FROM Scriptures') as $row) {
        echo "<a href='details.php?id=" . $row['id'] . "'>";
        echo $row['book'] . " " . $row["chapter"] . ":";
        echo $row["verse"] . "</a><br />\n";
    }
    ?>
</body>
</html>