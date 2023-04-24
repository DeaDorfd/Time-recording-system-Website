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
	$name = $_POST['name'];
    $person = $_POST['worker'];
	$result = mysqli_query($con, "SELECT * FROM projekts WHERE name='$name'");
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO projekts (name, time, persons)
					VALUES ('$name', '0', '$person')";
			$result = mysqli_query($con, $sql);
			if ($result) {
				$name = "";
				$person = "";
                header("Location: ../");
			} else {
				echo "<script>alert('Etwas ist schiefgelaufen')</script>";
			}
		} else {
			echo "<script>alert('Dieses Projekt gibt es bereits')</script>";
            header("Location: ../");
		}
}

$membersQuery = mysqli_query($conn, "SELECT * FROM users");
$members = array();
if(mysqli_num_rows($membersQuery) > 0){
    while($row = mysqli_fetch_assoc($membersQuery)){
        $members[] = $row;
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
    <title>Projekt erstellen</title>
</head>
<body>
<header>
    <nav class="nav custom-nav">    
    <a class="nav-link" href="/index.php">Home</a>
    <a class="nav-link" href="/members">Mitarbeiter</a>
    <a class="nav-link" href="/projekte">Projekte</a>
    <a class="nav-link" href="logout.php">Logout</a>
    </nav> 
</header>
    <div class="forms">
        <h1>Projekt erstellen</h1>
    <form name="form" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Projekt-Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="md-3">
            <label for="validationCustom04" class="form-label">Wähle einen Arbeiter</label>
            <select class="form-select" id="validationCustom04" name="worker" required>
            <?php
                if(count($members) > 0){
                    foreach($members as $member){
                ?>
                <option value=<?=$member['username']?>><?=$member['username']?></option>
                <?php
                    }
                }
            ?>
            </select>
        </div>
        <br>
        <button class="btn btn-outline-secondary" name="submit">Projekt erstellen</button> <br>
    </form>
    </div>
</body>
</html>