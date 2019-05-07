<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../assignments.css">
    <title>Results</title>
</head>
<body>
<h1>Your data:</h1>
<div>
<?php
$name = $_POST["name"];
$email = $_POST["email"];
$major = $_POST["major"];
$continents = $_POST["continent"];
$comment = $_POST["comment"];

$continentDictionary = array(
    "na" => "North America",
    "sa" => "South America",
    "eu" => "Europe",
    "as" => "Asia",
    "au" => "Australia",
    "af" => "Africa",
    "an" => "Antarctica",
    "0" => "None"
);

echo "Name: $name<br />Email: <a href='mailto:$email'>$email</a><br />Major: $major<br />";

if (!empty($continents))
{
    echo "Visited continents:<br />";
    foreach($continents as $continent)
    {
        echo " - ";
        echo $continentDictionary[$continent];
        echo "<br />";
    }
}

echo "Comment: $comment<br />";

?>
</div>
</body>
</html>