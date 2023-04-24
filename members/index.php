<?php
include '../config.php';

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

$membersQuery = mysqli_query($conn, "SELECT * FROM users");
$members = array();
if(mysqli_num_rows($membersQuery) > 0){
    while($row = mysqli_fetch_assoc($membersQuery)){
        $members[] = $row;
    }
}
function Projekts($name) {
    include '../config.php';
    $membersQuery = mysqli_query($con, "SELECT * FROM projekts WHERE persons='$name'");
    $members = array();
    if(mysqli_num_rows($membersQuery) > 0){
      while($row = mysqli_fetch_assoc($membersQuery)){
          $members[] = $row;
          if(count($members) > 0){
            foreach($members as $member){
              return $member['name']; 
            }
          }
       }
    } else {
      return "Keins";
    }
}

if (isset($_POST['submit'])) {
  $rang = $_POST['rangs'];
  $isadmin = "";
  if($rang === "admin") {$isadmin = 1;} else {$isadmin = 0;}
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = mySha256($_POST['password']);
  $sql = "DELETE FROM users WHERE username = '$name'";
  $delete = mysqli_query($conn, $sql);
  $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND username='$username'");
  if (!$result->num_rows > 0) {
    $sql = "INSERT INTO users (username, email, password, Admin)
        VALUES ('$username', '$email', '$password', '$isadmin')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $username = "";
      $email = "";
      $_POST['password'] = "";
              header("Location: /members");
    } else {
      echo "<script>alert('Etwas ist schiefgelaufen')</script>";
    }
  } else {
    echo "<script>alert('Diese Email oder Benutzer-Name wurde bereits verwendet')</script>";
  }
}

function Infos($info, $name) {
  include '../config.php';
  $membersQuery = mysqli_query($conn, "SELECT * FROM users WHERE username='$name'");
  $members = array();
  if(mysqli_num_rows($membersQuery) > 0){
    while($row = mysqli_fetch_assoc($membersQuery)){
        $members[] = $row;
        if(count($members) > 0){
          foreach($members as $member){
            return $member[$info]; 
          }
        }
     }
  } else {
    return "Error";
  }
}

$result1 = mysqli_query($conn, "SELECT * FROM users WHERE username='$Name'");
$row1 = mysqli_fetch_assoc($result1);
$admin = $row1['Admin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/CSS/members.css">
    <title>Mitarbeiter</title>
</head>
<body>
<header>
<nav class="nav custom-nav">
  <a class="nav-link" href="/index.php">Home</a>
  <a class="nav-link active" href="">Mitarbeiter</a>
  <a class="nav-link" href="/projekte">Projekte</a>
  <a class="nav-link" href="/logout.php">Logout</a>
</nav>
</header>
    <section id="members">
      <?php  if($admin) {?>
    <svg xmlns="http://www.w3.org/2000/svg" class="svg" onclick="Move()" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#027f88" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
      <?php }?>
      <h1>Mitarbeiter: </h1>    
    <table>
        <tbody>
        <div class="row m-b">
        <?php
        if(count($members) > 0){
            foreach($members as $member){
                ?>
                <div class="col-sm-4">
      <div class="box" style="border-radius: 5px;">
        <div class="box-header" style="font-family: 'Poppins', serif; font-size: 20px;">
          <h3><?=$member['username']?></h3>
          <small><?=$member['email']?></small>
        </div>
        <?php if($admin) {?>
        <div class="box-tool">
          <ul class="nav">
            <li class="nav-item inline">
              <a class="nav-link">
              <i data-toggle="modal" data-target="#delete" class="material-icons md-18">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="font-size: 2rem; color: black;" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg>
              </i>
                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Löschen des Benutzers</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Bist du dir sicher das du den benutzer löschen möchtest?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Abrechen</button>
                      <button type="button" class="btn btn-primary" onclick="DeleteUser('<?=$member['username']?>')">Löschen</button>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </li>
            <li class="nav-item inline dropdown">
              <a class="nav-link">
                <i onclick="EditUser('<?=$member['username']?>')" class="material-icons md-18">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                </svg>
                </i>
              </a>
            </li>
          </ul>
        </div>
        <?php }?>
        <div class="box-body" style="font-family: 'Poppins', serif; font-size: 20px;">
          <p class="m-0">Projekt: <?=Projekts($member['username'])?></p>
          <p class="m-0">Rang: <?php if($member['Admin']){echo "Administrator";}else{echo "Mitarbeiter";} ?></p>
        </div>
      </div>
    </div>
            <?php
            }
        }
            ?>
            </div>
        </tbody>
    </table>
    </section>
  </div>
    <script>
      function DeleteUser(str) {
        if (str == "") {
          return;
        }
        var xhr = new XMLHttpRequest;
        xhr.onreadystatechange=function(){
          if (xhr.readyState === 4 && xhr.status ===200) {
              var new_window = window.location.href = "";
              new_window.document.write(xhr.responseText);
            }
        }
        xhr.open("GET","delete.php?q="+str,true);
        xhr.send();
      }
      function Move() {
        window.location.href = "create";
      }
      function EditUser(str) {
        if(str == "") {
          return;
        }
        window.location.href = "user.php?q="+str;
      }
    </script>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>