<?php
include "db.php";
$sql = "DELETE FROM subscribers WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    echo "<script>
            window.setTimeout(function() {
                self.location = 'index.php';
            }, 1500);
          </script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
