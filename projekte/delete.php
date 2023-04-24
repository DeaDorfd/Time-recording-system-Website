<?php

include '../config.php';

    $name = $_GET['q'];
    $sql = "DELETE FROM projekts WHERE name = '$name'";
	$result = mysqli_query($con, $sql);
?>