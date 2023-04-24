<?php
include 'config.php';
include 'lib.php';

error_reporting(0);

session_start();
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email']; 
	$password = mySha256($_POST['password']);
    $rpassword = mySha256($_POST['rpassword']);
    if($password != $rpassword) {
        echo "<script>alert('Passwörter sind nicht gleich')</script>";
    }
		$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND username='$username'");
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password, Admin)
					VALUES ('$username', '$email', '$password', '0')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Du hast dich erfolgreich Registiert')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
			} else {
				echo "<script>alert('Etwas ist schiefgelaufen')</script>";
			}
		} else {
			echo "<script>alert('Diese Email oder diesen BenutzerNamen gibt es schon')</script>";
		}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registieren</title>
    <link rel="stylesheet" href="CSS/signup.css">
</head>
<body>
    <div class= "box">
        <span class="borderLine"></span>
        <form method="POST">
            <h2>Registieren</h2>
            <div class= "inputbox">
                <input type="text" required="required" name="username">
                <span>BenutzerName</span>
                <i></i>
            </div>
            <div class= "inputbox">
                <input type="email" required="required" name="email">
                <span>Email</span>
                <i></i>
            </div>
            <div class= "inputbox">
                <input type="password" required="required" name="password">
                <span>Passwort</span>
                <i></i>
            </div>
            <div class= "inputbox">
                <input type="password" required="required" name="rpassword">
                <span>Passwort Wiederholen</span>
                <i></i>
            </div>
            <div class="links">
                <a href="#">Passwort Vergessen?</a>
                <a href="signin.php">Login</a>
            </div>
            <input type="submit" name="submit" value="Registieren">
        </form>
    </div>
</body>
</html>