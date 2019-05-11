<?php
session_start();

$cart = [];
foreach ($_SESSION["cart"] as $item) {
    array_push($cart, $item);
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

// Strip special characters from user input
// Legal characters are letters, numbers, spaces, and hyphens.
foreach ($_POST as $key=>$input) {
    $_POST[$key] = preg_replace("/[^a-zA-Z0-9\- ]/", "", $input);
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
    function placeOrder() {
        alert("Order successfully placed!");
        // If this was a real application, we would do something else here
        $.ajax({
            method:'post',
            url:'clear_session.php',
            success: function(){
                window.location.href = "./shop.php";
            }
        });
    }

    function cancelOrder() {
        alert("Order successfully cancelled.");
        $.ajax({
            method:'post',
            url:'clear_session.php',
            success: function(){
                window.location.href = "./shop.php";
            }
        });
    }

    </script>

    <title>Confirm your purchase</title>
</head>
<body>
    <h1>Review your purchase</h1>
    <hr /> <br />

    <div id="content">
        <table>
            <tr><th>Item Name</th><th>Price</th></tr>
            <?php
            $totalPrice = 0.0;
            foreach ($cart as $item) {
                echo "<tr><td>$item</td><td>\$";
                $price = getPriceOfItem($item);
                $totalPrice += floatval($price);
                echo "$price</td></tr>\n";
            }
            ?>
            <tr id="total"><td>Total:</td>
            <td>$<?php echo number_format($totalPrice, 2, '.', ''); ?></td></tr>
        </table>

        <table class="address">
            <tr><th colspan="2">Billing information</th></tr>
            <tr><td>Address:</td><td>
            <?php
            echo $_POST["address"];
            if ($_POST["aptNum"] != "") {
                echo " #" . $_POST["aptNum"];
            }
            ?>
            </tr><tr><td></td><td>
            <?php echo($_POST["city"] . ", " . strtoupper($_POST["state"]) . " " . $_POST["zip"]); ?>
            </td></tr>
        </table>

    </div>

    <br />
    <button type="button" onclick="cancelOrder();">Cancel order</a>
    <button type="button" onclick="placeOrder();">Place order</a>

    <div id="error"></div>
</body>
</html>