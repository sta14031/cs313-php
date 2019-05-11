<?php
session_start();

// Remove the given variable name from the session
$_SESSION["cart"] = array_diff($_SESSION["cart"], [$_POST["varName"]]);
?>