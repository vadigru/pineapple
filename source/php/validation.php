<?php
  $validationErr = "";
  $validation = "";
  $email = "";
  $checkbox = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["checkbox"])) {
      $validationErr = "You must accept the terms and conditions";
    } else {
      $checkbox = test_input($_POST["checkbox"]);
    }

    if (empty($_POST["email"])) {
      $validationErr = "Email address is required";
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationErr = "Please provide a valid e-mail address";
      }
      if (substr($email, -3) === '.co') {
        $validationErr = "We are not accepting subscriptions from Colombia emails";
      }
    }

    if (!$validationErr) {
      $validation = 'ok';
      echo '<script>
              console.log("working");
              window.setTimeout(function() {
                  self.location = "php/index.php";
              }, 1500);
            </script>';

      echo '<noscript>
        <meta http-equiv="refresh" content="0;url=php/index.php">
      </noscript>';
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
