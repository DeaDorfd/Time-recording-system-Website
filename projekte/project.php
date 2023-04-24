<?php

include '../config.php';
include '../lib.php';

session_start();
$nameurl = $_GET['q'];
$result1 = mysqli_query($con, "SELECT * FROM projekts WHERE name='$nameurl'");
if (!$result1->num_rows > 0) {
    header("Location: notexist.html");
}

$row1 = mysqli_fetch_assoc($result1);
$mitglied = $row1['persons'];


$Name = $_SESSION['username'];
if (!isset($Name)) {
     header("Location: /html/signin.php");
} else {
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$Name'");
  $row = mysqli_fetch_assoc($result);
  $admin = $row['Admin'];
  if (!$result->num_rows > 0) {
    session_destroy();
    header("Location: /html/signup.php");
  } else {
      if(!$admin) {
        header("Location: /");
      }
  }
}

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
    $person = $_POST['worker'];
    $delete = mysqli_query($con, "DELETE FROM projekts WHERE name = '$nameurl'");
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
    <link rel="stylesheet" type="text/css" href="create/create.css">
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
        <h1>Projekt bearbeiten</h1>
    <form name="form" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Projekt-Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$nameurl?>" required>
        </div>
        <div class="md-3">
            <label for="validationCustom04" class="form-label">Wähle einen Arbeiter</label>
            <select class="form-select" id="validationCustom04" name="worker" required>
            <option value=<?=$mitglied?>><?=$mitglied?></option>
            <?php
                if(count($members) > 0){
                    foreach($members as $member){
                        if($member['username'] != $mitglied) {
                ?>
                <option value=<?=$member['username']?>><?=$member['username']?></option>
                <?php
                        }
                    }
                }
            ?>
            </select>
        </div>
        <br>
        <button class="btn btn-outline-secondary" name="submit">Projekt bearbeiten</button> <br>
    </form>
    </div>
</body>
</html>