<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "login";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Fehlgeschlagen.')</script>");
}

$database1 = "projekts"; 
$con = mysqli_connect($server, $user, $pass, $database1);

if (!$con) {
    die("<script>alert('Connection Fehlgeschlagen.')</script>");
}
?>