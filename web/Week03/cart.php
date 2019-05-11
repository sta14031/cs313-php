<?php
session_start();

$cart = [];
foreach ($_POST["cart"] as $item) {
    array_push($cart, $item);
    array_push($_SESSION["cart"], $item);
}

// Read the file to get all the prices
$fileVar = fopen("shop.json", "r");
$fileJson = fread($fileVar, filesize("shop.json"));
fclose($fileVar);

$itemPrices = json_decode($fileJson);

function getPriceOfItem($itemName) {
    foreach ($GLOBALS['itemPrices'] as $itemPrice) {
        if ($itemPrice[0] == $itemName) {
            return $itemPrice[1];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="shop.css">
    <script src="../jquery-3.3.1.min.js"></script>
    
    <script type="text/javascript">
    function removeItem(item) {
        $("tr." + (item.replace(/ /g, '')).replace(/,/g, "")).hide();
        // Remove the variable from the session
        $.ajax({
            method:'post',
            url:'remove_session.php',
            data: {'varName': item}
        });
    }
    </script>

    <title>Your cart</title>
</head>
<body>
    <h1>Your items for purchase</h1>
    <hr /> <br />

    <div id="content">
        <table>
        <tr><th>Item Name</th><th>Price</th><th></th></tr>
        <?php
        foreach ($cart as $item) {
            echo "<tr class='";
            // Strip out commas and spaces from the item name
            echo str_replace(' ', '', 
                    str_replace(',', '', $item));
            echo "'><td>$item</td><td>\$";
            echo getPriceOfItem($item);
            echo "</td><td><button type='button' onclick='removeItem(\"$item\")'>";
            echo "Remove</button></tr>\n";
        }
        ?>
        </table>
    </div>

    <br />
    <a href="shop.php">Go back to the shop</a>
    <a href="checkout.php">Continue to checkout</a>
</body>
</html>