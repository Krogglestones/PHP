<?php

  // -------------------------------------------------------------------------
  // NOTE: I didn't escape these because they're not connected to a database.
  // I couldn't use the $db as the 1st argument since there is no db connection.
  // --------------------------------------------------------------------------

  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $question = $_POST["question"];
  $submit = $_POST["submit"];
  $contact = $_POST["contact"];
  $products = array("Baseballs", "Footballs", "Basketballs");
  $product = $_POST["product"];
  $newsletter = $_POST["newsletter"];
  $new_stuff = $_POST["new_stuff"];
  $email_me = $_POST["email_me"];

  if (!empty($submit) && empty($email)) {
    echo "<h3>Please enter an email address</h3>";
  }

  if (!empty($submit) && empty($name)) {
    echo "<h3>Please enter a name</h3>";
  }

  if ($newsletter == "subscribed") {
    $subscribed = 'checked="checked"';
  } else {
    $subscribed = '';
  }

  if ($new_stuff == "notified") {
    $notified = 'checked="checked"';
  } else {
    $notified = '';
  }

  echo "NAME:  $name<br/>";
  echo "EMAIL: $email<br/>";
  echo "PHONE: $phone<br/>";
  echo "QUESTION:  $question<br/>";
  echo "CONTACT:  $contact<br/>";
  echo "PRODUCT:  $product<br/>";
  echo "NEWSLETTER? $newsletter<br/>";
  echo "NEW STUFF NOTIFICATIONS? $new_stuff<br/>"

?>

<div>

  <form action="contactus.php" method="post" class="form_style">

    <label for="name">Name:</label><input type="text" name="name" class="inner_style" id="name"
                                          value="<?php echo $name ?>"><br/>
    <label for="email">Email:</label><input type="email" name="email" class="inner_style" id="email"
                                            value="<?php echo $email ?>"><br/>
    <label for="phone">Phone:</label><input type="tel" name="phone" id="phone" class="inner_style"
                                            value="<?php echo $phone ?>"><br/>
    <label for="question">Question:</label><br/>
    <textarea name="question" placeholder="Enter your question here" class="inner_style"
              id="question"><?php echo $question ?></textarea>
    <label for="email_contact">Contact by email:</label>
    <input type="radio" name="contact" value="email" id="email_contact"<?php echo $contact ?>>
    <label for="phone_contact">Contact by phone:</label>
    <input type="radio" name="contact" value="phone" id="phone_contact"<?php echo $contact ?>>
    <label for="products">Select an item from the drop-down to learn more:</label>
    <?php
      echo '<select name="product" id="products" class="inner_style" >';
      $count = 0;
      while ($count < count($products)) {
        echo "<option";
        if ($product == $products[$count]) {
          echo " selected='selected'";
        }
        echo ">";
        echo $products[$count];
        echo "</option>";
        $count = $count += 1;
      }
      echo '</select>';
    ?>

    <br/>

    <label for="newsletter">Subscribe to Newsletter:</label><input type="checkbox" name="newsletter" value="subscribed"
                                                                   id="newsletter"<?php echo $subscribed ?>><br/>
    <label for="new_stuff">Notified about new stuff:</label><input type="checkbox" name="new_stuff" value="notified"
                                                                   id="new_stuff"<?php echo $notified ?>><br/>

    <input type="submit" name="submit" value="send" id="submit"><br/>


    <?php
      $form_data = <<<END_OF_DATA
        NEW USER QUESTION:
        NAME:  $name
        EMAIL:  $email
        PHONE NUMBER:  $phone
        QUESTION:  $question
        PREFERRED CONTACT METHOD:  $contact
        WHICH PRODUCT THEY'RE INTERESTED IN:  $product
        SUBSCRIBE TO NEWSLETTER?  $newsletter
        GET NOTIFIED ABOUT NEW STUFF?  $new_stuff
        
END_OF_DATA;

      $thank_you_message = <<<END_OF_THANKS

      Thank you for your interest in our products.  We will get back to you shortly.

END_OF_THANKS;


      if (!empty ($submit)) {
        $to = $email;
        $subject = "Thank you";
        $headers = "From: info@phpdev.craiglarsonsoftware.com\r\n";
        $message = $thank_you_message;
        $sent = mail($to, $subject, $message, $headers);
      }

      if (!empty($submit)) {
        $to2 = "info@phpdev.craiglarsonsoftware.com";
        $subject2 = "New Data";
        $headers2 = "From: info@phpdev.craiglarsonsoftware.com\r\n";
        $headers2 .= "BCC: dave.jones@scc.spokane.edu\r\n";
        $message2 = $form_data;
        $sent2 = mail($to2, $subject2, $message2, $headers2);
      }
    ?>
  </form>

</div>
