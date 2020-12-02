<?php
    if (isset($_POST['search'])) {
        $search_term = mysqli_real_escape_string($conn, $_POST['search-box']);
        $sql = "SELECT * FROM subscribers WHERE  CONCAT(id, ' ',
        email, ' ',
        date, ' ',
        time, ' ',
        provider) LIKE '%$search_term%'";
        $result = mysqli_query($conn, $sql) or die ('SQL error occured: '.mysqli_error($conn));
    }
?>
