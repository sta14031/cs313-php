<?php
    session_start();
    require("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="recipe.css" />
    <script src="../jquery-3.3.1.min.js"></script>
    <title>Sign Up | Recipe Book</title>
</head>
<body>
<script type="text/javascript">
$(document).ready(function(){

});

function validate() {
    if ($("input[name='password'").val()
     == $("input[name='passwordConfirm'").val())
        return true;
    else
    {
        $(".error").show();
        return false;
    }
}
</script>

    <h1>Sign up</h1>
    <hr />
    <div id="container">
        <div id="content">
        <form action="create_user.php" onsubmit="return validate()">
        <table>
            <tr><td>Name:</td><td><input type="text" name="username" /></td></tr>
            <tr><td><span class="error">* Passwords do not match.</span>
            Password:</td><td><input type="password" name="password" /></td></tr>
            <tr><td>Confirm Password:</td><td><input type="password" name="passwordConfirm" /></td></tr>
            <tr><td colspan="2"><button type="submit">Register</button></td></tr>
        </table>
        </form>
        </div>
    </div>
</body>
</html>