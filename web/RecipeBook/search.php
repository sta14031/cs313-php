<?php

require("db.php");

$table = $_GET["table"];
$column = $_GET["column"];
$query = strtolower($_GET["query"]);

// Sanitize query
$query = preg_replace("/[^a-zA-Z0-9\ ]/", "", $query);

$results = $db->query("SELECT * FROM $table WHERE $column ILIKE '%$query%' ORDER BY $column");

if ($results->rowCount() == 0) {
    echo "<p>Nothing found matching that search! Please try again.</p>";
} else {
    echo "<ul>\n";

    if ($table == "recipes") {
        foreach ($results as $row) {
            echo "<li><a href='view_recipe.php?recipe=" . strval($row["recipeid"]);
            echo "'>" . $row[$column] . "</a></li>\n";
        }

    } else {
        foreach ($results as $row) {
            echo "<li>" . $row[$column] . "</li>\n";
        }
    }
    echo "</ul>";
}

?>