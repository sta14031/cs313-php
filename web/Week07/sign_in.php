<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <title>Sign in</title>
</head>
<body>
    <h1>Enter your credentials:</h1>
    <div class="small">
        <form action="welcome.php" method="POST">
        <table>
            <tr><td>Name:</td><td><input type="text" name="username" /></td></tr>
            <tr><td>Password:</td><td><input type="text" name="password" /></td></tr>
            <tr><td colspan="2"><button type="submit">Log in</button></td></tr>
        </table>
        </form>
    </div>
</body>
</html>