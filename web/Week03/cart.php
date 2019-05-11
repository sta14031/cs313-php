<?php
session_start();
if (!isset($_SESSION["cart"])) {
    echo "Is not set";
    $_SESSION["cart"] = [];
}

$cart = [];
foreach ($_POST["cart"] as $item) {
    array_push($cart, $item);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="shop.css">
    <!--<script src="jquery-3.3.1.min.js"></script>-->
    <title>Confirm your purchase</title>
</head>
<body>
    <h1>Review your purchase</h1>
    <hr /> <br />

    <div id="content">
        <table>
        <tr><th>Item Name</th><th>Quantity</th></tr>
        <?php
        foreach ($cart as $item) {
            echo "<tr><td>$item</td><td>";
            echo "<input type='number' class='quantity' value='1' />";
            echo "</td></tr>\n";
        }
        ?>
    </div>
</body>
</html>