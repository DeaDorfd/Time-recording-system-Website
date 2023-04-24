<?php

include 'config.php';

session_start();
$Name = $_SESSION['username'];
if (!isset($Name)) {
     header("Location: signin.php");
} else {
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$Name'");
if (!$result->num_rows > 0) {
    session_destroy();
    header("Location: signup.php");
    }
}

$projektsQuery = mysqli_query($con, "SELECT * FROM projekts");
$projekts = array();
if(mysqli_num_rows($projektsQuery) > 0){
    while($row = mysqli_fetch_assoc($projektsQuery)){
        $projekts[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/interface.css">
</head>
<body>
<header>
<nav class="nav custom-nav">
  <a class="nav-link active" href="">Home</a>
  <a class="nav-link" href="/members">Mitarbeiter</a>
  <a class="nav-link" href="/projekte">Projekte</a>
  <a class="nav-link" href="logout.php">Logout</a>
</nav>
</header>
  <div name="content">
  <ul class="nav justify-content-center">
    <li class="nav-item">
      <a class="nav-link active" onclick="erfassung(1)" id="zeit">Zeitraum</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" onclick="erfassung(2)" id="time">Dauer</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" onclick="erfassung(3)" id="uhr">Stoppuhr</a>
    </li>
  </ul>
    <div id="stoppuhr" style="display: none;">
      <br>
      <div style="font-size: 25px;">
        <span id="tage">0</span> Tage,
        <span id="stunden">0</span> Stunden,
        <span id="minuten">0</span> Minuten,
        <span id="sekunden">0</span> Sekunden
      </div>
      <br>
      <div class="md-3">
            <label for="validationCustom04" class="form-label">Wähle ein Projekt</label>
            <select class="form-select" id="validationCustom04" name="projekts" required>
          <?php
              if(count($projekts) > 0){
                  foreach($projekts as $projekt){
              ?>
              <option value=<?=$projekt['name']?> style="font-family: 'Poppins', serif;"><?=$projekt['name']?></option>
              <?php
                  }
              }
          ?>
          </select>
      </div>
      <br>
      <button class="btn btn-outline-secondary" onclick="stoppuhr.start();">Start</button>
      <button class="btn btn-outline-secondary" onclick="stoppuhr.stop();">Stop</button>
      <button class="btn btn-outline-secondary" onclick="stoppuhr.clear();">Zurücksetzten</button>
      <br><br>
    </div>
    <div id="Zeitraum">
      <form action="" method="POST">
      <div class="mb-3">
            <label for="von" class="form-label">Von</label>
            <input type="time" class="form-control timeinput" value="09:00" id="von" name="von" onchange="timeChange()">
      </div>
      <div class="mb-3">
            <label for="bis" class="form-label">Bis</label>
            <input type="time" class="form-control timeinput" value="17:00" id="bis" name="bis" onchange="timeChange()">
      </div>
      <div class="md-3">
            <label for="validationCustom04" class="form-label">Wähle ein Projekt</label>
            <select class="form-select" id="validationCustom04" name="projekts" required>
          <?php
              if(count($projekts) > 0){
                  foreach($projekts as $projekt){
              ?>
              <option value=<?=$projekt['name']?>><?=$projekt['name']?></option>
              <?php
                  }
              }
          ?>
          </select>
      </div>
      <br>
      <button class="btn btn-outline-secondary" name="submit"> <span id="erfassenbutton"></span> erfassen</button>
      </form>
    </div>
    <div id="Dauer" style="display: none;">
      <div class="mb-3">
            <label for="dauer" class="form-label">Start</label>
            <input type="time" class="form-control timeinput" value="08:00" id="dauer" name="dauer" onchange="dauerChange()">
      </div>
      <div class="md-3">
            <label for="validationCustom04" class="form-label">Wähle ein Projekt</label>
            <select class="form-select" id="validationCustom04" name="projekts" required>
          <?php
              if(count($projekts) > 0){
                  foreach($projekts as $projekt){
              ?>
              <option value=<?=$projekt['name']?>><?=$projekt['name']?></option>
              <?php
                  }
              }
          ?>
          </select>
      </div>
      <br>
      <button class="btn btn-outline-secondary" name="submit"> <span id="dauerbutton"></span> erfassen</button>
    </div>
    <script src="/JS/Stopuhr.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </div>
</body>
</html>