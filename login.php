<?php
  ob_start();
  session_start();
  $title = "Login - Logout";
  include 'includes/header.php';
  include 'includes/functions.php';

  $db = db_connect();

  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $password = mysqli_real_escape_string($db, $_POST["password"]);
  //  $password = password_hash($password, PASSWORD_DEFAULT);
  $submit = $_POST["submit"];


  if (!empty($submit)) {

    $sql = "SELECT * FROM users WHERE email='$email'"; // AND password='$password'";
    $result = $db->query($sql);
    list($id, $email, $name, $encrypted_password) = $result->fetch_row();

    if (password_verify($password, $encrypted_password)) {
      echo "You are the man!!!";
      $_SESSION{"email"} = $email;
      ob_clean();
      header("Location: /");
    } else {
      $_SESSION{"email"} = "";
      $error_msg = "Unknown Credentials -Try Again";
    }

  }
//  echo password_hash("42424242", PASSWORD_DEFAULT);

?>

<!-- Main Wrapper -->
<div id="main-wrapper">
  <div class="wrapper style2">
    <div class="inner">
      <div class="container">
        <div id="content">

          <?php echo "Welcome: {$_SESSION['email']}"; ?>
          <?php

            $login_form = <<<END_OF_FORM

          <h1>LOG IN</h1>
          <p class="red">$error_msg</p>
          <form method="post" action="login.php">
            <p>Enter Email Address:</p>
            <input type="email" name="email" value="$email"><br/>
            <p>Enter Password:</p>
            <input type="password" name="password"><br/>
            <input type="submit" name="submit" value="Login"><br/><br/>
          </form> 
END_OF_FORM;
            echo $login_form;
          ?>

<!--          <p>Not registered? <a href="register.php">Click here to register!!!</a></p>-->

        </div>
      </div>
    </div>
  </div>
</div>

<?php

  include 'includes/footer.php';
  ob_end_flush();
?>
