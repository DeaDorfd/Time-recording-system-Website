<?php

include '../../config.php';
include '../../lib.php';

session_start();

$Name = $_SESSION['username'];
if (!isset($Name)) {
     header("Location: /html/signin.php");
} else {
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$Name'");
if (!$result->num_rows > 0) {
    session_destroy();
    header("Location: /html/signup.php");
    }
}

if (isset($_POST['submit'])) {
    $rang = $_POST['rangs'];
    $isadmin = "";
    if($rang === "admin") {$isadmin = 1;} else {$isadmin = 0;}
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = mySha256($_POST['password']);
		$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password, Admin)
					VALUES ('$username', '$email', '$password', '$isadmin')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Du hast dich erfolgreich Registiert')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
                header("Location: /members");
			} else {
				echo "<script>alert('Etwas ist schiefgelaufen')</script>";
			}
		} else {
			echo "<script>alert('Diese Email gibt es bereits')</script>";
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="create.css">
    <title>Mitarbeiter</title>
</head>
<body>
<header>
    <nav class="nav custom-nav">    
    <a class="nav-link" href="/index.php">Home</a>
    <a class="nav-link" href="/members">Mitarbeiter</a>
    <a class="nav-link" href="/projekte">Projekte</a>
    <a class="nav-link" href="/logout.php">Logout</a>
    </nav>
</header>
    <div class="forms">
        <h1>Teammitglied einstellen</h1>
    <form name="form" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Benutzer-Name</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Adresse</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Passwort</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="md-3">
            <label for="validationCustom04" class="form-label">Position</label>
            <select class="form-select" id="validationCustom04" name="rangs" required>
                <option value="worker">Mitarbeiter</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
        <br>
        <button class="btn btn-outline-secondary" name="submit">Account erstellen</button> <br>
    </form>
    </div>
</body>
</html>