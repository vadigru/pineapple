<?php
include "db.php";
include "sort.php";
include "pagination.php";
include "search.php";
include "filter.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pineapple - subscribers list</title>
</head>
<body>
  <table border="0" width="100%">
    <tr>
      <td align="right">
        <form name="search_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <input type="text" name="search-box"/>
          <input type="submit" name="search" value="Search...">
        </form>
      </td>
    </tr>
    <tr>
      <td align="right">
      <?php
        if (mysqli_num_rows($filter_result ) > 0) {
            $domain_array = array();
            while($wor= mysqli_fetch_array($filter_result )) {
              $user_email = $wor["email"];
              $domain = explode('@', $user_email);
              $domain = explode('.', $domain[1]);
              array_push($domain_array,  $domain[0]);
            }
            $unique_domains = array_unique($domain_array);
          }
        foreach ($unique_domains as $value) {
      ?>
        <a href="index.php?value=<?php echo $value; ?>"><button><?php echo $value; ?></button></a>
    <?php
      }
    ?>
    </td>
    </tr>
  </table>
  <hr>
  <table border="0" width="100%">
    <tr>
      <th><?php echo '<a href="index.php?id=id">Id</a>' ?></th>
      <th><?php echo '<a href="index.php?id=email">Email</a>' ?></th>
      <th><?php echo '<a href="index.php?id=date">Date</a>' ?></th>
      <th><?php echo '<a href="index.php?id=time">Time</a>' ?></th>
      <th></th>
    </tr>

    <?php
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td align="center"><?php echo $row["id"] ?></td>
            <td align="center"><?php echo $row["email"] ?></td>
            <td align="center"><?php echo $row["date"] ?></td>
            <td align="center"><?php echo $row["time"] ?></td>
            <td><a href="delete-process.php?id=<?php echo $row["id"]; ?>"><button>X</button></a></td>
          </tr>
          <?php
        }
      } else {
        echo "0 results";
      }
    ?>
  </table>
  <hr>
  <table width="100%">
    <tr>
      <td align="center">
      <?php

          for ($page = 1; $page <= $number_of_pages; $page++) {
            echo '<a href="index.php?page='.$page.'&id='.$id.'">'.$page.'</a>'."&nbsp;";
              }
            mysqli_close($conn);
      ?>
      </td>
    </tr>
  </table>
  <hr>
  </br>
  <div?><a href="../index.php">back to subscribe page</a></div>
</body>
</html>
