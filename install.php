<?php

include 'config.php';

    $sql = "CREATE TABLE IF NOT EXISTS users(ID INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, username VARCHAR(255), email VARCHAR(255), password VARCHAR(255), Admin BOOLEAN)";
	$result = mysqli_query($conn, $sql);
    if($result) {
        echo "<h1>Users wurde erfolgreich erstellt</h1>";
    } else {
        echo "<h1> Etwas ist schief gelaufen</h1>";
    }

    include 'config.php';

    $sql1 = "CREATE TABLE IF NOT EXISTS projekts(ID INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, name VARCHAR(255), time VARCHAR(255), persons VARCHAR(255))";
	$result1 = mysqli_query($con, $sql1);
    if($result1) {
        echo "<h1>Projekts wurde erfolgreich erstellt</h1>";
    } else {
        echo "<h1> Etwas ist schief gelaufen</h1>";
    }

?>