<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: recipe_home.php");
die();