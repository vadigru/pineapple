<?php 
  $servername = "sql189.main-hosting.eu";
  $username = "u758486942_pinea";
  $password = "P4ssw@rd";
  $dbname = "u758486942_pinea";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error($conn));
  }
?>
