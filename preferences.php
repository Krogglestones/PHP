<?php
  ob_start();
  $title = "Preferences";
  include 'includes/header.php';
  include 'includes/functions.php';

?>

<!-- Main Wrapper -->
<div id="main-wrapper">

  <?php

    $submit = $_POST["submit"];
    $db = db_connect();


    $first_name = mysqli_real_escape_string($db, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($db, $_POST["last_name"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $newsletter = mysqli_real_escape_string($db, $_POST["newsletter"]);

    echo "<h1>Fill out the form to subscribe to emails</h1>";
    $found_error = false;
    if (empty($first_name)) {
      echo "<p>Please enter a first name</p>";
      $found_error = true;
    }

    if (empty($last_name)) {
      echo "<p>Please enter a last name</p>";
      $found_error = true;
    }

    if (empty($email)) {
      echo "<p>Please enter an email address</p>";
      $found_error = true;
    }


    if (!$found_error) {

      $sql = "INSERT INTO `preferences` (`id`, `first_name`, `last_name`, `email`, `newsletter` )
              VALUES (NULL,  '$first_name', '$last_name' , '$email', 1 )";
      echo "SQL: $sql<br/>";
      $result = $db->query($sql);
      echo "updated";
      ob_clean();
      header("Location: blog_list.php");
    }

    $form = <<<END_OF_FORM
  <form method="POST" action="/preferences.php">
    First Name: <input type="text" name="first_name" value="$first_name"><br/>
    Last Name: <input type="text" name="last_name" value="$last_name"><br/>
    Email: <input type="email" name="email" value="$email"><br/>
    <input type="hidden" name="newsletter"><br/>
    
    <input type="submit" name="submit" value="SUBSCRIBE" />
  </form>
END_OF_FORM;
    echo $form;

  ?>

</div>

<?php
  include 'includes/footer.php';
  ob_end_flush();
?>
