<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="shop.css">
    <title>Checkout</title>
</head>
<body>
    <h1>Enter your billing information</h1>
    <hr /> <br />

    <form action="confirm.php" method="POST">
        <div id="address">
            Address: <input type="text" name="address" size="30" required />
            Apt number: <input type="text" name="aptNum" size="4" /> <br />
            City: <input type="text" name="city" size="30" required />
            State: <input type="text" name="state" size="2" maxlength="2" required />
            Zip: <input type="text" name="zip" size="5" required />
        </div>
        <br />
        <button type="submit">Continue</button>
    </form>
</body>
</html>