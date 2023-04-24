<?php

include '../config.php';

    $name = $_GET['q'];
    $sql = "DELETE FROM users WHERE username = '$name'";
	$result = mysqli_query($conn, $sql);
?>