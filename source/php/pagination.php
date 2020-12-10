<?php
  global $page;

  $sql = "SELECT * FROM subscribers ORDER by date DESC";
  $result = mysqli_query($conn, $sql) or die ('SQL error occured: '.mysqli_error($conn));
  $number_of_results = mysqli_num_rows($result);
  $results_per_page = 10;
  $number_of_pages = ceil($number_of_results / $results_per_page);

  if (!isset($_GET['page'])) {
      $page = 1;
  } else {
      $page = $_GET['page'];
  }
  if (!isset($_GET['sort'])) {
    $sort = 'date';
  } else {
    $sort = $_GET['sort'];
  }
  $this_page_first_result = ($page - 1) * $results_per_page;
  $sql = "SELECT * FROM subscribers ORDER by $sort ASC LIMIT
      $this_page_first_result
      ,
      $results_per_page";
  $result = mysqli_query($conn, $sql) or die ('SQL error occured: '.mysqli_error($conn));
?>
