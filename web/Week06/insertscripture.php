
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
    <title>Insert a scripture</title>
</head>
<body>
    <h1>Insert Scripture</h1>
    <hr />
    <h2>Insert:</h2>
    <form action="display-books.php" method="POST">
        Book: <input type="text" name="book" /> <br />
        Chapter: <input type="text" name="chapter" /> <br />
        Verse: <input type="text" name="verse" /> <br />
        Content: <textarea name="content" ></textarea> <br />
        <?php
        foreach ($db->query('SELECT * FROM Topics') as $row) {
            echo $row["topicname"] . " - <input type='checkbox' name=";
            echo $row["topicname"] . " /><br />";
        }
        ?>
        <button type="submit">Insert!</button>
    </form>
    <hr />
</body>
</html>