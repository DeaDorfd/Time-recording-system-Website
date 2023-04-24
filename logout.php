<?php

session_start();

session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body style="background: gray; text-align: center; font-family: 'Poppins', sans-serif; font-size: 20px;">
    <div style="display: inline-block;">
        <h1>Du wurdest erfolgreich ausgeloggt</h1>
        <a href="signin.php" style="color: black;">Zurück zum Login</a>
    </div>
</body>
</html>