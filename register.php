<?php
  ob_start();
  session_start();
  $title = "Register";
  include 'includes/header.php';
  include 'includes/functions.php';

  $db = db_connect();

  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $name = mysqli_real_escape_string($db, $_POST["name"]);
  $password = mysqli_real_escape_string($db, $_POST["password"]);
  $passwordConfirm = mysqli_real_escape_string($db, $_POST["passwordConfirm"]);
  //  $password = password_hash($password, PASSWORD_DEFAULT);
  $submit = $_POST["submit"];

  if (!empty($submit)) {
    if (($password == $passwordConfirm) && ($email != "")) {

      // Check to see if username is unique:

      $sql = "SELECT email FROM users WHERE email='$email'";
      $result = $db->query($sql);

      if ($result->num_rows == 0) {


        // encrypt the password

        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
        //Save to database
        $sql = "INSERT INTO users (id, email, name, password) VALUES  (NULL, '$email', '$name', '$encryptedPassword')";
        $result = $db->query($sql);


        //Add sessions, the ob_clean, and redirect to top page.

        $_SESSION["email"] = $email;
        $_SESSION["name"] = $name;

        ob_clean();
        header("Location: /");
      } else {
        $error_msg = "Email already exists in our database.";
      }
    } else {
      $error_msg = "Passwords don't match or you didn't enter an email.";
    }
  }
?>
  <!-- Main Wrapper -->
				<div id="main-wrapper">
					<div class="wrapper style2">
						<div class="inner">
							<div class="container">
  <?php
  $reg_form = <<<END_OF_FORM

          <h1>Register</h1>
          <p class="red">$error_msg</p>
          <form method="post" action="register.php">
            <p>Enter Email Address:</p>
            <input type="email" name="email" value="$email"><br/>
            <p>Enter Name:</p>
            <input type="text" name="name" value="$name"><br/>
            <p>Enter Password:</p>
            <input type="password" name="password"><br/>
            <p>Confirm Password:</p>
            <input type="password" name="passwordConfirm"><br/>
            <input type="submit" name="submit" value="Register">
          </form> 
END_OF_FORM;
  echo $reg_form;

  ?>
              </div>
            </div>
          </div>
        </div>


  include 'includes/footer.php';
  ob_end_flush();
?>
