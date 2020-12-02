<?php
    $sql = "SELECT * FROM subscribers";
    $filter_result = mysqli_query($conn, $sql) or die ('SQL error occured: '.mysqli_error($conn));
    if (isset($_GET['value'])) {
      $filter_value = $_GET['value'];
      $sql = "SELECT * FROM subscribers WHERE provider LIKE '$filter_value'";
      $result = mysqli_query($conn, $sql) or die ('SQL error occured: '.mysqli_error($conn));
  }
?>