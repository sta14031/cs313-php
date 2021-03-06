<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="recipe.css" />
    <script src="../jquery-3.3.1.min.js"></script>
    <title>Search Ingredients</title>
</head>
<body>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#search").click(function(){
            $.ajax({ url: "search.php",
                data: {
                    "table": "users",
                    "column": "username",
                    "query": $("input[name='username']").val()
                },
                success: function(result){
                    $("div#results").html(result);
                }
            });
        });
    });
    </script>

    <h1>Search Recipes</h1>
    <hr />

    <div id="container">
        <?php require("sidebar.php"); ?>
        
        <div id="content">
            Enter the name of a user:
            <input type="text" name="username" /> <br />
            <button type="button" id="search">Search!</button>
            <div id="results"></div>
        </div>
    </div>
</body>
</html>