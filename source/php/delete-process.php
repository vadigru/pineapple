<?php
include "db.php";
$sql = "DELETE FROM subscribers WHERE id='" . $_GET["id"] . "'";

if (mysqli_query($conn, $sql)) {
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  }
  if ($_GET['sort'] === '') {
    $sort_value = 'date';
  } else {
    $sort_value = $_GET['sort'];
  }
  if ($_GET['value'] === '') {
    header("Location:index.php?page=$page&sort=$sort_value");
  } else {
    $filter_value = $_GET['value'];
    header("Location:index.php?page=$page&sort=$sort_value&value=$filter_value");
  }

} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
