<?php
session_start();
$cart;

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
} else {
    $GLOBALS["cart"] = $_SESSION["cart"];
    $_SESSION["cart"] = [];
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
    <title>E-Shop</title>
</head>
<body>
    <script type="text/javascript">
    $(document).ready(function(){
        // Sorting items by category
        $("#filter").change(function(){
            if ($("#filter").val() == "all") {
                $("div.item").show();
            } else {
                $("div.item").hide();
                $("div." + $("#filter").val()).show();
            }
        });

        // Make sure at least one checkbox is checked before submitting
        $("form").submit(function(){
            if ($('div.item :checkbox:checked').length > 0) {
                return true;
            } else {
                alert("Please select something to buy.");
                return false;
            }
        });
    });
    </script>

    <h1>Browse the online store</h1>
    <hr /> <br />

    <div id="content">
        Filter items: <select id="filter">
            <option value="all">All</option>
            <option value="food">Food</option>
            <option value="appliance">Appliances</option>
            <option value="misc">Other</option>
        </select>
        <form action="cart.php" method="POST">
            <div id="items">
                <?php
                // Read the data from file
                $fileVar = fopen("shop.json", "r");
                $fileJson = fread($fileVar, filesize("shop.json"));
                fclose($fileVar);

                $items = json_decode($fileJson);
                foreach($items as $item)
                {
                    echo "<div class='item $item[2]'><br />";
                    echo "<input type='checkbox' name='cart[]' value='$item[0]' ";

                    // Countermeasure to stop a strange error
                    if (!is_array($GLOBALS["cart"])) {
                        $GLOBALS["cart"] = [];
                    }

                    if (in_array($item[0], $GLOBALS["cart"])) {
                        echo "checked ";
                    }
                    echo "/>$item[0]<br />\$$item[1]</div>\n";
                }
                ?>
            </div>

            <button type="submit">Add to cart</button><br />
        </form>
    </div>
</body>
</html>