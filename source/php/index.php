<?php
include "db.php";
include "pagination.php";
include "search.php";
include "filter.php";

global $filter_label;
global $sort_label;
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
      <th><?php echo '<a href="index.php?page=' . $page . '&sort=id">Id</a>' ?></th>
      <th><?php echo '<a href="index.php?page=' . $page . '&sort=email">Email</a>' ?></th>
      <th><?php echo '<a href="index.php?page=' . $page . '&sort=date">Date</a>' ?></th>
      <th><?php echo '<a href="index.php?page=' . $page . '&sort=time">Time</a>' ?></th>
      <th></th>
    </tr>

    <?php
      if (isset($_GET['value'])) {
        $filter_label = $_GET['value'];
      }
      if (isset($_GET['sort'])) {
        $sort_label = $_GET['sort'];
      }
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td align="center"><?php echo $row["id"] ?></td>
            <td align="center"><?php echo $row["email"] ?></td>
            <td align="center"><?php echo $row["date"] ?></td>
            <td align="center"><?php echo $row["time"] ?></td>
            <td>
            <?php echo '<a href="delete-process.php?sort=' . $sort_label .
              '&value=' . $filter_label .
              '&page=' . $page .
              '&id=' . $row["id"] .
              '"><button>X</button></a>' ?>
            </td>
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
                echo '<a href="index.php?page=' . $page .
                '&sort=' . $sort .
                '">' . $page . '</a>'."&nbsp;";
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
