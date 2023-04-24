<?php
include 'config.php';
include 'lib.php';

session_start();

if (isset($_SESSION['username'])) {
  header("Location: index.php");
}
error_reporting(0);

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = mySha256($_POST['password']);

	$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: index.php");
	} else {
		echo "<script>alert('Email oder Passwort ist Falsch.')</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/signin.css">
</head>
<body>
    <div class= "box">
        <span class="borderLine"></span>
        <form method="POST">
            <h2>Login</h2>
            <div class= "inputbox">
                <input type="email" required="required" name="email">
                <span>Email</span>
                <i></i>
            </div>
            <div class= "inputbox">
                <input type="password" required="required" name="password">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="#">Passwort Vergessen?</a>
                <a href="signup.php">Registieren</a>
            </div>
            <input type="submit" name="submit" value="Login">
        </form>

    </div>
</body>
</html>