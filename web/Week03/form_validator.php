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

// Defining variables to use later
    $name = $_POST["name"];
    $email = $_POST["email"];
    $major = $_POST["major"];
    $comment = $_POST["comment"];


echo("Name: $name<br />Email: $email<br />Major: $major<br />Comment: $comment<br />");

?>
</div>
</body>
</html>