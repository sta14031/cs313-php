<?php

$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$topics = $_POST["topic"];

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

$stmt = $db->prepare(
    "INSERT INTO Scriptures (book, chapter, verse, content) VALUES "
    . "($book, $chapter, $verse, $content);");
$stmt->execute();

foreach ($topics as $topic) {
    $stmt = $db->prepare(
        "INSERT INTO ScriptureTopic (scripture, topics) VALUES "
        . "(SELECT id FROM Sciptures WHERE "
        . "book=$book AND chapter=$chapter AND verse=$verse"
        . "), " . $topic["id"]);
    $stmt->execute();
}

?>