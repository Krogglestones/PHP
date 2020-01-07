<?php

  ob_start();
  //$title = "Blogs";
  include 'includes/header.php';
  include 'includes/functions.php';

?>

  <!-- Main Wrapper -->
  <div id="main-wrapper">

    <?php

      //  $id = $_GET["id"];
      $submit = $_POST["submit"];
      $db = db_connect();


      $author = mysqli_real_escape_string($db, $_POST["author"]);
      $date_posted = mysqli_real_escape_string($db, $_POST["date_posted"]);
      $blog_text = mysqli_real_escape_string($db, $_POST["blog_text"]);
      $blog_title = mysqli_real_escape_string($db, $_POST["title"]);

      //format so the db will like it.
      //    $date_posted = $date_posted->format("Y-m-d H:i:s");
      //$created_at = $created_at->format("Y-m-d H:i:s");
      //  $created_at = date_create();
      //  $created_at = $created_at->format("Y-m-d H:i:s");
      $found_error = false;
      if (empty($blog_title)) {
        $title_error = "Title is required";
        $found_error = true;
      }
      if (empty($author)) {
        $author_error = "Author is required";
        $found_error = true;
      }
      if (empty($blog_text)) {
        $text_error = "Text is required";
        $found_error = true;
      }
      if (!$found_error) {

//    $created_at = date_create();
//    $created_at = $created_at->format("Y-m-d H:i:s");

        $sql = "INSERT INTO `blogs` (`blog_id`, `author`, `date_posted`, `blog_text`, `blog_title` ) VALUES (NULL,  '$author', NOW() , '$blog_text', '$blog_title')";
        echo "SQL: $sql<br/>";
        $result = $db->query($sql);
        echo "updated";
        ob_clean();
        header("Location: blog_list.php?id=$db->insert_id");
      }

      $form = <<<END_OF_FORM
  <form method="POST" action="/blog_new.php">
    <a href="/blog_list.php">BACK TO LIST</a><br/><br/>
    AUTHOR: <input type="text" name="author" value="$author"><span class="red">$author_error</span><br/>
    TEXT: <input type="text" name="blog_text" value="$blog_text"><span class="red">$text_error</span><br/>
    TITLE: <input type="text" name="title" value="$blog_title"><span class="red">$title_error</span><br/>
  
    <!--DATE POSTED: <input type="datetime-local" name="date_posted" value="$date_posted"><br/>-->
    
    
    <input type="submit" name="submit" value="ADD" />
  </form>
END_OF_FORM;
      echo $form;

      $sql = "SELECT * FROM preferences WHERE newsletter=1";

      $result2 = $db->query($sql);
      //  print_r($result2);
      if (!empty($submit)) {
        while (list($id, $first_name, $last_name, $email, $newsletter) = $result2->fetch_row()) {
//    echo $email . "<br/>";

          $message = <<<END_OF_MESSAGE
	Hello $first_name,
	Here is the latest blog:

	AUTHOR:  $author
	
	TITLE: $blog_title
	
	BLOG: $blog_text
END_OF_MESSAGE;

          $to = $email;
          $subject = "New Blog: $blog_title";
          $headers = "From: info@phpdev.craiglarsonsoftware.com\r\n";
          $sent = mail($to, $subject, $message, $headers);
        }
      }

    ?>
  </div>
<?php


  include 'includes/footer.php';
  ob_end_flush();
?>